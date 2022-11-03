@extends('main')

@section('head')
    <style>
        {{--        Tao checkbox switch--}}
        .switch-checkbox {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 17px;
            margin-top: 7px;
            margin-left: 3px;
        }
        .switch-checkbox input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider-check {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider-check:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider-check {
            background-color: #2196F3;
        }
        input:focus + .slider-check {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider-check:before {
            -webkit-transform: translateX(13px);
            -ms-transform: translateX(13px);
            transform: translateX(13px);
        }
        /* Rounded sliders */
        .slider-check.round-check {
            border-radius: 17px;
        }
        .slider-check.round-check:before {
            border-radius: 50%;
        }
        #song-playing{
            border: 1px solid silver;
            padding: 5px 5px;
            color: #999999;
        }
        #song-playing:hover{
            color: #0c84ff;
        }

        .box-playlist{
            max-height: 200px;
            width: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
            margin-bottom: 50px;
        }

        #style-box-playlist::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }

        #style-box-playlist::-webkit-scrollbar-thumb {
            background-color: rgba(96, 92, 92, 0.77);
        }

        #style-box-playlist::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        .box-lyric{
            margin-top: 50px;
            /*margin-bottom: 100px;*/
            border:1px solid rgba(161, 160, 160, 0.58);
            width: 100%;
        }

        .lyric{
            height: 300px;
            overflow: hidden;
        }

        .btn_view_more {
            background: url(https://stc-id.nixcdn.com/v11/images/icon-repeat.png) -15px -409px no-repeat;
            padding: 0px 0 10px 18px;
            color: #2daaed;
            height: 25px;
            float: left;
            line-height: 25px;
            display: block;
        }

        .btn_view_hide {
            background: url(https://stc-id.nixcdn.com/v11/images/icon-repeat.png) -13px -438px no-repeat;
            padding: 0px 0 10px 18px;
            color: #2daaed;
            height: 25px;
            float: left;
            line-height: 25px;
            display: none;
        }

        .box-player{
            height: 155px;
            width: 100%;
            border-radius: 6px;
            background-color: #333;
            justify-content: center;
        }

        .visualizer-container {
            height: 120px;
            width: 100% -2px;
            background-color: #333;
            margin-left: 10px;
            margin-top: 10px;
            right: 0;
            left: 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            text-align: center;
        }

        .visualizer-container__bar {
            display: inline-block;
            opacity: 1;
            filter: alpha(opacity=100);
            background: #3597ff;
            margin: 0 1px;
            width: 5px;
        }

        .controls{
            display: flex;
            /*position: absolute;*/
            /*background-color: silver;*/
            height: 25px;
            text-align: center;
            color: #3597ff;
            bottom: 0;
            align-items: flex-end;
        }

        .play-pause{
            margin-left: 5px;
            color: #3597ff;
        }

        .slider {
            flex-grow: 1;
            background-color: #D8D8D8;
            cursor: pointer;
            z-index: 1;
            position: relative;
            width: 100%;
        }

        .slider .progress {
            z-index: 1;
            background-color: #3597ff;
            border-radius: inherit;
            position: absolute;
            pointer-events: none;
        }

        .slider .progress .pin {
            position: absolute;
            pointer-events: all;
            box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.32);
        }

        .slider:hover #progress-pin{
            height: 16px;
            width: 16px;
            border-radius: 8px;
            background-color: #000911;
            line-height: 4px;
            position: absolute;
        }



        .time-controler{
            font-size: 16px;
            line-height: 18px;
            color: #55606E;
            display: flex;
            flex-grow: 1;
            justify-content: space-between;
            align-items: center;
        }

        .time-controler .slider {
            margin-left: 16px;
            margin-right: 16px;
            border-radius: 8px;
            height: 4px;
        }

        .time-controler .slider .progress {
            width: 0;
            height: 100%;
        }

        .time-controler .slider .progress .pin {
            right: -8px;
            top: -6px;
        }

        #show-volume{
            display: block;
        }

        .volume-controls {
            width: 30px;
            height: 135px;
            background-color: rgba(0, 0, 0, 0.62);
            border-radius: 7px;
            flex-direction: column;
            align-items: center;
            display: none;
        }

        #show-volume:hover + .volume-controls {
            display: flex;
        }

        .volume-controls:hover{
            display: flex;
        }

        .volume-controls .slider {
            margin-top: 12px;
            margin-bottom: 12px;
            width: 6px;
            border-radius: 3px;
        }

        .volume-controls .slider .progress{
            bottom: 0;
            height: 100%;
            width: 6px;
        }

        .volume-controls .slider .progress .pin {
            left: -5px;
            top: -8px;
        }

        .volume-controls:hover #volume-pin {
            height: 16px;
            width: 16px;
            border-radius: 8px;
            background: #0a0e14;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <h3 id="idlist" name="{{$playlistcurent->id}}"><b>{{$playlistcurent->name}} </b></h3>
            </div>

            <div class="box-player" >
                <audio style="display: none" ></audio>

                <div class="visualizer-container">
                    <img width="100px" height="100px" src="{!! $playlistcurent->thumb !!}" id="thumb">
                </div>

                <div class="controls">
                    <button class="play-pause"><span class="material-icons">
                            <i class="fas fa-pause"></i>
                            </span>
                    </button>

                    <div class="time-controler">
                        <span class="current-time" style="color: white; margin-left: 10px;margin-right: -5px ">0:00</span>
                        <div class="slider" data-direction="horizontal">
                            <div class="progress">
                                <div class="pin" id="progress-pin" data-method="rewind"></div>
                            </div>
                        </div>
                    </div>

                    <span id="show-volume">
                          <i class="fas fa-volume-up" onclick="mute()" id="volume" style="margin-right: 5px"></i>
                        <i class="fas fa-volume-mute" onclick="mute()" id="mute"></i>
                    </span>

                    <div class="volume-controls" >
                        <div class="slider" data-direction="vertical">
                            <div class="progress">
                                <div class="pin" id="volume-pin" data-method="changeVolume"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-playlist" id="style-box-playlist">
                <ul>
                    @foreach($playlistcurent->playlist_song as $key=> $song)
                        <li id="song-playing" onclick="choosesong{{$key}}()" >
                            <input type="hidden" title="{{$key}}" id="songx_{{$key}}" name="{{$song->id}}" value="{{$song->file_song}}">
                            <div class="row">
                                <div id="playing-{{$key}}" style="
                            /*background-image: url('https://stc-id.nixcdn.com/v11/images/icon_status.gif');*/
                            background-size: cover;
                            margin-left: 20px;float: left;width: 20px">
                                    <h7>{{$key+1}}.</h7>
                                </div>
                                <div class="col-md-7">
                                    <h7 style="color: #333">{{$song->name}} - </h7>
                                    <h7>
                                        @php
                                            $count= count($song->song_singer);
                                        @endphp
                                        @foreach($song->song_singer as $singer)
                                            @if($count!=1)
                                                <a href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html"  id="singer-name">{{$singer->name}},</a>
                                            @else
                                                <a href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html"  id="singer-name">{{$singer->name}}</a>
                                            @endif
                                            @php
                                                $count--;
                                            @endphp
                                        @endforeach
                                    </h7>
                                </div>
                                <div class="col-md-2" >
                                    <i class="fas fa-headphones-alt"></i>
                                    {{number_format($song->view)}}
                                </div>
                                <div class="col-md-2" style="float: right;color: #999999">
                                    <a  id="play_song" >
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <a style="margin-left: 50px" href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html"  target="_blank">
                                        <i class="far fa-clone"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <script>
                            var song{{$key}} = document.getElementById('songx_{{$key}}');
                        </script>
                    @endforeach

                </ul>
            </div>

            @foreach($playlistcurent->playlist_song as $key=> $song)
            <div class="box-lyric" style="display: none" id="box-lyric-{{$key}}">
                    <h4 style="margin-left:20px;margin-top: 20px">
                        <b>Lời bài hát: </b>
                        <b id="namesong-{{$key}}" > </b>
                    </h4>
{{--                    <h6  style="margin-left:20px;color: #9a9a9a">--}}
{{--                        <b>Tác giả:</b>--}}
{{--                        <b id="nametacgia-{{$key}}"></b>--}}
{{--                    </h6>--}}
                    <hr>
                    <div class="lyric" id="boxlyric{{$key}}" >
                        <div id="lyric-{{$key}}" style="margin:20px;color: #333;font-family: sans-serif">
                        </div>
                    </div>
                    <div class="more_add" id="divMoreAddLyric">
                        <button  id="seeMoreLyric{{$key}}" onclick="showlr{{$key}}()"  class="btn_view_more">Xem toàn bộ<span class="down"></span></button>
                        <button  id="hideMoreLyric{{$key}}" onclick="hidelr{{$key}}()" class="btn_view_hide">Thu gọn<span class="up"></span></button>
                    </div>
            </div>
            @endforeach

