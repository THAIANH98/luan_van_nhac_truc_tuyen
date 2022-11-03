@extends('admin.main')
@section('content')

    <table class="table">
        <thead style="background: #0c84ff;width: 100%;">
        <tr style="text-align: center;position: relative">
            <th style="text-align: center;position: relative">STT</th>
            <th style="text-align: center;position: relative">Tên Đăng Nhập</th>
            <th style="text-align: center;position: relative">Tên Hiển Thị</th>
            <th style="text-align: center;position: relative">Hình Ảnh</th>
            <th style="text-align: center;position: relative" >Số Bài Hát</th>
            <th style="text-align: center;position: relative" >Số Playlist</th>
            <th style="text-align: center;position: relative" >Chi Tiết</th>
        </tr>
        </thead>
        <tbody style="text-align: center;margin-top: 200px;position: relative" >
        @foreach($users as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td><img src="{!! $user->avatar !!}" width="60px" height="60px"></td>
                <td>{{count($user->user_song)}}</td>
                <td>{{count($user->user_playlist)}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/user/detail/{{$user->id}}" >
                        <i class="far fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{!! $users->links() !!}
@endsection
