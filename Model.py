import os
import tensorflow.keras.backend as K
from tensorflow.keras.layers import Dense, LSTM, Reshape, BatchNormalization, Input, Conv2D, MaxPool2D, Lambda, Bidirectional, Add, Activation
from tensorflow.keras.models import Model
from tensorflow.keras.activations import relu, softmax
from tensorflow.keras.utils import to_categorical
from tensorflow.keras.callbacks import CSVLogger, TensorBoard, ModelCheckpoint, EarlyStopping, ReduceLROnPlateau
from config_model import *

class CRNNModel:
    def __init__(self, char_list, max_label_len):
        self.char_list = char_list
        self.max_label_len = max_label_len
        self.model = None

    def build_model(self):
        # input with shape of height=32 and width=128
        inputs = Input(shape=(118, 2167, 1))

        # Block 1
        x = Conv2D(64, (3,3), padding='same')(inputs)
        x = MaxPool2D(pool_size=3, strides=3)(x)
        x = Activation('relu')(x)
        x_1 = x

        # Block 2
        x = Conv2D(128, (3,3), padding='same')(x)
        x = MaxPool2D(pool_size=3, strides=3)(x)
        x = Activation('relu')(x)
        x_2 = x

        # Block 3
        x = Conv2D(256, (3,3), padding='same')(x)
        x = BatchNormalization()(x)
        x = Activation('relu')(x)
        x_3 = x

        # Block4
        x = Conv2D(256, (3,3), padding='same')(x)
        x = BatchNormalization()(x)
        x = Add()([x,x_3])
        x = Activation('relu')(x)
        x_4 = x

        # Block5
        x = Conv2D(512, (3,3), padding='same')(x)
        x = BatchNormalization()(x)
        x = Activation('relu')(x)
        x_5 = x

        # Block6
        x = Conv2D(512, (3,3), padding='same')(x)
        x = BatchNormalization()(x)
        x = Add()([x,x_5])
        x = Activation('relu')(x)

        # Block7
        x = Conv2D(1024, (3,3), padding='same')(x)
        x = BatchNormalization()(x)
        x = MaxPool2D(pool_size=(3, 1))(x)
        x = Activation('relu')(x)

        # pooling layer with kernel size (2,2) to make the height/2 #(1,9,512)
        x = MaxPool2D(pool_size=(3, 1))(x)

        # to remove the first dimension of one: (1, 31, 512) to (31, 512)
        squeezed = Lambda(lambda x: K.squeeze(x, 1))(x)

        # bidirectional LSTM layers with units=128
        blstm_1 = Bidirectional(LSTM(512, return_sequences=True, dropout=0.2))(squeezed)
        blstm_2 = Bidirectional(LSTM(512, return_sequences=True, dropout=0.2))(blstm_1)

        # softmax character probability with timesteps
        outputs = Dense(len(self.char_list)+1, activation='softmax')(blstm_2)

        # Model to be used at test time
        self.model = Model(inputs, outputs)

    def compile_model(self):
        labels = Input(name='the_labels', shape=[self.max_label_len], dtype='float32')
        input_length = Input(name='input_length', shape=[1], dtype='int64')
        label_length = Input(name='label_length', shape=[1], dtype='int64')

        def ctc_lambda_func(args):
            y_pred, labels, input_length, label_length = args
            return K.ctc_batch_cost(labels, y_pred, input_length, label_length)

        loss_out = Lambda(ctc_lambda_func, output_shape=(1,), name='ctc')([self.model.output, labels, input_length, label_length])

        self.model = Model(inputs=[self.model.input, labels, input_length, label_length], outputs=loss_out)
        self.model.compile(loss={'ctc': lambda y_true, y_pred: y_pred}, optimizer='adam')
        
    def predict(self, input):
        return self.model.predict(input)
    
    def get_callbacks(self):
        return [
            TensorBoard(
                log_dir='./logs',
                histogram_freq=10,
                profile_batch=0,
                write_graph=True,
                write_images=False,
                update_freq="epoch"
            ),
            ModelCheckpoint(
                filepath=os.path.join('checkpoint_weights.hdf5'),
                monitor='val_loss',
                save_best_only=True,
                save_weights_only=True,
                verbose=1
            ),
            EarlyStopping(
                monitor='val_loss',
                min_delta=1e-8,
                patience=20,
                restore_best_weights=True,
                verbose=1
            ),
            ReduceLROnPlateau(
                monitor='val_loss',
                min_delta=1e-8,
                factor=0.2,
                patience=10,
                verbose=1
            )
        ]
    
    def train(self, inputs, labels, batch_size, epochs, validation_data, verbose):
        model_callbacks = self.get_callbacks()
        self.model.fit(x = inputs,
                       y = labels,
                       batch_size = batch_size,
                       epochs = epochs,
                       validation_data = validation_data,
                       verbose = verbose,
                       callbacks = model_callbacks)

crnn_model = CRNNModel(char_list, max_label_len)
crnn_model.build_model()
crnn_model.compile_model()
crnn_model.model.summary()