<br>
            <div class="box-goiy-playlist">
                <div id="tieude">
                    PLAYLIST
                </div>
                <div class="row row10px float-col-width">
                    @foreach($listgoiy as $key=> $playlist)
                        @if($key+1%5!=0)
                            <div class="col">
                                <div class="card card1">
                                    <a href="/playlist/{{$playlist->id}}/{!! Str::slug($playlist->name,'-') !!}.html" title="{{$playlist->name}}">
                                        <div id="playlist{{$playlist->id}}" class="card-header" style="background-image: url({{$playlist->thumb}});">
                                        <span id="nen{{$playlist->id}}" style="background: #565555; position: absolute;display: none;opacity: 0.5;width: 175px;height: 176px;
                                                        top: 0px;
                                                        left: 0px;"></span>
                                            <span style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                        top: calc((100% - 48px)/2);
                                                        left: calc((100% - 48px)/2);
                                                        width: 48px;
                                        height: 48px;" id="icon{{$playlist->id}}playlist"></span>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="/playlist/{{$playlist->id}}/{!! Str::slug($playlist->name,'-') !!}.html" title="{{$playlist->name}}">{{$playlist->name}}</a></h3>
                                        <a id="name-singer-bxh">V.A</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col">
                                <div class="card card1">
                                    <a href="/playlist/{{$playlist->id}}/{!! Str::slug($playlist->name,'-') !!}.html" title="{{$playlist->name}}">
                                        <div id="playlist{{$playlist->id}}" class="card-header" style="background-image: url({{$playlist->thumb}});">
                                       <span id="nen{{$playlist->id}}" style="background: #565555; position: absolute;display: none;opacity: 0.5;width: 175px;height: 176px;
                                                        top: 0px;
                                                        left: 0px;"></span>
                                            <span style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                        top: calc((100% - 48px)/2);
                                                        left: calc((100% - 48px)/2);
                                                        width: 48px;
                                        height: 48px;" id="icon{{$playlist->id}}playlist"></span>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="/playlist/{{$playlist->id}}/{!! Str::slug($playlist->name,'-') !!}.html" title="{{$playlist->name}}">{{$playlist->name}}</a></h3>
                                        <a id="name-singer-bxh">V.A</a>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="row row10px float-col-width">
                    @endif
                    @endforeach
                </div>

                <div id="tieude">
                    Bài Hát
                </div>
                <div class="box-songofsinger">
                    <div>
                        <ul>
                            @foreach($songgoiy as $song)
                                <hr>
                                <li>
                                    <div class="row" id="div_songs">
                                        <div class="col-md-7">
                                            <div>
                                                <b><a href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html" id="song-name">{{$song->name}}</a></b>
                                            </div>

                                            <div>

                                                @foreach($song->song_singer as $key=>$singer)
                                                    @if($key!=1)
                                                        <a href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html"  id="singer-name">{{$singer->name}},</a>
                                                    @else
                                                        <a href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html"  id="singer-name">{{$singer->name}}</a>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="col-md-2" style="top:20px;color: #999999">
                                            <i class="fas fa-headphones-alt"></i>
                                            {{$song->view}}
                                        </div>
                                        <div class="col-md-2" style="top:20px;">
                                            <a id="play_song" style="color: #999999;" href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html">
                                                <i class="fas fa-play"></i>
                                            </a>
                                            <a id="newtab" href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html" target="_blank">
                                                <i class="far fa-clone"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            @include('Play.listplaylistrandom')
        </div>

    </div>







    <script>


