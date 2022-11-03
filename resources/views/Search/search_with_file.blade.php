@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div style="margin: auto;color: #007efc">
                <h3>
                    Bài hát
                </h3>
            </div>

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="txt-note"> <b>Kết quả tìm kiếm phù hợp đoạn âm thanh</b></span>
                </div>
            </div>
            <section id="bai-hat-moi" class="content-current">
                <ul class="list-unstyled list_music">
                    @foreach($songs as $count=> $song)
                        <li class="media align-items-stretch not">
                            <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
                                <span style="width: 20px" class="counter">{{$count+1}}</span>
                            </div>
                            <div class="m-r-10">
                                <a href="/song/{{$song->id}}/{!! Str::slug($song->name,'-') !!}.html" title="{{$song->name}}">
                                    <img src="{{$song->thumb}}" width="55px" height="55px" alt="{{$song->name}}">
                                </a>
                            </div>
                            <div class="media-body d-flex flex-column">
                                <h6 class="mt-0 mb-0"><a href="/song/{{$song->id}}/{!! Str::slug($song->name,'-') !!}.html" title="{!! $song->name !!}"><b>{{mb_convert_case($song->name, MB_CASE_TITLE, "UTF-8")}}</b></a></h6>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <div class="author">
                                        @foreach($song->song_singer as $singer)
                                            <a style="color: #6c757d" id="name-singer-bxh" href="/singer/{{$singer->id}}/{!! Str::slug($singer->name,'-') !!}.html">{{$singer->name}};</a>
                                        @endforeach
                                    </div>
                                    <small class="counter_view">{{number_format($song->view)}}</small>
                                </div>
                            </div>
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </section>
        </div>

        <div class="col-md-3" style="height: 1059px">
            @include('bxh')
        </div>
    </div>
@endsection
