<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"type="image/icon type">
    <title>{{$title}}</title>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/template/css/util.css">
    <link rel="stylesheet" type="text/css" href="/template/css/main.css">
    <link rel="stylesheet" href="/template/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/template/owlcarousel/assets/owl.theme.default.min.css">
    <script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/template/owlcarousel/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">


<!--===============================================================================================-->
</head>



<style>

    .pagination > .active > a {
        z-index: 3;
        color: #fff;
        background-color: #007efc !important;
        border-color: #007efc!important;
        cursor: default;
    }

    #name-singer-bxh{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 12px;
    }

    #name-song-bxh{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 14px;
    }

    .counter_view{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 10px;
        margin-right: 20px;
    }

    .bxh .media.now .media-left {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }



    a {
        color: #000000;
        text-decoration: none;
    }

    .row10px {
        margin: 0 -10px;
    }

    .card1 {
        border: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-radius: 0;
        margin-bottom: 20px;
        background-color: transparent;
    }

    .card1 .card-header {
        padding: 0;
        padding-top: 100%;
        background-color: transparent;
        background-position: center;
        background-size: cover;
        border-radius: 3px;
        position: relative;
        -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .card1 .card-body {
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
        padding-top: 10px;
    }

    .card1 .card-body .card-title {
        font-size: 14px;
        letter-spacing: 0;
        line-height: 19px;
        margin-bottom: 5px;
        text-transform: capitalize;
    }

    .card1 .card-header a span {
        position: absolute;
        z-index: 101;
        top: calc((100% - 48px)/2);
        left: calc((100% - 48px)/2);
        width: 48px;
        /*visibility: hidden;*/
        height: 48px;
        display: block;
        /*background: url(https://data.chiasenhac.com/imgs/icon.png) left -28px no-repeat;*/
    }
    #navmenu ul {
        margin: 0 0em;
        max-width: none;
        box-shadow: inset 0 -2px #d1d3d2;
    }

    #navmenu li {
        display: list-item;
        text-align: -webkit-match-parent;
    }

    #navmenu ul {
        position: relative;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: flex;
        margin: 0 auto;
        padding: 0;
        max-width: 1200px;
        list-style: none;
        -ms-box-orient: horizontal;
        -ms-box-pack: center;
        -webkit-flex-flow: row wrap;
        -moz-flex-flow: row wrap;
        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
    }

    nav {
        text-align: center;
    }

    #navmenu li a {
        font-weight: 700!important;
        font-size: 18px!important;
        text-decoration-line: none;
        letter-spacing: 0;
        color: #74777b;
        font-family: 'SFProDisplay-Bold';
        text-transform: uppercase;
        white-space: nowrap;
        border: none;
    }

    #navmenu ul li {
        position: relative;
        z-index: 1;
        display: block;
        margin: 0;
        text-align: left;
        /*text-align: center;*/
        -webkit-flex: 1;
        -moz-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .tabs nav a span {
        vertical-align: middle;
        font-size: 0.75em;
    }

    #navmenu li.tab-current a {
        box-shadow: inset 0 -2px #007efc;
        color: #007efc;
        border-bottom-color: #007efc;
    }

    .float-col-width .col {
        width: 20%!important;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
        -webkit-box-flex: initial;
        -ms-flex-positive: initial;
        flex-grow: initial;
    }

    .card1 .card-body .card-text {
        font-size: 12px;
        color: #878787;
        letter-spacing: 0;
        text-transform: capitalize;
    }

    body{
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }


    .pagination > li {
        display: inline;
    }
    #newtab{
        margin-left: 50px;
        color: #999999;
    }

    #prevslide{
        opacity: 0.1;filter: alpha(opacity=30);
        background: #f50000;
        height: 50px;
        width: 50px;
        position: absolute; left:0px;top: 50px;
        background-color: silver;
        margin-top: auto;
        margin-bottom: auto;
    }
    #prevslide:hover{
        opacity: 0.5;filter: alpha(opacity=100);
    }

    #nextslide{
        opacity: 0.1;filter: alpha(opacity=30);
        height: 50px;
        width: 50px;
        position: absolute; right:0px;top: 50px;
        background-color: silver;
        width: 50px;
    }
    #nextslide:hover{
        opacity: 0.5;filter: alpha(opacity=100);
    }


    #tieude{
        color: #42a1ff;
        font-size: 30px;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    #listcontinue{
        height: 460px;
        overflow: hidden;
        width: 100%;
    }

    .btn-more{
        height: 25px;
        line-height: 25px;
        width: 150px;
        background-color: silver;
        border-radius: 20px;
        visibility: visible;
    }

    .btn-more:hover{
        background-color: #2daaed;
        color: white;
    }

    .btn-hide{
        height: 25px;
        line-height: 25px;
        width: 150px;
        background-color: silver;
        border-radius: 20px;
        visibility: hidden;
    }

    .btn-hide:hover{
        background-color: #2daaed;
        color: white;
    }


</style>

@yield('head')
