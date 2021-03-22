<?php
/**
 * Created by PhpStorm.
 * User: tianyu
 * Date: 2021/03/22
 * Time: 18:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Medz\IdentityCard\China\Identity;
use Jxlwqq\IdValidator\IdValidator;


class IdCardController extends Controller
{


    function getInfo(Request $request)
    {
        $idCard = (string)$request->input('idCard', '');

        if ($idCard == '') {
            $res['status'] = 0;
            $res['msg'] = '请输入身份证号码';

        } else {
            $peopleIdentity = new Identity($idCard);
            $peopleRegion = $peopleIdentity->region();


            $res['status'] = 1;
            $res['msg'] = [
                '校验结果' => $peopleIdentity->legal() ? "符合身份证规则" : "<font color='red'>不符合身份证规则</font>",
                '生日' => $peopleIdentity->birthday(), // 1989-06-18
                '性别' => $peopleIdentity->gender(),   // 女 | 男
//                '地区编码' => $peopleRegion->code(),       // 350302
                '地区' => $peopleRegion->treeString(' ') // 福建省 莆田市 城厢区
            ];

            //不太精确
//            $idValidator = new IdValidator();
//            $idValidator->isValid($idCard);
//            $info = $idValidator->getInfo($idCard);
//            $res['msg1'] = $info;

            /**
             * 'addressCode'   => '440308',                    // 地址码
             * 'abandoned'     => 0,                           // 地址码是否废弃，1 为废弃的，0 为正在使用的
             * 'address'       => '广东省深圳市盐田区',           // 地址
             * 'addressTree'  => ['广东省', '深圳市', '盐田区']   // 省市区三级列表
             * 'birthdayCode'  => '1999-01-10',                // 出生日期
             * 'constellation' => '水瓶座',                     // 星座
             * 'chineseZodiac' => '卯兔',                       // 生肖
             * 'sex'           => 1,                           // 性别，1 为男性，0 为女性
             * 'length'        => 18,                          // 号码长度
             * 'checkBit'      => '2',                         // 校验码
             */


        }

        return response()->json($res);


    }

}
