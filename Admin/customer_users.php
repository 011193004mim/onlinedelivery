 
<?php 
require('top.inc.php') ;
isAdmin();
if(isset($_GET['type']) && $_GET['type']!==''){
   $type=get_safe_value($con,$_GET['type']);
   
   if($type=='Delete'){
     
      $ID=get_safe_value($con,$_GET['ID']);
     
      $delete_sql="DELETE FROM customer_users  WHERE ID='$ID'";
      mysqli_query($con,$delete_sql);
   }
}
$sql="SELECT * from customer_users order by ID desc";
$res=mysqli_query($con,$sql);

?>


  <div class="content pb-0">
            <div class="orders">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Client</h4>
                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                        <th>Password</th>
                                       <th>Phone</th>
                                       <th>Date</th>
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
                                       <td><?php echo $row['name'] ?></td>
                                       <td><?php echo $row['email'] ?></td>
                                       <td><?php echo $row['password'] ?></td>
                                       <td><?php echo $row['phone'] ?></td>
                                       <td><?php echo $row['added_on'] ?></td>
                                       
                                        
                                       <td>
                                          <?php 
                                       
                                            echo "<span class='badge badge-delete'><a href='?type=Delete&&ID=".$row['ID']."'>Delete</a></span>"; 
                                          
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
       <?php require('footer.inc.php') ?>
