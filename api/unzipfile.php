<?php

include_once('../class/ArgsValidator.class.php');
include_once('../class/Response.class.php');
include_once('../class/SimpleFileManager.class.php');

$args = ArgsValidator::validate(
	array('dir', 'fileName'),
	array(),
	array(
		'errcode' => 1
	)
);
if(!is_array($args)){
	Response::responseData($args, array());
}
else{
	$args['dir'] = mb_convert_encoding($args['dir'], 'GBK', 'UTF-8');
	$args['fileName'] = mb_convert_encoding($args['fileName'], 'GBK', 'UTF-8');

	$sfm = new SimpleFileManager($args['dir']);
	if($sfm->unzip($args['fileName'])){
		Response::responseData(0);
	}
	else{
		Response::responseData(2);
	}
}
?>