@extends('admin.main')

@section('content')
    <button class="btn btn-danger btn-sm" type="button" id="button_del" href="#"
            onclick="delid()" style="display: none; height: 50px;width: 100px;position: fixed;bottom: 0;left: 0;z-index: 100000" >
        <span> Từ chối</span>
    </button>

    <button class="btn btn-primary btn-sm" type="button" id="button_ok" href="#"  onclick="duyetqua()" style="display: none; height: 50px;width: 100px;position: fixed;bottom: 0;left: 100px;z-index: 100001" >
        <span>Duyệt qua</span>
    </button>
    <table class="table" style="position: absolute;">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
            <th style="width: 150px; line-height: normal">
                <input type="checkbox" id="del_all" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left" > <label for="del_all">Chọn Nhiều</label>
            </th>
            <th>STT</th>
            <th>Hình Ảnh</th>
            <th>Tên</th>
            <th>
                <select style="text-align: center" class="form-control" name="menu_id" id="menu_id" >
                    <option style="text-align: center" value="*">Danh Mục</option>
                    @foreach($menus as $menu)
                        <option style="text-align: center" value="{{$menu->id}}">{{ucwords($menu->name)}}</option>
                    @endforeach
                </select>
            </th>
            {{--            <th>Danh sách bài hát</th>--}}
            <th>Tình Trạng Duyệt</th>
            <th style="width: 200px"  >Danh Sách Bài Hát</th>
        </tr>
        </thead>
        @php
            $counter=1;
        @endphp
        <tbody style="text-align: center" id="danhsachbaihat">
        @foreach($playlistxs as $playlist)
            <tr>
                <td>
                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="{{$playlist->id}}" >
                </td>
                <td> {{ $counter }} </td>
                <td> <img src="{!! $playlist->thumb !!}" width="80px" height="80px"> </td>
                <td style="width: auto">{{$playlist->name}}</td>
                <td>
                    <label class="form-check-label">
                        {{ $playlist->menu_playlist->name }}
                    </label>
                    <br>
                </td>
                <td> <div id="parent_active_{{$playlist->id}}"> </div> {!!  \App\Http\Helper\Helper::active($playlist->active,$playlist->id,"/admin/playlist/change/".$playlist->id) !!}</td>

                <td>
                    <a class="btn btn-primary btn-sm" >
                        <i onclick="doitrangthai({{$playlist->id}})" class="far fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            @php
                $counter++;
            @endphp
        @endforeach
        </tbody>
    </table>


    <style>
        #listbaihat{overflow-y: scroll;scrollbar-color: #656262;scrollbar-width: thin;z-index: 1;  visibility: hidden;position: absolute;right: 35%;
            background: #0a0e14;
            height: 500px;
            opacity: 0.9;
            width: 500px;
            color: white;
            text-align: left;
        }

        #namesong{
            margin-left: 50px;
        }
    </style>


    <div id="listbaihat">

    </div>

    <script>
        function doitrangthai(id){
            if(document.getElementById("listbaihat").style.visibility == "hidden"){
                var url ='/admin/playlist/song/'+id;
                $.ajax({
                    type: 'GET',
                    datatype: 'JSON',
                    url: url,
                    success:function (result){
                        if (result.error == true){
                            var  html='';
                            $('#listbaihat').html(html);
                            alert('Hiện không có bài hát thể loại này');
                        }else {
                            console.log(result.song);
                            var  html='';
                            $.each(result.song, function (i,item){
                                html+='<label id="namesong">'+item.name+'</label><br>';
                                $('#listbaihat').html(html);
                            });
                        }
                    }});
                document.getElementById("listbaihat").style.visibility = "visible";
            }
            else
                document.getElementById("listbaihat").style.visibility = "hidden";
        };

        $(document).ready(function() {
            $('#menu_id').bind('change',
                function song_genre(){
                    var idmenu = document.getElementById('menu_id').value;
                    var url ='/admin/browse/playlist';
                    if (idmenu!='*'){
                        url = url+'/'+idmenu;
                        $.ajax({
                            type: 'GET',
                            datatype: 'JSON',
                            url: url,
                            success:function (result){
                                if (result.error == true){
                                    var  html='';
                                    $('#danhsachbaihat').html(html);
                                    alert('Hiện không có bài hát thể loại này');
                                }else {
                                    console.log(result.playlist);
                                    var  html='';
                                    $.each(result.playlist, function (i,item){
                                        html +='<tr>';
                                        html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                        html +='<td>'+ (i+1) +'</td>';
                                        html +="<td> <img src='"+ item.thumb +"'  width='80px' height='80px'> </td>";
                                        html +='<td style="text-align: center;width: 200px;"><label class="form-check-label">'+ item.name +'</label></td>';
                                        html +='<td>'+ result.menu.name +'</td>';
                                        if (item.active==1)
                                            html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/playlist/change/"+item.id+"')>Yes</span></div> </td>";
                                        else
                                            html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/playlist/change/"+ item.id +"')>No</span></div>  </td>";
                                        html += "<td><a class='btn btn-primary btn-sm' > <i onclick='doitrangthai("+item.id +")' class='far fa-solid fa-eye'></i> </a></td>";
                                        html +='</tr>';
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }else {
                        location.reload();
                    }
                }
            );
        });
    </script>

    <script>
        function delall(){
            var $iddel = document.getElementsByName('del_id[]');
            var $delall = document.getElementsByName('del_all');
            if($delall[0].checked===true){
                document.getElementById('button_del').style.display='block';
                document.getElementById('button_ok').style.display='block';
                for($i=0 ; $i<$iddel.length;$i++){
                    $iddel[$i].checked=true;
                }
            }
            else{
                document.getElementById('button_ok').style.display='none';
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
                    document.getElementById('button_del').style.display='block';
                    document.getElementById('button_ok').style.display='block';
                }else {
                    document.getElementById('button_del').style.display='none';
                    document.getElementById('button_ok').style.display='none';
                }
            }
        }

        function delid(){
            if(confirm('Bạn có muốn từ chối các playlist đã chọn')){
                var $iddel = document.getElementsByName('del_id[]');
                for($i=0 ; $i <$iddel.length;$i++){
                    if($iddel[$i].checked===true){
                        removeRow($iddel[$i].value,'/admin/browse/destroy/playlist');
                    }
                }
                alert('Từ chối thành công');
                location.reload();
            }

        }

        function duyetqua(){
            if(confirm('Các bài hát bạn chọn sẽ được duyệt qua.')){
                var $iddel = document.getElementsByName('del_id[]');

                for($i=0 ; $i <$iddel.length;$i++){
                    if($iddel[$i].checked===true){
                        change_active(0,'/admin/playlist/change/'+$iddel[$i].value);
                    }
                }
                alert('Đã duyệt thành công');
                location.reload();
            }

        }
    </script>
@endsection
