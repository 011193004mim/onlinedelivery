<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$ID=get_safe_value($con,$_GET['ID']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql=" UPDATE sub_categories set status='$status' where ID='$ID'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$ID=get_safe_value($con,$_GET['ID']);
		$delete_sql="DELETE from  sub_categories where ID='$ID'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="SELECT sub_categories.*,admin_categorie.categories from sub_categories,admin_categorie where admin_categorie.ID=sub_categories.categories_id order by sub_categories.sub_categories asc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Sub Categories </h4>
				   <h4 class="box-link"><a href="manage_sub_categories.php">Add Sub Categories</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Categories</th>
							   <th>Sub Categories</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['ID']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['sub_categories']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&ID=".$row['ID']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&ID=".$row['ID']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_sub_categories.php?ID=".$row['ID']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&ID=".$row['ID']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>