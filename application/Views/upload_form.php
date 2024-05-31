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
         <?php
	if ($error != ''){echo "<div class='alert alert-danger'>".$error."</div>"; }
	?>
	
	 <?php
	if ($data != ''){echo "<div class='alert alert-danger'>".$data."</div>"; }
	?>
      <?php echo form_open_multipart('upload/do_upload');?> 
		
      <form action = "" method = "">
          <div class="form-group col-sm-4">
         <input class="form-control" type = "file" name = "userfile" size = "20" /> 
        </div>
      
         <input class="btn btn-primary" type = "submit" value = "Upload" /> 
      </form> 
		
  </div>
    </div>
</div>
  <?php require_once("a_footer.php"); ?>
<?php include('app_js.php'); ?>
</body>
</html>
