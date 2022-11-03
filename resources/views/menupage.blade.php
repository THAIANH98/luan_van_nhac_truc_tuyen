@extends('main')

@section('content')
    <div class="media media-tab">
        <div class="media-left">
            <h2 class="media-title"><b style="color: #007efc"  >Nhạc {{$title}}</b> </h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-9">
            <nav id="navmenu">
                <ul>
                    <li id="bai-hat-moi" class="tab-current"><a onclick="categoryTab('album-moi','bai-hat-moi')" class="bai-hat-moi" href="#"><span>Bài Hát mới</span></a></li>
                    <li id="album-moi" class=""><a onclick="categoryTab('bai-hat-moi','album-moi')" class="album-moi" href="#"><span>Playlist mới</span></a></li>
                </ul>
            </nav>
            <br>
            <div id="songpage" style="display: block">
                @include('menu.songpage')
            </div>
            <div id="playlistpage" style="display: none">
                @include('menu.playlistpage')
            </div>

        </div>
        <div class="col-md-3" style="height: 1059px">
            @include('bxh')
        </div>
    </div>

    <script>
        function categoryTab(tabrm,tabcr){
            let elementrm= document.getElementById(tabrm);
            let elementcr= document.getElementById(tabcr);
            elementrm.classList.remove("tab-current");
            elementcr.className = elementcr.className.replace('',"tab-current")
            if(tabcr=='bai-hat-moi'){
                document.getElementById('songpage').style.display = 'block';
                document.getElementById('playlistpage').style.display = 'none';
            }
            else   {
                document.getElementById('songpage').style.display = 'none';
                document.getElementById('playlistpage').style.display = 'block';
            }
        }
    </script>

    <script>
        @foreach($songs as $song)
        $(document).ready(function(){
            $("#{{$song->id}}").mouseenter(function(){
                document.getElementById('icon{{$song->id}}').style.visibility = 'visible';
            });
        });
        $(document).ready(function(){
            $("#{{$song->id}}").mouseleave(function(){
                document.getElementById('icon{{$song->id}}').style.visibility = 'hidden';
            });
        });
        @endforeach

        @foreach($playlists as $playlistgoiy)
        $(document).ready(function(){
            $("#playlist{{$playlistgoiy->id}}").mouseenter(function(){
                document.getElementById('nen{{$playlistgoiy->id}}').style.display = 'block';
                document.getElementById('icon{{$playlistgoiy->id}}playlist').style.visibility = 'visible';
            });
        });
        $(document).ready(function(){
            $("#playlist{{$playlistgoiy->id}}").mouseleave(function(){
                document.getElementById('nen{{$playlistgoiy->id}}').style.display = 'none';
                document.getElementById('icon{{$playlistgoiy->id}}playlist').style.visibility = 'hidden';
            });
        });
        @endforeach
    </script>
@endsection
