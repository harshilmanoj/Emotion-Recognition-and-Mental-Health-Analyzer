# Step 1) Imports
import sys
import gtts
import os
import IPython.display as display
import matplotlib.pyplot as plt
import librosa
import speech_recognition as sr

import warnings
warnings.filterwarnings('ignore')

sys.path.append('/content/mer-thesis-app/')
from record_audio import get_audio
from predict_emotion_tf import *


# Step 2) Defining constants
lang = 'en'
dur = 11
emoji_dict = {"happy":"😊", "fear":"😱", "angry":"😡", "sad":"😢", "disgust":"🤮", "shame":"😳", "guilt":"😓", "neutral": "😐"}
NO = 'no'
DEFAULT_SAMPLE_RATE = 16000
output_file = 'output_emotion.mp3'

# Step 3) Model loading
print('Models are being loaded, it will take some time...')

ser_trill_model_iemocap = TRILLSERModel(SER_TRILL_MODEL_IEMOCAP, TRILL_URL, emotions_iemocap, input_length_iemocap, SAMPLING_RATE)
ser_trill_model_ravdess = TRILLSERModel(SER_TRILL_MODEL_RAVDESS, TRILL_URL, emotions_ravdess, input_length_ravdess, SAMPLING_RATE)
mer_electra_trill_model_iemocap = ElectraTRILLMERModel(MER_ELECTRA_TRILL, TRILL_URL, emotions_iemocap, input_length_iemocap, SAMPLING_RATE)

ser_yamnet_model_iemocap = YAMNetSERModel(SER_YAMNET_MODEL_IEMOCAP, YAMNET_URL, emotions_iemocap, input_length_iemocap, SAMPLING_RATE)
ser_yamnet_model_ravdess = YAMNetSERModel(SER_YAMNET_MODEL_RAVDESS, YAMNET_URL, emotions_ravdess, input_length_ravdess, SAMPLING_RATE)
mer_electra_yamnet_model_iemocap = ElectraYAMNetMERModel(MER_ELECTRA_YAMNET, YAMNET_URL, emotions_iemocap, input_length_iemocap, SAMPLING_RATE)

ter_electra_model_iemocap = TERModel(TER_ELECTRA_IEMOCAP, emotions_iemocap)
ter_electra_model_psychexp = TERModel(TER_ELECTRA_PSYCHEXP, emotion_psychexp)

print('Models are loaded!')

# Step 4) Definition of functions
def get_transription(audio_file):
  # use the audio file as the audio source
  r = sr.Recognizer()
  with sr.AudioFile(audio_file) as source:
      audio = r.record(source, duration=dur)  # read the entire audio file
  
  # Resource: https://github.com/Uberi/speech_recognition/blob/master/examples/audio_transcribe.py
  # Recognize speech using Google Speech Recognition
  try:
      text = r.recognize_google(audio, language=lang)
  except sr.UnknownValueError:
      print("Google Speech Recognition could not understand audio")
      return ""
  except sr.RequestError as e:
      print("Could not request results from Google Speech Recognition service; {0}".format(e))
      return ""
  
  return text

def predict_emotion(audio_file, print_intro=True):
  if print_intro:
    print('Welcome to the Multimodal Speech Emotion Recognizer app from audio and text!')
    print('-'*80)
    print('Help:')
    print(' - record a speech and the program will recognize your emotion')

  print('Recognizing emotion...')
  # Recognize the emotion
  text = get_transription(audio_file)

  # TRILL predictions
  ser_trill_iemocap = ser_trill_model_iemocap.predict_emotion(audio_file)
  ser_trill_ravdess = ser_trill_model_ravdess.predict_emotion(audio_file)
  mer_trill_electra = mer_electra_trill_model_iemocap.predict_emotion(text, audio_file)

  # Yamnet predictions
  ser_yamnet_iemocap = ser_yamnet_model_iemocap.predict_emotion(audio_file)
  ser_yamnet_ravdess = ser_yamnet_model_ravdess.predict_emotion(audio_file)
  mer_yamnet_electra = mer_electra_yamnet_model_iemocap.predict_emotion(text, audio_file)

  # TER Electra predictions
  ter_electra_iemocap = ter_electra_model_iemocap.predict_emotion(text)
  ter_electra_psychexp = ter_electra_model_psychexp.predict_emotion(text)

  print('\n' + '='*60)
  print(f'\nYou\'ve said: {text}.\n')
  print("Audio's waveform:")
  plt.figure(figsize=(10,5))
  plt.plot(librosa.load(audio_file)[0])
  plt.title(f'Audio\'s waveform (sample rate {round(DEFAULT_SAMPLE_RATE/1000)}kHz)')
  plt.xlabel('Time')
  plt.ylabel('Amplitude')
  plt.show()
  print('='*60)
  print("Predictions:")
  print('-'*40)

  print('YAMNet models:')
  print(f'Speech Recognition: {mer_yamnet_electra}')

  print('-'*40)

  print('='*60)

  return mer_trill_electra
  audio, sample_rate, audio_file = get_audio()

print('Speech recorded!')
pred_emotion = predict_emotion(audio_file)