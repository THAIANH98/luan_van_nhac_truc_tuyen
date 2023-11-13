<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\Singer\SingerController;
use App\Http\Controllers\Admin\Upload\UploadController;
use App\Http\Controllers\Admin\Musican\MusicanController;
use App\Http\Controllers\Admin\Song\SongController;
use App\Http\Controllers\Admin\Playlist\PlaylistController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\MainClientController;
use App\Http\Controllers\MenuClientController;
use App\Http\Controllers\Admin\Category\CategoryController;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::get('admin/users/logout', [LoginController::class, 'logout']);


Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('main', [MainController::class, 'index']);
        Route::get('/', [MainController::class, 'index'])->name('admin');

        //      menu
        Route::prefix('menu')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('addcate', [MenuController::class, 'addcate']);
            Route::post('addcate', [MenuController::class, 'storecate']);
            Route::get('editcate/{menu}', [MenuController::class, 'editcate']);
            Route::post('editcate/{menu}', [MenuController::class, 'updatecate']);
            Route::get('edit/{menu}', [MenuController::class, 'edit']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::post('change/{menu}', [MenuController::class, 'change_active']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        //      Category
        Route::prefix('category')->group(function () {
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('edit/{category}', [CategoryController::class, 'edit']);
            Route::post('edit/{category}', [CategoryController::class, 'update']);
            Route::post('change/{category}', [CategoryController::class, 'change_active']);
            Route::DELETE('destroy', [CategoryController::class, 'destroy']);
        });

        //      Singer
        Route::prefix('singer')->group(function () {
            Route::get('add', [SingerController::class, 'create']);
            Route::post('add', [SingerController::class, 'store']);
            Route::get('list', [SingerController::class, 'list']);
            Route::get('edit/{singer}', [SingerController::class, 'edit']);
            Route::post('edit/{singer}', [SingerController::class, 'update']);
            Route::post('change/{singer}', [SingerController::class, 'change_active']);
            Route::DELETE('destroy', [SingerController::class, 'destroy']);
        });


        //      Musican
        Route::prefix('musican')->group(function () {
            Route::get('add', [MusicanController::class, 'create']);
            Route::post('add', [MusicanController::class, 'store']);
            Route::get('list', [MusicanController::class, 'list']);
            Route::get('edit/{musican}', [MusicanController::class, 'edit']);
            Route::post('edit/{musican}', [MusicanController::class, 'update']);
            Route::post('change/{musican}', [MusicanController::class, 'change_active']);
            Route::DELETE('destroy', [MusicanController::class, 'destroy']);
        });


        //      Song
        Route::prefix('song')->group(function () {
            Route::get('add', [SongController::class, 'create']);
            Route::post('add', [SongController::class, 'store']);
            Route::get('list', [SongController::class, 'list']);
            Route::get('full', [SongController::class, 'list_genre_full']);
            Route::get('list_genre/{category}', [SongController::class, 'list_genre']);
            Route::get('list_genre/{menu}/{category}', [SongController::class, 'list_genre_menu']);
            Route::get('list_menu_genre/{menu}', [SongController::class, 'list_menu']);
            Route::get('edit/{song}', [SongController::class, 'edit']);
            Route::post('edit/{song}', [SongController::class, 'update']);
            Route::post('change/{song}', [SongController::class, 'change_active']);
            Route::DELETE('destroy', [SongController::class, 'destroy']);
        });

        //      Playlist
        Route::prefix('playlist')->group(function () {
            Route::get('add', [PlaylistController::class, 'create']);
            Route::post('add', [PlaylistController::class, 'store']);
            Route::get('list', [PlaylistController::class, 'list']);
            Route::get('song/{playlist}', [PlaylistController::class, 'listsong']);
            Route::get('list/{menu}', [PlaylistController::class, 'playlistmenu']);
            Route::get('list/full', [PlaylistController::class, 'playlistfull']);
            Route::get('edit/{playlist}', [PlaylistController::class, 'edit']);
            Route::post('edit/{playlist}', [PlaylistController::class, 'update']);
            Route::post('change/{playlist}', [PlaylistController::class, 'change_active']);
            Route::DELETE('destroy', [PlaylistController::class, 'destroy']);
        });


        //      Slider
        Route::prefix('slider')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'list']);
            Route::get('edit/{slider}', [SliderController::class, 'edit']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::post('change/{slider}', [SliderController::class, 'change_active']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        //      Duyệt
        Route::prefix('browse')->group(function () {
            Route::get('song', [MainController::class, 'browse_song']);
            Route::get('playlist', [MainController::class, 'browse_playlist']);
            Route::get('full', [MainController::class, 'list_genre_full']);
            Route::get('playlist/{menu}', [MainController::class, 'playlistmenu']);
            Route::get('list_genre/{category}', [MainController::class, 'list_genre']);
            Route::get('list_genre/{menu}/{category}', [MainController::class, 'list_genre_menu']);
            Route::get('list_menu_genre/{menu}', [MainController::class, 'list_menu']);
            Route::DELETE('destroy/song', [MainController::class, 'destroy_song']);
            Route::DELETE('destroy/playlist', [MainController::class, 'destroy_playlist']);
        });

        //      Thành viên
        Route::prefix('user')->group(function () {
            Route::get('list', [\App\Http\Controllers\Admin\Users\UserController::class, 'index']);
            Route::get('detail/{user}', [\App\Http\Controllers\Admin\Users\UserController::class, 'detail']);
        });

        //      Upload
        Route::POST('upload/service', [UploadController::class, 'store']);
        Route::POST('upload_thumb/services', [UploadController::class, 'store_thumb']);
        Route::POST('upload_song/services', [UploadController::class, 'store_song']);

        //        Training
        Route::get('/training', [\App\Http\Controllers\Admin\TrainingController::class, 'index']);
    });
});

