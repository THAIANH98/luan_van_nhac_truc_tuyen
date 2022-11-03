@extends('admin.main')

@section('content')
    @if($var ==0)
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="menu">Tên Thể Loại</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name">
                        <br>
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputPassword1">Quốc Gia</label>--}}
{{--                            <select class="form-control" name="menu_id">--}}
{{--                                @foreach($menus as $menu)--}}
{{--                                    <option value="{{$menu->id}}"> {{$menu->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label>Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="1" type="radio" name="active" checked id="active">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="0" type="radio" name="active" id="no_active">
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                        <div>
                            <button type="submit"class="btn btn-primary">Thêm Thể Loại</button>
                        </div>
                    </div>
            @csrf
        </form>
    @else
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="menu">Tên Danh Mục</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" id="menu" value="{{ $category->name }}" placeholder="Enter name">
                        <br>
                        {{--                        @if($menu->parent_id != 0)--}}
                        {{--                        @endif--}}
                        <div class="form-group">
                            <label>Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="1" type="radio" name="active" {{ $category->active==1 ? 'checked':'' }} id="active">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="0" type="radio" {{ $category->active==0 ? 'checked':'' }} name="active" id="no_active">
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                        <div>
                            <button type="submit"class="btn btn-primary">Cập Nhật Thể Loại</button>
                        </div>
                    </div>
            @csrf
        </form>
    @endif

    <div style="  border-left: thin solid #000000;"></div>
    <div class="col-md-8" style="border: 2px" >
        <table class="table">
            <thead style="background: #0c84ff;color: white">
            <tr style="text-align: center">
                <th style="width: 100px; line-height: normal">
                    <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left" > Xóa
                </th>
                <th>STT</th>
                <th>Tên</th>
                <th>Kích hoạt</th>
                <th style="width: 100px"  >Sửa</th>
            </tr>
            </thead>
            @php
                $counter=1;
            @endphp
            <tbody style="text-align: center">
            @foreach($cgory as $cg)
                <tr>
                    <td>
                        <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="{{$cg->id}}" >
                    </td>
                    <td> {{ $counter }} </td>
                    <td style="text-align: left; width: auto">{{$cg->name}}</td>
                    <td> <div id="parent_active_{{$cg->id}}">{!!  \App\Http\Helper\Helper::active($cg->active,$cg->id,'/admin/category/change/'.$cg->id) !!} </div></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/category/edit/{{$cg->id}}" >
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @php
                    $counter++;
                @endphp
            @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm" type="button" id="button_del" href="#"
                onclick="delid()" style="display: none; height: 50px;width: 100px" >
            <i class="fas fa-trash"></i>
        </button>
        {{--            {!! $cgory->links() !!}--}}

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
                            removeRow($iddel[$i].value,'/admin/category/destroy');
                        }
                    }
                }
            }
        </script>
    </div>
    </div>
    </div>

@endsection



