import collections
import os
import librosa
from pydub import AudioSegment
from tqdm import tqdm
import numpy as np
from python_speech_features import mfcc, fbank, logfbank
import pickle
from annoy import AnnoyIndex
import time

start_time = time.time()

# # Mở file và xây dựng cây index
train_filefeatures=open('../public/Search_ANN/file_train/train_features.pk','rb')
train_filesongs=open('../public/Search_ANN/file_train/train_songs.pk','rb')

train_features = pickle.load(train_filefeatures)
train_songs = pickle.load(train_filesongs)
#
f = 120
u = AnnoyIndex(f,metric='angular')
u.load('../public/Search_ANN/music.ann')

dochinhxac=0

search_filefeatures=open('../public/storage/uploads_client/feat_search.pk','rb')
search_filesongs=open('../public/storage/uploads_client/song_search.pk','rb')

search_features = pickle.load(search_filefeatures)
search_songs = pickle.load(search_filesongs)

results=[]

for i in range(0, len(search_features)):
    result = u.get_nns_by_vector(search_features[i], n=5)
    result_songs = [train_songs[k][9:] for k in result]
    results.append(result_songs)


results = np.array(results).flatten()
from collections import Counter

most_song = Counter(results)
songs=[]
for i in range(0,20):
    songs.append(most_song.most_common()[i][0])


print(songs)
