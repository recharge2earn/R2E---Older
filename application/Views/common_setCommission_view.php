<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Commission</title>
 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 
    <script language="javascript">
    function changecommission(id,user_type,user_id)
        {
            var com = document.getElementById("txtComm"+id).value;
            $.ajax({
                  type: "GET",
                  url: '<?php echo base_url(); ?>common_setCommission/ChangeCommission?id='+id+"&com="+com+"&user_id="+user_id,
                  cache:false,
                  success:function(html)
                    {
                        document.getElementById("txtComm"+id).value = html;
                    }
                });
            
        }
    </script>
   
<script type="text/JavaScript">
function valid(f) {
!(/^[A-z&#2.09;&#241;0-9]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z&#209;&#241;0-9]/ig,''):null;
} 
</script>

    
</head>

<body>

<?php require_once("menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Set Commission</div>
      <div class="panel-body">


    <?php
    if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
    if($this->session->flashdata('user_message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('user_message')."</div>";}
    
        if($this->session->flashdata('message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";}   
    
    ?>    
    
    
<?php
    $user_id = $this->session->userdata("id");
        $id = $this->Common_methods->decrypt($this->uri->segment(3));
        $userinfo = $this->Userinfo_methods->getUserInfo($id);
        $user_type = $userinfo->row(0)->usertype_name;

    $str_query = "select tbluser_commission.*,(select company_name from tblcompany where tblcompany.company_id = tbluser_commission.company_id) as company_name from tbluser_commission where user_id = ?";
    $rslt = $this->db->query($str_query,array($id));
    
    ?>
    

    <h2>Set Commission for <?php echo $userinfo->row(0)->business_name." [".$userinfo->row(0)->username."]"; ?></h2>  
<div class="table-responsive">
<table class="table table-hover">
    <tr>  
    <th>Sr No.</th>
    <th>Network</th>
    <th>Your Commission </th>
    
    <th>Client Commission </th>
    <th></th>
    </tr>
<?php 
$str = '';
    $i=1;
    foreach($rslt->result() as $row)
    {
    
    $dist_com_rslt  = $this->db->query("select * from tbluser_commission where company_id = ? and user_id = ?",array($row->company_id,$user_id));
    if($i % 2 == 0)
    {
        echo '<tr class="row1">';
    }
    else
    {
        echo '<tr class="row2">';
    }?>
        

        <td><?php echo $i;?></td>
        <td><?php echo $row->company_name;?></td>
        <td><?php echo $dist_com_rslt->row(0)->commission;?></td>
    <td>

    <input type="number" class="form-control" id="txtComm<?php echo $row->Id;?>" name="txtComm<?php echo $row->Id;?>" value="<?php echo $row->commission;?>" onkeyup="valid(this)" onblur="valid(this)"/></td>

        <td><input type="button" class="btn btn-primary" id="btnsubmit" name="btnsubmit" value="Submit" onClick="changecommission('<?php echo $row->Id;?>','<?php echo $user_type;?>','<?php echo $id;?>')"/></td>
        </tr>
<?php
        $i++;
    }
?>

</table>
 </div>
    </div>
</div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
   
<script language=JavaScript>
<!--


var message="This function is not allowed";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

// --> 
</script>  


</body>
</html>