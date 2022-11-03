<table class="table" >
    <thead style="background: #0c84ff;color: white">
    <tr style="text-align: center">
        <th style="width: 100px; line-height: normal">
            <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left" > Xóa
        </th>
        <th>STT</th>
        <th>Tên slider</th>
        <th>URL</th>
        <th>Slider</th>
        <th style="width: 200px">Kích hoạt</th>
        <th style="width: 100px"  >Sửa </th>
    </tr>
    </thead>
    <tbody style="text-align: center">
    @php
        $counter=1;
    @endphp
    @foreach($sliders as $slider)
        <tr>
            <td>
                <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="{{$slider->id}}" >
            </td>
            <td> {{ $counter }} </td>
            <td style="text-align: left;">{{$slider->name}}</td>
            <td style=" text-align: left;">{{$slider->url}}</td>
            <td>
                <img src="{!! $slider->thumb !!}" width="80px">
            </td>
            <td> <div id="parent_active_{{$slider->id}}"></div> {!!  \App\Http\Helper\Helper::active($slider->active,$slider->id,'/admin/slider/change/'.$slider->id) !!}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/slider/edit/{{$slider->id}}" >
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
{!! $sliders->links() !!}
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
                    removeRow($iddel[$i].value,'/admin/slider/destroy');
                }
            }
        }
        alert('Xóa Thành Công');
        location.reload();
    }
</script>
