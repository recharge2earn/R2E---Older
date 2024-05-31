<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List of Sent Messages</title>
<?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>  
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

// MS OFFICE 2003  : data:application/vnd.ms-excel
// MS OFFICE 2007  : application/vnd.openxmlformats-officedocument.spreadsheetml.sheet

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

    		//Loop through table rows
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

<body class="twoColFixLtHdr">
<form id="frmserchrecarge" name="frmserchrecarge" method="post">
<input type="hidden" id="hidSearchrechargeAction" name="hidSearchrechargeAction">
<input type="hidden" id="hidvalue" name="hidvalue">
</form>
<form id="frmflag" name="frmflag" method="post">
<input type="hidden" id="hidflag" name="hidflag">
<input type="hidden" id="hidvalue" name="hidvalue">
</form>

<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  <input type="hidden" id="renderflag" value="true"/>
  <div>
    <form action="<?php echo base_url()."sent_message" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <legend>Search By</legend>
	From Date : <input type="text" title="Select Date." class="text" name="txtFromDate" id="txtFromDate" >To Date : <input type="text" title="Select Date." class="text" name="txtToDate" id="txtToDate" >&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" >     
</fieldset>
<br />
 </form>
 
<h2 class="h2">List of Sent Messages<font style="padding-left:60%;"></font></h2>  
    <?php
	if ($message != ''){echo "<div id='msg' class='message'><span id='msgspan'>".$message."</span></div>"; }
	if($this->session->flashdata('message')){
	echo "<div id='msg' class='message'><span id='msgspan'>".$this->session->flashdata('message')."</span></div>";}
	if(isset($result_messages)){	
	?>  
      
<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">  
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="50" height="30" >Id</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="50" height="30" >To</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="50" height="30" >Message</th>  
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="80" height="30" >Send Date</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="60" height="30" >Api Response</th>
                   
    </tr>
    <?php 	$i = count($result_messages->result());foreach($result_messages->result() as $result) 	{ ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:50px;width:50px;"><?php echo $result->Id; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:50px;width:50px;"><?php echo $result->to_mobile; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:300px;width:80px;"><?php echo $result->message; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:80px;width:80px;"><?php echo $result->add_date; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:200px;"><?php echo $result->response; ?></td>

 </tr>
		<?php 	
		$i--;} ?>
        <tr class="ColHeader" style="background: #110303;color: #fff;">  
        <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="50" height="30" ></th>  
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="50" height="30" ></th>  
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="80" height="30" > </th>
      <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="80" height="30" > </th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="60" height="30" > </th>
    
    </tr>
		</table> 
         <?php  echo $pagination; ?>        
       <?php } ?>
	<!-- end #mainContent --></div>
   <center> <input type="button" id="tbnexport" name="tbnexport" value="export To Excel" onClick="startexoprt()"/></center>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
      
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>

</body>
</html>