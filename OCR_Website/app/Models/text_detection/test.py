from transformers import pipeline
corrector = pipeline("text2text-generation", model="bmd1905/vietnamese-correction")
final_pred= corrector("Công hiên xã hội chủ nghĩa Viết. Nóm",max_new_tokens=70)
print(final_pred)