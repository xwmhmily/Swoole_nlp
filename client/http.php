<?php

$text = urlencode('我一会开车过去看看');

$url = 'http://127.0.0.1:9502/nlp/parse?text='.$text;

$retval = file_get_contents($url);
$retval = json_decode($retval, TRUE);

print_r($retval);