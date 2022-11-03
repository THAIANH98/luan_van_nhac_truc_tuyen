<?php

namespace App\Http\Controllers;

use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Search\SearchFileService;
use App\Http\Service\Search\SearchService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongClientServie;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class SearchClientController extends Controller
{
    protected $searchservice;
    protected $songservice;
    protected $singerservice;
    protected $playlistservice;
    protected $searchfileservice;

    public function __construct(SearchService $searchService,SearchFileService $searchfileservice,SongClientServie $songService,SingerService $singerService,PlaylistClientService $playlistClientService)
    {
        $this->searchservice = $searchService;
        $this->searchfileservice = $searchfileservice;
        $this->songservice = $songService;
        $this->singerservice = $singerService;
        $this->playlistservice = $playlistClientService;
    }

    public function index(Request $request){
        $songs = $this->searchservice->getssong($request);
        $playlists = $this->searchservice->getplaylist($request);
        $singers = $this->searchservice->getsinger($request);

        if ($request->input('search')==''){
            return redirect('/');
        }
        return view('Search.search_results',[
            'title'=>'Kết quả tìm kiếm',
            'songs'=>$songs,
            'playlists'=>$playlists,
            'singers'=>$singers,
            'key'=>$request->input('search'),
            'count_list'=>$this->searchservice->count_list($request->input('search')),
            'count_song'=>$this->searchservice->count_song($request->input('search')),
            'count_singer'=>$this->searchservice->count_singer($request->input('search')),
        ]);
    }

    public function loadplaylist(Request $request){
        $page = $request->input('page');
        $key = $request->input('key');

//        dd($ke)
        $result = $this->searchservice->loadplaylist($page,$key);
        if (count($result)!=0){
            $html = view('Search.search_playlist',[
                'playlists'=>$result,
                'key'=>$key,
                'count_list'=>$this->searchservice->count_list($key),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }

    public function loadsong(Request $request){
        $page = $request->input('page');
        $key = $request->input('key');
        $result = $this->searchservice->loadsong($page,$key);
        if (count($result)!=0){
            $html = view('Search.search_song',[
                'songs'=>$result,
                'key'=>$key,
                'count_song'=>$this->searchservice->count_song($key),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }


    public function loadsinger(Request $request){
        $page = $request->input('page');
        $key = $request->input('key');
        $result = $this->searchservice->loadsinger($page,$key);
        if (count($result)!=0){
            $html = view('Search.search_singer',[
                'singers'=>$result,
                'key'=>$key,
                'count_singer'=>$this->searchservice->count_singer($key),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }

    public function search_file(Request $request){
        return view('Search.search_with_file',[
            'title'=>'Kết quả tìm kiếm',
            'songs'=>$this->searchfileservice->search($request),
            'limit'=>$this->searchfileservice->limit(),
        ]);
    }

    public function  result_file($slug=''){
        $slug=str_replace('storage','/storage',$slug);
        $slug=str_replace('uploads','/uploads',$slug);
        $slug=str_replace('song','/song/',$slug);
        $slug=str_replace('-',' ',$slug);
        $song = $this->songservice->getsong_file_song($slug);

        $menuid=$song->menu_id;
        $cateid= $song->category_id;
        $id=$song->id;
        $songrandom= $this->songservice->getsongrandom($id);
        $songofsinger = $this->singerservice->getsingersong($id);
        if (count($songofsinger)<=1){
            $songofsinger = $this->songservice->getsong_menu_playsong($song->menu_id);
        }

        return view('Play.playsongpage',[
            'title'=> 'Bài Hát-'. $song->name,
            'song'=>$song,
            'songsinger'=>$songofsinger,
            'songrandom'=>$songrandom,
            'listgoiy'=>$this->playlistservice->get_playlist_goiy($menuid,$cateid),
        ]);
    }

}
