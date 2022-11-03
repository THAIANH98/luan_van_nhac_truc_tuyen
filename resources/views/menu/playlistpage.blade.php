@php
    $count=1;
@endphp
<div class="row row10px float-col-width">
    @foreach($playlists as $playlist)
        @if($count%5!=0)
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
    @php
        $count+=1;
    @endphp
    @endforeach
</div>

    @php
        $page =  $countlist/20;
    @endphp
@if($cate=='notcate')
    <center>
        <ul class="pagination">
            <li id="pagelist0" value="0" class="active">
                <a style="padding: 10px;" onclick="loadplaylist({{$menu}},'0')" href="#">1</a>
            </li>
            @for($i=1 ; $i<=$page ; $i++)
                <li id="pagelist{{$i}}" value="{{$i}}" >
                    <a style="padding: 10px;" onclick="loadplaylist({{$menu}},'{{$i}}')" href="#">{{$i+1}}</a>
                </li>
            @endfor
        </ul>
    </center>
@else
    <center>
        <ul class="pagination">
            <li id="pagelist0" value="0" class="active">
                <a style="padding: 10px;" onclick="loadplaylistcate({{$menu}},{{$cate}},'0')" href="#">1</a>
            </li>
            @for($i=1 ; $i<=$page ; $i++)
                <li id="pagelist{{$i}}" value="{{$i}}" >
                    <a style="padding: 10px;" onclick="loadplaylistcate({{$menu}},{{$cate}},'{{$i}}')" href="#">{{$i+1}}</a>
                </li>
            @endfor
        </ul>
    </center>
@endif
