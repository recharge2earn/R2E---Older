<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>Upload Logo</title>
    <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include('app_css.php'); ?>
<script src="https://cdn.ckeditor.com/4.9.0/full/ckeditor.js"></script>
</head>

<body>

<?php include('admin_menu.php'); ?>
<div class="container">
<div class="panel panel-primary">
      <div class="panel-heading">Upload Logo</div>
      <div class="panel-body">
        <div class="alert alert-success">LOGO UPDATED</div>
		
		<img src="images/logo.png" class="img-rounded" alt="" width="auto" height="55" />
  </div>
    </div>
</div>
  <?php require_once("a_footer.php"); ?>
<?php include('app_js.php'); ?>
</body>
</html>
