@extends('main')

@section('content')
    <style>
        .nav_kq_search {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 15px;
        }


        .nav_kq_search .nav-tabs {
            border: none;
        }
        .nav_kq_search .nav-tabs .nav-item.active, .nav_kq_search .nav-tabs .nav-item:hover {
            color: #007efc;
            border-bottom-color: #007efc;
            font-weight: bold;
        }

        .nav_kq_search .nav-tabs .nav-item {
            text-transform: uppercase;
            font-size: 13px;
            color: #000000;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Bold';
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom-width: 2px;
            width: 330px;
        }

        .topic{
            width: 100%;
            height: 100px;
            border-radius: 20px;
            text-align: center;
            line-height: 90px;
            margin-bottom: 10px;
            font-size: 30px;
            color: white;
            opacity: 0.7;
            filter: alpha(opacity=70);
            font-weight: bold;
        }
    </style>
<br>
<br>
<br>
    <div class="row">
        <div class="col-md-9">
            <nav class="nav_kq_search d-flex align-items-center justify-content-between">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active show" id="nav-song-tab" data-toggle="tab" href="#nav-all" onclick="showsong()" role="tab" aria-controls="nav-all" aria-selected="true"><h5>bài hát</h5></a>
                    <a class="nav-item nav-link" id="nav-album-tab" data-page="page_album" data-toggle="tab" href="#nav-album" onclick="showplaylist()" role="tab" aria-controls="nav-album" aria-selected="false"><h5>playlist</h5> </a>
                    <a class="nav-item nav-link" id="nav-artist-tab" data-page="page_artist" data-toggle="tab" href="#nav-artist" onclick="showsinger()" role="tab" aria-controls="nav-artist" aria-selected="false"><h5>ca sĩ </h5></a>
                </div>
            </nav>

            <div id="search_song" style="display: block">
                @include('Search.search_song')
            </div>
            <div id="search_playlist" style="display: none">
                @include('Search.search_playlist')
            </div>
            <div id="search_singer" style="display: none">
                @include('Search.search_singer')
            </div>
        </div>

        <div class="col-md-3" style="height: 1059px">
            @include('bxh')
        </div>
    </div>

    <script>
        var song = document.getElementById('search_song');
        var playlist = document.getElementById('search_playlist');
        var singer = document.getElementById('search_singer');
        function showsong(){
            song.style.display = 'block';
            playlist.style.display = 'none';
            singer.style.display = 'none';
        }
        function showplaylist(){
            song.style.display = 'none';
            playlist.style.display = 'block';
            singer.style.display = 'none';
        }
        function showsinger(){
            song.style.display = 'none';
            playlist.style.display = 'none';
            singer.style.display = 'block';
        }

    </script>
@endsection
