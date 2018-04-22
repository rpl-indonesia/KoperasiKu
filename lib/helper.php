<?php

function url(){
  $base_url = 'http://'.$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
  return $base_url;
}
function asset($fileNa = ''){
  $base_url = url().$fileNa;
  return $base_url;
}
function antiInject($text){
  $filter = strip_tags(stripcslashes(htmlspecialchars($text, ENT_QUOTES)));
  return $filter;
}