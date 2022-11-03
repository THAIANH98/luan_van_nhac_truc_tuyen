@extends('main')

@section('content')

    <div>
        <div class="row" style="background: #222222; position: relative;width: 100%;color: #ffffff;padding: 20px">
            <div class="col-md-2 align-content-center">
                <div class="singer-avatar">
                    <img width="110px" style="border-radius: 55px" height="110px" src="{{$musican->avatar}}">
                </div>
                <b class="singer-name" style="text-overflow:ellipsis;overflow: hidden;white-space:nowrap; font-size: 24px">{{$musican->name}}</b>
                @if($musican->birthday!=null)
                    <p>Sinh nhật: {{$musican->birthday}}</p>
                @endif
            </div>
            <div class="col-md-10">
                @if($musican->description!=null)
                    <p><b style="font-size: 24px">Tiểu sử:</b>{!! $musican->description !!}</p>
                @endif
            </div>
        </div>
    </div>

    <hr>

<br>
<br>
<br>
    <div class="row">
        <div class="col-md-9">
            <nav id="navmenu">
                <ul>
                    <li id="bai-hat-moi" class="tab-current"><a onclick="categoryTab('album-moi','bai-hat-moi')" class="bai-hat-moi" href="#"><span>Bài Hát mới</span></a></li>
                    <li id="album-moi" class=""><a onclick="categoryTab('bai-hat-moi','album-moi')" class="album-moi" href="#"><span>ALbum mới</span></a></li>
                </ul>
            </nav>
            <br>
            <div id="songpage" style="display: block">
                @include('singer.song_of_singer')
            </div>
            <div id="playlistpage" style="display:none ">
                @include('singer.playlist_of_singer')
            </div>
        </div>

        <style>
            .list_singer_hot {
                float: left;
                width: 300px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            .tile_box_key {
                width: 100%;
                float: left;
            }

            .tile_box_key h3 a{
                color: #2daaed;
                float: left;
                display: block;
                width: auto;
                font-size: 26px;
                /*text-transform: uppercase;*/
                font-weight: bold;
                font-family: 'SFProDisplay-Bold';
                line-height: 36px;
                margin: 0 0 10px 0;
            }

            .list_singer_hot ul {
                float: left;
                width: 100%;
                margin-top: 0px;
            }

            .list_singer_hot ul li:first-child {
                width: 287px;
                height: 287px;
            }

            .list_singer_hot ul li {
                float: left;
                width: 135px;
                height: 135px;
                margin: 0px 15px 15px 0px;
                vertical-align: middle;
                position: relative;
            }

            .list_singer_hot ul li:first-child a.name_singer_main {
                width: 287px;
                height: 100%;
                padding-top: 140px;
            }

            .list_singer_hot ul li a.name_singer_main {
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .list_singer_hot ul li a.name_singer_main {
                width: 135px;
                z-index: 1001;
                font-size: 14px;
                line-height: 16px;
                padding: 62px 0 0 0;
                height: 142px;
                vertical-align: middle;
                background: rgba(0,0,0,0.7);
                opacity: 0;
                position: absolute;
                color: #fff;
                left: 0;
                top: 0;
                text-align: center;
            }

            .list_singer_hot ul li:hover a.name_singer_main {
                opacity: 1;
            }

            a {
                color: rgba(0,0,0,0.88);
                text-decoration: none;
                -webkit-transition: all 0.2s linear;
                -moz-transition: all 0.2s linear;
                transition: all 0.2s linear;
            }

            .list_singer_hot ul li:first-child img {
                float: left;
                width: 287px;
                height: 287px;
                margin: 0 0 0 0;
            }

            img {
                max-width: 100%;
                vertical-align: middle;
                border: 0;
                -ms-interpolation-mode: bicubic;
            }


            .list_singer_hot ul li img {
                float: left;
                width: 142px;
                height: 142px;
                margin: 0 0 0 0;
            }

            a:hover {
                text-decoration: none;
                color: #0689ba;
                -webkit-transition: all 0.2s linear;
                -moz-transition: all 0.2s linear;
                transition: all 0.2s linear;
            }

            a, a:hover, a:active, a:focus {
                outline: 0;
            }

            .list_singer_hot ul li a.name_singer_main {
                line-height: 21px !important;
            }

            .list_singer_hot ul li .img {
                width: 142px;
                height: 142px;
                z-index: 1000;
            }

            .box_name_album_info {
                float: left;
                width: 300px;
                margin: 0 0 0 0;
            }

            .box_name_album_info .info_album {
                float: left;
                width: 300px;
                margin-left: 0px;
            }

            .box_name_album_info .info_album .avatar_album {
                width: 300px;
                height: 180px;
                position: relative;
            }

            .box_name_album_info .info_album .avatar_album .rotate_album {
                width: 180px;
                height: 180px;
                position: absolute;
                z-index: 17;
                left: 87px;
                top: 9px;
            }

            .box_name_album_info .info_album .avatar_album .box_font_album {
                width: 180px;
                position: absolute;
                z-index: 20;
                background: url(https://stc-id.nixcdn.com/v11/images/icon.png) -261px -170px no-repeat;
                height: 180px;
            }

            .icon_play_single_playlist {
                position: absolute;
                z-index: 101;
                top: 50%;
                left: 50%;
                margin: -24px 0 0 -24px;
                width: 48px;
                height: 48px;
                display: block;
                background: url(https://stc-id.nixcdn.com/v11/images/icon.png) left -28px no-repeat;
            }

            .box_name_album_info .info_album .avatar_album .box_bg_album {
                width: 260px;
                position: absolute;
                z-index: 19;
                background: url(https://stc-id.nixcdn.com/v11/images/icon.png) left -170px no-repeat;
                height: 200px;
                overflow: hidden;
            }

            .box_name_album_info .info_album .img_avatar {
                width: 180px;
                height: 180px;
            }

            .box_name_album_info .info_album .img_avatar img {
                width: 180px;
                height: 180px;
                -ms-interpolation-mode: bicubic;
            }

            .rotate {
                -webkit-border-radius: 90px;
                -moz-border-radius: 90px;
                border-radius: 90px;
                animation: mymove 10s linear 0s infinite;
                -webkit-animation: mymove 10s linear 0s infinite;
                -moz-animation: mymove 10s linear 0s infinite;
                -o-animation: mymove 10s linear 0s infinite;
                -webkit-transition-duration: 0.8s;
                -moz-transition-duration: 0.8s;
                -o-transition-duration: 0.8s;
                transition-duration: 0.8s;
                -webkit-transition-property: -webkit-transform;
                -moz-transition-property: -moz-transform;
                -o-transition-property: -o-transform;
                transition-property: transform;
                overflow: hidden;
            }

            .tile_box_key h3 a {
                color: #2daaed;
                text-transform: uppercase;
                font-weight: 300 !important;
            }
        </style>

        <div class="col-md-3">
            @if($top1playlist!==false)
                <div class="tile_box_key">
                    <h3><a class="nomore">Top Playlist</a></h3>
                </div>

                <div class="box_name_album_info">
                    <div class="info_album">
                        <div class="avatar_album">
                            <div class="rotate_album"><img src="{{$top1playlist->thumb}}" id="rotate" class="rotate" width="164"></div>
                            <a href="/playlist/{{$top1playlist->id}}/{{Str::slug($top1playlist->name,'-')}}.html" id="mainAlbum" class="box_font_album box_absolute">
                                <span class="icon_play_single_playlist"></span>
                            </a>
                            <div class="box_bg_album">
                                <a href="/playlist/{{$top1playlist->id}}/{{Str::slug($top1playlist->name,'-')}}.html" class="img_avatar">
                                    <img src="{{$top1playlist->thumb}}" class="img_album" width="180"></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            @if($top1song!==false)
            <div class="tile_box_key">
                <h3><a style="margin-top: 20px">Top Song </a></h3>
            </div>

            <div class="box_name_album_info">
                <div class="info_album">
                    <div class="avatar_album">
                        <div class="rotate_album"><img src="{{$top1song->thumb}}" id="rotatesong" class="rotate" width="164"></div>
                        <a href="/song/{{$top1song->id}}/{{Str::slug($top1song->name,'-')}}.html" id="mainAlbum" class="box_font_album box_absolute">
                            <span class="icon_play_single_playlist"></span>
                        </a>
                        <div class="box_bg_album">
                            <a href="/song/{{$top1song->id}}/{{Str::slug($top1song->name,'-')}}.html" class="img_avatar">
                                <img src="{{$top1song->thumb}}" class="img_album" width="180"></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <script>
                corner =0;
                var t = setInterval(move, 250);
                function move(){
                    document.getElementById('rotate').style.transform = 'rotate('+ corner +'deg)';
                    document.getElementById('rotatesong').style.transform = 'rotate('+ corner +'deg)';
                    corner+=10;
                }
            </script>

            <div class="list_singer_hot">
                <div class="tile_box_key" style="margin-top: 20px">
                    <h3><a title="Ca Sĩ | Nghệ Sĩ">Nhạc Sĩ | Ca Sĩ</a></h3>
                </div><!--@end div tile_box_key-->
                <ul>
                    @foreach($musicans as $musican)
                    <li>
                        <a href="/musican/{{$musican->id}}/{!! Str::slug($musican->name,'-') !!}.html" class="img" title="{{$musican->name}}">
                            <img src="{!! $musican->avatar !!}" title="{{$musican->name}}" alt="{{$musican->name}}">
                        </a>
                        <a href="/musican/{{$musican->id}}/{!! Str::slug($musican->name,'-') !!}.html" class="name_singer_main" title="{{$musican->name}}">{{$musican->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        function categoryTab(tabrm,tabcr){
            let elementrm= document.getElementById(tabrm);
            let elementcr= document.getElementById(tabcr);
            elementrm.classList.remove("tab-current");
            elementcr.className = elementcr.className.replace('',"tab-current");
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

        @foreach($playlists as $playlist)
        $(document).ready(function(){
            $("#playlist{{$playlist->id}}").mouseenter(function(){
                document.getElementById('icon{{$playlist->id}}playlist').style.visibility = 'visible';
            });
        });
        $(document).ready(function(){
            $("#playlist{{$playlist->id}}").mouseleave(function(){
                document.getElementById('icon{{$playlist->id}}playlist').style.visibility = 'hidden';
            });
        });
        @endforeach
    </script>
@endsection
