<div class="row">
    <div class="col-md-8" style="color: #0c84ff">
        <h4>Nghe tiếp</h4>
    </div>
    <div class="col-md-4">
        <label>Autoplay</label>
        <label class="switch-checkbox">
            <input type="checkbox" onclick="checkcontinue()" id="checkcontinue" >
            <span class="slider-check round-check"></span>
        </label>
    </div>
</div>

<script>
    if (sessionStorage.getItem('checked')==1){
        document.getElementById('checkcontinue').checked = true;
    }

    function checkcontinue() {
        if(document.getElementById('checkcontinue').checked===true){
            sessionStorage.setItem('checked',1);
        }else{
            sessionStorage.removeItem('checked');
        }
    }

</script>

<div id="listcontinue">
    <div class="row">
        <ul style="margin-top: 5px">
            @foreach($songrandom as $key=>$song)
                <li>
                    <div class="row">
                        <div class="col-md-3 m-l-15">
                            <a id="{{$key}}" href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html">
                                <img title="{{$song->name}}" src="{!! $song->thumb !!}" width="60px" height="60px">
                            </a>
                        </div>
                        <div class="col-md-9 m-l--15 " >
                            <a id="name-song-bxh" title="{{$song->name}}" href="/song/{{$song->id}}/{{Str::slug($song->name,'-')}}.html">
                                <b>{{ucwords($song->name)}}</b>
                            </a><br>
                            @php
                                $count= count($song->song_singer);
                            @endphp
                            @foreach($song->song_singer as $singer)
                                @if($count!=1)
                                    <a id="name-singer-bxh" href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html" >{{$singer->name}},</a>
                                @else
                                    <a id="name-singer-bxh" href="/singer/{{$singer->id}}/{{\Illuminate\Support\Str::slug($singer->name,'-')}}.html"  >{{$singer->name}}</a>
                                @endif
                                @php
                                    $count--;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </li>
                <hr>
            @endforeach
        </ul>
    </div>
</div>
<div style="width: 300px;text-align: center; margin-top: 10px;">
    <button onclick="showsong()" id="btn-more" class="btn-more">
        Xem thêm
    </button>
    <button onclick="hidesong()" class="btn-hide" id="btn-hide">
        Thu gọn
    </button>
</div>



