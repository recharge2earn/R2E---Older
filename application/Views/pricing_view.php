<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>My RC- Recharge Software & API</title>
    <meta name="description" content="">
   <?php include('myrc_css.php'); ?>
</head>

<body>

<?php include('myrc_menu.php'); ?>
<div class="nav-overlay bg-5 alpha-8 gradient"></div>
<header class="page header bg-3 color-1">
    <div class="container">
        <h1 class="font-lg bold color-1">API Pricing </h1>
        <p class="lead">We provide all mobile , dth, data card, postpaid bill payment API. If you are a developer or want to develop  B2B, B2C Recharge portal you can integrate in any portal to use our recharge services</p>
    </div>
</header>
 <div class="container">
   <br /> 
    
<?php
        $result_alert = $this->db->query("select * from plan_upgrade");             
        echo html_entity_decode($result_alert->row(0)->plan);
    ?>

    
  
</div>

<?php include('myrc_footer.php'); ?>
<?php include('myrc_js.php'); ?>
</body>
</html>
