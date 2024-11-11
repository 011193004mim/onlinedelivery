<?php 
require('top.inc.php') ;
$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==1){

$condition= " AND food_product.added_by='".$_SESSION['ADMIN_ID']."' ";
$condition1= " AND added_by='".$_SESSION['ADMIN_ID']."' ";
}
$categories_id ='';
$sub_categories_id ='';
$name ='';
$price ='';
$image ='';
$short_desc ='';
$description ='';
$meta_title='';
$meta_key ='';

$msg='';
$image_required='required';

if(isset($_GET['ID']) && $_GET['ID']!=''){
   $image_required='';
	$ID=get_safe_value($con ,$_GET['ID']) ;
	$res= mysqli_query($con,"SELECT * FROM food_product WHERE ID='$ID'  $condition1");
	$check=mysqli_num_rows($res);
	if($check>0){
	$row=mysqli_fetch_assoc($res);
	$categories_id =$row['categories_id'];
   $sub_categories_id =$row['sub_categories_id'];
   $name =$row['name'];
   $price =$row['price'];
   $short_desc =$row['short_desc'];
   $description =$row['description'];
   $meta_title =$row['meta_title'];
   $meta_key =$row['meta_key'];
  
}
else{
	header('location:product.php');
die();
}
}

if(isset($_POST['submit'])){
$categories_id=get_safe_value($con ,$_POST['categories_id']) ;
$sub_categories_id=get_safe_value($con ,$_POST['sub_categories_id']) ;
$name=get_safe_value($con ,$_POST['name']) ;
$price=get_safe_value($con ,$_POST['price']) ;
$short_desc=get_safe_value($con ,$_POST['short_desc']) ;
$description=get_safe_value($con ,$_POST['description']) ;
$meta_title=get_safe_value($con ,$_POST['meta_title']) ;
$meta_key=get_safe_value($con ,$_POST['meta_key']) ;

$res= mysqli_query($con,"SELECT * FROM food_product WHERE name='$name' and $condition1 ");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['ID']) && $_GET['ID']!=''){
  $getData=mysqli_fetch_assoc($res);
if($ID==$getData['ID']){

}
else{
	  $msg="Product already exist";
}		}
    else{
      $msg="Product already exist";
  }
	}


if($msg==''){
	if(isset($_GET['ID']) && $_GET['ID']!=''){
     if($_FILES['image']['tmp_name']!=''){

$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],'../media/food/'.$image);
      $update_sql="UPDATE  food_product set categories_id='$categories_id',name='$name',price='$price',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_key='$meta_key', image='$image',sub_categories_id= '$sub_categories_id' WHERE ID='$ID' ";
     }else{

      $update_sql="UPDATE  food_product set categories_id='$categories_id',name='$name',price='$price',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_key='$meta_key',sub_categories_id= '$sub_categories_id'WHERE ID='$ID' ";

     }
mysqli_query($con, $update_sql);

}
else{
  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'],'../media/food/'.$image);

mysqli_query($con,"INSERT INTO food_product(categories_id,name,price,short_desc,description,meta_title,meta_key,status,image,sub_categories_id , added_by) VALUES('$categories_id','$name','$price','$short_desc','$description','$meta_title','$meta_key' ,'1','$image','$sub_categories_id','".$_SESSION['ADMIN_ID']."')");
}
header('location:product.php');
die();

}
}


?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Food Items</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                        	<div class="card-body card-block">

                           <div class="form-group">
                           	<label for="categories" class=" form-control-label">Categories</label>
                           	<select  class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')">
                                 <option>Select Category</option>
                                 <?php 
                                 $res=mysqli_query($con,"SELECT ID ,categories FROM admin_categorie order by categories asc");
                                 while($row=mysqli_fetch_assoc($res)){
                                  if(row['$ID'] == $categories_id){
                                     echo "<option selected value=".$row['ID']." > ".$row['categories']." </option>"; 
                                 } 
                                  
                                  else{
                             echo "<option value=".$row['ID']." > ".$row['categories']." </option>"; 
                                 } 
                                  }
                                
                                 ?>
                              </select>
                           </div>
                           <div class="form-group">
                           <label for="categories" class=" form-control-label">Sub Categories</label>
                           <select class="form-control" name="sub_categories_id" id="sub_categories_id">
                              <option>Select Sub Category</option>
                           </select>
                        </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Food Name</label>
                              <input type="text" name="name" placeholder="Enter Food name" class="form-control" required value="<?php echo $name ?>">
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Price</label>
                              <input type="text" name="price" placeholder="Enter Price" class="form-control" required value="<?php echo $price ?>">
                           </div>
                  
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Image</label>
                              <input type="file" name="image"  class="form-control" ><?php echo $image_required ?>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Short Description</label>
                              <textarea name="short_desc" placeholder="Please enter food short description" class="form-control" required ><?php echo $short_desc ?></textarea>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label"> Description</label>
                              <textarea name="description" placeholder="Please enter food description" class="form-control" required ><?php echo $description ?></textarea>
                           </div>
                            <div class="form-group">
                              <label for="categories" class=" form-control-label"> Meta Title</label>
                              <textarea name="meta_title" placeholder="Enter food meta title " class="form-control" ><?php echo $meta_title ?></textarea>
                           </div>
                            <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Keyword</label>
                              <textarea name="meta_key" placeholder="Enter food meta dkeyword" class="form-control" required ><?php echo $meta_key ?></textarea>
                           </div>

                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <div class="field_error"><?php echo $msg ?></div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<script>
         function get_sub_cat(sub_cat_id){
            var categories_id=jQuery('#categories_id').val();
            jQuery.ajax({
               url:'get_sub_cat.php',
               type:'post',
               data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
               success:function(result){
                  jQuery('#sub_categories_id').html(result);
               }
            });
         }
       </script>
<?php
require('footer.inc.php');
?>
<script>
<?php
if(isset($_GET['ID'])){
?>
get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>


