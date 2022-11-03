<div class="form-group col-md-3 " >
    <form action="" method="POST">
        <label for="menu">Tên Ca Sĩ</label><font color="red"> (*)</font>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name" value="{{$singer_edit->name}}" >

        <label for="menu">Ngày Sinh</label>
        <input type="text" name="birthday" class="form-control" id="menu" value="{{$singer_edit->birthday}}" placeholder="Enter birthday: 30/12/2020">

        <div class="form-group">
            <label for="menu">Avatar</label>
            <input type="file" id="upload"  style="padding: 5px" class="form-control">
            <div id="avatar_show">
                <img src="{!! $singer_edit->avatar !!}" width="100px">
            </div>
            <input type="hidden" name="avatar" value="{{$singer_edit->avatar}}" id="file">
        </div>

        <div class="form-group">
            <label for="menu">Mô tả </label>
            <textarea name="description" id="description" class="form-control" > {{$singer_edit->description}} </textarea>
        </div>

        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" {{ $singer_edit->active == 1 ? 'checked' : '' }} name="active" checked id="active">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" {{ $singer_edit->active == 0 ? 'checked' : '' }} name="active" id="no_active">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Ca Sĩ</button>
        </div>
        @csrf
    </form>
</div>
