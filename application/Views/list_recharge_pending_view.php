<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List of pending recharge</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 
     
    <script>
	$(document).ready(function(){
$( "#txtSearch_Date" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });

	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == "Success")
			{isstatus = 'Success';}else{isstatus='Failure';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' rechrge for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hidrechargeid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	function statuschecking(value)
	{
		$.ajax({
			url:'<?php echo base_url()."rec_status/test?id=";?>'+value,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == "gtid is wrong.")
				{
					document.getElementById("sts"+value).innerHTML = "Failure";
				}
				else
				{
					document.getElementById("sts"+value).innerHTML = html;
				}
			}
			});
		
	}
	</script>
</head>
<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">List of pending recharge</div>
  <div class="panel-body">
    <form class="form-inline" action="<?php echo base_url()."list_recharge_pending" ?>" method="post" name="frmSearch" id="frmSearch">
    
    <div class="form-group">
    <label for="txtSearch_Date">Select Date:</label>
    <input type="date" title="Select Date." class="form-control" name="txtSearch_Date" id="txtSearch_Date" >
    </div>

    <input type="submit" class="btn btn-primary" value="Search" name="btnSearch" id="btnSearch" >

	
 </form>
 
 <hr>

 
 <form action="<?php echo base_url()."list_recharge_pending" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidrechargeid" name="hidrechargeid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
    <?php
	if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
	?> 


	 <div class="table-responsive">  
<table class="table table-hover">
    <tr>   
     <th>SR No.</th> 
     <th>Recharge Id</th>
    <th>Recharge Date</th>
    <th>Name</th>
   <th>Company Name</th>
	<th>Mobile No</th>    
	<th>Amount</th>    
   	<th>API</th>    
	<th>Recharge By</th>
    <th>Response</th> 
   	<th>Status</th>    
	<th>Action</th>                 
    </tr>
    <?php	$i = 0;foreach($result_recharge->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

            <td><?php echo $i+1; ?></td>
            <td><a href="<?php echo base_url()."recharge_detail/index/".$this->Common_methods->encrypt($result->recharge_id); ?>" target="_blank"><?php echo $result->recharge_id; ?></a></td>
 <td><?php echo $result->add_date; ?></td>
 <td><?php echo $result->name; ?></td>
  <td><?php echo $result->company_name; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->amount; ?></td>
 <td><?php echo $result->ExecuteBy; ?></td>
 <td><?php echo $result->recharge_by; ?></td>
  <td><?php echo $result->response; ?></td>
<td>
 <?php if($result->recharge_status == 'Pending'){echo "<span class='btn btn-warning'><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Pending</a></span>";}
 if($result->recharge_status == 'Success'){$totalRecharge += $result->amount;echo "<span class='btn btn-success'><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Success</a></span>";}
 if($result->recharge_status == 'Failure'){echo "<span class='btn btn-danger'>
 <a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Failure</a></span>";}
 
 ?></td>
 <td>

 <select class="form-control" id="action_<?php echo $result->recharge_id; ?>" onChange="ActionSubmit('<?php echo $result->recharge_id; ?>','<?php echo $result->mobile_no; ?>')">
 <option value="Select">Select</option>
 <option value="Pending">Pending</option>
 <option value="Success">Success</option>
 <option value="Failure">Failure</option>
 </select>
 </td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>	
	</div>
	</div>
    </div>
</div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
  
</body>
</html>