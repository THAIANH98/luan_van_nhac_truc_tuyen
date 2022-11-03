@extends('admin.main')

@section('content')
    <button   class="btn btn-primary btn-sm" type="button" id="button_del" href="#"
              onclick="delid()" style="display: none; height: 50px;width: 100px;position: fixed; bottom: 0;left: 0;z-index: 100000" >
        <i class="fas fa-trash"></i>
    </button>
    <div class="row m-b-10">
        <div  style="display: flex;line-height: 48px" class="col-md-3">
            <label for="exampleInputPassword1">Danh mục: </label>
            <div class="form-inline">
                <select class="form-control" id="menu_id" >
                    <option value="*" >Tất cả</option>
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display: flex;line-height: 48px" class="col-md-3">
            <label style="margin-left: 50px" for="exampleInputPassword1">Thể loại: </label>
            <div class="form-inline">
                <select class="form-control" id="category_id">
                    <option value="*" >Tất cả</option>
                    @foreach($category as $ctegory)
                        <option value="{{$ctegory->id}}">{{$ctegory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">

        </div>

    </div>

    <table class="table">
        <thead style="background: #0c84ff;width: 100%;">
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
        @php
            $counter=1;
        @endphp
        <tbody style="text-align: center;margin-top: 200px;position: relative" id="danhsachbaihat">
        @foreach($songs as $song)
            <tr>
                <td>
                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="{{$song->id}}" >
                </td>
                <td> {{ $counter }} </td>
                <td style="text-align: left;width: 200px;">{{$song->name}}</td>
                <td style="width: 200px;">{{$song->song_cate->name}}</td>
                <td style="width: 200px;">
                    <img src="{!! $song->thumb !!}" width="80px">
                </td>

                <td><div id="parent_active_{{$song->id}}">{!!  \App\Http\Helper\Helper::active($song->active,$song->id,'/admin/song/change/'.$song->id) !!} </div> </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/song/edit/{{$song->id}}" >
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

    {{--    {!! $songs->links() !!}--}}

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
                        removeRow($iddel[$i].value,'/admin/song/destroy');
                    }
                }
            }
            alert('Xóa thành công');
            location.reload();
        }
    </script>

    <script>
        $url='/admin/song/list_genre';
    $(document).ready(function() {
        $('#category_id').bind('change',
            function song_genre(url){
            url=$url;
            var idcate = document.getElementById('category_id').value;
            var idmenu = document.getElementById('menu_id').value;
            if(idmenu=='*'){
                if (idcate!='*'){
                    url = url+'/'+idcate;
                    $.ajax({
                        // cache: false,
                        type: 'GET',
                        datatype: 'JSON',
                        // data: { id },
                        url: url,
                        success:function (result){
                            if (result.error === true){
                                alert('Hiện không có bài hát thể loại này');
                                location.reload();
                            }else {
                                console.log(result.songs);
                                var  html='';
                                $.each(result.songs, function (i,item){
                                    html +='<tr>';
                                    html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                    html +='<td>'+ (i+1) +'</td>';
                                    html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                    html +='<td style="width: 200px;">'+ result.catename +'</td>';
                                    html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                    // html +="<td>"+  +"</td>";
                                    // html +="<td>"+  +"</td>";
                                    if (item.active==1)
                                        html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                    else
                                        html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                    html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                    html +='</tr>';
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }else {
                    location.reload();
                }
            }else{
                if (idcate!='*'){
                    url = url+'/'+idmenu+'/'+idcate;
                    $.ajax({
                        // cache: false,
                        type: 'GET',
                        datatype: 'JSON',
                        // data: { id },
                        url: url,
                        success:function (result){
                            if (result.error === true){
                                alert('Hiện không có bài hát thể loại này');
                                location.reload();
                            }else {
                                console.log(result.songs);
                                var  html='';
                                $.each(result.songs, function (i,item){
                                    html +='<tr>';
                                    html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                    html +='<td>'+ (i+1) +'</td>';
                                    html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                    html +='<td style="width: 200px;">'+ result.catename +'</td>';
                                    html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                    // html +="<td>"+  +"</td>";
                                    // html +="<td>"+  +"</td>";
                                    if (item.active==1)
                                        html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                    else
                                        html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                    html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                    html +='</tr>';
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }else {
                    url = '/admin/song/list_menu_genre'+'/'+idmenu;
                    $.ajax({
                        type: 'GET',
                        datatype: 'JSON',
                        // data: { id },
                        url: url,
                        success:function (result){
                            if (result.error === true){
                                alert('Hiện không có bài hát thể loại này');
                                location.reload();
                            }else {
                                console.log(result.songs);
                                var  html='';
                                $.each(result.songs, function (i,item){
                                    html +='<tr>';
                                    html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                    html +='<td>'+ (i+1) +'</td>';
                                    html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                    for(var n=0;n<result.cate.length;n++){
                                        if(result.cate[n].id == item.category_id){
                                            html +='<td style="width: 200px;">'+ result.cate[n].name +'</td>';
                                            break;
                                        }
                                    }

                                    html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                    // html +="<td>"+  +"</td>";
                                    // html +="<td>"+  +"</td>";
                                    if (item.active==1)
                                        html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                    else
                                        html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                    html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                    html +='</tr>';
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }
            }

        }
    )});
    $(document).ready(function() {
        $('#menu_id').bind('change',
            function song_genre(url){
                url=$url;
                var idcate = document.getElementById('category_id').value;
                var idmenu = document.getElementById('menu_id').value;
                if(idmenu=='*'){
                    if (idcate!='*'){
                        url = url+'/'+idcate;
                        $.ajax({
                            // cache: false,
                            type: 'GET',
                            datatype: 'JSON',
                            // data: { id },
                            url: url,
                            success:function (result){
                                if (result.error === true){
                                    alert('Hiện không có bài hát thể loại này');
                                    location.reload();
                                }else {
                                    console.log(result.songs);
                                    var  html='';
                                    $.each(result.songs, function (i,item){
                                        html +='<tr>';
                                        html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                        html +='<td>'+ (i+1) +'</td>';
                                        html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                        html +='<td style="width: 200px;">'+ result.catename +'</td>';
                                        html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                        // html +="<td>"+  +"</td>";
                                        // html +="<td>"+  +"</td>";
                                        if (item.active==1)
                                            html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                        else
                                            html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                        html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                        html +='</tr>';
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }else {
                        location.reload();
                    }
                }else{
                    if (idcate!='*'){
                        url = url+'/'+idmenu+'/'+idcate;
                        $.ajax({
                            // cache: false,
                            type: 'GET',
                            datatype: 'JSON',
                            // data: { id },
                            url: url,
                            success:function (result){
                                if (result.error === true){
                                    alert('Hiện không có bài hát thể loại này');
                                    location.reload();
                                }else {
                                    console.log(result.songs);
                                    var  html='';
                                    $.each(result.songs, function (i,item){
                                        html +='<tr>';
                                        html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                        html +='<td>'+ (i+1) +'</td>';
                                        html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                        html +='<td style="width: 200px;">'+ result.catename +'</td>';
                                        html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                        // html +="<td>"+  +"</td>";
                                        // html +="<td>"+  +"</td>";
                                        if (item.active==1)
                                            html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                        else
                                            html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                        html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                        html +='</tr>';
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }else {
                        url = '/admin/song/list_menu_genre'+'/'+idmenu;
                        $.ajax({
                            type: 'GET',
                            datatype: 'JSON',
                            // data: { id },
                            url: url,
                            success:function (result){
                                if (result.error === true){
                                    alert('Hiện không có bài hát thể loại này');
                                    location.reload();
                                }else {
                                    console.log(result.songs);
                                    var  html='';
                                    $.each(result.songs, function (i,item){
                                        html +='<tr>';
                                        html +="<td> <input type='checkbox' name='del_id[]' onclick='showbutton()' style='height: 20px;width: 20px'  value='"+ item.id +"'> </td>";
                                        html +='<td>'+ (i+1) +'</td>';
                                        html +='<td style="text-align: left;width: 200px;">'+ item.name +'</td>';
                                        for(var n=0;n<result.cate.length;n++){
                                            if(result.cate[n].id == item.category_id){
                                                html +='<td style="width: 200px;">'+ result.cate[n].name +'</td>';
                                                break;
                                            }
                                        }

                                        html +="<td style='width: 200px;'> <img src='"+ item.thumb +"' width='80px'> </td>";
                                        // html +="<td>"+  +"</td>";
                                        // html +="<td>"+  +"</td>";
                                        if (item.active==1)
                                            html +=" <td><div id='parent_active_"+item.id+"' ><span id='menu-yes-"+item.id+"' class='btn btn-success btn-xs' onclick=change_active("+ item.active +",'/admin/song/change/"+item.id+"')>Yes</span></div> </td>";
                                        else
                                            html +=" <td><div id='parent_active_"+item.id+"' > <span id='menu-no-"+item.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'/admin/song/change/"+ item.id +"')>No</span></div>  </td>";
                                        html += "<td><a class='btn btn-primary btn-sm' href='/admin/song/edit/"+item.id+"' > <i class='far fa-edit'></i> </a></td>";
                                        html +='</tr>';
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }
                }

            }
        )});

    </script>

@endsection
