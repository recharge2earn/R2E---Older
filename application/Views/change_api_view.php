<?php
$us_id = $this->session->userdata("id");
$rslt = $this->db->query("select * from tblusers where user_id = '$us_id'");
$state_id = $rslt->row(0)->state_id;
$rslt1 = $this->db->query("select * from tblstate where state_id = '$state_id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Change API</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  
    <?php include("app_css.php"); ?>
   
<script>

function changeApi(value)
	{
		var api_name = document.getElementById(value+"ddlapi").value;
		document.getElementById("api_name").value = api_name;
		document.getElementById("company_id").value = value;
		document.getElementById("changeapi").value = "change";
		document.getElementById("apichangeform").submit();
	}
	</script>

</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("admin_menu.php"); ?>
   
   <div class="container">
     <form id="apichangeform" name="apichangeform" action="<?php echo base_url()."change_api"?>" method="post">
<input type="hidden" name="api_name" id="api_name">
<input type="hidden" name="company_id" id="company_id">
<input type="hidden" name="changeapi" id="changeapi">
</form>
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">Change API</div>
      <div class="panel-body">

<div class="table-responsive">
<table class="table">

    <thead> 
        <tr> 
             <th>Operator Name</th> 
            <th>Code</th>
            
          <th>Service</th>
          
             <th>Default API</th>
             <th>Change API</th>
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_company->result() as $result) 	{  ?>
			<tr>

            	<td><span id="comp_<?php echo $result->company_id; ?>"><?php echo $result->company_name; ?></span></td>
 				<td><span id="provider_<?php echo $result->company_id; ?>"><?php echo $result->provider; ?></span></td>
 				
                <td>
  <input type="hidden" id="hidservice_<?php echo $result->company_id; ?>" value="<?php echo $result->service_id; ?>" name="hidservice_<?php echo $result->company_id; ?>" />
  <?php echo $result->service_name; ?></td>
              
 				<td><span id="api_<?php echo $result->company_id; ?>"><?php echo $result->api_name; ?></span></td>
 				
  <td>

<div class="form-group">
 <select id="<?php echo $result->company_id; ?>ddlapi" name="ddlapi" class="form-control" onChange="changeApi('<?php echo $result->company_id; ?>')">
<option value="0">Select</option>
<?php 
	$rslt_api = $this->db->query("select * from tblapi");
	foreach($rslt_api->result() as $row)
	{
?>

<option value="<?php echo $row->api_name;?>"><?php echo $row->api_name;?></option>
<?php } ?>
</select> </div></td>
 					</tr>
		<?php 	
		$i++;} ?>
      </tbody>
	</table>
</div>

</div>

</div>
</div>


    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<?php include("app_js.php"); ?>

</body>
</html>
