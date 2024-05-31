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
     
   
    <div class="panel panel-primary">
      <div class="panel-heading">List Of API</div>
      <div class="panel-body">

<div class="table-responsive">

<table class="table table-bordered">
     <thead> 
        <tr> 
            <th>API Provider</th> 
            <th>User iD</th> 
            <th>Token</th>
              <th>Balance</th>
             
            <th>Edit</th> 
        </tr> </thead>


    <?php   $i = 0;foreach($result_api->result() as $result)    { 
    
    $url = $result->balance_url;
    $username = $result->username;
    $password = $result->password;
     $step1 = str_replace("uuu",$username,$url);
     $step2 = str_replace("ppp",$password,$step1);
     $balance_url = $step2;
     
   
    
     if($result->method == "GET"){
         
         
    
    $buffer =  file_get_contents($balance_url);
     $obj = json_decode($buffer,true); 
    if($response_type->response_type == "xml")
    {
        $xml = simplexml_load_string($buffer);
$json = json_encode($xml);
 $obj = json_decode($json,TRUE); 
    }
    if($response_type->response_type == "csv")
    {
        
 $obj = explode(",",$buffer);
    } 
    
      $balance = $obj[$result->balance_response_text]; 
     }
     
     
    
    
   if($result->method == "POST"){
    
    $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$balance_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS);
        $buffer = curl_exec($ch);       
        curl_close($ch);
    
         $buffer;
         $obj = json_decode($buffer,true); 
          if($response_type == "xml")
    {
        $xml = simplexml_load_string($buffer);
$json = json_encode($xml);
 $obj = json_decode($json,TRUE); 
    }
    
    $balance = $obj[$result->balance_response_text]; 
    
   } 
    
    
    
    
    
    
    
    ?>
    <tbody> 
            <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

              <td><span id="name_<?php echo $result->api_id; ?>"><?php echo $result->api_name; ?></span></td>
             <td><span id="uname_<?php echo $result->api_id; ?>"><?php echo $result->username; ?></span></td>
              <td><span id="pwd_<?php echo $result->api_id; ?>"><?php echo $result->password; ?></span></td>  
               <td><span id="pwd_<?php echo $result->api_id; ?>"><?php echo $balance; ?></span></td>  
                           
            <td><a href="#txtPassword" class="btn btn-info" onClick="SetEdit('<?php echo $result->api_id; ?>')" role="button">Edit</a>
              </td>  
        </tr></tbody>
        <?php   
        $i++;} ?>
        </table> 
</div>
</div>
</div>
</div>
   
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

<form method="post" action="<?php echo base_url()."api"; ?>" name="frmapi_view" id="frmapi_view" autocomplete="off">

<div class="form-group">
<label for="txtAPIName">API Provider :</label>
<input type="text" id="txtAPIName" required="yes" readonly="" class="form-control" title="API Name" name="txtAPIName" value="<?php echo $row->api_name;?>">
</div>

<div class="form-group">
<label for="txtUserName">User Name :</label>
<input type="text" id="txtUserName" required class="form-control" title="Enter User Name" name="txtUserName">
</div>


<div class="form-group">
<label for="txtPassword">Password :</label>
<input type="password" class="form-control" id="txtPassword" required title="Enter API Password." name="txtPassword" maxlength="50"/>
</div>

<input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Update"/>
<input type="hidden" id="hidID" name="hidID" />
</form>

</div>
</div>
</div>




    <!-- Copyright Area Start -->
    <?php include("a_footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<?php include("app_js.php"); ?>

</body>
</html>