{{--        Playlist lien quan--}}
        @foreach($listgoiy as $playlistgoiy)
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

         // show Lyric

        @foreach($playlistcurent->playlist_song as $keyshow=>$song)
            const showlyric{{$keyshow}} = document.getElementById('seeMoreLyric{{$keyshow}}');
            const hidenlyric{{$keyshow}} = document.getElementById('hideMoreLyric{{$keyshow}}');
            const  heightlyric{{$keyshow}} = document.getElementById('boxlyric{{$keyshow}}');
            function showlr{{$keyshow}}(){
                showlyric{{$keyshow}}.style.display = 'none';
                heightlyric{{$keyshow}}.style.height = 'auto';
                heightlyric{{$keyshow}}.style.overflow = 'auto';
                hidenlyric{{$keyshow}}.style.display = 'block';
            }
            function hidelr{{$keyshow}}(){
                heightlyric{{$keyshow}}.style.height = '300px';
                heightlyric{{$keyshow}}.style.overflow = 'hidden';
                showlyric{{$keyshow}}.style.display = 'block';
                hidenlyric{{$keyshow}}.style.display = 'none';
            }
        @endforeach


        let i=1;
        const audio = document.querySelector("audio");
        //Số lượng bài hát 1 list

        //Khoi tao
        @foreach($playlistcurent->playlist_song as $keykhoitao=>$songkhoitao)
            var lyric{{$keykhoitao}}='{!!  $songkhoitao->lyric  !!}';
            var box_lyric_{{$keykhoitao}} = document.getElementById('box-lyric-{{$keykhoitao}}');
            box_lyric_{{$keykhoitao}}.style.display = 'none';
            var namesong_{{$keykhoitao}} =document.getElementById('namesong-{{$keykhoitao}}');
            namesong_{{$keykhoitao}}.innerHTML = '{{$songkhoitao->name}}';
            {{--var nametacgia_{{$keykhoitao}} =document.getElementById('nametacgia-{{$keykhoitao}}');--}}
            {{--nametacgia_{{$keykhoitao}}.innerHTML = '{{$songkhoitao->song_musican->name}}';--}}
            var lyric_{{$keykhoitao}} = document.getElementById('lyric-{{$keykhoitao}}');
            lyric_{{$keykhoitao}}.innerHTML = lyric{{$keykhoitao}};
            @if($keykhoitao==0)
                let songx=document.getElementById('songx_{{$keykhoitao}}');
                var playing = document.getElementById('playing-{{$keykhoitao}}');
                playing.style.backgroundImage = "url('https://stc-id.nixcdn.com/v11/images/icon_status.gif')";
                audio.src=song{{$keykhoitao}}.value;
                if (lyric{{$keykhoitao}}!=''){
                    box_lyric_{{$keykhoitao}}.style.display = 'block';
                }
            @endif
        @endforeach

