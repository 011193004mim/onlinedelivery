<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
   $type=get_safe_value($con,$_GET['type']);
   if($type=='status'){
      $operation=get_safe_value($con,$_GET['operation']);
      $id=get_safe_value($con,$_GET['ID']);
      if($operation=='active'){
         $status='1';
      }else{
         $status='0';
      }
      $update_status_sql="update region_food set status='$status' where ID='$ID'";
      mysqli_query($con,$update_status_sql);
   }
   
   if($type=='delete'){
      $id=get_safe_value($con,$_GET['ID']);
      $delete_sql="delete from region_food where ID='$ID'";
      mysqli_query($con,$delete_sql);
   }
}

$sql="select region_food.*,admin_region_category.category from region_food,admin_region_category where region_food.region_id=admin_region_category.ID order by region_food.ID desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">Products </h4>
               <h4 class="box-link"><a href="manage_region_product.php">Add Product</a> </h4>
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        <th class="serial">#</th>
                        <th>ID</th>
                        <th>Categories</th>
                        <th>Name</th>
                        <th>Image</th>
              
                        <th>Price</th>
                       
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
                        <td><?php echo $row['category']?></td>
                        <td><?php echo $row['name']?></td>
                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
                  
                        <td><?php echo $row['price']?></td>
                       
                        <td>
                        <?php
                        if($row['status']==1){
                           echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&ID=".$row['ID']."'>Active</a></span>&nbsp;";
                        }else{
                           echo "<span class='badge badge-pending'><a href='?type=status&operation=active&ID=".$row['ID']."'>Deactive</a></span>&nbsp;";
                        }
                        echo "<span class='badge badge-edit'><a href='manage_region_product.php?ID=".$row['ID']."'>Edit</a></span>&nbsp;";
                        
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