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

    <title>Search Plan</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="">
    <meta name="author" content="">

  <?php include("app_css.php"); ?>
   
      <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       

  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
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
      <div class="panel-heading">Search Plan</div>
      <div class="panel-body"><form class="form-inline" action="" method="post" name="frmReport" id="frmReport">
 <div class="form-group">
  <label for="sel1">Select Operator:</label>
  <select class="form-control" id="oparr" name="oparr">
    <option value="AT">Airtel</option>
    <option value="ID">Idea</option>
    <option value="VF">Vodafone</option>
    <option value="RG">Reliance GSM</option>
    <option value="AC">Aircel</option>
    <option value="TD">Docomo</option>
      <option value="MT">MT</option>
      <option value="UN">Telenor</option>
       <option value="RJ">JIO</option>
  </select>
</div>
  <div class="form-group">
  <label for="sel1">Select Circle:</label>
  <select class="form-control" id="zonearr" name="zonearr">
    <option value="WB">All India</option>
   
  </select>
</div>
  
  <button type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-primary">Submit</button>
</form>
<br />

<div class="table-responsive">
 <table id="table_id" class="table">
                            <thead>
						
                                <tr>
                                  
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Validity</th>
                                    <th>Type</th>
                                     
                                 
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$oparr = $_REQUEST[oparr];
							
 $zonearr = $_REQUEST[zonearr];

	$url = 'http://api.plansinfo.com/api.php?op_code='.$oparr.'&zone_code='.$zonearr.'&app_token=AMr9znCdEM';

  $obj = file_get_contents("$url");
 $obj = json_decode($obj);
						
						for($j=0; $j<count($obj->{'am'}); $j++){
							
							?>
                              
										<tr>
									
                                         <td><?php echo $obj->{'am'}[$j] ?></td>
                                            <td><?php echo $obj->{'des'}[$j] ?></td>
                                            <td><?php echo $obj->{'val'}[$j] ?></td>
                                             <td><?php echo $obj->{'tp'}[$j] ?></td>
                                            
                                      
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table> 
			
				 
</div>	
</div>
</div>
</div>
  
      
   
      <br />
	

    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
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