//tạo các hàm chuyển bài
        @foreach($playlistcurent->playlist_song as $key_function => $song_function)
            function choosesong{{$key_function}}(){
                @foreach($playlistcurent->playlist_song as $keyreset=>$songreset)
                    document.getElementById('playing-{{$keyreset}}').style.backgroundImage = "";
                    box_lyric_{{$keyreset}}.style.display='none';
                @endforeach
                document.getElementById('playing-{{$key_function}}').style.backgroundImage = "url('https://stc-id.nixcdn.com/v11/images/icon_status.gif')";
                songx = song{{$key_function}};
                if (lyric{{$key_function}}!=''){
                    box_lyric_{{$key_function}}.style.display = 'block';
                }
                console.log('{{$song_function->name}}');
                audio.src=songx.value;
                audioState.isPaused=false;
                playPauseButton.innerHTML = pauseIcon;
                audio.play();
            }
        @endforeach

        var soluong = {{count($playlistcurent->playlist_song )}}-1;

        function onEnd() {
            audio.currentTime = 0;
            $.ajax({
                // cache: false,
                type: 'POST',
                datatype: 'JSON',
                url: '/songview/'+songx.name+'/',
            });
            var stt = Number(songx.title)+1;

            if (stt>soluong && document.getElementById('checkcontinue').checked === true) {
                window.location.href=document.getElementById('0').href;
            }else if(stt>soluong){
                stt=0;
            }
            else if(stt==1){
                $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    url: '/playlistview/'+{{$playlistcurent->id}}+'/',
                });
            }

            //chuyen bai hat khi het
            $(document).ready(function (){
                @foreach($playlistcurent->playlist_song as $key2=>$song)
                document.getElementById('playing-{{$key2}}').style.backgroundImage = "";
                box_lyric_{{$key2}}.style.display='none';
                var lyric = '{{$song->lyric}}';
                @endforeach
                document.getElementById('playing-'+stt).style.backgroundImage = "url('https://stc-id.nixcdn.com/v11/images/icon_status.gif')";
                songx = document.getElementById('songx_'+stt);
                if (lyric != ''){
                    document.getElementById('box-lyric-'+stt).style.display='block';
                }
                // showlyric.style.display = 'block';
                // hidenlyric.style.display = 'none';
                // document.getElementById('boxlyric'+stt).style.height = '300px';
                // document.getElementById('boxlyric'+stt).style.overflow = 'hidden';
                console.log(songx);
                audio.src=songx.value;
                audioState.isPaused=false;
                playPauseButton.innerHTML = pauseIcon;
                audio.play();
            });
        }
    </script>

