<?php
require('top.inc.php');

$sql="select * from customer_users order by ID desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Master </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Order ID</th>
									<th class="product-name"><span class="nobr">Order Date</span></th>
									<th class="product-name"><span class="nobr">Name</span></th>
									<th class="product-name"><span class="nobr">Phone Number</span></th>
									<th class="product-price"><span class="nobr"> Address </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$res=mysqli_query($con,"SELECT order_detail.qty,food_product.name,`order`.*,order_status.name as order_status_str from order_detail,food_product,`order`,order_status where order_status.ID=`order`.order_status and food_product.ID=order_detail.product_id and `order`.ID=order_detail.order_id and food_product.added_by='".$_SESSION['ADMIN_ID']."' order by `order`.ID desc");
								while($row=mysqli_fetch_assoc($res)){
								?>
								<tr>
									<td class="product-add-to-cart"><a href="order_master_detail_vendor.php?ID=<?php echo $row['ID']?>"> <?php echo $row['ID']?></a>
                                             <br/>
                                            <a href="../order_pdf.php?ID=<?php echo $row['ID']?>"> PDF</a> 
									</td>
									<td class="product-name"><?php echo $row['added_on']?></td>
									<td class="product-name"><?php echo $row['name']?></td>
									<td class="product-name"><?php echo $row['mobile']?></td>
									<td class="product-name">
										
									<?php echo $row['address']?><br/>
									<?php echo $row['city']?><br/>
									<?php echo $row['pincode']?>
									</td>
									<td class="product-name"><?php echo $row['payment_type']?></td>
									<td class="product-name"><?php echo $row['payment_status']?></td>
									<td class="product-name"><?php echo $row['order_status_str']?></td>
									
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