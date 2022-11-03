
@if(count($songs)==0)
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <span class="txt-note">Từ khoá <b>{{$key}}</b> có 0 kết quả</span>
        </div>
    </div>
@else
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <span class="txt-note">Từ khoá <b>{{$key}}</b> có {{ count($songs) }} kết quả</span>
        </div>
    </div>
@endif

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

<center>
    <ul class="pagination">
        <li id="pagesong0" value="0" class="active">
            <a style="padding: 10px;" onclick="loadsong_search('0','{{$key}}')" href="#">1</a>
        </li>
        @for($i=1 ; $i<=$count_song/15 ; $i++)
            <li id="pagesong{{$i}}" value="{{$i}}" >
                <a style="padding: 10px;" onclick="loadsong_search('{{$i}}','{{$key}}')" href="#">{{$i+1}}</a>
            </li>
        @endfor
    </ul>
</center>

