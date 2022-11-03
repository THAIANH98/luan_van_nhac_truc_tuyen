<?php

namespace App\Http\Service\Search;

use App\Http\Service\Song\SongClientServie;
use App\Http\Service\Upload\UploadClientService;
use App\Models\Song;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SearchFileService
{
    const LIMIT = 20;

    public function limit(){
        return self::LIMIT;
    }

    protected $uploadservice;
    protected $sonservice;
    public function __construct(UploadClientService $clientService,SongClientServie $songClientServie)
    {
        $this->uploadservice =$clientService;
        $this->sonservice = $songClientServie;
    }

    function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    function mb_ucfirst($string, $encoding)
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, null, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }



    public function train(){
        $process = new Process(['../public/Search_ANN/Approximate Nearest Neighbors.py']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        Session::flash('success','Xây dựng thành công hệ thống tìm kiếm');
        return $process->getOutput();
    }

    public function create_feat(){
        $process = new Process(['../public/Search_ANN/create_data_test.py']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return $process->getOutput();
    }


    public function search($request){
            $process = new Process(['../public/Search_ANN/search.py']);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();

            $output=str_replace('[','',$output);
            $output=str_replace("\\",'/',$output);
            $output=str_replace("//",'/',$output);
            $output=str_replace(']','',$output);
            $output=str_replace("'",'',$output);
            $output = explode(', ',$output);

            $song= Song::where('active',1)->get();
            $songs=[];
            foreach ($song as $key=> $s){
                if(in_array($s->file_song,$output)){
                    $songs[] = $s;
                }
            }

            $this->uploadservice->deleteall();

        return $songs;
    }
}
