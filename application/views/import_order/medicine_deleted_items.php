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
$(".top_bar_title").html("<?= $main_page_title ?>");
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
						<button type="submit" class="btn btn-primary mainbutton next_btn" name="submit" value="submit" style="width:35%">Download deleted items</button>
					</a>
				</div>
				<div class="col-sm-4 col-4 text-right">
					<a href="<?= base_url(); ?>my_cart">
						<button type="submit" class="btn btn-primary mainbutton next_btn" name="submit" value="submit" style="width:20%">Next</button>
					</a>
				</div>
			</div>
		</div>
	</div>     
</div>
<script>
function medicine_cart_list()
{
	user_altercode = "<?=$chemist_id?>";
	$.ajax({
		url: "<?php echo base_url(); ?>Chemist_json/my_cart_api",
		type:"POST",
		cache: true,
		data: {user_altercode:user_altercode},
		error: function(){
		},
		success: function(data){
			$.each(data.items, function(i,item){
				if (item)
				{
					// just cart reaload hear
				}
			});
		},
		timeout: 10000
	});
}
function page_load()// just cart reaload hear
{
	medicine_cart_list();// just cart reaload hear
}
setTimeout('page_load();',500);// just cart reaload hear
</script>