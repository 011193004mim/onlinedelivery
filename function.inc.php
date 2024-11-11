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

function get_product($con,$limit='',$cat_id='',$product_id='',$search_str='',$sort_order='',$sub_categories=''){
	$sql="SELECT food_product.*,admin_categorie.categories from food_product,admin_categorie where food_product.status=1 ";
	if($cat_id!=''){
		$sql.=" AND food_product.categories_id=$cat_id ";
	}
	if($product_id!=''){
		$sql.=" AND food_product.ID=$product_id ";
	}
	if($sub_categories!=''){
		$sql.=" and food_product.sub_categories_id=$sub_categories ";
	}
	$sql.=" AND food_product.categories_id=admin_categorie.ID ";
	if($search_str!=''){
		$sql.=" and (food_product.name like '%$search_str%' OR food_product.description like '%$search_str%') ";
	}
	if($sort_order!=''){
		$sql.=$sort_order;
	}else{
		$sql.=" ORDER BY food_product.ID desc";
	}
	
$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	
	
		
	
	if($limit!=''){
		$sql.="limit $limit";
	}

	return $data;
}
 ?>

