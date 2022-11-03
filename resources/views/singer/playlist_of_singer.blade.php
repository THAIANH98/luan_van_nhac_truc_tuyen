<div class="row row10px float-col-width">
    @foreach($playlists as $key=> $playlist)
        @if(($key+1)%5!=0)
            <div class="col">
                <div class="card card1">
                    <a href="/playlist/{{$playlist->id}}/{!! Str::slug($playlist->name,'-') !!}.html" title="{{$playlist->name}}">
                        <div id="playlist{{$playlist->id}}" class="card-header" style="background-image: url({{$playlist->thumb}});">
                                <span style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                            z-index: 101;
                                                            top: calc((100% - 48px)/2);
                                                            left: calc((100% - 48px)/2);
                                                            width: 48px;
                                                            height: 48px;
                                                            display: block;" id="icon{{$playlist->id}}playlist"></span>
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
                            <span style="visibility: hidden;background:url(https://data.chiasenhac.com/imgs/icon.png)  left -28px no-repeat;position: absolute;
                                                        z-index: 101;
                                                        top: calc((100% - 48px)/2);
                                                        left: calc((100% - 48px)/2);
                                                        width: 48px;
                                                        height: 48px;
                                                        display: block;" id="icon{{$playlist->id}}playlist"></span>
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
