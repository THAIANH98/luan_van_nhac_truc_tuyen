@extends('main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
    <style>
        .form-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        .box_right_upload .form-group .form-control {
            opacity: 0.8;
            border: 1px solid rgba(151, 151, 151, 0.5);
            border-radius: 3px;
            font-size: 14px;
            color: #878787;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Regular';
            min-height: 40px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .box_right_upload .form-group label {
            font-size: 16px;

            color: #1B1B1B;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Bold';
        }

        .box_right_upload .form-group small {
            font-family: 'SFProDisplay-Regular';
            color: #FF2D55;
            letter-spacing: 0;
            font-size: 12px;
        }
        ul.token-input-list-facebook {
            overflow: hidden;
            height: auto !important;
            border: 1px solid #d3d3d3;
            cursor: text;
            font-size: 14px;
            min-height: 1px;
            z-index: 999;
            margin: 0;
            padding: 4px 8px;
            background-color: #fff;
            list-style-type: none;
            clear: left;
            min-height: 40px;
            font-family: 'SFProDisplay-Regular';
        }

        ul.token-input-list-facebook li input {
            border: 0;
            width: 100px;
            padding: 3px 8px;
            background-color: white;
            margin: 1px 0;
            -webkit-appearance: caret;
            color: #a0a0a0;
        }

        li.token-input-token-facebook {
            overflow: hidden;
            height: auto !important;
            height: 15px;
            margin: 1px 3px;
            padding: 3px 8px;
            background-color: #fc5975;
            color: white;
            cursor: default;
            border: 1px solid #fc5975;
            font-size: 13.6px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            float: left;
            white-space: nowrap;
        }
        li.input-token-none-facebook {
            background-color: #959595!important;
            border: 1px solid #959595!important;
        }

        li.token-input-token-facebook p {
            display: inline;
            padding: 0;
            margin: 0;
        }

        li.token-input-token-facebook span {
            color: white;
            margin-left: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        li.token-input-selected-token-facebook {
            background-color: #fc5975;
            border: 1px solid #f84d6a;
            color: #fff;
        }

        li.token-input-input-token-facebook {
            float: left;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        div.token-input-dropdown-facebook {
            position: absolute;
            width: 400px;
            background-color: #fff;
            overflow: hidden;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            cursor: default;
            font-size: 11px;
            font-family: Verdana;
            z-index: 1;
        }

        div.token-input-dropdown-facebook p {
            margin: 0;
            padding: 5px;
            font-weight: bold;
            color: #777;
        }

        div.token-input-dropdown-facebook ul {
            margin: 0;
            padding: 0;
        }

        div.token-input-dropdown-facebook ul li {
            background-color: #fff;
            padding: 3px;
            margin: 0;
            list-style-type: none;
        }

        div.token-input-dropdown-facebook ul li.token-input-dropdown-item-facebook {
            background-color: #fff;
        }

        div.token-input-dropdown-facebook ul li.token-input-dropdown-item2-facebook {
            background-color: #fff;
        }

        div.token-input-dropdown-facebook ul li em {
            font-weight: bold;
            font-style: normal;
        }

        div.token-input-dropdown-facebook ul li.token-input-selected-dropdown-item-facebook {
            background-color: #fc5975;
            color: #fff;
        }

        .box_right_upload .form-group .form-control {
            opacity: 0.8;
            border: 1px solid rgba(151, 151, 151, 0.5);
            border-radius: 3px;
            font-size: 14px;
            color: #878787;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Regular';
            min-height: 40px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
    <style>
        #box_left_user {
            float: left;
            width: 200px;
            margin-right: 20px;
            padding: 20px 0px 20px 20px;
            margin: 0 0 20px 0;
            background: #e5e5e5;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #box_left_user ul li {
            float: left;
            width: 100%;
            border-bottom: #d9d9d9 solid 1px;
        }
        #box_left_user ul li a {
            float: left;
            width: 190px;
            padding: 10px 0 10px 10px;
            font-size: 16px;
        }
        #box_left_user ul li a.active {
            background: #FFFFFF;
            color: #0689ba;
            font-weight: 700;
        }

        #box_left_user .box-img-avatar {
            float: left;
            width: 100%;
            border-bottom: #d9d9d9 solid 1px;
            padding: 0px 0px 20px 0px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
    @include('user.sidebar')
        <div class="col-md-9">
            <table class="table">
                <thead style="background: #0c84ff;width: 100%;color: white">
                <tr style="text-align: center;position: relative">
                    <th style="width: 100px; line-height: normal;position: relative">
                        <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left" > Xóa
                    </th >
                    <th style="text-align: center;position: relative">STT</th>
                    <th style="text-align: center;position: relative">Tên bài hát</th>
                    <th style="text-align: center;position: relative">Thể Loại</th>
                    <th style="text-align: center;position: relative">Hình Ảnh</th>
                    {{-- --}}
                    <th style="text-align: center;position: relative">Kích hoạt</th>
                    <th style="text-align: center;position: relative" >Sửa</th>
                </tr>
                </thead>
                <tbody style="text-align: center;margin-top: 200px;position: relative" id="danhsachbaihat">
                @foreach($songs as $counter => $song)
                    <tr>
                        <td>
                            <input type="checkbox" name="del_id[]"
                                   onclick="showbutton()"
                                   style="height: 20px;width: 20px"
                                   value="{{$song->id}}" >
                        </td>
                        <td> {{ $counter+1 }} </td>
                        <td style="text-align: left;width: 200px;">{{$song->name}}</td>
                        <td style="width: 200px;">{{$song->song_cate->name}}</td>
                        <td style="width: 200px;">
                            <img src="{!! $song->thumb !!}" width="80px">
                        </td>

                        <td>
                            <div>
                                @if($song->active ==1)
                                <span class="btn btn-success">
                                    Đã duyệt
                                </span>
                                @else
                                    <span class="btn btn-danger">
                                    Chờ duyệt
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/user/song/edit/{{$song->id}}/{{$user->id}}" >
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button   class="btn btn-primary btn-sm" type="button" id="button_del" href="#"
                      onclick="delid()" style="display: none; height: 50px;width: 100px;float: right" >
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>

    <div style="padding: 10px">
        {!! $songs->links() !!}
    </div>

@endsection


<script>
    function delall(){
        var $iddel = document.getElementsByName('del_id[]');
        var $delall = document.getElementsByName('del_all');
        if($delall[0].checked===true){
            document.getElementById('button_del').style.display='block';
            for($i=0 ; $i<$iddel.length;$i++){
                $iddel[$i].checked=true;
            }
        }
        else{
            document.getElementById('button_del').style.display='none';
            for($i=0 ; $i<$iddel.length;$i++){
                $iddel[$i].checked=false;
            }
        }
    }

    function showbutton(){
        var $iddel = document.getElementsByName('del_id[]');

        for($i=0 ; $i<$iddel.length;$i++){
            if ($iddel[$i].checked===true){
                return document.getElementById('button_del').style.display='block';
            }else {
                document.getElementById('button_del').style.display='none';
            }
        }
    }

    function delid(){
        if(confirm('Dữ liệu xóa không thể khôi phục. Bạn có muốn xóa không?')){
            var $iddel = document.getElementsByName('del_id[]');

            for($i=0 ; $i <$iddel.length;$i++){
                if($iddel[$i].checked===true){
                    removeRow($iddel[$i].value,'/user/song/destroy/');
                }
            }
        }
        location.reload();
    }

    function removeRow(id,url){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success:function (result){
                if(result.error === true){
                    location.reload();
                }else {
                    location.reload();
                }
            }
        })
    }
</script>
