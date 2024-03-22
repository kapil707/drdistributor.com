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
	window.location.href = "<?= base_url();?>";
}
</script>
<div class="container main_container">
	<div class="row">
		<div class="col-sm-12 col-12">
			<table class="table table-striped table-bordered" aria-describedby>
				<thead>
					<tr>
						<th style="width:50px;" scope>
							S.No.
						</th>
						<th scope>
							Item Name
						</th>
						<th scope>
							Suggest Item
						</th>
						<th scope>
							Action
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$lastcount=1;
				foreach($result as $row)
				{
					?>
					<tr class="selected_suggest_<?= $row->id ?>">
						<td><?= $lastcount++?></td>
						<td><?= ucwords(strtolower($row->your_item_name))?></td>
						<td><?= ucwords(strtolower($row->item_name))?></td>
						<td><a href="javascript:delete_suggest_by_id('<?= $row->id ?>')" title="Delete Suggest Medicine"><i class="fa fa-trash" aria-hidden="true" style="margin-left:10px; font-size:20px"></i></a></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>	
	</div>     
</div>
<script>
function delete_suggest_by_id(_id)
{
	if (confirm('Are you sure Delete Suggest?')) {
		$('.selected_suggest_'+_id).hide();
		$.ajax({
			url: "<?php echo base_url(); ?>import_order/delete_suggest_by_id",
			type:"POST",
			dataType: 'json',
			data: {id:_id},
			success: function(data){
				
			}
		});
	}
}
</script>