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

    <title>Refund Report</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include("app_css.php"); ?>
   
  
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
      <div class="panel-heading">Refund Report</div>
      <div class="panel-body"><?php
	echo '<div class="table-responsive"><table class="table">
	<thead>
          <tr>
    <tr>
    <th>Recharge ID</th>
    <th>Date</th>
    <th>Description</th>
    <th>Refund Amount</th>
   
     
		

    </tr> </thead>
          <tbody>'
    ;
	$str_query_recharge = "select tblewallet.* from tblewallet where user_id =? and transaction_type = 'Recharge_Refund' order by tblewallet.Id desc limit 0, 30";
	$result_recharge = $this->db->query($str_query_recharge,array($this->session->userdata('id')));		
	$i = 0;
	foreach($result_recharge->result() as $resultRecharge) 	{ 
		echo '<tr'; 
		if($i%2 == 0){
			echo "row1"; 
			}
			else{ 
			echo "row2";
			}
		echo '">';
		echo '<td>'.$resultRecharge->recharge_id.'</td>';
		echo '<td>'.$resultRecharge->add_date.'</td>';
        echo '<td>'.$resultRecharge->description.'</td>';
 		echo '<td>'.$resultRecharge->credit_amount.'</td>';
 		
 			 		
 		
	
  echo '</td> ';
	echo '</tr>';	 	
		$i++;} 
		echo ' </tbody></table></div>'; ?></div>
  
  <div class="container"> <div class="row">
  
  <div class="col-sm-12"><br />
	
	
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
