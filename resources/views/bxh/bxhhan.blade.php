<ul class="list-unstyled bxh mb-0" style="width: 100%;">
    @php
        $count=1;
    @endphp
    @foreach($songs as $song)
        @if($count==1)
            <li style="width: 100%;" class="media first stand align-items-stretch">
                <div class="media-left-first mr-3">
                    <span style="font-weight: bold;text-align: center;line-height: 25px;margin-top:65px;background: #0505e7;position: absolute;color: #F0D107;font-size: 20px;height: 25px;width: 23px;font-family: 'SFProDisplay-Regular'">{{$count}}</span>
                    <a class="media-thumb" href="/song/{{$song->id}}{$song->id}}/{!! Str::slug($song->name,'-') !!}.html.html" title="{{$song->name}}"><img src="{{$song->thumb}}" width="90px" height="90px"></a>
                </div>
                <div class="media-body d-flex flex-column ">
                    <h6 class="mt-0 mb-0"><a href="/song/{{$song->id}}{$song->id}}/{!! Str::slug($song->name,'-') !!}.html.html" title="{!! $song->lyric !!}">{{ucwords($song->name)}}</a></h6>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <div class="author">
                            @foreach($song->song_singer as $singer)
                                <a id="name-singer-bxh" href="/singer/{{$singer->id}}/{!! Str::slug($singer->name,'-') !!}.html">{{$singer->name}};</a>
                            @endforeach
                        </div>
                        <small class="counter_view">{{number_format($song->view)}}</small>
                    </div>
                </div>
            </li>
            <hr>
        @else
            <li style="width: 100%;" class="media now up align-items-stretch">
                <div class="media-left mr-3">
                    @if($count==2)
                        <span style="font-weight: bold; color:#7ED321;font-size: 20px;height: 25px;width: 23px;font-family: 'SFProDisplay-Regular'">{{$count}}</span>
                    @elseif($count==3)
                        <span style="font-weight: bold;color:#FF2D55;font-size: 20px;height: 25px;width: 23px;font-family: 'SFProDisplay-Regular'">{{$count}}</span>
                    @else
                        <span style="font-weight: bold;color:#222222;font-size: 20px;height: 25px;width: 23px;font-family: 'SFProDisplay-Regular'  ">{{$count}}</span>
                    @endif
                    <a href="/song/{{$song->id}}{$song->id}}/{!! Str::slug($song->name,'-') !!}.html.html" title="{{$song->name}}"><img src="{{$song->thumb}}" width="40px" height="40px"></a>
                </div>
                <div class="media-body d-flex flex-column justify-content-between">
                    <h6 class="media-title mt-0 mb-0"><a href="/song/{{$song->id}}{$song->id}}/{!! Str::slug($song->name,'-') !!}.html.html" title="">{{ucwords($song->name)}}</a></h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="author">
                            @foreach($song->song_singer as $singer)
                                <a id="name-singer-bxh" href="/singer/{{$singer->id}}/{!! Str::slug($singer->name,'-') !!}.html">{{$singer->name}};</a>
                            @endforeach
                        </div>
                        <small class="counter_view">{{number_format($song->view)}}</small>
                    </div>
                </div>
            </li>
            <hr>
        @endif
        @php
            $count+=1;
        @endphp
    @endforeach
</ul>
