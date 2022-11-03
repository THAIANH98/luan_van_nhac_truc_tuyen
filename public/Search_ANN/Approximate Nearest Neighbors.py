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

data_dir="../public/storage/uploads/song/"
train_songs=[]
train_features=[]

for song in tqdm(os.listdir(data_dir)):
    song = os.path.join(data_dir, song)
    y , sr = librosa.load(song, sr=16000)
    feat = extract_features(y)
    for i in range(0, feat.shape[0], 5):
        train_features.append(crop_feature(feat, i, nb_step=10))
        train_songs.append(song)

pickle.dump(train_features, open('../public/Search_ANN/file_train/train_features.pk', 'wb'))

pickle.dump(train_songs, open('../public/Search_ANN/file_train/train_songs.pk', 'wb'))

end_time = time.time()
elapsed_time = end_time - start_time
print (elapsed_time)

namefile= 'create_data_train.txt'
file = open('../public/Search_ANN/Thời gian tiền xử lý dữ liệu/'+namefile,'a',encoding='utf-8')
txt=str(elapsed_time)
file.write("Thời gian " +namefile +': '+txt+'\n')
file.close()

# # Mở file và xây dựng cây index
# train_filefeatures=open('../public/Search_ANN/file_train/train_features.pk','rb')
# train_filesongs=open('../public/Search_ANN/file_train/train_songs.pk','rb')
#
# train_features = pickle.load(train_filefeatures)
# train_songs = pickle.load(train_filesongs)

f = 120
t = AnnoyIndex(f,metric='angular')

for i in range(len(train_features)):
    v = train_features[i]
    t.add_item(i, v)

t.build(f) # 120 trees
t.save('../public/Search_ANN/music.ann')

end_time = time.time()
elapsed_time = end_time - start_time

namefile= 'training.txt'
file = open('../public/Search_ANN/Thời gian train_test/'+namefile,'a',encoding='utf-8')
txt=str(elapsed_time)
file.write("Thời gian tạo " +namefile +' với nfilt = 12: '+txt+'\n')
file.close()

print('OK')

quit()