<?php

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;

class C_Nlp extends Controller {

    // parse
    public function parse(){
		$start_time = Logger::getMicrotime();
        $text = $this->getParam('text');

        $rep = [];
        $rep['segmentation'] = Jieba::cut($text);
        $rep['trunk'] = JiebaAnalyse::extractTags($text, 10);
	
		$end_time = Logger::getMicrotime();
		$rep['start'] = $start_time;
		$rep['end']   = $end_time;
		$rep['cost']  = $end_time - $start_time;
	
        return JSON($rep);
    }

}
