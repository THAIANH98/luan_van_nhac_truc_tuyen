@extends('admin.main')

{{--@section('head')--}}
{{--    <script src="/ckeditor/ckeditor.js"></script>--}}
{{--@endsection--}}

@section('content')
    <div class="card-body">
        <div class="row">
            @if($var==0)
                <div class="form-group col-md-3" >
                    <form action="" method="POST">
                        <label for="menu">Tên Slider</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name">

                        <label for="url">URL</label><font color="red"> (*)</font>
                        <input type="text" name="url" class="form-control" id="url" placeholder="http://nhactructuyen.test/">

                        <div class="form-group">
                            <label for="menu">Slide</label><font color="red"> (*)</font>
                            <input type="file" id="upload_thumb"  style="padding: 5px" class="form-control">
                            <div id="thumb_show"></div>
                            <input type="hidden" name="thumb" id="thumb">
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
                            <button type="submit" class="btn btn-primary">Thêm Slider</button>
                        </div>
                        @csrf
                    </form>
                </div>

            @else
                @include('admin.slider.edit')
            @endif


            <div style="margin-left: 10px; margin-right: 50px; border-left: thin solid #000000;"></div>

            <div class="form-group col-md-8">
                @include('admin.slider.list')
            </div>

        </div>
    </div>


@endsection

{{--@section('footer')--}}
{{--    <script>--}}
{{--        CKEDITOR.replace('description')--}}
{{--    </script>--}}
{{--@endsection--}}