// Client

use App\Http\Controllers\SongClientController;
//use App\Http\Controllers\PlaylistClientController;
//use App\Http\Controllers\SingerClientController;
//use App\Http\Controllers\SearchClientController;

Route::get('/list_genre/{category}', [SongController::class, 'list_genre']);
Route::get('/list_genre/{menu}/{category}', [SongController::class, 'list_genre_menu']);
Route::get('/list_menu_genre/{menu}', [SongController::class, 'list_menu']);
Route::get('/', [MainClientController::class, 'index']);
Route::get('/danh-muc/{menu}-{slug}.html', [MenuClientController::class, 'index']);
Route::get('/{menu}/{cate}-{slug}.html', [MenuClientController::class, 'store']);
//load với id menu
Route::post('/services/loadplaylist', [MainClientController::class, 'loadlistmenu']);
Route::post('/services/loadsong', [MainClientController::class, 'loadsongmenu']);
//load với id menu và id cate
Route::post('/services/loadplaylist_cate', [MainClientController::class, 'loadplaylistcate']);
Route::post('/services/loadsong_cate', [MainClientController::class, 'loadsongcate']);

Route::get('/song/{song}/{slug}.html', [SongClientController::class, 'songpage']);
Route::post('songview/{id}/', [SongController::class, 'viewplus']);
Route::get('singer/{singer}/{slug}.html', [\App\Http\Controllers\SingerClientController::class, 'index']);
Route::get('musican/{musican}/{slug}.html', [\App\Http\Controllers\MusicanController::class, 'index']);
Route::get('/playlist/{playlist}/{slug}.html', [\App\Http\Controllers\PlaylistClientController::class, 'playlistpage']);
Route::post('playlistview/{id}/', [\App\Http\Controllers\PlaylistClientController::class, 'viewplus']);
Route::POST('/upload_song/services', [\App\Http\Controllers\UploadClientController::class, 'store']);
Route::POST('/upload_song_user/services', [\App\Http\Controllers\UploadClientController::class, 'song_user']);
Route::POST('/upload_playlist_user/services', [\App\Http\Controllers\UploadClientController::class, 'playlist_user']);
Route::POST('/upload_avatar/services', [\App\Http\Controllers\UploadClientController::class, 'avatar_user']);

