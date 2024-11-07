<script>
$(".top_bar_title").html("<?= $MainPageTitle ?>");
function goBack() {
	window.location.href = "<?= base_url();?>io";
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
				/*$lastcount=1;
				foreach($result as $row)
				{
					?>
					<tr class="selected_suggest_<?= $row->id ?>">
						<td><?= $lastcount++?></td>
						<td class="all_item_name"><?= ucwords(strtolower($row->your_item_name))?></td>
						<td class="all_item_name"><?= ucwords(strtolower($row->item_name))?></td>
						<td class="">
							<a href="javascript:delete_suggest_by_id('<?= $row->id ?>')" title="Delete Suggest Medicine" class="all_item_delete_btn"><i class="fa fa-trash" aria-hidden="true" style="margin-left:10px; font-size:20px"></i> Delete suggest medicine</a>
						</td>
					</tr>
					<?php
				}*/
				?>
				</tbody>
			</table>
		</div>	
	</div>     
</div>
<script>
$(document).ready(function(){
	MainPageFuncationCall();
});
</script>
<script>
function MainPageFuncationCall() {
	$.ajax({
        type: "POST",
        dataType: "json",
        url: get_base_url() + "import_order_api/medicine_suggest_api",
        cache: true,
        error: function() {},
        success: function(data) {
			
		}
	});
}
function delete_suggest_by_id(_id)
{
	if (confirm('Are you sure Delete Suggest?')) {
		$('.selected_suggest_'+_id).hide();
		$.ajax({
			url: "<?php echo base_url(); ?>import_order_api/delete_suggest_by_id",
			type:"POST",
			dataType: 'json',
			data: {id:_id},
			success: function(data){
				
			}
		});
	}
}
</script>