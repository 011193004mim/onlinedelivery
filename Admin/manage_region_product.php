<?php 
require('top.inc.php') ;

$region_id ='';

$name ='';
$price ='';
$image ='';

$description ='';

$msg='';
$image_required='required';

if(isset($_GET['ID']) && $_GET['ID']!=''){
   $image_required='';
	$ID=get_safe_value($con ,$_GET['ID']) ;
	$res= mysqli_query($con,"SELECT * FROM region_food WHERE ID='$ID' ");
	$check=mysqli_num_rows($res);
	if($check>0){
	$row=mysqli_fetch_assoc($res);
	$region_id =$row['region_id'];

   $name =$row['name'];
   $price =$row['price'];
 
   $description =$row['description'];

  
}
else{
	header('location:region_product.php');
die();
}
}

if(isset($_POST['submit'])){
$region_id=get_safe_value($con ,$_POST['region_id']) ;

$name=get_safe_value($con ,$_POST['name']) ;
$price=get_safe_value($con ,$_POST['price']) ;

$description=get_safe_value($con ,$_POST['description']) ;

$res= mysqli_query($con,"SELECT * FROM region_food WHERE name='$name'  ");
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
      $update_sql="UPDATE  region_food set region_id='$region_id',name='$name',price='$price',description='$description', image='$image' WHERE ID='$ID' ";
     }else{

      $update_sql="UPDATE  region_food set region_id='$region_id',name='$name',price='$price',description='$description'WHERE ID='$ID' ";

     }
mysqli_query($con, $update_sql);

}
else{
  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'],'../media/food/'.$image);

mysqli_query($con,"INSERT INTO region_food(region_id,name,price,description,status,image) VALUES('$region_id','$name','$price','$description' ,'1','$image')");
}
header('location:region_product.php');
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
                           	<select  class="form-control" name="categories_id" id="categories_id" >
                                 <option>Select Region</option>
                                 <?php 
                                 $res=mysqli_query($con,"SELECT ID ,category FROM admin_region_category order by category asc");
                                 while($row=mysqli_fetch_assoc($res)){
                                  if(row['ID'] == $region_id){
                                     echo "<option selected value=".$row['ID']." > ".$row['category']." </option>"; 
                                 } 
                                  
                                  else{
                             echo "<option value=".$row['ID']." > ".$row['category']." </option>"; 
                                 } 
                                  }
                                
                                 ?>
                              </select>
                          
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
                              <label for="categories" class=" form-control-label"> Description</label>
                              <textarea name="description" placeholder="Please enter food description" class="form-control" required ><?php echo $description ?></textarea>
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

<?php
require('footer.inc.php');
?>

