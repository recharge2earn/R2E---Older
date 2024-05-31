<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complain List</title> 
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>     
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == "Solved")
			{isstatus = 'Solved';}else{isstatus='Unsolved';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' complain for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hidresponse').value= document.getElementById('message_'+value).value;
				document.getElementById('hidcomplainid').value= value;								 
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	</script>
     
    <script language="javascript">
	function searchRecord()
	{
		 if (e.keyCode == 13) 
		 {
			 document.getElementById("frmsearch").submit();
		 }
		
		
	}
	</script>
    
</head>
<body>

<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Complain List</div>
      <div class="panel-body">
              
    <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
    


    	<form class="form-inline" action="<?php echo base_url()."list_complain"; ?>" method="post" name="frmReport" id="frmReport">

<div class="form-group">
<label for="txtFrom">From Date:</label>
<input type="date" name="txtFrom" id="txtFrom" class="form-control" title="Select From Date." maxlength="10" />
</div>

<div class="form-group">
<label for="txtTo" >To Date:</label>
<input type="date" name="txtTo" id="txtTo" class="form-control" title="Select From To." maxlength="10" />
</div>

<input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-primary" title="Click to search." />
</form>
   


    <form action="<?php echo base_url()."list_complain" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidresponse" name="hidresponse" />
<input type="hidden" id="hidcomplainid" name="hidcomplainid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>



<div class="table-responsive">
<table class="table table-hover">
    <thead> 
        <tr> 
        <th>Complain Id</th>
          
             <th>Complain Date</th> 
             <th>Business Name</th> 
             <th>Message</th> 
             <th>User Type</th> 
             
             <th>Status</th> 
       
             <th>Response Message</th> 
           <th>Actions</th>
              
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_complain->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <td>			
						<?php echo $result->complain_id; ?>
                </td>
                 
            	<td>			
						<?php echo $result->complain_date; ?>
                </td>
                <td>			
						<?php echo $result->business_name; ?>
                </td>
                <td>			
						<?php echo $result->message; ?>
                </td>
                <td>			
						<?php echo $result->usertype_name; ?>
                </td>
                
                <td>			
						<?php if($result->complain_status == "Pending"){echo "<span class='btn btn-warning'>".$result->complain_status."</span>";} ?>
  <?php if($result->complain_status == "Solved"){echo "<span class='btn btn-success'>".$result->complain_status."</span>";} ?>
  <?php if($result->complain_status == "Unsolved"){echo "<span class='btn btn-danger'>".$result->complain_status."</span>";} ?>
                </td>
                <?php if($result->response_message == ""){ ?>
                <td>			
						 <input type="text" class="form-control" title="Enter Response Message." id="message_<?php echo $result->complain_id; ?>" name="message_<?php echo $result->complain_id; ?>"  />
                </td>
                <?php }else {?>
                <td>			
						<?php echo $result->response_message; ?>
                </td>
                <?php } ?>
 				<td>
                	<select class="form-control" id="action_<?php echo $result->complain_id; ?>" onChange="ActionSubmit('<?php echo $result->complain_id; ?>','<?php echo $result->username; ?>')"><option value="Select">Select</option><option value="Solved">Solved</option><option value="Unsolved">Unsolved</option></select>
               </td>
 				
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>
     <?php  echo $pagination; ?>
	
 </div>
</div>
</div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 

</body>
</html>