{{--    Hiển thị sóng nhạc--}}
    <script>
        // Create an audio context
        const ctx = new AudioContext();
        (function () {
            // Create an audio source
            const audioSource = ctx.createMediaElementSource(audio);
            // Create an audio analyzer
            const analayzer = ctx.createAnalyser();
            // Connect the source, to the analyzer, and then back the the context's destination
            audioSource.connect(analayzer);
            audioSource.connect(ctx.destination);
            // Print the analyze frequencies
            const frequencyData = new Uint8Array(analayzer.frequencyBinCount);
            analayzer.getByteFrequencyData(frequencyData);
            // Get the visualizer container
            const visualizerContainer = document.querySelector(".visualizer-container");
            // The number of bars that should be displayed
            const NBR_OF_BARS = 150;
            // Create a set of pre-defined bars
            for( let i = 0; i < NBR_OF_BARS; i++ ) {
                const bar = document.createElement("DIV");
                bar.setAttribute("id", "bar" + i);
                bar.setAttribute("class", "visualizer-container__bar");
                visualizerContainer.appendChild(bar);
            }
            // This function has the task to adjust the bar heights according to the frequency data
            function renderFrame() {
                // Update our frequency data array with the latest frequency data
                analayzer.getByteFrequencyData(frequencyData);
                for( let i = 0; i < NBR_OF_BARS; i++ ) {
                    // Since the frequency data array is 1024 in length, we don't want to fetch
                    // the first NBR_OF_BARS of values, but try and grab frequencies over the whole spectrum
                    const index = (i + 10) * 2;
                    // fd is a frequency value between 0 and 255
                    const fd = frequencyData[index];
                    // Fetch the bar DIV element
                    const bar = document.querySelector("#bar" + i);
                    if( !bar ) {
                        continue;
                    }
                    // If fd is undefined, default to 0, then make sure fd is at least 4
                    // This will make make a quiet frequency at least 4px high for visual effects
                    const barHeight = Math.max(0, fd || 0);
                    bar.style.height = barHeight*0.45 + "px";
                }
                // At the next animation frame, call ourselves
                window.requestAnimationFrame(renderFrame);
            }
            renderFrame();
            audio.play();
            audio.volume=0.1;
        })();
        //Khung Controls
        const playPauseButton = document.querySelector('.play-pause');
        // const volumeBar = document.querySelector('.volume');
        var  ctime = document.querySelector('.current-time');
        const pauseIcon = `<span class="material-icons">
        <i class="fas fa-pause"></i>
        </span>`;
        const playIcon = `<span class="material-icons">
        <i class="fas fa-play"></i>
        </span>`;
        const replayIcon = `<span class="material-icons">
        <i class="fas fa-reply"></i></span>`;
        let audioState = {
            isReplay : false,
            isPaused : false,
        };
    </script>


