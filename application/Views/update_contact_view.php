<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>Update Contact</title>
    <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include('app_css.php'); ?>
<script src="https://cdn.ckeditor.com/4.9.0/full/ckeditor.js"></script>
</head>

<body>

<?php include('admin_menu.php'); ?>
<div class="container">
<div class="panel panel-primary">
      <div class="panel-heading">Update Contact</div>
      <div class="panel-body">
<?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
<br />
    <form action="<?php echo base_url()."update_contact"; ?>" method="post" autocomplete="off" name="frmService" id="frmService">
<div class="form-group">
 <textarea id="editor1" name="editor1">
      <?php
		$str_query = "select * from contact";
		$result = $this->db->query($str_query);		
		
		echo html_entity_decode($result->row(0)->contact);
	?>
        </textarea> </div>
		
<input type="submit" class="btn btn-primary value="Update Contact" name="btnSubmit" id="btnSubmit" />
 

</form>
<script type="text/javascript">
		//<![CDATA[
			// Replace the <textarea id="editor1"> with an CKEditor instance.
			var editor = CKEDITOR.replace( 'editor1' );
		//]]>
		</script>


</div>
    </div>
</div>
  <?php require_once("a_footer.php"); ?>
<?php include('app_js.php'); ?>
</body>
</html>