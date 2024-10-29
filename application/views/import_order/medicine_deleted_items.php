<?php if(!empty($chemist_id)){ ?>
<style>
.top_bar_title{
	margin-top: -5px;
}
</style>
<script>
$(".top_bar_title1").show();
</script>
<?php } ?>
<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>import_order";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class="row">
				<div class="col-sm-12 col-12">
					<table class="table table-striped table-bordered" aria-describedby>
						<thead>
							<tr>
								<th style="width:50px;" scope>
									S.No.
								</th>
								<th scope>
									Item name
								</th>
								<th style="width:150px;" scope>
									Mrp.
								</th>
								<th style="width:150px;" scope>
									Quantity
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
						foreach ($result as $row)
						{
							?>
							<tr>
								<td class="cart_id">
									<?= $i++ ?>
								</td>
								<td class="cart_title">
									<?= ucwords(strtolower($row->item_name)) ?>
								</td>
								<td class="cart_mrp">
									<?= $row->mrp ?>
								</td>
								<td class="cart_stock">
									<?= $row->quantity ?>
								</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-8 col-8 text-left">	
					<a href="<?= base_url(); ?>import_order/downloadfile/<?php echo base64_encode($order_id); ?>">
						<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" style="width:35%">Download excel</button>
					</a>
				</div>
				<div class="col-sm-4 col-4 text-right">
					<a href="<?= base_url(); ?>my_cart">
						<button type="submit" class="btn btn-primary main_theme_button next_btn" name="submit" value="submit" style="width:20%">Next</button>
					</a>
				</div>
			</div>
		</div>
	</div>     
</div>