{{--    Xử lý khung control--}}
    <script>
        playPauseButton.addEventListener('click', togglePlayPause);
        audio.addEventListener('timeupdate', setProgress);
        audio.addEventListener('ended', onEnd);
        window.addEventListener('resize', directionAware);
        var volumeControls = document.querySelector('.volume-controls');
        var volumeProgress = volumeControls.querySelector('.slider .progress');
        audio.addEventListener('volumechange', updateVolume);


        function updateVolume() {
            volumeProgress.style.height = audio.volume * 100 + '%';
            if(audio.volume !=0 ){
                document.getElementById('volume').style.display = 'block';
                document.getElementById('mute').style.display = 'none';
            }else {
                document.getElementById('mute').style.display= 'block';
                document.getElementById('volume').style.display = 'none';
            }
        }


        function mute(){
            if(audio.volume!=0){
                audio.volume = 0;
                sessionStorage.setItem('mute',audio.volume);
                document.getElementById('mute').style.display= 'block';
                document.getElementById('volume').style.display = 'none';
            }else {
                audio.volume = sessionStorage.getItem('volume');
                sessionStorage.removeItem('mute');
                document.getElementById('mute').style.display= 'none';
                document.getElementById('volume').style.display = 'block';
            }

        }
        //Xử lý nút play
        function togglePlayPause() {
            ctx.resume().then(() => {
                if(audioState.isPaused) {
                    playPauseButton.innerHTML = pauseIcon;
                    audio.play();
                } else {
                    if(audioState.isReplay) { // Replay
                        playPauseButton.innerHTML = pauseIcon;
                        audio.play();
                        audioState.isReplay = false;
                        return;
                    }
                    playPauseButton.innerHTML = playIcon;
                    audio.pause();
                }
                audioState.isPaused = !audioState.isPaused;
            });
        }

        var currentlyDragged = null;
        var draggableClasses = ['pin'];
        var progress = document.querySelector('.progress');
        var sliders = document.querySelectorAll('.slider');
        var currentTime = document.querySelector('.current-time');
        function onSeek(evt) {
            audio.currentTime = evt.target.value;
        }
        window.addEventListener('mousedown', function(event) {
            if(!isDraggable(event.target)) return false;
            currentlyDragged = event.target;
            let handleMethod = currentlyDragged.dataset.method;
            this.addEventListener('mousemove', window[handleMethod], false);
            window.addEventListener('mouseup', () => {
                currentlyDragged = false;
                window.removeEventListener('mousemove', window[handleMethod], false);
            }, false);
        });
        directionAware();
        function isDraggable(el) {
            let canDrag = false;
            let classes = Array.from(el.classList);
            draggableClasses.forEach(draggable => {
                if(classes.indexOf(draggable) !== -1)
                    canDrag = true;
            })
            return canDrag;
        }


        function formatTime(time) {
            var min = Math.floor(time / 60);
            var sec = Math.floor(time % 60);
            return min + ':' + ((sec<10) ? ('0' + sec) : sec);
        }
        sliders.forEach(slider => {
            let pin = slider.querySelector('.pin');
            slider.addEventListener('click', window[pin.dataset.method]);
        });


        function setProgress() {
            var current = audio.currentTime;
            var percent = (current / audio.duration) * 100;
            progress.style.width = percent + '%';
            currentTime.textContent = formatTime(current);
        }


        function getRangeBox(event) {
            let rangeBox = event.target;
            let el = currentlyDragged;
            if(event.type == 'click' && isDraggable(event.target)) {
                rangeBox = event.target.parentElement.parentElement;
            }
            if(event.type == 'mousemove') {
                rangeBox = el.parentElement.parentElement;
            }
            return rangeBox;
        }


        function inRange(event) {
            let rangeBox = getRangeBox(event);
            let rect = rangeBox.getBoundingClientRect();
            let container= document.getElementById('container').offsetLeft;
            let direction = rangeBox.dataset.direction;
            if(direction === 'horizontal') {
                var min = rangeBox.offsetLeft + container;
                var max = min + rangeBox.offsetWidth + container;
                if(event.clientX < min || event.clientX > max) return false;
            } else {
                var min = rect.top;
                var max = min + rangeBox.offsetHeight;
                if(event.clientY < min || event.clientY > max) return false;
            }
            return true;
        }

        function getCoefficient(event) {
            let slider = getRangeBox(event);
            let container= document.getElementById('container').offsetLeft;
            let rect = slider.getBoundingClientRect();
            let K = 0;
            if(slider.dataset.direction === 'horizontal') {
                let offsetX = event.clientX - slider.offsetLeft - container;
                let width = slider.clientWidth;
                K = offsetX / width ;
            } else if(slider.dataset.direction === 'vertical') {

                let height = slider.clientHeight;
                var offsetY = event.clientY - rect.top;
                K = 1 - offsetY / height;

            }
            return K;
        }

        if (sessionStorage.getItem('mute')){
            audio.volume = sessionStorage.getItem('mute');
        }
        else if(sessionStorage.getItem('volume')) {
            audio.volume = sessionStorage.getItem('volume');
        }
        else{
            sessionStorage.setItem('volume',audio.volume);
        }

        // Xử lý tăng thêm view
        function changeVolume(event) {
            if(inRange(event)) {
                audio.volume = getCoefficient(event);
                sessionStorage.setItem('volume',audio.volume);
            }
        }

        function rewind(event) {
            if(inRange(event)) {
                audio.currentTime = audio.duration * getCoefficient(event);
            }
        }


        function directionAware() {
            if(window.innerHeight < 250) {
                volumeControls.style.bottom = '-54px';
                volumeControls.style.left = '54px';
            } else if(document.offsetTop < 154) {
                volumeControls.style.bottom = '-164px';
                volumeControls.style.left = '-3px';
            } else {
                volumeControls.style.bottom = '52px';
                volumeControls.style.left = '-3px';
            }
        }
    </script>

@endsection
