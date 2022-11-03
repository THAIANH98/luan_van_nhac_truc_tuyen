@extends('admin.main')

<style>
    .center-text {
        /*width: 400px;*/
        /*height: 120px;*/
        /*font-size: 24px;*/
        /*line-height: 120px;*/
        text-align: center;
        background-color: #fafafa;
        /*border: solid 1px lightgray;*/
        /*display: table-cell;*/
        /*text-align: center;*/
        vertical-align: middle;
    }
</style>

@section('content')
    @if($var ==0)
{{--        <form action="" method="POST">--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    <div class="form-group col-md-3">--}}
{{--                        <label for="menu">Tên Quốc Gia</label><font color="red"> (*)</font>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control" name="menu_id">--}}
{{--                                @foreach($menus as $menu)--}}
{{--                                    <option value="{{$menu->id}}"> {{$menu->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputPassword1">Danh Sách Thể Loại</label>--}}
{{--                                <div class="form-control pl-4 " style="   height: 200px;--}}
{{--                                                                  overflow-y: scroll;--}}
{{--                                                                  scrollbar-color: #656262;--}}
{{--                                                                  scrollbar-width: thin;" >--}}
{{--                                    @foreach($cates as $cate)--}}
{{--                                        <input type="checkbox" name="cate_id[]" style="width: 20px;height: 20px" id="{{ $cate->name }}" value="{{ $cate->id }}">--}}
{{--                                        <label class="form-check-label" for="{{ $cate->name }}">--}}
{{--                                            {{ $cate->name }}--}}
{{--                                        </label>--}}
{{--                                        <br>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <button type="submit"class="btn btn-primary">Thêm Danh Mục</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--            @csrf--}}
{{--        </form>--}}
    @else
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
{{--                        <label for="menu">Tên Quốc Gia</label><font color="red"> (*)</font>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control" name="menu_id">--}}
{{--                                @foreach($menus as $menu)--}}
{{--                                    <option value="{{$menu->id}}"> {{$menu->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh Sách Thể Loại</label>
                                <div class="form-control pl-4 " style="   height: 200px;
                                                                  overflow-y: scroll;
                                                                  scrollbar-color: #656262;
                                                                  scrollbar-width: thin;" >

                                    @php
                                        $i=0;
                                        foreach($menucate->menu_category as $catemenu )
                                            $i++;
                                    @endphp

                                    @foreach($cates as $cate)
                                        @if($i!=0)
                                            @foreach($menucate->menu_category as $cateid)
                                                <input type="checkbox" name="cate_id[]" style="width: 20px;height: 20px" {{ $cate->id == $cateid->id ? 'checked=true':'' }}
                                                id="{{ $cate->name }}" value="{{ $cate->id }}"
                                            @endforeach>
                                        @else
                                            <input type="checkbox" name="cate_id[]" style="width: 20px;height: 20px"
                                                   id="{{ $cate->name }}" value="{{ $cate->id }}">
                                        @endif
                                        <label class="form-check-label" for="{{ $cate->name }}">
                                            {{ $cate->name }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit"class="btn btn-primary">Cập Nhật Danh Sách Thể Loại</button>
                        </div>
                    </div>
            @csrf
        </form>
    @endif

    <div style="  border-left: thin solid #000000;"></div>
    <div class="col-md-12" style="border: 2px" >
        <table class="table center-text">
            <thead style="background: #0c84ff;color: white">
            <tr style="text-align: center">
                <th>Danh Mục</th>
                <th>Thể Loại</th>
                <th>Sửa</th>
            </tr>
            </thead>
            <tbody style="text-align: center">
                @foreach($menus as $menu)
                    @if(empty($menu->menu_category))
                        @continue
                    @else
                    <tr>
                        <td>{{$menu->name}}</td>
                    @endif
                            <td style="text-align: left">
                            @foreach($menu->menu_category as $cate)
                                {{$cate->name}}<hr>
                            @endforeach
                            </td>
                        <td><a href="/admin/menu/editcate/{{$menu->id}}">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
{{--        <button class="btn btn-primary btn-sm" type="button" id="button_del" href="#"--}}
{{--                onclick="delid()" style="display: none; height: 50px;width: 100px" >--}}
{{--            <i class="fas fa-trash"></i>--}}
{{--        </button>--}}
{{--        <script>--}}
{{--            function delall(){--}}
{{--                var $iddel = document.getElementsByName('del_id[]');--}}
{{--                var $delall = document.getElementsByName('del_all');--}}
{{--                if($delall[0].checked===true){--}}
{{--                    document.getElementById('button_del').style.display='block';--}}
{{--                    for($i=0 ; $i<$iddel.length;$i++){--}}
{{--                        $iddel[$i].checked=true;--}}
{{--                    }--}}
{{--                }--}}
{{--                else{--}}
{{--                    document.getElementById('button_del').style.display='none';--}}
{{--                    for($i=0 ; $i<$iddel.length;$i++){--}}
{{--                        $iddel[$i].checked=false;--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}

{{--            function showbutton(){--}}
{{--                var $iddel = document.getElementsByName('del_id[]');--}}

{{--                for($i=0 ; $i<$iddel.length;$i++){--}}
{{--                    if ($iddel[$i].checked===true){--}}
{{--                        return document.getElementById('button_del').style.display='block';--}}
{{--                    }else {--}}
{{--                        document.getElementById('button_del').style.display='none';--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}

{{--            function delid(){--}}
{{--                if(confirm('Dữ liệu xóa không thể khôi phục. Bạn có muốn xóa không?')){--}}
{{--                    var $iddel = document.getElementsByName('del_id[]');--}}

{{--                    for($i=0 ; $i <$iddel.length;$i++){--}}
{{--                        if($iddel[$i].checked===true){--}}
{{--                            removeRow($iddel[$i].value,'/admin/menu/destroy');--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        </script>--}}
    </div>
    </div>
    </div>

@endsection
