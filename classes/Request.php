<?php
class Request{
  public $route;
  public $uri;

  public function __construct($route, $uri){
    $this -> route = $route;
    $this -> uri = $uri;
  }

  public function params(string $id){
    $raw_route = self :: split_params($this -> route);
    $raw_request = self :: split_params($this -> uri);
    $params = self :: combine($raw_route, $raw_request);
    return $params[$id];
  }

  public function params_match(){
    $a = self :: split_params($this -> route);
    $b = self :: split_params($this -> uri);
    $matches = array_intersect($a, $b);
    return $matches;
  }

  public static function split_params($str){
    $str = str_replace(":", "", $str);
    $arr = explode("/", $str);
    array_shift($arr);
    return $arr;
  }

  public static function combine($arr1, $arr2){
    $arr_comb = "";
    if(sizeof($arr1)==sizeof($arr2)){
     $arr_comb = array_combine($arr1, $arr2);
    }
    return $arr_comb;
  }

  public static function params_array($str){
    $arr = explode("/", $str);
    return $arr;
  }

  public static function has_query($url){
    $url_components = parse_url($url);
    $has_query = false;
    foreach ($url_components as $key => $component) {
      if($key === 'query'){
        $has_query = true;
      }
    }
    return $has_query;
  }

  public static function get_url_components($url){
    $url_components = parse_url($url);
    return $url_components;
  }

  public static function get_query_params($url){
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    return $params;
  }

  public function get_request_uri(){
    $request_uri = $_SERVER['REQUEST_URI'];
    return $request_uri;
  }

}
