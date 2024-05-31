<?php
class Agent_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$user_id,$mobile_no)
	{
		/*if($service_id == "ALL" && $user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date));
		return $result;
		}
		if($user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.service_id=? order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$service_id));
		return $result;
		}		
*/		
		if($mobile_no > 0)
		{
		$str_query ="select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as business_name,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id=? and tblrecharge.mobile_no = ? order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id,$mobile_no));
		return $result;
		}				
		$str_query ="select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as business_name,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id=? and tblrecharge.company_id != '102' order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;		
	}
	
	
	
		public function dmr_report($start_date,$end_date,$user_id,$mobile_no)
	{
		/*if($service_id == "ALL" && $user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date));
		return $result;
		}
		if($user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.service_id=? order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$service_id));
		return $result;
		}		
*/		
		if($mobile_no > 0)
		{
		$str_query ="select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as business_name,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id=? and tblrecharge.mobile_no = ? order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id,$mobile_no));
		return $result;
		}				
		$str_query ="select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as business_name,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id=? and tblrecharge.company_id = '102' order by tblrecharge.recharge_id desc";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;		
	}
	
	
public function get_recharge_limited($start_row,$per_page,$user_id)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblrecharge.user_id= '$user_id' and tblcompany.company_id=tblrecharge.company_id order by recharge_id limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
	
	public function get_Distibutor_recharge($start_date,$end_date,$user_id,$service_id)
	{
		
		
			
		if($service_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name, tblusers.username from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Agent' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id in (select user_id from tblusers where tblusers.parent_id = ?) order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;
		}	
		
		$str_query ="select tblrecharge.*,tblcompany.company_name, tblusers.username from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Agent' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.service_id=? and tblrecharge.user_id in (select user_id from tblusers where tblusers.parent_id = ?) order by tblrecharge.recharge_date";
		$result = $this->db->query($str_query,array($start_date,$end_date,$service_id,$user_id));
		return $result;		
	}
	
	
	public function get_MasterDistibutor_recharge($start_date,$end_date,$user_id,$service_id)
	{
		
		
			
		if($service_id == "ALL")
		{
		$str_query ="select tblrecharge.*,(select a.username from tblusers a where a.user_id = tblusers.parent_id and tblusers.parent_id and tblusers.user_id = tblrecharge.user_id) as distributor_code,tblcompany.company_name, tblusers.username from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Agent' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id in (select user_id from tblusers where tblusers.parent_id in (select user_id from tblusers where tblusers.user_id = ?)) order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;
		}	
		
		$str_query ="select tblrecharge.*,tblcompany.company_name, tblusers.username from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Agent' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.service_id=? and tblrecharge.user_id in (select user_id from tblusers where tblusers.parent_id in (select user_id from tblusers where tblusers.user_id = ?)) order by tblrecharge.recharge_date";
		$result = $this->db->query($str_query,array($start_date,$end_date,$service_id,$user_id));
		return $result;		
	}
}

?>