@extends('admin.main')
@section('content')
    <style>
        span {
            font-size: 20px;
            padding: 10px;
        }
    </style>
    <div class="row">
        <div class="col-md-3">
            <img src="{!! $user->avatar !!}" height="198px" width="198px"><br>
            <label style="font-size: 20px">Tên thành viên:</label>  {{$user->name}}<br>
            <label style="font-size: 20px">Email thành viên:</label>  {{$user->email}}
        </div>
        <div style="  border-left: thin solid #7e7d7d;"></div>
        <div class="col-md-4">
            <span>Số Lượng Bài Hát: {{count($user->user_song)}}</span>
            <table class="table">
                <thead style="background: #0c84ff;width: 100%;">
                <tr style="text-align: center;position: relative">
                    <th style="text-align: center;position: relative">STT</th>
                    <th>Tên Bài Hát</th>
                    <th>Tình trạng</th>
                </tr>
                </thead>
                <tbody style="text-align: center;position: relative" >
                @foreach($user->user_song as $key => $song)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$song->name}}</td>
                        <td>
                            <div>
                                @if($song->active ==1)
                                    <a href="/song/99/con-trai-cung.html" >
                                        <span class="btn btn-success" >
                                            <i class="fas fa-play"></i>
                                        </span>
                                    </a>
                                @else
                                    <span class="btn btn-danger">
                                    Chờ duyệt
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="  border-left: thin solid #7e7d7d;"></div>
        <div class="col-md-4">
            <span>Số Lượng Playlist: {{count($user->user_playlist)}}</span>
            <table class="table">
                <thead style="background: #0c84ff;width: 100%;">
                <tr style="text-align: center;position: relative">
                    <th style="text-align: center;position: relative">STT</th>
                    <th>Tên Bài Hát</th>
                    <th>Tình trạng</th>
                </tr>
                </thead>
                <tbody style="text-align: center;position: relative" >
                @foreach($user->user_playlist as $key => $playlist)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$playlist->name}}</td>
                        <td>
                            <div>
                                @if($playlist->active ==1)
                                    <a href="/song/99/con-trai-cung.html" >
                                        <span class="btn btn-success" >
                                            <i class="fas fa-play"></i>
                                        </span>
                                    </a>
                                @else
                                    <span class="btn btn-danger">
                                    Chờ duyệt
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="  border-left: thin solid #7e7d7d;"></div>
    </div>
@endsection
