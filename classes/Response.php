<?php
class Response{

  public function render($path, $obj){
    foreach ($obj as $key => $value) {
      ${$key} = $value;
    }
    require "views/" . $path . ".php";
  }

  public function send($str){
    echo $str;
  }

}
 ?>
