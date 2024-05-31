<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_commission extends CI_Controller {
function getCommission()
{


		$id = $_GET["id"];
		$userinfo = $this->Userinfo_methods->getUserInfo($id);
		$user_type = $userinfo->row(0)->usertype_name;

	$str_query = "select tbluser_commission.*,(select company_name from tblcompany where tblcompany.company_id = tbluser_commission.company_id) as company_name from tbluser_commission where user_id = ?";
	$rslt = $this->db->query($str_query,array($id));

	$str ='<br /><div class="alert alert-info">Commission Structure of <strong>'.$userinfo->row(0)->business_name.'</strong></div><table class="table table-hover" >
	<tr>  
	<th>Sr No.</th>
	<th>Network</th>
	
	<th>Client Commission (%)</th>
	<th></th>
	</tr>
	';
	$i=1;
	foreach($rslt->result() as $row)
	{
	$adm_com_rslt  = $this->db->query("select * from tblcompany where company_id = ?",array($row->company_id));
	if($i % 2 == 0)
	{
		$str .='<tr>';
	}
	else
	{
		$str .='<tr>';
	}
		$str.='

		<td>'.$i.'</td>
		<td>'.$row->company_name.'</td>
		
		
		<td>
<div class="form-group">

		<input type="text" maxlength="4" class="form-control" id="txtComm'.$row->Id.'" name="txtComm'.$row->Id.'" value="'.$row->commission.'"/></div></td>
		<td>

		<input type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" value="Submit" onclick="changecommission('.$row->Id.',\''.$user_type.'\')"/><span id="wait_tip" style="display:none;"> Please wait...<img src="<?php echo base_url()."images/ajax-loader.gif";?>">
           id="loading_img"/></span></td>
		</tr>
		';
		$i++;
	}
	$str.='</table>';
	echo $str;
}
function ChangeCommission()
{
	$id = $_GET["id"];
	$com = $_GET["com"];
	echo $id."  ".$com;
	$rslt = $this->db->query("update tbluser_commission set commission = ? where Id = ?",array($com,$id));
	
}
function getdealer()
{
	$id = $_GET["id"];
	$rsltdealer = $this->db->query("select * from tblusers where parent_id = ? and usertype_name = 'Distributor'",array($id));
	echo "<option>Select</option>";
	foreach($rsltdealer->result() as $row)
	{
		
		echo "<option value='".$row->user_id."'>".$row->business_name."[".$row->username."]</option>";
	}

}
function getretailer()
{
	$id = $_GET["id"];
	$rsltdealer = $this->db->query("select * from tblusers where parent_id = ? and usertype_name = 'Agent'",array($id));
	echo "<option>Select</option>";
	foreach($rsltdealer->result() as $row)
	{
		
		echo "<option value='".$row->user_id."'>".$row->business_name."[".$row->username."]</option>";
	}

}
	
	
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$data['message']='';				
			if($this->input->post("hidflag") == "Set")
			{
				$com_id = $this->input->post("hidid",TRUE);
				$com_per = $this->input->post("hidcom",TRUE);
				
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$commissionID = $this->input->post("hidID",TRUE);
				$Company_id = $this->input->post("ddlCompanyName",TRUE);
				//$Proirity = $this->input->post("ddlPriority",TRUE);
				$Proirity =1;
				$RCommission = $this->input->post("txtRoyalComm",TRUE);	
				$PCommission = $this->input->post("txtPayworldComm",TRUE);	
				$CCommission = $this->input->post("txtCyberComm",TRUE);				
				$Scheme = $this->input->post("ddlScheme",TRUE);								
				$this->load->model('Commission_model');				
				if($this->Commission_model->update($commissionID,$Company_id,$Proirity,$RCommission,$PCommission,$CCommission,$Scheme) == true)
				{
					$this->msg ="Commission Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$commissionID = $this->input->post("hidValue",TRUE);
				$this->load->model('Commission_model');
				if($this->Commission_model->delete($commissionID) == true)
				{
					$this->msg ="Commission Delete Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else
			{
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
				$data=array(
				"message"=>"",
				);
				$this->load->view("set_commission_view",$data);
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}