//Search
Route::get('/search/', [\App\Http\Controllers\SearchClientController::class, 'index']);
Route::post('/services/loadplaylist_search', [\App\Http\Controllers\SearchClientController::class, 'loadplaylist']);
Route::post('/services/loadsong_search', [\App\Http\Controllers\SearchClientController::class, 'loadsong']);
Route::post('/services/loadsinger_search', [\App\Http\Controllers\SearchClientController::class, 'loadsinger']);

Route::get('/user/login/', [\App\Http\Controllers\LoginClientController::class, 'login']);
Route::post('/getusername/{user}', [\App\Http\Controllers\LoginClientController::class, 'getuser']);
Route::post('/getusername_indata/{user}', [\App\Http\Controllers\LoginClientController::class, 'getuser_indata']);
Route::post('/getemail_indata/{email}', [\App\Http\Controllers\LoginClientController::class, 'getemail_indata']);
Route::post('/user/login/', [\App\Http\Controllers\LoginClientController::class, 'login_store']);
Route::get('/user/register/', [\App\Http\Controllers\LoginClientController::class, 'register']);
Route::post('/user/register/', [\App\Http\Controllers\LoginClientController::class, 'register_store']);

Route::get('send_mail', [\App\Http\Controllers\SendMailController::class, 'sendmail'])->name('send_mail');
Route::post('send_mail', [\App\Http\Controllers\SendMailController::class, 'create_user']);

Route::get('search_file', [\App\Http\Controllers\SearchClientController::class, 'search_file']);
Route::get('/result_file/{slug}', [\App\Http\Controllers\SearchClientController::class, 'result_file']);

Route::get('user/song/{user}', [\App\Http\Controllers\UserClientController::class, 'song_user']);
Route::get('user/list_song/{user}', [\App\Http\Controllers\UserClientController::class, 'list_song_user'])->name('list_song_user');
Route::post('user/song/{user}', [\App\Http\Controllers\UserClientController::class, 'create_song_user']);
Route::get('/user/song/edit/{song}/{user}', [\App\Http\Controllers\UserClientController::class, 'edit_song']);
Route::post('/user/song/edit/{song}/{user}', [\App\Http\Controllers\UserClientController::class, 'store_edit_song']);
Route::delete('/user/song/destroy/', [\App\Http\Controllers\UserClientController::class, 'delete_song_user']);
Route::get('user/playlist/{user}', [\App\Http\Controllers\UserClientController::class, 'playlist_user']);
Route::post('user/playlist/{user}', [\App\Http\Controllers\UserClientController::class, 'create_playlist_user']);
Route::get('/user/list_playlist/{user}', [\App\Http\Controllers\UserClientController::class, 'list_playlist_user']);
Route::delete('/user/delete/list_playlist', [\App\Http\Controllers\UserClientController::class, 'delete_playlist_user']);
Route::get('/user/playlist/edit/{playlist}/{user}', [\App\Http\Controllers\UserClientController::class, 'edit_playlist']);
Route::post('/user/playlist/edit/{playlist}/{user}', [\App\Http\Controllers\UserClientController::class, 'store_edit_playlist']);
Route::get('user/info/{user}', [\App\Http\Controllers\UserClientController::class, 'info_user']);

Route::post('/edit_username/{user}', [\App\Http\Controllers\UserClientController::class, 'edit_username']);
Route::post('/edit_name/{user}', [\App\Http\Controllers\UserClientController::class, 'edit_name']);
Route::post('/edit_avatar/{user}', [\App\Http\Controllers\UserClientController::class, 'edit_avatar']);
Route::get('/edit_pass/{user}', [\App\Http\Controllers\SendMailController::class, 'edit_pass']);
Route::post('/edit_pass/{user}', [\App\Http\Controllers\SendMailController::class, 'store_pass']);
Route::get('/forget_pass', [\App\Http\Controllers\SendMailController::class, 'forget_pass']);
Route::post('/forget_pass', [\App\Http\Controllers\SendMailController::class, 'store_forget_pass']);
Route::get('send_mail_forget_pass', [\App\Http\Controllers\SendMailController::class, 'sendmail_forget_pass'])->name('send_mail_forget_pass');
Route::post('send_mail_forget_pass', [\App\Http\Controllers\SendMailController::class, 'reset_pass']);
