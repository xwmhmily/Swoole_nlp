<?php

$jieba_path = LIB_PATH.'/jieba-php/src';
require $jieba_path."/class/Jieba.php";
require $jieba_path."/class/Posseg.php";
require $jieba_path."/class/Finalseg.php";
require $jieba_path."/class/JiebaAnalyse.php";
require $jieba_path."/vendor/multi-array/MultiArray.php";
require $jieba_path."/vendor/multi-array/Factory/MultiArrayFactory.php";

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;

class Worker {

	// Init JieBa library
    public static function afterStart(swoole_server $server, int $workerID){
		ini_set('memory_limit', '600M');
        Jieba::init(['mode' => 'test', 'dict' => 'small']);

        Jieba::init();
        Posseg::init();
        Finalseg::init();
		JiebaAnalyse::init();
		
		if($workerID == 0){
			$server->tick(1000, function(){
				Server::stat();
			});
		}
	}

	// Do anything you want before http request
	public static function beforeRequest($method, swoole_http_request $request, swoole_http_response $response){
		if(isset($request->get['page'])){
			Request::setPage(intval($request->get['page']));
		}else{
			Request::setPage(1);
		}

		Request::setInstance($request);
		Response::setInstance($response);
		
		$method = strtoupper($method);
		Request::setMethod($method);

		if($method == Request::HTTP_METHOD_GET){
			Request::setData($request->get);
		}else if($method == Request::HTTP_METHOD_POST){
			Request::setData($request->post);
		}

		Request::setCookie($request->cookie);
		Request::setServer($request->server);
	}

	// Do anything you want after worker stop
	public static function afterStop(swoole_server $server, int $workerID){
		Logger::log(__FUNCTION__);
	}
	
}