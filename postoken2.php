<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $orderid = $orderinfo->order_id;?>

<?php foreach ($iteminfo as $kitchen) {

	$new_arr[] = $kitchen->kitchenid;

}

$unique_arr = array_unique($new_arr);

?>


<?php $i = 0; foreach ($unique_arr as $key=>$value) { ?>
	<?php  $k=$this->db->select("*")->from('tbl_kitchen')->where('kitchenid',$value)->get()->row(); ?>


	<div class="print_area2">
		<div class="panel-body">
			<div class="table-responsive m-b-20">

				<table border="0" width="100%">
					<tr>
						<td align="center"><nobr><date><?php echo display('token_no')?>:<?php echo $orderinfo->tokenno;?></nobr><br/><?php echo $customerinfo->customer_name;?></td>
							<td><?php echo display('ordstatus')?></td>
						</tr>
						<h3><?php echo $k->kitchen_name; ?></h3>
					</table>

					<table border="0" class="wpr_100" style="width: 100%;">
						<tr class="text-left">
							<td>Q</td>
							<td>Item</td>
							<td class="text-right">Size</td>
						</tr>
					</table>


					<table border="0" class="wpr_100" style="width: 100%;">
						<?php foreach ($iteminfo as  $orders) { ?>

							<?php
							$food = $this->db->select('*')
							->from('item_foods')
							->where('ProductsID',$orders->ProductsID)
							->where('kitchenid',$value)
							->get()
							->result();
							?>

							<?php  $variant = $this->db->select('*')->from('variant')->where('variantid',$orders->varientid)->get()->row(); ?>

							<?php foreach ($food as  $f) { ?>
								<tr>
									<td><?php  echo $orders->menuqty ?></td>
									<td><?php  echo $f->ProductName ?></td>
									<td class="text-right"><?php  echo $variant->variantName ?></td>
								</tr>

							<?php } ?>

						<?php } ?>



						<tr style="margin-top: 30px;">
							<td colspan="3" align="center"><?php if(!empty($tableinfo)){ echo display('table').': '.$tableinfo->tablename;}?> | <?php echo display('ord_number');?>:<?php echo $orderinfo->order_id;?></td>
						</tr>

					</table>



				</div>
			</div>
		</div>


		<style type="text/css">
			.print_area2{
				display: block !important;
				page-break-after: always;

			}
		</style>



		<?php } ?>