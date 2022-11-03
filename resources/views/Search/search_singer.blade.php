@if(count($singers)==0)
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <span class="txt-note">Từ khoá <b>{{$key}}</b> có 0 kết quả</span>
        </div>
    </div>
@else
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <span class="txt-note">Từ khoá <b>{{$key}}</b> có {{ count($singers) }} kết quả</span>
        </div>
    </div>
@endif

<section id="bai-hat-moi" class="content-current">
    <ul class="list-unstyled list_music">
        @foreach($singers as $countsinger=> $singer)
            <li class="media align-items-stretch not">
                <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
                    <span style="width: 20px" class="counter">{{$countsinger+1}}</span>
                </div>
                <div class="m-r-10">
                    <a href="/singer/{{$singer->id}}/{!! Str::slug($singer->name,'-') !!}.html" title="{{$singer->name}}">
                        <img src="{{$singer->avatar}}" height="55px" width="55px" alt="{{$singer->name}}">
                    </a>
                </div>
                <div class="media-body d-flex flex-column">
                    <h6 class="mt-0 mb-0"><a href="/singer/{{$singer->id}}/{!! Str::slug($singer->name,'-') !!}.html" title="{!! $singer->name !!}"><b>{{$singer->name}}</b></a></h6>
                </div>
            </li>
            <hr>
        @endforeach
    </ul>
</section>


<center>
    <ul class="pagination">
        <li id="pagesinger0" value="0" class="active">
            <a style="padding: 10px;" onclick="loadsinger_search('0','{{$key}}')" href="#">1</a>
        </li>
        @for($i=1 ; $i<=$count_singer/15 ; $i++)
            <li id="pagesinger{{$i}}" value="{{$i}}" >
                <a style="padding: 10px;" onclick="loadsinger_search('{{$i}}','{{$key}}')" href="#">{{$i+1}}</a>
            </li>
        @endfor
    </ul>
</center>
