<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_api extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		
		$result = $this->get_api();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."add_api/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_api'] = $this->get_api_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('add_api_view',$this->view_data);		
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
			if($this->input->post("btnSubmit") == "Submit")
			{
				$ApiName = $this->input->post("txtAPIName",TRUE);
				$url = $this->input->post("url",TRUE);
				$response_type = $this->input->post("response_type",TRUE);
				$status_response_text = $this->input->post("status_response_text",TRUE);
				$txid_response_text = $this->input->post("txid_response_text",TRUE);
				$opid_response_text = $this->input->post("opid_response_text",TRUE);
				$success_response_text = $this->input->post("success_response_text",TRUE);
				$failure_response_text = $this->input->post("failure_response_text",TRUE);
				$message_response_text = $this->input->post("message_response_text",TRUE);
				$balance_url = $this->input->post("balance_url",TRUE);
				$balance_response_text = $this->input->post("balance_response_text",TRUE);
				$method = $this->input->post("method",TRUE);
				
			
				if($this->add($ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,"0",$method) == true)
				{
					$this->msg ="Api Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$apiID = $this->input->post("hidID",TRUE);
				$ApiName = $this->input->post("txtAPIName",TRUE);
				$url = $this->input->post("url",TRUE);
				$response_type = $this->input->post("response_type",TRUE);
				$status_response_text = $this->input->post("status_response_text",TRUE);
				$txid_response_text = $this->input->post("txid_response_text",TRUE);
				$opid_response_text = $this->input->post("opid_response_text",TRUE);
				$success_response_text = $this->input->post("success_response_text",TRUE);
				$failure_response_text = $this->input->post("failure_response_text",TRUE);
				$message_response_text = $this->input->post("message_response_text",TRUE);
			$balance_url = $this->input->post("balance_url",TRUE);
				$balance_response_text = $this->input->post("balance_response_text",TRUE);
				$method = $this->input->post("method",TRUE); 
					$second_api = $this->input->post("second_api",TRUE); 
			
				if($this->update($apiID,$ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,$balance_url,$balance_response_text,$method,$second_api) == true)
				{
					$this->msg ="Api Updated Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{				
				$apiID = $this->input->post("hidValue",TRUE);
				$this->load->model('Api_model');
				if($this->delete($apiID) == true)
				{
					$this->msg ="Api Delete Successfully.";
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
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
	
	
	
	
	
		public	function add($ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,$ipaddress,$method)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblapi(api_name,url,response_type,status_response_text,txid_response_text,opid_response_text,success_response_text,failure_response_text,message_response_text,ipaddress,method) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,$ipaddress,$method));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($apiID)
	{	
		$str_query = "delete from tblapi where api_id=?";
		$result = $this->db->query($str_query,array($apiID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($apiID,$ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,$balance_url,$balance_response_text,$method,$second_api)
	{	
		$str_query = "update tblapi set api_name=?, url=?, response_type=?, status_response_text=?, txid_response_text=?, opid_response_text=? ,success_response_text=?, failure_response_text=?,message_response_text=?,balance_url=?,balance_response_text=?, method=?, second_api=? where api_id=?";
		$result = $this->db->query($str_query,array($ApiName,$url,$response_type,$status_response_text,$txid_response_text,$opid_response_text,$success_response_text,$failure_response_text,$message_response_text,$balance_url,$balance_response_text,$method,$second_api,$apiID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_api()
	{
		$str_query = "select * from  tblapi order by api_id ";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_api_limited($start_row,$per_page)
	{
		$str_query = "select * from  tblapi order by api_id limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
	
	
	
	
}