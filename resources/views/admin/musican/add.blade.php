@extends('admin.main')

@section('head')
    <script src="//cdn.ckeditor.com/4.16.2/basic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card-body">
        <div class="row">

            <div class="form-group col-md-3 " >
                @if($var==0)
                    <form action="" method="POST">
                        <label for="menu">Tên Nhạc Sĩ</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                        <label for="menu">Ngày Sinh</label>
                        <input type="text" name="birthday" class="form-control" id="menu" placeholder="Enter birthday: 30/12/2020">
                        <div class="form-group">
                            <label for="menu">Avatar</label>
                            <input type="file" id="upload"  style="padding: 5px" class="form-control">
                            <div id="avatar_show"></div>
                            <input type="hidden" name="avatar" id="file">
                        </div>
                        <div class="form-group">
                            <label for="menu">Mô tả</label>
                            <textarea name="description" id="description" class="form-control" ></textarea>
                        </div>

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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm Nhạc Sĩ</button>
                        </div>
                        @csrf
                    </form>
                @else
                    @include('admin.musican.edit')
                @endif
            </div>

            <div style="margin-left: 10px; margin-right: 50px; border-left: thin solid #000000;"></div>
            <div class="form-group col-md-8">
                @include('admin.musican.list')
            </div>
        </div>
    </div>

@endsection


@section('footer')
    <script>
        CKEDITOR.replace('description')
    </script>
@endsection
