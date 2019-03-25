<?php
/**
 * Created by PhpStorm.
 * User: tianyu
 * Date: 2017/7/24
 * Time: 17:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Snoopy\Snoopy;
use Illuminate\Support\Str;
use Knp\Snappy\Image;
use ZipArchive;
use DiDom\Document;
use Curl\Curl;

class ToolsController extends Controller
{
    public $my_url;
    public $google_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    public $img_path = 'uploads/images/';
    public $base_web_path = 'uploads/web/';
    public $web_name;
    public $attr = [
        'images' => ['tag' => 'img', 'attr' => 'src'],
        'css' => ['tag' => 'link', 'attr' => 'href'],
        'js' => ['tag' => 'script', 'attr' => 'src'],
    ];
    protected $web_files;
    protected $web_log_str = "\r\n\r\n网页模板下载工具\r\n%s\r\n下载网页:%s";
    protected $screen_shot_opt = [
        ['width' => 1440, 'height' => 900],
        ['width' => 1200, 'height' => 800],
        ['width' => 1024, 'height' => 768],
        ['width' => 768, 'height' => 1024],
        ['width' => 480, 'height' => 640],
        ['width' => 320, 'height' => 480],
    ];
    protected $screen_shot_quality = [
        70,
        55,
        45,
        30,
        20,
        10,
    ];


    public function __construct()
    {
        $this->img_path .= date('Y/md/His');
        $this->web_path = $this->base_web_path . date('Y/md');
        $this->my_url = env('APP_URL');
    }


    function shortcut(Request $request)
    {
        $my_url = $this->my_url;
        $url = trim($request->input('url', $my_url), '/');

        $ico_url = $url == $my_url ? $url . '/favicon.png' : $url . '/favicon.ico';

        $shortcut = '[InternetShortcut]
URL=' . $url . '
IconFile=' . $ico_url . '
IconIndex=0
HotKey=1613
IDList=[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2';
        $file_name = str_replace('http://', '', $url) . '.url';
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file_name);

        //header('Content-Length: ' . filesize($file_name));

        return $shortcut;
    }


    function screen_shot(Request $request)
    {
        $url = $request->input('url', $this->my_url);
        $options = $request->input('options', $this->my_url);

        $opt = [
            'format' => $options['ext'],
            'width' => $this->screen_shot_opt[$options['resolution']]['width'],
            'height' => $this->screen_shot_opt[$options['resolution']]['height'],
            'quality' => $this->screen_shot_quality[$options['resolution']],
        ];

        if (isset($options['clipping']) && $options['clipping']) {
            unset($opt['height']);
        }

        $name = $this->img_path . Str::quickRandom(5) . '.' . $options['ext'];
        $res['status'] = 0;
        $res['msg'] = '';
        try {
            $snappy = new Image('/usr/bin/wkhtmltoimage');
            $snappy->generate($url, $name, $opt);
            $res['status'] = 1;
            $res['msg'] = $this->my_url . '/' . $name;
        } catch (\Exception $e) {
            $res['msg'] = $e->getMessage();
//            $res['msg'] = $e->getTrace();
        }

        return response()->json($res);
    }


    function down_page(Request $request)
    {
        set_time_limit(600);
        $url = $request->input('url');
        $url = rtrim($url, '/');
        $this->web_name = Str::quickRandom(8);

        $res['status'] = 0;
        $res['msg'] = '';
        try {
            $snoopy = new Snoopy();
            $snoopy->fetch($url);
            $html_res = $snoopy->results;

            $encode = mb_detect_encoding($html_res, ["ASCII", "GB2312", "GBK", "UTF-8", "BIG5"]);
            if ($encode != 'utf8') {
                $html_res = mb_convert_encoding($html_res, 'utf8', $encode);
            }
            $html_length = strlen($html_res);
            if ($html_length < 500) {
                return response()->json(['status' => 0, 'msg' => 'Sorry! 无法抓取该网页' . '<span style="color:#fff">' . strlen($html_length) . '</span>']);
            }


            $array = [];
            $html = new Document($html_res);

            foreach ($this->attr as $k => $v) {
                $attr = $v['tag'] . '[' . $v['attr'] . ']';
                $array[$k] = $html->find($attr);
            }

//        $array['img'] = $html->find('img[src]');
//        $array['css'] = $html->find('link[href]');
//        $array['js'] = $html->find('script[src]');

            // 最终生成的文件名（含路径）
            $filename = $this->web_path . '/' . $this->web_name . '.zip';
            // 生成文件
            $zip = new ZipArchive ();
            if ($zip->open($filename, ZIPARCHIVE::CREATE) !== true) {
                exit ('无法打开文件，或者文件创建失败');
            }


            foreach ($array as $k => $v) {
                foreach ($v as $val) {
                    $path = $val->attr($this->attr[$k]['attr']);
                    if ($val->attr('rel') == 'dns-prefetch') {
                        continue;
                    }
                    if (substr($path, 0, 2) == '//') {
                        $path = 'http:' . $path;
                    }
                    if (substr($path, 0, 4) != 'http') {
                        $path = $url . $path;
                    }
                    if (strpos($path, '?')) {
                        $path = strstr($path, '?', true);
                    }
                    $name = $this->save($path, $k);
                    if ($name) {
                        $val->attr($this->attr[$k]['attr'], $k . '/' . $name);
                        $zip->addFile($this->web_files, $k . '/' . $name);
                    }

                }
            }

            $index_file = $this->web_path . '/' . $this->web_name . '/index.html';
            file_put_contents($index_file, $html->html());
            $zip->addFile($index_file, 'index.html');
            $zip->addFromString('log.txt', sprintf($this->web_log_str, $request->url(), $url));
            $zip->close(); // 关闭
            $res['status'] = 1;
            $res['msg'] = $this->my_url . '/' . $filename;
            unset($html);
            unset($html_res);
            unset($snoopy);
        } catch (\Exception $e) {
//            $res['msg'] = $e->getLine() . ' ' . $e->getCode() . ' ' . $e->getFile() . ' ' . $e->getMessage();
            $res['msg'] = $e->getMessage();
        }

        return response()->json($res);

        //下面是输出下载;
        /*header("Cache-Control: max-age=0");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
        header("Content-Type: application/zip"); // zip格式的
        header("Content-Transfer-Encoding: binary"); // 告诉浏览器，这是二进制文件
        header('Content-Length: ' . filesize($filename)); // 告诉浏览器，文件大小
        readfile($filename);//输出文件;*/
    }


    private function save($url, $folder)
    {
        $img_save_path = $this->web_path . '/' . $this->web_name . '/' . $folder . '/';
        self::createDir($img_save_path);
        $name_arr = explode('/', $url);

        $file_name = end($name_arr);
        if (!$file_name) {
            return false;
        }

        $img_file = $this->getContent($url);
        if ($img_file === false) {
            return false;
        }

        $img_save_path .= $file_name;
        file_put_contents($img_save_path, $img_file); //写入到本地
        $this->web_files = $img_save_path;

        return $file_name;
    }


    static function createDir($path)
    {
        if (!file_exists($path)) {
            self::createDir(dirname($path));
            mkdir($path, 0777);
        }
    }

    function getLocation(Request $request)
    {
        $ip = $request->input('ip', '');
        try {
            $res = $this->getContent('http://ip-api.com/json/' . $ip);

            return response()->json(json_decode($res, true));

        } catch (\Exception $e) {
            $res['msg'] = '发生错误，请刷新页面重试';
            //$res['msg'] = $e->getTrace();
        }
    }


    function getContent($url, $post_string = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_REFERER, $url);

        if ($post_string) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);


        }
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    function verify(Request $request)
    {
        $g_recaptcha_response_v2 = $request->input('g_recaptcha_response_v2', '');
        $g_recaptcha_response_v3 = $request->input('g_recaptcha_response_v3', '');

        $post = [];
        if ($g_recaptcha_response_v2) {
            $post = [
                'secret' => env('RE_CAPTCHA_SERVER_2'),
                'response' => $g_recaptcha_response_v2,
            ];
        }
        if ($g_recaptcha_response_v3) {
            $post = [
                'secret' => env('RE_CAPTCHA_SERVER_3'),
                'response' => $g_recaptcha_response_v3,
            ];
        }

        $post_string = http_build_query($post);


        try {
            $curl = new Curl();
            $res = $curl->request('post', $this->google_verify_url, $post_string);

            return response()->json($res);

        } catch (\Exception $e) {
            //$res['msg'] = '发生错误，请刷新页面重试';
            $res['msg'] = $e->getTrace();
        }
    }

}