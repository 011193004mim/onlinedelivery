<?php 
session_start();
$con=mysqli_connect("localhost", "root","", "inventory");

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/FoodStroy/');
define('SITE_PATH','http://127.0.0.1/FoodStroy/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/food/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/food/');

define('BANNER_SERVER_PATH',SERVER_PATH.'media/banner/');
define('BANNER_SITE_PATH',SITE_PATH.'media/banner/');
 ?>