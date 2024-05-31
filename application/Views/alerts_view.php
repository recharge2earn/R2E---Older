<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>Set Alert/News</title>
    <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include('app_css.php'); ?>
<script src="https://cdn.ckeditor.com/4.9.0/full/ckeditor.js"></script>
</head>

<body>

<?php include('admin_menu.php'); ?>
<div class="container">
<div class="panel panel-primary">
      <div class="panel-heading">Set Alert/News</div>
      <div class="panel-body">
<?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
<br />
    <form action="<?php echo base_url()."alerts"; ?>" method="post" autocomplete="off" name="frmService" id="frmService">
<div class="form-group">
 <textarea id="editor1" row="50" name="editor1" class="form-control">
      <?php
		$str_query = "select * from tblalerts";
		$result = $this->db->query($str_query);		
		
		echo $result->row(0)->alert_name;
	?>
        </textarea> </div>
		
<input type="submit" class="btn btn-primary value="Set Alert" name="btnSubmit" id="btnSubmit" />
 

</form>
<script type="text/javascript">
		//<![CDATA[
			// Replace the <textarea id="editor1"> with an CKEditor instance.
			var editor = CKEDITOR.replace( '' );
		//]]>
		</script>


</div>
    </div>
</div>
  <?php require_once("a_footer.php"); ?>
<?php include('app_js.php'); ?>
</body>
</html>
