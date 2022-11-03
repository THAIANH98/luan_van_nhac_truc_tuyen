<form action="" method="POST">
    <label for="menu">Tên Nhạc Sĩ</label><font color="red"> (*)</font>
    <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $musican->name}}">
    <label for="menu">Ngày Sinh</label>
    <input type="text" name="birthday" class="form-control" id="menu" value="{{ $musican->birthday}}" placeholder="Enter birthday: 30/12/2020">
    <div class="form-group">
        <label for="menu">Avatar</label>
        <input type="file" id="upload"  style="padding: 5px" class="form-control">
        <div id="avatar_show">
            <img src="{!! $musican->avatar !!}" width="100px">
        </div>
        <input type="hidden" name="avatar" value="{{$musican->avatar}}" id="file">
    </div>

    <div class="form-group">
        <label for="menu">Mô tả</label>
        <textarea name="description" id="description" class="form-control" > {{$musican->description}}</textarea>
    </div>

    <div class="form-group">
        <label>Kích hoạt</label>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" name="active" {{ $musican->active == 1 ? 'checked' : '' }}  id="active">
            <label for="active" class="custom-control-label">Có</label>
        </div>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" {{ $musican->active == 0 ? 'checked' : '' }} name="active" id="no_active">
            <label for="no_active" class="custom-control-label">Không</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Nhạc Sĩ</button>
    </div>
    @csrf
</form>
