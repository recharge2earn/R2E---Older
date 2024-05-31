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

    <title>Buy/Upgrade plan</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

   <?php include("app_css.php"); ?>

</head>
<script type="text/javascript" src="js/mobile_networks_min.js"></script>
<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
    
     <div class="container">
  <div class="panel panel-primary">
      <div class="panel-heading">Plan</div>
          <div class="panel-body">
	
<?php
		$result_alert = $this->db->query("select * from plan_upgrade");				
		echo html_entity_decode($result_alert->row(0)->plan);
	?>

	
   </div>
</div>
</div>
   
    <?php include("footer.php"); ?>
   
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

<?php include("app_js.php"); ?>
   
</body>
</html>
