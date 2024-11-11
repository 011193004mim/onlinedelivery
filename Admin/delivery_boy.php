<?php 

require('top.inc.php') ;


if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
   $type=get_safe_value($con,$_GET['type']);
   if($type=='status'){
      $operation=get_safe_value($con,$_GET['operation']);
      $id=get_safe_value($con,$_GET['id']);
      if($operation=='Active'){
         $status='1';
      }
      else{
         $status='0';
      }
      $update_status_sql="UPDATE delivery_boy SET status='$status' WHERE id='$id'";
      mysqli_query($con,$update_status_sql);
   }
   if($type=='Delete'){
     
      $id=get_safe_value($con,$_GET['id']);
     
      $delete_sql="DELETE FROM delivery_boy WHERE id='$id' ";
      mysqli_query($con,$delete_sql);
   }
}
$sql="SELECT * from delivery_boy  order by id asc ";
$res=mysqli_query($con,$sql);


?>
  <div class="content pb-0">
            <div class="orders">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Delivery Boy </h4>
                           <h4 class="box-link"> <a href="manage_delivery_boy.php"> Add Delivery </a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>Name</th>
                                       <th>Mobile</th>
                                      <th>Added On</th>
                                  
                                       <th></th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php if(mysqli_num_rows($res)>0){
                                  $i=1;
                                 while ($row=mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                       <td class="serial"><?php echo $i ?></td>
               
                                       <td><?php echo $row['name'] ?></td>
                                       <td><?php echo $row['mobile'] ?></td>
                                        	<td>
							<?php 
							$dateStr=strtotime($row['added_on']);
							echo date('d-m-Y',$dateStr);
							?>
							</td>
							<td>
                                          <?php if($row['status']==1){
                                             echo "<span class='badge badge-complete'><a href='?type=status&operation=Deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                                          }
                                          else{
                                            echo "<span class='badge badge-pending'><a href='?type=status&operation=Active&id=".$row['id']."'>Deactive</a></span>&nbsp;"; 
                                          }
                                          echo "<span class='badge badge-edit'><a href='manage_delivery_boy.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
                                            echo "<span class='badge badge-delete'><a href='?type=Delete&&id=".$row['id']."'>Delete</a></span>"; 
                                          
                                            ?>
                                             
                                          </td>
                                    </tr>
                                 <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
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