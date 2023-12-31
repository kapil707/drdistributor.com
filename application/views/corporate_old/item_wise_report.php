<style>
.menubtn1
{
	display:none;
}
.headertitle
{
    margin-top: 5px !important;
}
</style>
<script>
$(".headertitle").html("Item wise report");
</script>
<div class="container all_page_main_part">
	<div class="row">
		<div class="col-sm-12 col-12">
			<div class='row'>
				<div class='col-xs-6 col-md-3'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker1' style="width: 100%">
							<input type='text' class="form-control formdate" id="from" name="from" value="" placeholder="Select date from"  data-date-format="DD-MMM-YYYY">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>

				<div class='col-xs-6 col-md-3'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker2' style="width: 100%">
							<input type='text' class="form-control todate" id="to" name="to" value="" placeholder="Select date to" data-date-format="DD-MMM-YYYY">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class='col-xs-6 col-md-3'>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block site_main_btn31" onclick="call_page()">Submit</button>
					</div>
				</div>
				<div class='col-xs-6 col-md-3'>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block site_main_btn31 downloadbtn" onclick="call_download()" style="display:none;">Download</button>
					</div>
				</div>
			</div>
			<table class="table table-striped table-bordered" aria-describedby style="background:white">
				<thead>
					<tr>
						<th style="width:50px;" scope>

						</th>
						<th style="width:50px;" scope>
							CODE
						</th>
						<th style="width:100px;" scope>
							CUSTOMER
						</th>
						<th style="width:50px;" scope>
							QTY
						</th>
						<th style="width:50px;" scope>
							FREE
						</th>
						<th style="width:50px;" scope>
							AMOUNT
						</th>
						<th style="width:200px;" scope>
							ADDRESS
						</th>
						<th style="width:50px;" scope>
							MOBILE
						</th>
					</tr>
				</thead>
				<tbody class="load_page">
					
				</tbody>
			</table>
			<div class="load_page_loading">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<script>
$('#from').datetimepicker({format: 'DD-MMM-YYYY'});
$('#to').datetimepicker({format: 'DD-MMM-YYYY'});
$('#month').datetimepicker({format: 'MMM'});
</script>    
<script>
function call_page()
{
	user_session	=	'<?=$_SESSION["user_session"]?>';
	user_division	=	'<?=$_SESSION["user_division"]?>';
	user_compcode	=	'<?=$_SESSION["user_compcode"]?>';
	
	$(".downloadbtn").hide();
	formdate = $(".formdate").val();
	todate   = $(".todate").val();
	if(formdate=="")
	{
		alert("Select Date from")
		return false;
	}
	if(todate=="")
	{
		alert("Select Date to")
		return false;
	}
	$(".load_more").hide();
	$(".load_page").html("");
	$(".load_page_loading").html('<h1><center><img src="<?= base_url(); ?>/img_v<?= constant('site_v') ?>/loading.gif" width="100px"></center></h1><h1><center>Loading....</center></h1>');
	$.ajax({
		type       : "POST",
		data       :  {user_session:user_session,user_division:user_division,user_compcode:user_compcode,formdate:formdate,todate:todate} ,
		url        : "<?php echo base_url(); ?>corporate/item_wise_report_api",
		cache	   : false,
		error: function(){
			$(".load_page_loading").html('<h1><img src="<?= base_url(); ?>img_v<?= constant('site_v') ?>/something_went_wrong.png" width="100%"></h1>');
		},
		success    : function(data){
			if(data!="")
			{
				$(".load_page_loading").html("");
			}
			var itc1 = "";
			var itc2 = "";
			var int_i = 0;
			total_qty = total_fqty = total_netamt = 0;
			$.each(data.items, function(i,item){	
				if (item){
					if(item.permission!="")
					{
						$(".load_page").append('<center>'+item.permission+'</center>');
					}
					else
					{
						int_i++;
						$(".downloadbtn").show();
						itc1 = item.item_code;
						if(itc1!=itc2)
						{
							itc2 = itc1;
							if(int_i!=1)
							{
								$(".load_page").append('<tr><td>Total</td><td></td><td></td><td>'+total_qty+'</td><td>'+total_fqty+'</td><td>'+total_netamt.toFixed(2)+'</td><td></td><td></td></tr>');
								total_qty = total_fqty = total_netamt = 0;
							}
							$(".load_page").append('<tr><td class="cart_title" colspan="8">'+atob(item.item_name)+' <span class="cart_packing">('+atob(item.item_packing)+' Packing)</span></td></tr>');					
						}
						total_qty 		= total_qty + parseInt(item.qty);
						total_fqty 		= total_fqty + parseInt(item.fqty);
						total_netamt 	= total_netamt + parseFloat(item.netamt);
						$(".load_page").append('<tr><td></td><td class="cart_chemist_code">'+item.chemist_id+'</td><td class="cart_chemist_name">'+atob(item.chemist_name)+'</td><td class="cart_stock">'+item.qty+'</td><td class="cart_stock_free">'+item.fqty+'</td><td>'+item.netamt+'</td><td class="cart_chemist_phone">'+atob(item.chemist_address)+'</td><td class="cart_chemist_phone">'+atob(item.chemist_mobile)+'</td></tr>');
					}
				}
			});	
		},
		timeout: 10000
	});
}
function call_download()
{
	$(".downloadbtn").hide();
	formdate = $(".formdate").val();
	todate   = $(".todate").val();
	if(formdate=="")
	{
		alert("Select Date from")
		return false;
	}
	if(todate=="")
	{
		alert("Select Date to")
		return false;
	}
	window.location.href = "<?= constant('api_url') ?>staff_download_item_wise_report/<?= $user_session; ?>/<?= $user_division; ?>/<?= $user_compcode; ?>/"+formdate+"/"+todate;
	$(".downloadbtn").show(10000);
}
</script>