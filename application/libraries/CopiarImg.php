<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
ini_set('display_errors', 1);

class CopiarImg
{

private $_name ="";
private $_size =0;
private $_type ="";
private $_tmp  ="";
protected static $RUTA = FCPATH.'resources/images/Imagenes_Server/';
protected static $TYPES = array('image/png','image/jpeg','image/jpg');
protected static $SIZE = 2000000;

function __construct($name = null,$size = null ,$type = null,$tmp=null){
    $this->_name = $name;
    $this->_size = $size;
    $this->_type = $type;
    $this->_tmp = $tmp;
} 

function __get($attr){
    return $this->$attr;
}

function __set($attr,$value){
    $this->$attr = $value;
}   

function upload(){
$ext = explode("/", $this->_type);
$ext = ".".$ext[1];
$randomName = self::generateRandomString(7);
$name = "img_".$randomName.$ext;
if (move_uploaded_file($this->_tmp, self::$RUTA.$name)) {
    return $name;
}else{
    return null;
}

}

/*function  validate(){
return $this->_size<=self::$SIZE
&& in_array($this->_type, self::$TYPES);
}*/


public static function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
}


