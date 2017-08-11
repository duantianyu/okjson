<?php
/**
 * Created by PhpStorm.
 * User: tianyu
 * Date: 2017/7/24
 * Time: 17:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use SqlFormatter;
use Curl\Curl;

class FormatController extends Controller
{
    public function sql(Request $request)
    {
        $query = $request->input('query', '');
        $type = $request->input('type', 'format');
        if ($type == 'compress') {
//            $result = '<pre>'.SqlFormatter::compress($query).'</pre>';
            $result = SqlFormatter::compress($query);
        } else {
            $result = SqlFormatter::format($query);
        }

        return response()->json(compact('result'));
    }

    public function poster(Request $request){
        $url = $request->input('url', '');
        $method = $request->input('method', '');
        $parameter = $request->input('parameter', '');

        if(!in_array(strtolower($method), ['post', 'get'])){
            return '请选择请求方式';
        }

        $curl = new Curl();
        if($parameter != ''){
            json_decode($parameter, true);
            if(json_last_error() == JSON_ERROR_NONE){
                $curl->headers = ['Content-Type' => 'application/json;charset=utf-8'];
            }else{
                $parameter = urldecode($parameter);
            }
            $res = $curl->request($method, $url, $parameter);
        }else{
            $res = $curl->request($method, $url);
        }
        return $res;

    }
}