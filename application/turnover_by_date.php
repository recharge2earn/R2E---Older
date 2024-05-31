<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Turnover_by_date extends CI_Controller {
	public function index()
	{
		if($this->session->userdata("alogged_in") != true)
		{
			redirect(base_url()."login");
		}
		$str_query = "select Date(add_date) as tdate,IFNULL(sum(amount),0) as Success,(select IFNULL(sum(amount),0)  from tblrecharge a  where a.recharge_status = 'Failure' and Date(a.add_date) =Date(tblrecharge.add_date) ) as Failure from tblrecharge where recharge_status = 'Success' group by Date(add_date) order by Date(add_date) desc";
		$rslt = $this->db->query($str_query);
		echo "<table border=1 cellpadding='5' cellspacing='3' style='border-collapse:collapse' width='50%' align='center'>";
		echo "<th>Date</th>";
		echo "<th>Success</th>";
		echo "<th>Failure</th>";
		$i=0;
		foreach($rslt->result() as $rw)
		{
			if($i % 2 == 0)
			{
				echo "<tr style='background-color:#F2F5F8'>"; 
			}
			else
			{
				echo "<tr>"; 
			}
			echo "<td align='right'>".$rw->tdate."</td>";
			echo "<td align='right'>".$rw->Success."</td>";
			echo "<td align='right'>".$rw->Failure."</td>";
			echo "</tr>"; 
			$i++;
		}
			echo "</table>";
	}	
}
