<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>My RC- Admin Panel</title>
    <meta name="description" content="">
   <?php include('app_css.php'); ?>
</head>

<body>

<?php include('admin_menu.php'); ?>
<div class="nav-overlay bg-5 alpha-8 gradient"></div>
<header class="page header bg-3 color-1">
    <div class="container">
        <h1 class="font-lg bold color-1">Developer API</h1>
        <p class="lead">With the help of MY RC Recharge API , You can integrate recharge services to any website of software</p>
    </div>
</header>
 <div class="container">
   <br /> 
    
<?php
        $result_alert = $this->db->query("select * from api_plan");             
        echo html_entity_decode($result_alert->row(0)->api_plan);
    ?>

    
  
</div>

<?php include('footer.php'); ?>
<?php include('app_js.php'); ?>
</body>
</html>
