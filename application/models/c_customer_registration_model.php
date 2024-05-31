<?php
class C_customer_registration_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function checkCustomer_Exist($retailer_id)
	{
		$str_query = "select * from tblusers where parent_id=?";
		$result = $this->db->query($str_query,array($retailer_id));		
		if($result->num_rows() == 1)
		{			
			return $result->row(0)->user_id;
		}
		else
		{
			return 'true';
		}					
	}				
public	function add($RetailerName,$Parent_id,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$DistName,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$binnode_side,$tLevel,$Order_No,$client_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$total_amount = $WorLimit+$Scheme_amt;
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();
$str_query = "insert into tblusers(business_name,parent_id,postal_address,landmark,pincode,state_id,city_id,subarea_id,contact_person,mobile_no,landline,retailer_type_id,emailid,other_area,usertype_name,add_date,ipaddress,bank_id,account_no,account_type,ordganisation,prefered_language,bank_id_2,account_no_2,account_type_2,scheme_id,payment_mode,cheque_dd_no,cheque_dd_date,depositing_bank_id,working_limit,scheme_amount,total_amount,binnode_side,tLevel,Order_No,client_id,status) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($RetailerName,$Parent_id,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,'Customer',$date,$ip,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$total_amount,$binnode_side,$tLevel,$Order_No,$client_id,'1'));		
		if($result > 0)
		{
			$user_id = $this->db->insert_id();			
			$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('yes','yes','".$this->db->insert_id()."','".$date."','".$ip."')");
			$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();				
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,( $Scheme_amt + $WorLimit ),$PayMode,'First Payment To Distibuter','Recharge',$payment_date,$payment_time,$date,$ip));
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($this->session->userdata('id'),$user_id,$master_id,$Scheme_amt,$PayMode,'Registration Fees','Recharge',$payment_date,$payment_time,$date,$ip));
			return $user_id;
		}
		else
		{
			return false;
		}		
	}		
	public function update($UserName,$Password,$user_id,$commission_user)
	{
		$str_query = "update tblusers set username=?,password=?,commission_user=? where user_id=?";
		$result = $this->db->query($str_query,array($UserName,$Password,$commission_user,$user_id));		
		if($result > 0)
		{			
			return true;
		}
		else
		{
			return false;
		}				
	}
	public function find_mobile_exist($mobile)
	{
		$str_query = "select * from tblusers where mobile_no=?";
		$result = $this->db->query($str_query,array($mobile));		
		if($result->num_rows() == 1)
		{			
			return false;
		}
		else
		{
			return true;
		}				
	}	
	
	
	
	private $first=0;
	private $data='';
	private $tt='';
	public function display_btree($client_id)
	{
		$sql= "select * from tblusers where client_id='$client_id' order by Order_No" ;		
		$CI =& get_instance();      	
		$result = $CI->db->query($sql);
		$id1;$id2;
		global $first;
		global $data;		
		for($i=0;$i<$result->num_rows();$i++)
		{
			if($i==0)
			{
			$data .= '"'.$result->row($i)->business_name.'"';		
			}
			else
			{
				$data .= ',"'.$result->row($i)->business_name.'"';				
			}
			
			//			
//			global $first;
//			global $data;
//			if($first == 0)
//			{
//			$data .= '"'.$result->row($i)->business_name.'"';		
//			}
//			$first =1;			
//			$sqlChild = "select * from tblusers where parent_id='".$result->row($i)->user_id."'";
//			echo $sqlChild;
//			$resultChild = $CI->db->query($sqlChild);
//			$k=0;
//			foreach($resultChild->result_array() as $row)
//			{				
//				$data .= ',"'.$row['business_name'].'"';				
//				if($k == 0)
//				{
//					$id1=$row['user_id'];
//				}
//				else
//				{
//					$id2=$row['user_id'];
//				}
//				$k++;
//				//$this->dis($row['user_id']);
//			}	
//			if(isset($id1)){
//				$this->dis($id1);}
//				if(isset($id2)){
//				$this->dis($id2);}
//						
//			//	if(isset($id1)){
////			$this->dis($id1);}
////			if(isset($id2)){
////			$this->dis($id2);}
//			//echo $id1;exit;			
		}

					return $data;
	}
	public function CheckBinaryNode($root_id)
	{
		$str_query = "select * from tblusers where parent_id=?";
		$result = $this->db->query($str_query,array($root_id));		
		if($result->num_rows() == 2)
		{			
			return 'Not Allow';
		}
		else
		{
			return 'true';
		}					
	}			            	
	public function getAllParent($id)
	{
			global $tt;
			$sqlChild = "select parent_id,binnode_side from tblusers where user_id='".$id."'";
			$resultChild = $this->db->query($sqlChild);
			$k=0;
			if($resultChild->row(0)->binnode_side == 'left')
			{
				$tt .= $resultChild->row(0)->parent_id.',';
				$this->getAllParent($resultChild->row(0)->parent_id);				
			}
			else
			{
				$tt .= $resultChild->row(0)->parent_id;
			}
			return $tt;
	}
	public function getBinaryLevelNo($root_id)
	{	
		$result =explode(",",$this->display_btree($root_id));				
		for($x=0;$x<count($result);$x++)
		{
			$testArray[$x+1] = $result[$x];
		}
		$i;$j;
		$array_size = ((count($testArray)/2)+1)*2;
		$i = 1;
		do {$i = $i*2;} while ($i < $array_size);
		$array_size = $i;
		for ($i = 1; $i <= $array_size; $i++){
		if (!isset($testArray[$i])){$testArray[$i] = "null";}
		}
		$i = 2;$depth=0;
		while ($i <= $array_size) 
		{
			for ($j = $i-$i/2 ; $j < $i; $j++){}
			$depth++;
			$i = $i*2;
		}
		return $depth-1;
	}
	public function getBinaryParentID($root_id)
	{			
		global $data;
		//$result = explode(",",$this->dis($root_id));										
		$result = explode(",",$data);		
		for($x=0;$x<count($result);$x++)
		{
			$testArray[$x+1] = $result[$x];
		}
		//print_r($testArray);exit;
		$i;$j;$k=0;
		$array_size = ((count($testArray)/2)+1)*2;
		$i = 1;
		do {$i = $i*2;} while ($i < $array_size);
		$array_size = $i;
		for ($i = 1; $i <= $array_size; $i++)
		{
			if (!isset($testArray[$i]))
			{				
				return $this->getBinaryParentIDByName(str_replace('"','',$testArray[$i / 2]));
			}
		}
	}
	public function getBinaryParentIDByName($business_name)
	{		
		$str_query = "select * from tblusers where business_name=?";
		$result = $this->db->query($str_query,array($business_name));		
		if($result->num_rows() == 1)
		{			
			return $result->row(0)->user_id;
		}							
	}	
	public function getRootNode($retailer_id)
	{
		$str_query = "select * from tblusers where parent_id=?";
		$result = $this->db->query($str_query,array($retailer_id));		
		if($result->num_rows() == 1)
		{			
			return $result->row(0)->user_id;
		}
		else
		{
			return true;
		}					
	}
	
	public function getOrderNo($retailer_id)
	{
		$str_query = "SELECT (max(order_no) + 1) as orderno FROM `tblusers` WHERE client_id=?";
		$result = $this->db->query($str_query,array($retailer_id));		
		if($result->num_rows() == 1)
		{			
			return $result->row(0)->orderno;
		}
		else
		{
			return true;
		}					
	}
	public function getClientID($id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($id));							
		return $result->row(0)->client_id;
	}
	public function CheckParentID_ExactTwo($id)
	{
		$str_query = "select * from tblusers where parent_id=?";
		$result = $this->db->query($str_query,array($id));							
		if($result->num_rows() == 2)
		{
			
			return true;	
		}
		else
		{
			return false;
		}		
	}
	
	
}
?>