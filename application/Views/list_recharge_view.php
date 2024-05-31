<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recharge History</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
  
    <script type="text/javascript">
    function runScript(e) 
	{
    	if (e.keyCode == 13) 
		{
			var recid = document.getElementById("txtsearchbox").value;
			alert(recid);
			document.getElementById("hidSearchrechargeAction").value = "Set"; 
			document.getElementById("hidvalue").value = recid; 
			document.getElementById("frmserchrecarge").submit(); 
		}
    }
	
</script>
    <script language="javascript">
function startexoprt()
{
	$.ajax({
			url:'<?php echo base_url()."list_recharge/getdata"?>',
			type:'post',
			cache:false,
			success:function(html)
			{
				
				window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    			e.preventDefault();
			}
			});
}

</script>
    <script language="javascript">

function ExportToExcel(tbl)
    {
       
        var htmltable= document.getElementById(tbl);
        var html = htmltable.outerHTML;
		alert(html);



        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

</script>                     
  <script type="text/JavaScript">

function AutoRefresh( t ) {
	if(document.getElementById("renderflag").value == "true")
	{
		setTimeout("location.reload(true);", t);	
	}
	
}
function setReloadFlag()
{
	var str = document.getElementById("ddlreloadflag").value;
	if(str == 1 | str == 2)
	{
		document.getElementById("hidvalue").value = str;
		document.getElementById("hidflag").value = "Set";
		document.getElementById("frmflag").submit();
	}
}

</script>
<script>	
$(document).ready(function(){
$( "#txtFromDate,#txtToDate " ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	

	
	function statuschecking(value)
	{
		document.getElementById("divstatus"+value).style.display = "none";
		document.getElementById("divprocess"+value).style.display = "block";
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
				document.getElementById("divstatus"+value).style.display = "block";
				document.getElementById("divprocess"+value).style.display = "none";
			}
			});
		
	}
	  function doSearch() {
    		var searchText = document.getElementById('txtsearchbox').value;
    		var targetTable = document.getElementById('example');
    		var targetTableColCount;

    		
    		for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
    			var rowData = '';

    			//Get column count from header row
    			if (rowIndex == 0) {
    				targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
    				continue; //do not execute further code for header row.
    			}

    			//Process data rows. (rowIndex >= 1)
    			for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
    				var cellText = '';

    				if (navigator.appName == 'Microsoft Internet Explorer')
    					cellText = targetTable.rows.item(rowIndex).cells.item(colIndex).innerText;
    				else
    					cellText = targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;

    				rowData += cellText;
    			}

    			// Make search case insensitive.
    			rowData = rowData.toLowerCase();
    			searchText = searchText.toLowerCase();

    			//If search term is not found in row data
    			//then hide the row, else show
    			if (rowData.indexOf(searchText) == -1)
    				targetTable.rows.item(rowIndex).style.display = 'none';
    			else
    				targetTable.rows.item(rowIndex).style.display = 'table-row';
    		}
    	}
	</script>
   <script type="text/javascript">
    
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == "Success")
			{isstatus = 'Success';}
			else if(document.getElementById('action_'+value).value == "Failure")
			{isstatus='Failure';}
			else if(document.getElementById('action_'+value).value == "Pending")
			{isstatus='Pending';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' rechrge for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hidrechargeid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	
</script>
 
</head>

<body>
<?php require_once("admin_menu.php"); ?> 




<div class="panel panel-default">
  <div class="panel-heading">Recharge History</div>
 <div class="panel-body">
<form id="frmserchrecarge" name="frmserchrecarge" method="post">
<input type="hidden" id="hidSearchrechargeAction" name="hidSearchrechargeAction">
<input type="hidden" id="hidvalue" name="hidvalue">
</form>
<form id="frmflag" name="frmflag" method="post">
<input type="hidden" id="hidflag" name="hidflag">
<input type="hidden" id="hidvalue" name="hidvalue">
</form>

  <input type="hidden" id="renderflag" value="true"/>

    <form class="form-inline" action="<?php echo base_url()."list_recharge" ?>" method="post" name="frmSearch" id="frmSearch">

     <div class="form-group">
    <label for="txtFromDate">From Date :</label>

	<input type="date" title="Select Date." class="form-control" name="txtFromDate" id="txtFromDate" >
</div>


  <div class="form-group">
    <label for="txtToDate">To Date :</label>
	<input type="date" title="Select Date." class="form-control" name="txtToDate" id="txtToDate" >
	    
</div>

<input type="submit" class="btn btn-primary" value="Search" name="btnSearch" id="btnSearch" > 

 </form>
 
 <hr>

<form id="checkStatus" name="checkStatus" method="post" action="<?php echo base_url()."list_recharge"?>" >
<input type="hidden" id="hidid" name="hidid" />
<input type="hidden" id="hidstatuscheck" name="hidstatuscheck"/>
</form>


 <form action="<?php echo base_url()."list_recharge" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidrechargeid" name="hidrechargeid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>


    <?php
	if ($message != ''){echo "<div id='msg' class='alert alert-warning'><span id='msgspan'>".$message."</span></div>"; }
	if($this->session->flashdata('message')){
	echo "<div id='msg' class='alert alert-warning'><span id='msgspan'>".$this->session->flashdata('message')."</span></div><br />";}
	if(isset($result_recharge)){	
	?>  
      
       <div class="form-group">
    <label for="txtsearchbox">Search : :</label>
    <input class="form-control" type="text" id="txtsearchbox" name="txtsearchbox" onKeyPress="return runScript(event)"/></div> 
</div>
<div class="alert alert-danger"><b><?php if(isset($result_recharge) and $result_recharge->num_rows() > 0){ echo "Total Successful Recharge : ".$result_recharge->row(0)->totalRecahrge;} ?></b></div>  
<div class="table-responsive">
<table class="table table-striped table-bordered">
<thead>
    <tr>  
    <th>Sr</th>
    <th>TxID</th>
    <th>Wallet</th>
   
     <th>Operator Id</th>  
     <th>Date</th>
     <th>Name</th>
     <th>Balance</th>
     <th>Operator</th>
	 <th>Number</th>    
	 <th>Amount</th>    
   	 <th>API</th>    
	 <th>By</th>
   	 <th>Status</th> 
     <th>Action</th>                   
    </tr>
    <?php $totalRecharge = 0;	$i = count($result_recharge->result());foreach($result_recharge->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <td><?php echo $i; ?></a></td>
 <td><a class="btn btn-success" href="<?php echo base_url()."recharge_detail/index/".$this->Common_methods->encrypt($result->recharge_id); ?>" target="_blank"><?php echo $result->recharge_id; ?></a></td>
 
 <td><a class="btn btn-primary" href="<?php echo base_url()."check_transaction/index/".$result->recharge_id;?>" target=_blank><?php echo $result->ewallet_id; ?></a></td>

 
  <td><?php echo $result->operator_id; ?></td>
 <td><?php echo $result->add_date; ?></td>
 <td><a class="btn btn-primary" href="<?php echo base_url()."profile/view/".$this->Common_methods->encrypt("Agent")."/".$this->Common_methods->encrypt($result->user_id);?>" target="_blank"><?php echo substr("$result->business_name",0,5); ?></a></td>
 <td><?php echo $result->balance; ?></td>

 <td><?php echo $result->company_name; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->amount; ?></td>
 <td><?php echo $result->ExecuteBy; ?></td>
 <td><?php echo $result->recharge_by; ?></td>
 <td>

 <div id="divstatus<?php echo $result->recharge_id; ?>">
 <?php if($result->recharge_status == 'Pending'){echo "<span class='btn btn-warning'><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Pending</a></span>";}

 if($result->recharge_status == 'Success'){$totalRecharge += $result->amount;echo "<span class='btn btn-success'><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Success</a></span>";}

 if($result->recharge_status == 'Failure'){echo "<span class='btn btn-danger'>
 <a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Failure</a></span>";}
  ?></div>

 <div id="divprocess<?php echo $result->recharge_id; ?>" style="display:none;">
 <img src="<?php echo base_url("images/ajax-loader2.gif"); ?>" />
 </div>

 </td>

  <td>
 <select class="form-control" id="action_<?php echo $result->recharge_id; ?>" onChange="ActionSubmit('<?php echo $result->recharge_id; ?>','<?php echo $result->mobile_no; ?>')">
 <option value="Select">Select</option>
 <option value="Success">Success</option>
 <option value="Failure">Failure</option>
 </select>
 </td>
 </tr>
		<?php 	
		$i--;} ?>
  </tr>
  </tbody>
  
	</table> 
             <?php  echo $pagination; ?>       
       <?php } ?>



</div>
</div>
</div>
<?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 

</body>
</html>