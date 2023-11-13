@extends('main')

@section('content')
    @include('slider')
    <br>
    <br>
    @php
        $count = 1;
    @endphp
    <div>
        <h2 style="color: #007efc;">Bài mới nhất</h2><br>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="row row10px float-col-width">
                @foreach ($newsongs as $song)
                    @if ($count % 5 != 0)
                        <div class="col">
                            <div class="card card1">
                                <a href="/song/{{ $song->id }}/{!! Str::slug($song->name, '-') !!}.html" title="{{ $song->name }}">
                                    <div id="{{ $song->id }}" class="card-header"
                                        style="background-image: url({{ $song->thumb }});">
                                        <span
                                            style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                                z-index: 101;
                                                                top: calc((100% - 48px)/2);
                                                                left: calc((100% - 48px)/2);
                                                                width: 48px;
                                                                height: 48px;
                                                                display: block;"
                                            id="icon{{ $song->id }}"></span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="/song/{{ $song->id }}/{!! Str::slug($song->name, '-') !!}.html"
                                            title="{{ $song->name }}">{{ $song->name }}</a></h3>
                                    @foreach ($song->song_singer as $singer)
                                        <p class="card-text"><a
                                                href="/singer/{{ $singer->id }}/{!! Str::slug($singer->name, '-') !!}.html">{{ $singer->name }};</a>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col">
                            <div class="card card1 ">
                                <a href="/song/{{ $song->id }}/{!! Str::slug($song->name, '-') !!}.html"
                                    title="{{ $song->name }}">
                                    <div id="{{ $song->id }}" class="card-header"
                                        style="background-image: url({{ $song->thumb }});">
                                        <span
                                            style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                            z-index: 101;
                                                            top: calc((100% - 48px)/2);
                                                            left: calc((100% - 48px)/2);
                                                            width: 48px;
                                                            height: 48px;
                                                            display: block;"
                                            id="icon{{ $song->id }}"></span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="/song/{{ $song->id }}/{!! Str::slug($song->name, '-') !!}.html"
                                            title="{{ $song->name }}">{{ $song->name }}</a></h3>
                                    @foreach ($song->song_singer as $singer)
                                        <p class="card-text"><a
                                                href="/singer/{{ $singer->id }}/{!! Str::slug($singer->name, '-') !!}.html">{{ $singer->name }};</a>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
            </div>
            <div class="row row10px float-col-width">
                @endif
                @php
                    $count += 1;
                @endphp
                @endforeach
            </div>



            <div>
                <br>
                <h2 style="color: #007efc; ">Playlist mới nhất</h2><br>
            </div>
            <div class="row row10px">
                @foreach ($newplaylist as $playlist)
                    @if ($count % 5 != 0)
                        <div class="col">
                            <div class="card card1">
                                <a href="/playlist/{{ $playlist->id }}/{!! Str::slug($playlist->name, '-') !!}.html"
                                    title="{{ $playlist->name }}">
                                    <div id="playlist{{ $playlist->id }}" class="card-header"
                                        style="background-image: url({{ $playlist->thumb }});">
                                        <span
                                            style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                                z-index: 101;
                                                                top: calc((100% - 48px)/2);
                                                                left: calc((100% - 48px)/2);
                                                                width: 48px;
                                                                height: 48px;
                                                                display: block;"
                                            id="icon{{ $playlist->id }}playlist"></span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title"><a
                                            href="/playlist/{{ $playlist->id }}/{!! Str::slug($playlist->name, '-') !!}.html"
                                            title="{{ $playlist->name }}">{{ $playlist->name }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col">
                            <div class="card card1">
                                <a href="/playlist/{{ $playlist->id }}/{!! Str::slug($playlist->name, '-') !!}.html"
                                    title="{{ $playlist->name }}">
                                    <div id="playlist{{ $playlist->id }}" class="card-header"
                                        style="background-image: url({{ $playlist->thumb }});">
                                        <span
                                            style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                            z-index: 101;
                                                            top: calc((100% - 48px)/2);
                                                            left: calc((100% - 48px)/2);
                                                            width: 48px;
                                                            height: 48px;
                                                            display: block;"
                                            id="icon{{ $playlist->id }}playlist"></span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title"><a
                                            href="/playlist/{{ $playlist->id }}/{!! Str::slug($playlist->name, '-') !!}.html"
                                            title="{{ $playlist->name }}">{{ $playlist->name }}</a></h3>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="row row10px">
                @endif
                @php
                    $count += 1;
                @endphp
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            @include('bxh')
        </div>
    </div>

    <br>

    <script>
        @foreach ($newsongs as $song)
            $(document).ready(function() {
                $("#{{ $song->id }}").mouseenter(function() {
                    document.getElementById('icon{{ $song->id }}').style.visibility = 'visible';
                });
            });
            $(document).ready(function() {
                $("#{{ $song->id }}").mouseleave(function() {
                    document.getElementById('icon{{ $song->id }}').style.visibility = 'hidden';
                });
            });
        @endforeach

        @foreach ($newplaylist as $playlist)
            $(document).ready(function() {
                $("#playlist{{ $playlist->id }}").mouseenter(function() {
                    document.getElementById('icon{{ $playlist->id }}playlist').style.visibility =
                    'visible';
                });
            });
            $(document).ready(function() {
                $("#playlist{{ $playlist->id }}").mouseleave(function() {
                    document.getElementById('icon{{ $playlist->id }}playlist').style.visibility = 'hidden';
                });
            });
        @endforeach
    </script>
@endsection
