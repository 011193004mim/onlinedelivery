<?php 
function pr($arr){
	echo '<pre>';
	print_r($arr);

}
function prx($arr){
	echo '<pre>';
print_r($arr);
die();
}

function get_safe_value($con, $str){
	if($str!=''){
		$str=trim($str);
	return mysqli_real_escape_string($con,$str);
}
}

function get_product($con,$type='', $limit=''){
	$sql="SELECT * FROM food_product ";
$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	if($type=='offer'){
		$sql.="ORDER BY ID desc";
	}
	if($limit!=''){
		$sql.="limit $limit";
	}

	return $data;
}

function isAdmin(){
	if(!isset($_SESSION['ADMIN_LOGIN'])){
	?>
		<script>
		window.location.href='login.php';
		</script>
		<?php
	}
	if($_SESSION['ADMIN_ROLE']==1){
		?>
		<script>
		window.location.href='product.php';
		</script>
		<?php
	}
}
?>
