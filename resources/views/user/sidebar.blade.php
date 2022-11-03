
<div  id="box_left_user">
    <div id="box-img-avatar">
        <img id="img_user" height="150px" width="150px" style="margin-bottom: 10px">
    </div>
    <ul>
        <li><a href="/user/info/{{$user->id}}" id="info_user" style="font-size: 16px;font-weight: bold" class="active">Quản lý tài khoản</a></li>
        <li> <a style="color:#ff0000;font-size: 16px;font-weight: bold">Quản lý bài hát</a>
            <ul>
                <li>
                    <a href="/user/song/{{$user->id}}" id="song_user" class="">
                        Thêm bài hát</a>
                </li>
                <li>
                    <a href="/user/list_song/{{$user->id}}" id="list_song_user" class="">
                        Danh sách bài hát
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a style="color:#ff0000;font-size: 16px;font-weight: bold">Quản lý Playlist</a>
            <ul>
                <li>
                    <a href="/user/playlist/{{$user->id}}" id="playlist_user" class="">Thêm Playlist</a>
                </li>
                <li>
                    <a href="/user/list_playlist/{{$user->id}}" id="list_playlist_user" class="">
                        Danh sách Playlist

                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
    console.log(location.href)
    info_user = document.getElementById('info_user');
    song_user = document.getElementById('song_user');
    list_song_user = document.getElementById('list_song_user');
    list_playlist_user = document.getElementById('list_playlist_user');
    song_user = document.getElementById('song_user');
    playlist_user = document.getElementById('playlist_user');
    if (location.href.indexOf('list_playlist')>0){
        info_user.style.color = '#ff0000';
        info_user.classList.remove("active");
        song_user.classList.remove("active");
        playlist_user.classList.remove("active");
        list_song_user.classList.remove("active");
        list_playlist_user.className = playlist_user.className.replace('',"active")
    }
    else if(location.href.indexOf('playlist')>0){
        info_user.classList.remove("active");
        info_user.style.color = '#ff0000';
        song_user.classList.remove("active");
        playlist_user.className = playlist_user.className.replace('',"active")
    } else if(location.href.indexOf('list_song')>0) {
        console.log(location.href.indexOf('list_song'));
        song_user.classList.remove("active");
        playlist_user.classList.remove("active");
        info_user.classList.remove("active");
        info_user.style.color = '#ff0000';
        list_song_user.className = list_song_user.className.replace('',"active")
    }else if(location.href.indexOf('song')>0){
        info_user.classList.remove("active");
        info_user.style.color = '#ff0000';
        playlist_user.classList.remove("active");
        song_user.className = song_user.className.replace('',"active")
    }else if(location.href.indexOf('info')>0) {
        song_user.classList.remove("active");
        playlist_user.classList.remove("active");
        list_song_user.classList.remove("active");
        list_playlist_user.classList.remove("active");
        info_user.className = song_user.className.replace('',"active")
    }else {
        console.log('ok')
    }
    $ava = sessionStorage.getItem('avatar');
    document.getElementById('img_user').src = $ava;
</script>

