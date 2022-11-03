<!doctype html>
<html lang="en">
    @include('head')
    <style>
        #status {
            width: 200px;
            height: 200px;
            position: fixed;
            left: 50%;
            /*z-index: 100;*/
            top: 50%;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921');
            background-repeat: no-repeat;
            background-position: center;
            margin: -100px 0 0 -100px;
            z-index: 1001
        }

        #loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-color: #FFF;
            z-index: 1000
        }
    </style>
    <div id="loading" style="display: none">
        <div id='status'>
            <b style="margin-left: 5px">Đang xử lý đoạn âm thanh</b>
        </div>
        <div id='loader'></div>
    </div>
    <body>

    <header id="header" style="display: block">
        @include('header')
    </header>


    <div class="container" id="container" style="display: block;margin-top: 100px;overflow: hidden">
        <div id="content" style="display: block">
            @yield('content')
        </div>
    </div>
    <div style="display: block;position: relative;width: 100%;margin-top: 100px">
        @include('footer')
    </div>
    </body>
</html>
