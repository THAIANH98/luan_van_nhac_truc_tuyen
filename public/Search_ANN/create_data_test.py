import os
import librosa
from tqdm import tqdm
import numpy as np
from python_speech_features import mfcc, fbank, logfbank
import pickle
import time

start_time = time.time()

def extract_features(y, sr=16000, nfilt=12, winsteps=0.02):
    try:
        feat = mfcc(y, sr, nfilt=nfilt, winstep=winsteps)
        return feat
    except:
        raise Exception("Extraction feature error")


def crop_feature(feat, i = 0, nb_step=10, maxlen=120):
    crop_feat = np.array(feat[i : i + nb_step]).flatten()
    crop_feat = np.pad(crop_feat, (0, maxlen - len(crop_feat)), mode='constant')
    return crop_feat


data = '../public/storage/uploads_client/song/'
for song in tqdm(os.listdir(data)):
    song = os.path.join(data, song)
    y ,sr = librosa.load(song,sr=16000)
    feat = extract_features(y)


test_songs=[]
test_features=[]

for i in range(0, feat.shape[0], 5):
    test_features.append(crop_feature(feat, i, nb_step=10))
    test_songs.append(song)

pickle.dump(test_features, open('../public/storage/uploads_client/feat_search.pk', 'wb'))

pickle.dump(test_songs, open('../public/storage/uploads_client/song_search.pk', 'wb'))


end_time = time.time()
elapsed_time = end_time - start_time

print(feat.shape)
