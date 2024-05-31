<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Api2_balance extends CI_Controller

{

	private $msg='';

	public function pageview()

	{

		$user=$this->session->userdata('auser_type');

		if(trim($user) != 'Admin')

		{redirect(base_url().'login');}

		$this->load->library('common');

		$this->load->model('Royalcapital_balance_model');

		$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('API2');

		$url="http://www.jupiterinfosoft.com/jupiterapiportal/api_users/getbalance";

		$postfield = "clientid=".$RCInfo->row(0)->username."&password=".$RCInfo->row(0)->password;

		$this->view_data['balance'] = $this->common->ExecuteBalanceURL($url,$postfield);

		$this->view_data['message'] = $this->msg;

		$this->load->view('api2_balance_view',$this->view_data);

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