<?php

if(!function_exists('generateUniqueId')){

	function generateUniqueId($name, $other = ''){
		$uniqueId = '';
        if($other){
        	$uniqueId .= str_replace(' ', '', $other);
        }
        $newName = str_replace(' ', '', $name);
        $uniqueId .= strtoupper($newName);
        $uniqueId .= date('Yndhis');
        return str_shuffle($uniqueId);
	}

}