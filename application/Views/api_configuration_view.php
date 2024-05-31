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

    <title>API Configuration</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  
    <?php include("app_css.php"); ?>
   
<script>
function SetEdit(value)
	{
		document.getElementById('txtAPIName').value=document.getElementById("name_"+value).innerHTML;
		document.getElementById('txtUserName').value=document.getElementById("uname_"+value).innerHTML;		
		document.getElementById('txtPassword').value='';
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit API";
	}
</script>

</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("admin_menu.php"); ?>
   
   <div class="container">
     
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">API Configuration</div>
      <div class="panel-body">

<form method="post" action="<?php echo base_url()."api_configuration"; ?>" name="frmapi_view" id="frmapi_view" autocomplete="off">
<div class="form-group">
<label for="txtAPIName">Select API Provider:</label>
<select class="form-control" id="txtAPIName" name="txtAPIName" >

<?php 
    $rslt_api = $this->db->query("select * from tblapi");
    foreach($rslt_api->result() as $row)
    {
?>
<option value="<?php echo $row->api_name;?>"><?php echo $row->api_name;?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="txtUserName">User Name :</label>
<input type="text" id="txtUserName" required class="form-control" title="Enter User Name" name="txtUserName">
</div>


<div class="form-group">
<label for="txtPassword">Password :</label>
<input type="password" class="form-control" id="txtPassword" required title="Enter API Password." name="txtPassword" maxlength="50"/>
</div>

<input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Submit"/>
<input type="hidden" id="hidID" name="hidID" />
</form>

</div>
</div>
</div>

<div class="container">
     
   
    <div class="panel panel-primary">
      <div class="panel-heading">List Of API</div>
      <div class="panel-body">


<table class="table table-bordered">
     <thead> 
        <tr> 
            <th>API Provider</th> 
            <th>User Name</th> 
            <th>Password</th>
             
            <th>Edit</th> 
        </tr> </thead>


    <?php   $i = 0;foreach($result_api->result() as $result)    {  ?>
    <tbody> 
            <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

              <td><span id="name_<?php echo $result->api_id; ?>"><?php echo $result->api_name; ?></span></td>
             <td><span id="uname_<?php echo $result->api_id; ?>"><?php echo $result->username; ?></span></td>
              <td><span id="pwd_<?php echo $result->api_id; ?>"><?php echo '*******'; ?></span></td>              
                           
            <td><a href="#" class="btn btn-info" onClick="SetEdit('<?php echo $result->api_id; ?>')" role="button">Edit</a>
              </td>  
        </tr></tbody>
        <?php   
        $i++;} ?>
        </table> 

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
