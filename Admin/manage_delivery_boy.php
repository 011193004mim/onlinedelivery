<?php 
require('top.inc.php') ;

$msg="";
$name="";
$mobile="";

$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($con ,$_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from delivery_boy where id='$id'"));
	$name=$row['name'];
	
	$mobile=$row['mobile'];
}

if(isset($_POST['submit'])){
	$name=get_safe_value($con,$_POST['name']);
 
	$mobile=get_safe_value($con,$_POST['mobile']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from delivery_boy where mobile='$mobile'";
	}else{
		$sql="select * from delivery_boy where mobile='$mobile' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Delivery boy already added";
	}else{
		if($id==''){
			
			mysqli_query($con,"insert into delivery_boy(name,mobile,status,added_on) values('$name','$mobile',1,'$added_on')");
		}else{
			mysqli_query($con,"update delivery_boy set name='$name', mobile='$mobile' where id='$id' $condition1 ");
		}
		
header('location: delivery_boy.php');
die();

	}
}
?>
<div class="row">
			  <div class="card-header"><strong>Manage delivery boy</strong><small> Form</small></div>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" placeholder="name" name="name" required value="<?php echo $name?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1">Mobile</label>
                      <input type="text" class="form-control" placeholder="mobile" name="mobile" required value="<?php echo $mobile?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                  
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php require('footer.inc.php');?>