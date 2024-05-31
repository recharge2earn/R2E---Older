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

    <title>Support Ticket System</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include("app_css.php"); ?>
      <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    
  <script>
	function getDiv()
	{
			if(document.getElementById("ddlComplainType").value == "ID")
			{
				document.getElementById("transactiondiv").style.display = "block";
			}
			else if(document.getElementById("ddlComplainType").value == "Other")
			{
				document.getElementById("transactiondiv").style.display = "none";
			}
	}
	function setLoad()
	{
		alert("setLoad");
			document.getElementById("transactiondiv").style.display = "none";
		
	}
	function setcompform()
	{

document.getElementById("recid").style.display ="table-row";
			document.getElementById("ddlcomp_tyoe").value ="Recharge Id";
			document.getElementById("recharge_id").value = '<?php echo $recahrge_id; ?>';
		
	}
	
	</script>
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmcomplain_view");
	var varsubject = $("#ddlcomp_tyoe");
	var varmessage = $("#txtMessage");	


	varsubject.focus();
	form.submit(function(){		
		if(validatesSubject() & validatesMessage())
			{				
			return true;
			}
		else
			return false;
	});	
	
function validatesSubject(){
	var dropdown1 = document.getElementById('ddlcomp_tyoe');
	var a = dropdown1.selectedIndex;
		if(a == 0){
			varsubject.addClass("error");
			return false;
		}
		
		else{
			if(a == 1)
			{
				varsubject.removeClass("error");
				document.getElementById("recid").style.display = "block";
				if(document.getElementById("recharge_id").value == "")
				{
					$('#recharge_id').addClass("error");
					return false;
				}
				else
				{
					$('#recharge_id').removeClass("error");
					return true;
				}
			}
			else
			{
			varsubject.removeClass("error");
			return true;
			}
		}
	}
	
		function validatesMessage(){
		if(varmessage.val() == ""){
			varmessage.addClass("error");
			return false;
		}
		else{
			varmessage.removeClass("error");
			return true;
		}
	}	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
function test()
{
	var ddl = document.getElementById("ddlcomp_tyoe");
	if(ddl.selectedIndex == 0)
	{
		document.getElementById("recid").style.display="none";
	}
	if(ddl.selectedIndex == 1)
	{
		document.getElementById("recid").style.display="table-row";
	}
	if(ddl.selectedIndex == 2)
	{
		document.getElementById("recid").style.display="none";
	}
}
	</script>
  
</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
   
   <div class="container">
     
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">Rise Support Ticket</div>
      <div class="panel-body">
    <div>
            
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
              <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	?>

    <form method="post" action="<?php echo base_url()."support_ticket"; ?>" name="frmcomplain_view" id="frmcomplain_view" autocomplete="off">
  
<div id="messagediv" class="form-group">
<label for="ddlcomp_tyoe">Subject : </label>
<select class="form-control" id="ddlcomp_tyoe" name="ddlcomp_tyoe" onChange="test()">
<option>----Select---- </option>
<option>Recharge Dispute</option>
<option>DTH Transfer Request</option>
<option>Billing Support</option>
<option>Sales Support</option>
<option>Technical Issue</option>
<option>Domain Renewal</option>
<option>API Technical Support</option>
<option>Other Support</option>
</select>
</div>

<div class="form-group">
<label for="txtMessage">Message :</label>
<textarea class="form-control" title="Enter Message Regarding Your Complain" id="txtMessage" name="txtMessage" rows="5" cols="5">
</textarea>
</div>

<input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Submit"/> 
<input type="reset" class="btn btn-primary" value="Cancel" name="btnCancel" id="btnCancel" />

</form>
<br />
<div class="table-responsive">
<table class="table">
    <tr>
    <th>Ticket id</th>
    <th>Subject</th>
   <th>Message</th>
   <th>Date</th>
    <th>Response</th>    
   <th>Status</th>    
    </tr>
    <?php	$i = 0;foreach($result_complain->result() as $result) 	{  ?>
	<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
     <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->complain_id; ?></td>
  <td><?php echo $result->complain_type; ?></td>
  <td><?php echo $result->message; ?></td>
   <td><?php echo $result->complain_date; ?></td>  
  <td><?php echo $result->response_message; ?></td>  
  <td>
     <?php if($result->complain_status == "Pending"){echo '<button type="button" class="btn btn-warning">Open</button>';} ?>
  <?php if($result->complain_status == "Solved"){echo '<button type="button" class="btn btn-success">Closed</button>';} ?>
  <?php if($result->complain_status == "Unsolved"){echo '<button type="button" class="btn btn-success">Closed</button>';} ?>
 </td>      
</tr>
		<?php 	
		$i++;} ?>
		</table>

       <?php  echo $pagination; ?>

</div>

	</div>
</div>
  
  <div class="container"> <div class="row">
  
  <div class="col-sm-12">
      
   
      <br />
	
	
	</div>
</div></div>
    </div><br /></div>
    <!-- Login Area End -->

    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<?php include("app_js.php"); ?>
   
     <script>
            $(document).ready(function(){

                //* boxes animation
                form_wrapper = $('.login_box');
                function boxHeight() {
                    form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
                };
                form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
                    var target  = $(this).attr('href'),
                    target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height'        : form_wrapper.height()
                    });
                    $(form_wrapper.find('form:visible')).fadeOut(400,function(){
                        form_wrapper.stop().animate({
                            height   : target_height,
                            marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height'        : ''
                            });
                        });
                    });
                    e.preventDefault();
                });

                //* validation
                $('#login_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    rules: {
                        username: { required: true, minlength: 3 },
                        password: { required: true, minlength: 3 }
                    },
                    highlight: function(element) {
                        $(element).closest('div').addClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    unhighlight: function(element) {
                        $(element).closest('div').removeClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    }
                });
            });
        </script>
</body>
</html>
