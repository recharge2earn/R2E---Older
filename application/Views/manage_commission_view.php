<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Commission</title>
<?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>  
  
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
function test(i)
{
	document.getElementById("spanid"+i).style.display = "inline";
}
function changeMarkup(i,value)
{
	var markup = document.getElementById("txtmarkup"+i).value;
	if(markup >= 0)
	{
		$.ajax({
			url:'<?php echo base_url()."manage_commission/setmarkup?id=";?>'+value+'&value='+markup,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == 1)
				{
					document.getElementById("spanid"+i).style.display = "none";
					document.getElementById("txtval"+i).innerHTML = markup;
				}
			}
			});
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



<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  <input type="hidden" id="renderflag" value="true"/>
  <div>
    
 
<h2 class="h2">Manage Markup</h2>  

      
<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
   
   
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="80" height="30" >Airline</th>
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="80" height="30" >Airline Name</th>    
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="30" height="30" >Airline Code</th>    
   	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="70" height="30" >Markup added by you</th> 
      
	             
    </tr>
    <?php
	
	 $i = 0;foreach($data->result() as $result) 	{  ?>
     <?php 
	 $user_id = $this->session->userdata("id");
	 $airline_id = $result->air_company_id;
	 $rslt_markup = $this->db->query("select *  from tblAgentMarkup where user_id = '$user_id' and airline_id='$airline_id'");
	 if($rslt_markup->num_rows() > 0)
	 {
	 	$Markup = $rslt_markup->row(0)->Markup;
	 }
	 else
	 {
		 $Markup = 0;
	 }
	 ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

            <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:50px;width:50px;"><?php echo $result->air_company_id; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:50px;width:50px;"><?php echo $result->company_name; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:80px;width:80px;"><?php echo $result->carrier_code; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:80px;width:80px;"><a id="txtval<?php echo $i; ?>" href="javascript:test('<?php echo $i; ?>')"><?php echo $Markup; ?></a><span id="spanid<?php echo $i; ?>" style="display:none;padding-left:50px;"><input type="text" style="width:60px;" id="txtmarkup<?php echo $i; ?>" name="txtmarkup"><input type="button" id="btnmarkup<?php echo $i; ?>" name="btnmarkup" value="submit" onClick="changeMarkup('<?php echo $i; ?>','<?php echo $result->air_company_id; ?>')"></span></td>

 <?php $i++; ?>

 </tr>
		<?php 	
		} ?>
        
		</table> 
       
      
	<!-- end #mainContent --></div>
   
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
      
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>

</body>
</html>