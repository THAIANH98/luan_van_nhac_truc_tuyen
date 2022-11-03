@php
    $count=1;
@endphp
<section id="bai-hat-moi" class="content-current">
    <ul class="list-unstyled list_music">
        @foreach($songs as $song)
        <li class="media align-items-stretch not">
            <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
                <span style="width: 20px" class="counter">{{$count}}</span>
            </div>
            <div class="m-r-10">
                <a href="/song/{{$song->id}}/{!! Str::slug($song->name,'-') !!}.html" title="{{$song->name}}">
                    <img src="{{$song->thumb}}" width="55px" alt="{{$song->name}}">
                </a>
            </div>
            <div class="media-body d-flex flex-column">
                <h6 class="mt-0 mb-0"><a href="/song/{{$song->id}}/{!! Str::slug($song->name,'-') !!}.html" title="{!! $song->name !!}"><b>{{$song->name}}</b></a></h6>
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
            @php
                $count+=1;
            @endphp
        @endforeach
    </ul>
</section>

@php
    $page =  $countsong/20;
@endphp

@if($cate=='notcate')
    <center>
        <ul class="pagination">
            <li id="pagesong0" value="0" class="active">
                <a style="padding: 10px;" onclick="loadsong({{$menu}},'0')" href="#">1</a>
            </li>
            @for($i=1 ; $i<=$page ; $i++)
                <li id="pagesong{{$i}}" value="{{$i}}" >
                    <a style="padding: 10px;" onclick="loadsong({{$menu}},'{{$i}}')" href="#">{{$i+1}}</a>
                </li>
            @endfor
        </ul>
    </center>
@else
    <center>
        <ul class="pagination">
            <li id="pagesong0" value="0" class="active">
                <a style="padding: 10px;" onclick="loadsongcate({{$menu}},{{$cate}},'0')" href="#">1</a>
            </li>
            @for($i=1 ; $i<=$page ; $i++)
                <li id="pagesong{{$i}}" value="{{$i}}" >
                    <a style="padding: 10px;" onclick="loadsongcate({{$menu}},{{$cate}},'{{$i}}')" href="#">{{$i+1}}</a>
                </li>
            @endfor
        </ul>
    </center>
@endif
