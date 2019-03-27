<?php

namespace App;

class Helpers
{

    /**
     * get the amount of memory allocated to PHP
     * @return string
     */
    static function getMemoryUsage()
    {
        $size = memory_get_usage(true);
        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];

        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $unit[$i];
    }

    /**
     * get the amount of memory allocated to PHP
     * @return string
     */
    static function getIP()
    {
        $ip = false;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = false;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match('/^(10│172\.16│192\.168)\./', $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }

        return $ip ? $ip : $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Send a get request through a proxy
     * @param string $url
     * @param bool $need_proxy
     * @return mixed
     */
    static function getByCurl($url, $need_proxy = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36 OPR/54.0.2952.54');

        if ($need_proxy) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1088');
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5)
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
        }

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    /**
     * Post request
     * @param string $remote_server
     * @param string(json) $post_string
     * @param bool $need_proxy
     * @return mixed
     */
    static function requestByCurl($remote_server, $post_string, $need_proxy = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json;charset=utf-8']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if ($need_proxy) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1088');
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5)
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
        }

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


}
