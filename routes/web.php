<?php
set_time_limit(0);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//json
Route::get('/', function () {
    return view('index');
});
Route::get('/json/poster', function () {
    return view('json.poster');
});
Route::get('/json/parser', function () {
    return view('json.parser');
});
Route::get('/json/format', function () {
    return view('json.format');
});
Route::post('/poster', ['as' => 'sql', 'uses' => 'FormatController@poster']);

//格式化
Route::get('/format/js', function () {
    return view('format.js');
});
Route::get('/format/css', function () {
    return view('format.css');
});
Route::get('/format/xml', function () {
    return view('format.xml');
});
Route::get('/format/sql', function () {
    return view('format.sql');
});
Route::post('/sql', ['as' => 'sql', 'uses' => 'FormatController@sql']);

//转换
Route::get('/convert/time', function () {
    return view('convert.time');
});
Route::get('/convert/url', function () {
    return view('convert.url');
});

Route::get('/convert/markdown', function () {
    return view('convert.markdown');
});
Route::get('/convert/n2a', function () {
    return view('convert.n2a');
});
Route::get('/convert/hex', function () {
    return view('convert.hex');
});
Route::get('/convert/rgb', function () {
    return view('convert.rgb');
});
Route::get('/convert/togglecase', function () {
    return view('convert.togglecase');
});
Route::get('/convert/cn_tw', function () {
    return view('convert.cn_tw');
});

//加密
Route::get('/encrypt/md5', function () {
    return view('encrypt.md5');
});
Route::get('/encrypt/base64', function () {
    return view('encrypt.base64');
});
Route::get('/encrypt/openssl_encode', function () {
    return view('encrypt.openssl_encode', ['mode' => openssl_get_cipher_methods(), 'key' => md5(env('APP_URL')), 'iv' => substr(md5(env('APP_URL')), 0, 16)]);
});
Route::get('/encrypt/openssl_decode', function () {
    return view('encrypt.openssl_decode', ['mode' => openssl_get_cipher_methods(), 'key' => md5(env('APP_URL')), 'iv' => substr(md5(env('APP_URL')), 0, 16)]);
});
Route::get('/encrypt/hash', function () {
    return view('encrypt.hash');
});

Route::any('/openssl_encode', ['as' => 'openssl_encode', 'uses' => 'EncodeController@openssl_encode']);
Route::post('/openssl_decode', ['as' => 'openssl_decode', 'uses' => 'EncodeController@openssl_decode']);
Route::post('/hash', ['as' => 'hash', 'uses' => 'EncodeController@hash']);



//表格
Route::get('/tables/pag', function () {
    return view('tables.pag');
});
Route::get('/tables/rgb', function () {
    return view('tables.rgb');
});
Route::get('/tables/httpstatus', function () {
    return view('tables.httpstatus');
});
Route::get('/tables/httpheader', function () {
    return view('tables.httpheader');
});
Route::get('/tables/httpmethod', function () {
    return view('tables.httpmethod');
});
Route::get('/tables/androidmanifest', function () {
    return view('tables.androidmanifest');
});
Route::get('/tables/geo', function () {
    return view('tables.geo');
});

//tools
Route::get('/tools/wordcount', function () {
    return view('tools.wordcount');
});
Route::get('/tools/regex', function () {
    return view('tools.regex');
});
Route::get('/tools/qr', function () {
    return view('tools.qr');
});
Route::get('/qr', ['as' => 'qr', 'uses' => 'QrController@generate']);
Route::get('/tools/uuid', function () {
    return view('tools.uuid');
});
Route::get('/uuid', ['as' => 'uuid', 'uses' => 'EncodeController@uuid']);
Route::get('/tools/shortcut', function () {
    return view('tools.shortcut');
});
Route::get('/tools/screenshot', function () {
    return view('tools.screenshot');
});
Route::get('/tools/downpage', function () {
    return view('tools.downpage');
});
Route::get('/tools/g', function () {
    return view('tools/g');
});
Route::get('/tools/ip', function () {
    return view('tools/ip');
});

Route::post('/screen_shot', ['as' => 'screen_shot', 'uses' => 'ToolsController@screen_shot']);
Route::post('/shortcut', ['as' => 'shortcut', 'uses' => 'ToolsController@shortcut']);
Route::post('/down_page', ['as' => 'down_page', 'uses' => 'ToolsController@down_page']);
Route::post('/ip', ['as' => 'ip', 'uses' => 'ToolsController@getLocation']);

//common sense
Route::get('/cs/for_short', function () {
    return view('common_sense/for_short');
});


//fm
Route::get('/page/fm', function () {
    return view('page.fm');
});

//miner
Route::get('/page/miner', function () {
    return view('page.miner');
});


