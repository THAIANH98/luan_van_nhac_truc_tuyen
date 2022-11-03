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
        <ul style="margin-top: 5px;width: 100%">
            @foreach($playlistrandom as $key=>$playlist)
                <li>
                    <div class="row">
                        <div class="col-md-3 m-l-15">
                            <a id="{{$key}}" href="/playlist/{{$playlist->id}}/{{Str::slug($playlist->name,'-')}}.html">
                                <img title="{{$playlist->name}}" src="{!! $playlist->thumb !!}" width="60px" height="60px">
                            </a>
                        </div>
                        <div class="col-md-9 m-l--15" >
                            <a id="name-song-bxh" title="{{$playlist->name}}" href="/playlist/{{$playlist->id}}/{{Str::slug($playlist->name,'-')}}.html">
                                <b>{{ucwords($playlist->name)}}</b>
                            </a><br>
                            <a id="name-singer-bxh">V.A</a>
                        </div>
                    </div>
                </li>
                <hr>
            @endforeach
                @unset($playlistrandom[$key])

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

<script>
    const showsongs= document.getElementById('btn-more');
    const hidesongs= document.getElementById('btn-hide');
    const listshow = document.getElementById('listcontinue');

    function showsong(){
        showsongs.style.visibility='hidden';
        listshow.style.height='auto';
        hidesongs.style.visibility='visible';
        listshow.style.overflow='';
    }

    function hidesong(){
        showsongs.style.visibility='visible';
        listshow.style.height='460px';
        hidesongs.style.visibility='hidden';
        listshow.style.overflow='hidden';
    }

</script>
