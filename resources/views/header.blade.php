<div class="wrap-menu-desktop" style="top: 0px ;background-color:#282828 ;width: 100%; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif">
    <nav class="limiter-menu-desktop container" style="color: silver;">
        <!-- Logo desktop -->
        <a href="/" class="logo">
            <img style="margin-left: 100px" src="\template\images\logo.png" alt="IMG-LOGO">
        </a>

        <!-- menu desktop -->
        <div class="menu-desktop">
            <ul class="main-menu">
                <li class="active-menu">
                    <a style=" color: silver;font-family: Arial,sans-serif,Roboto; font-size: 16px" href="/">Trang Chủ</a>
                </li>
                {!! App\Http\Helper\Helper::menus($menus) !!}
            </ul>
        </div>

        <form action="/search/" id="search_form" style="margin-left: 69px;display: flex">
            <input style="width: 200px" type="search" id="search" class="form-control" name="search" placeholder="Search" aria-label="Search"/>
                <label for="upload_client" style="margin-left: 5px;margin-right: 5px;">
                <span style="font-size: 20px;margin: auto" aria-hidden="true"><i class="fas fa-file-audio"></i></span>
                <input type="file" name="file" id="upload_client" style="display:none">
            </label>
            <span class="input-group-text border-0" id="search-addon">
                <button type="submit">
                     <i class="fas fa-search"></i>
                </button>
            </span>
        </form>

        <form action="/search_file/" id="search_form_file" style="margin-left: 69px;display: none">
            <input style="width: 200px" type="search" id="search_test" class="form-control" name="search_test" placeholder="Search" aria-label="Search"/>
            <label for="upload_client_file" style="margin-left: 5px;margin-right: 5px;">
                <span style="font-size: 20px;margin: auto" aria-hidden="true"><i class="fas fa-file-audio"></i></span>
                <input type="file" name="file" id="upload_client_file" style="display:none">
                {{--                <div id="audio_show"> </div>--}}
            </label>
            <span class="input-group-text border-0" id="search-addon">
                <button type="submit">
                     <i class="fas fa-search"></i>
                </button>
            </span>
        </form>


        <div id="non_login"  style="margin-left: 50px ;color: silver;display: block">
            <ul class="list-inline m-0">
                <li class="list-inline-item" ><a style="color: silver" href="/user/login/" title="Đăng nhập">Đăng nhập</a></li>
                <li class="list-inline-item">/</li>
                <li class="list-inline-item"><a  style="color: silver" href="/user/register/"  title="Đăng ký">Đăng ký</a></li>
            </ul>
        </div>

        <div id="login" style="margin-left: 50px ;color: silver;display: none">
            <ul class="list-inline m-0">
                <li class="list-inline-item" ><a style="color: silver" id="username" title="anh"></a></li>
                <li class="list-inline-item">/</li>
                <li class="list-inline-item"><a  style="color: silver" href="/" onclick="dangxuat()" title="Đăng ký">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
</div>


<script>
    if (sessionStorage.getItem('nameuser')){
        var user =  document.getElementById('username');
        document.getElementById('login').style.display='block';
        document.getElementById('non_login').style.display='none';
        user.innerHTML='<b>'+sessionStorage.getItem('nameuser')+'</b>';
        document.getElementById('username').href = '/user/info/'+sessionStorage.getItem('id');
    }

    function dangxuat(){
        document.getElementById('login').style.display='none';
        document.getElementById('non_login').style.display='block';
        sessionStorage.removeItem('nameuser');
        sessionStorage.removeItem('id');
        sessionStorage.removeItem('email');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.getElementById('upload_client').addEventListener('change',function (){
        document.getElementById('search_form').style.display = 'none';
        document.getElementById('search_form_file').style.display = 'flex';
    })

    document.getElementById('search_test').addEventListener('change',function (){
        document.getElementById('search_form').style.display = 'flex'
        document.getElementById('search_form_file').style.display = 'none'
        document.getElementById('search').value = document.getElementById('search_test').value;
    })

    $('#upload_client').change(function (){
        const form =new FormData();
        document.getElementById('content').style.display='none';
        document.getElementById('header').style.display='none';
        document.getElementById('loading').style.display='block';
        form.append('file',$(this)[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/upload_song/services',
            success: function (results){
                if(results.error === false){
                    document.getElementById('content').style.display='block';
                    document.getElementById('header').style.display='block';
                    document.getElementById('loading').style.display='none';
                    document.getElementById('search_test').value = results.shape;
                }else {
                    alert('Tải bị lỗi');
                }
            }
        })
    })

    $('#upload_client_file').change(function (){
        const form =new FormData();
        document.getElementById('content').style.display='none';
        document.getElementById('header').style.display='none';
        document.getElementById('loading').style.display='block';
        form.append('file',$(this)[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/upload_song/services',
            success: function (results){
                if(results.error === false){
                    document.getElementById('content').style.display='block';
                    document.getElementById('header').style.display='block';
                    document.getElementById('loading').style.display='none';
                    document.getElementById('search_test').value = results.shape;
                }else {
                    alert('Tải bị lỗi');
                }
            }
        })
    })

</script>



