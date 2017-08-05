<?php
/**
 * Created by PhpStorm.
 * User: tianyu
 * Date: 2017/7/24
 * Time: 17:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    protected $format = 'png';


    function generate(Request $request){

        $data = $request->input('data');
        $error = $request->input('error');
        $outerFrame = $request->input('outerFrame');
        $size = $request->input('size');

        $res['status'] = 0;
        $res['msg'] = '';
        try{
            $img = QrCode::format($this->format)->size($size * 40)->margin($outerFrame)->errorCorrection($error)->generate($data);
            $path = 'uploads/qr/' . date('Y/m/');
            ToolsController::createDir($path);
            $res['msg'] = $path . date('dHi') . Str::quickRandom(5) . '.'.  $this->format;
            file_put_contents($res['msg'], $img);
            $res['status'] = 1;
        }catch (\Exception $e){
            $res['msg'] = '发生错误，请刷新页面重试';
            //$res['msg'] = $e->getTrace();
        }

        return response()->json($res);
    }

}