<div class="form-group col-md-3" >
    <form action="" method="POST">
        <label for="menu">Tên Slider</label><font color="red"> (*)</font>
        <input type="text" name="name" class="form-control" id="menu" value="{{$slider->name}}" placeholder="Enter name">

        <label for="url">URL</label><font color="red"> (*)</font>
        <input type="text" name="url" class="form-control" id="url" value="{{$slider->url}}" placeholder="http://nhactructuyen.test/">

        <div class="form-group">
            <label for="menu">Slide</label><font color="red"> (*)</font>
            <input type="file" id="upload_thumb"  style="padding: 5px" class="form-control">
            <div id="thumb_show">
                <img src="{!! $slider->thumb !!}" width="100px">
            </div>
            <input type="hidden" name="thumb" value="{{$slider->thumb}}" id="thumb">
        </div>

        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" name="active" {{ $slider->active == 1 ? 'checked':'' }} id="active">
                <label for="active" class="custom-control-label">Có</label>
            </div>

            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" name="active" {{ $slider->active == 0 ? 'checked':'' }} id="no_active">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
        </div>
        @csrf
    </form>
</div>
