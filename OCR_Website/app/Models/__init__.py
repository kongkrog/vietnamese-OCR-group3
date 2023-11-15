from Model import *
import sys
import cv2
import torch
import time

import gradio as gr
from transformers import TrOCRProcessor, VisionEncoderDecoderModel, AutoConfig
from transformers.modeling_outputs import Seq2SeqLMOutput
import requests
from PIL import Image
import pytesseract

class BetterHFTrOCR(VisionEncoderDecoderModel):
    """creates a TrOCR model"""

    def __init__(self, model_path):
        model_ = VisionEncoderDecoderModel.from_pretrained(model_path)

        super().__init__(model_.config)

        self.encoder = model_.encoder
        self.decoder = model_.decoder

    def forward(
        self,
        pixel_values=None,
        decoder_input_ids=None,
        decoder_attention_mask=None,
        encoder_outputs=None,
        past_key_values=None,
        decoder_inputs_embeds=None,
        labels=None,
        use_cache=None,
        output_attentions=None,
        output_hidden_states=None,
        return_dict=None,
        **kwargs,
    ):

        encoder_hidden_states = encoder_outputs['last_hidden_state'] \
                                 if type(encoder_outputs)==dict \
                                 else encoder_outputs[0]

        encoder_attention_mask = None
        
        eos_mask = decoder_input_ids[:, -1] <= self.config.eos_token_id

        # Decode        
        if any(eos_mask) and (decoder_input_ids.shape[1]>1):
            reduced_logits = self.decoder(
                ### compute reduction ###
                input_ids=decoder_input_ids[torch.logical_not(eos_mask), :],
                attention_mask=decoder_attention_mask[torch.logical_not(eos_mask), :],
                encoder_hidden_states=encoder_hidden_states[torch.logical_not(eos_mask), :, :],
                #########################
                encoder_attention_mask=encoder_attention_mask,
                inputs_embeds=decoder_inputs_embeds,
                output_attentions=output_attentions,
                output_hidden_states=output_hidden_states,
                use_cache=use_cache,
                past_key_values=past_key_values,
            ).logits
            
            logits = torch.full((decoder_input_ids.shape[0], decoder_input_ids.shape[1], self.config.decoder.vocab_size), fill_value=self.config.pad_token_id, dtype=reduced_logits.dtype, device=reduced_logits.device)
            logits[torch.logical_not(eos_mask), :, :] = reduced_logits
            logits[eos_mask, :, :] = self.ids_to_logits(decoder_input_ids[eos_mask, 1:], reduced_logits)
        else:
            logits = self.decoder(
                input_ids=decoder_input_ids,
                attention_mask=decoder_attention_mask,
                encoder_hidden_states=encoder_hidden_states,
                encoder_attention_mask=encoder_attention_mask,
                inputs_embeds=decoder_inputs_embeds,
                output_attentions=output_attentions,
                output_hidden_states=output_hidden_states,
                use_cache=use_cache,
                past_key_values=past_key_values,
            ).logits

        return Seq2SeqLMOutput(
          logits=logits,
        )

    def ids_to_logits(self, ids, reduced_logits):
        logits = torch.zeros((ids.shape[0], ids.shape[1]+1, self.config.decoder.vocab_size), dtype=reduced_logits.dtype, device=reduced_logits.device)
        logits[:, -1, 2] = 1 # max_pad_token
        for i in range(ids.shape[1]):
            logits[:, i, ids[:, i]] = 1
        
        return logits



def configure_generation(model, processor, beams=1):
    # model.config.decoder_start_token_id = preprocessor.tokenizer.cls_token_id # only if you're gonna train the model
    model.config.pad_token_id = model.config.decoder.pad_token_id = processor.tokenizer.pad_token_id
    model.config.eos_token_id = model.config.decoder.eos_token_id = processor.tokenizer.sep_token_id
    # make sure vocab size is set correctly
    model.config.vocab_size = model.config.decoder.vocab_size
    # set beam search parameters
    model.config.decoder.early_stopping = True
    model.config.decoder.no_repeat_ngram_size = 3
    model.config.decoder.length_penalty = 2.0
    model.config.decoder.num_beams = beams
    
def process_image(image): 
    # prepare image
    pixel_values = processor(image, return_tensors="pt").pixel_values

    # generate (no beam search)
    generated_ids = model.generate(pixel_values)

    # decode
    generated_text = processor.batch_decode(generated_ids, skip_special_tokens=True)[0]

    return generated_text

def prediction(image_path):
    global processor, model, custom_config
    processor = TrOCRProcessor.from_pretrained("microsoft/trocr-base-handwritten")
    model = BetterHFTrOCR(model_path = "C:/xampp/htdocs/OCR_Website/app/Models/text_detection/checkpoint-3000").to("cpu")
    
    configure_generation(model, processor)
    
    # model.to(device)
    
    Lit = []
    # Set the path to the Tesseract OCR executable
    pytesseract.pytesseract.tesseract_cmd = "C:/xampp/htdocs/OCR_Website/app/Models/text_detection/Tesseract-OCR/tesseract.exe"
    img = cv2.imread(image_path)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

    hImg, wImg, _ = img.shape
    boxes = pytesseract.image_to_data(img)
    temp = ['1', '1', '0', '0', '0', '0', '0', '0', '644', '675', '-1']

    # List to store cropped regions
    cropped_regions = []
    expansion_factor = 5  # You can adjust this value based on your requirement

    for x, b in enumerate(boxes.splitlines()):
        if x != 0:
            b = b.split()
            if int(b[7]) < 5:
                continue

            if float(temp[10]) == -1 and float(b[10]) != -1:
                x1, y1 = max(0, int(b[6]) - expansion_factor), max(0, int(b[7]) - expansion_factor)

            if float(temp[10]) != -1 and float(b[10]) == -1:
                x2 = min(wImg, int(temp[6]) + int(temp[8]) + expansion_factor)
                y2 = min(hImg, int(temp[7]) + int(temp[9]) + expansion_factor)
                # cv2.rectangle(img, (x1, y1), (x2, y2), (0, 0, 255), 1)
                # Crop the region of interest
                cropped_region = img[y1:y2, x1:x2]
                cropped_regions.append(cropped_region)

            if len(b) == 12:
                x, y, w, h = int(b[6]), int(b[7]), int(b[8]), int(b[9])
            temp = b
        if x == 10:
            break

    # Display each cropped region
    for region in cropped_regions:
        image_fromarray = Image.fromarray(region)
        image = image_fromarray.convert("RGB")
        print(process_image(image))
        Lit.append(process_image(image))

    return Lit

if __name__ == "__main__":
    # image_path = sys.argv[1]
    image_path = 'C:/xampp/htdocs/OCR_Website/app/Models/text_detection/Tesseract-OCR/image/dontu2.jpg'
    # prediction(image_path)
    output_data = prediction(image_path)
    output = ' \n'.join(output_data)
    print(output)