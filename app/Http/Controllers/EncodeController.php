<?php
/**
 * Created by PhpStorm.
 * User: tianyu
 * Date: 2017/7/24
 * Time: 18:49
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Exception;

class EncodeController extends Controller
{


    public static function openssl_encode(Request $request){
        $data = $request->input('data');
        $method = $request->input('method');
        $key = $request->input('key');
        $options = $request->input('options');
        $iv = $request->input('iv');


        try{
            $iv_length = openssl_cipher_iv_length($method);
            if(strlen($iv) != $iv_length){
                $res = 'IV长度不符合算法，长度应为' . $iv_length;
            }

            $res = base64_encode(openssl_encrypt ($data , $method , $key, $options, $iv));
            if(!$res){
                $res = '对不起，加密失败!';
            }
        }catch (Exception $e){
            $res = '无法获取结果，请检查所选加密算法和IV是否正确!';
        }

        return $res;
    }


    public static function openssl_decode(Request $request){
        $data = $request->input('data');
        $method = $request->input('method');
        $key = $request->input('key');
        $options = $request->input('options');
        $iv = $request->input('iv');

        try{
            $iv_length = openssl_cipher_iv_length($method);
            if(strlen($iv) != $iv_length){
                $res = 'IV长度不符合算法，长度应为' . $iv_length;
            }

            $res = openssl_decrypt (base64_decode($data) , $method , $key, $options, $iv);
            if(!$res){
                $res = '对不起，解密失败!';
            }
        }catch (Exception $e){
            $res = '无法获取结果，请检查所选加密算法和IV是否正确!';
        }

        return $res;
    }


    public function hash(Request $request){
        $data = $request->input('data');
        $algo = $request->input('algo');

        try{
            $res = hash($algo, $data);
        }catch (Exception $e){
            $res = '无法获取结果，请检查所选加密算法是否正确!';
        }
        return $res;
    }


    public function uuid(Request $request){
        $callback = $request->input('callback');

        $res =[
            Uuid::generate() . '',
            Uuid::generate(3, mt_rand(1000, 9999), Uuid::NS_DNS) . '',
            Uuid::generate(3, mt_rand(1000, 9999), Uuid::NS_URL) . '',
            Uuid::generate(3, mt_rand(1000, 9999), Uuid::NS_OID) . '',
            Uuid::generate(3, mt_rand(1000, 9999), Uuid::NS_X500) . '',
            Uuid::generate(5, mt_rand(1000, 9999), Uuid::NS_DNS) . '',
            Uuid::generate(5, mt_rand(1000, 9999), Uuid::NS_URL) . '',
            Uuid::generate(5, mt_rand(1000, 9999), Uuid::NS_OID) . '',
            Uuid::generate(5, mt_rand(1000, 9999), Uuid::NS_X500) . '',
        ];

        //jQuery21408895808049818765_1500893177500(["f79adf3f-03b1-9072-35e3-e4fc178678f9","670262ad-7c11-2ab7-0560-48001f5aae50","4ce1d7de-1eb0-70a9-26a1-5b190ea8890f","4585d74a-610c-180a-9091-68988f652251","dbab12ff-4542-d808-9b8f-2d458f03a6e6","4fcc5ff0-312a-db9d-9ba3-b2536fa5a17e","76e6682a-25cd-af15-de6b-4f1c5d5f758e","453ee700-c864-7117-14cc-89d44de8dc50"])
        return $callback . '(' . json_encode($res) . ')';
        //return response()->json($res);
    }



}