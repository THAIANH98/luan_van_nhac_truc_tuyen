@php
    $count=1;
    $page = $count_list/15;
@endphp
    @if(count($playlists)==0)
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <span class="txt-note">Từ khoá <b>{{$key}}</b> có 0 kết quả</span>
            </div>
        </div>
    @else
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <span class="txt-note">Từ khoá <b>{{$key}}</b> có {{ count($playlists) }} kết quả</span>
            </div>
        </div>
    @endif


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

<center>
    <ul class="pagination">
        <li id="pagelist0" value="0" class="active">
            <a style="padding: 10px;" onclick="loadplaylist_search('0','{{$key}}')" href="#">1</a>
        </li>
        @for($i=1 ; $i<=$page ; $i++)
            <li id="pagelist{{$i}}" value="{{$i}}" >
                <a style="padding: 10px;" onclick="loadplaylist_search('{{$i}}','{{$key}}')" href="#">{{$i+1}}</a>
            </li>
        @endfor
    </ul>
</center>


<script>

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
