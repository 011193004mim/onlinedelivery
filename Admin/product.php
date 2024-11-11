 
<?php 

require('top.inc.php') ;
$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==1){

$condition= " AND food_product.added_by='".$_SESSION['ADMIN_ID']."' ";
$condition1= " AND added_by='".$_SESSION['ADMIN_ID']."' ";
}

if(isset($_GET['type']) && $_GET['type']!==''){
   $type=get_safe_value($con,$_GET['type']);
   if($type=='status'){
      $operation=get_safe_value($con,$_GET['operation']);
      $ID=get_safe_value($con,$_GET['ID']);
      if($operation=='Active'){
         $status='1';
      }
      else{
         $status='0';
      }
      $update_status_sql="UPDATE food_product SET status='$status' $condition1 WHERE ID='$ID'";
      mysqli_query($con,$update_status_sql);
   }
   if($type=='Delete'){
     
      $ID=get_safe_value($con,$_GET['ID']);
     
      $delete_sql="DELETE FROM food_product  WHERE ID='$ID' $condition1";
      mysqli_query($con,$delete_sql);
   }
}

$sql="SELECT  food_product. *, sub_categories.sub_categories, admin_categorie.categories FROM food_product,admin_categorie , sub_categories WHERE food_product.categories_id=admin_categorie.ID  AND sub_categories.ID=food_product.sub_categories_id $condition order by ID desc";
$res=mysqli_query($con,$sql);

?>


  <div class="content pb-0">
            <div class="orders">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Food Items </h4>
                           <h4 class="box-link"> <a href="manage_product.php"> Add Items </a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th> Sub Categories</th>
                                       <th>Name</th>
                                       <th>Image</th>
                                       <th>Price</th>
                                       <th>Quantity</th>
                                       <th></th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                  $i=1;
                                 while ($row=mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                       <td class="serial"><?php echo $i ?></td>
               
                                       <td><?php echo $row['ID'] ?></td>
                                       <td><?php echo $row['categories'] ?></td>
                                        <td><?php echo $row['sub_categories'] ?></td>
                                       <td><?php echo $row['name'] ?></td>
    <td><img  src="../media/food/<?php echo $row['image'] ?>"/></td>
                                       <td><?php echo $row['price'] ?></td>
                                      <td>
                                          <?php if($row['status']==1){
                                             echo "<span class='badge badge-complete'><a href='?type=status&operation=Deactive&ID=".$row['ID']."'>Active</a></span>&nbsp;";
                                          }
                                          else{
                                            echo "<span class='badge badge-pending'><a href='?type=status&operation=Active&ID=".$row['ID']."'>Deactive</a></span>&nbsp;"; 
                                          }
                                          echo "<span class='badge badge-edit'><a href='manage_product.php?ID=".$row['ID']."'>Edit</a></span>&nbsp;";
                                            echo "<span class='badge badge-delete'><a href='?type=Delete&&ID=".$row['ID']."'>Delete</a></span>"; 
                                          
                                            ?>
                                             
                                          </td>
                                             
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
       <?php require('footer.inc.php') ?>
