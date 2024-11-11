<?php 
require('top.inc.php') ;
isAdmin();
$admin_categorie ='';
$categories= '';
$msg='';
if(isset($_GET['ID']) && $_GET['ID']!=''){
	$ID=get_safe_value($con ,$_GET['ID']) ;
	$res= mysqli_query($con,"SELECT * FROM admin_categorie WHERE ID='$ID'");
	$check=mysqli_num_rows($res);
	if($check>0){
	$row=mysqli_fetch_assoc($res);
	$admin_categorie =$row['categories'];
}
else{
	header('location:categories.php');
die();
}
}

if(isset($_POST['submit'])){
$categories=get_safe_value($con ,$_POST['categories']) ;
$res= mysqli_query($con,"SELECT * FROM admin_categorie WHERE categories='$categories'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['ID']) && $_GET['ID']!=''){
  $getData=mysqli_fetch_assoc($res);
if($ID==$getData['ID']){

}
else{
	  $msg="Categories already exist";
}		}
    else{
      $msg="Categories already exist";
  }
	}
if($msg==''){
	if(isset($_GET['ID']) && $_GET['ID']!=''){
mysqli_query($con,"UPDATE  admin_categorie set categories='$categories'WHERE ID='$ID'");
}
else{

mysqli_query($con,"INSERT INTO admin_categorie(categories,status) VALUES('$categories','1')");
}
header('location:categories.php');
die();

}
}

?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                        	<div class="card-body card-block">
                           <div class="form-group">
                           	<label for="categories" class=" form-control-label">Categories</label>
                           	<input type="text" name="categories" placeholder="Enter categories type" class="form-control" required value="<?php echo $admin_categorie ?>">
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


<?php require('footer.inc.php') ?>


