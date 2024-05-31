<?php
class Treestr_model extends CI_Model 
{	
private $string='';
private $str_chd='';
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getChild($str)
	{
		
		//echo $str;exit;
		$str_query = "select user_id, business_name, username from tblusers where parent_id=?";
		$result_md = $this->db->query($str_query,array($str));
		$numrows = $result_md->num_rows();
		$this->string.="<ul>";
		foreach ($result_md->result() as $row)
	    {
			$id = $row->user_id;
			$Name=$row->business_name;
			$uname=$row->username;
			$str_query = "select tblusers.*,(select b.business_name from tblusers b where b.user_id = tblusers.parent_id) as parent_name,(select c.username from tblusers c where c.user_id = tblusers.parent_id) as parent_id from tblusers where user_id=?";
				$rslt  =$this->db->query($str_query,array($id));
				$data = "Name : ".$rslt->row(0)->business_name."<br>UserType : ".$rslt->row(0)->usertype_name."<br>OnePay ID : ".$rslt->row(0)->username."<br>Mobile_No :".$rslt->row(0)->mobile_no."<br>Sponcer Name : ".$rslt->row(0)->parent_name."<br>Sponcer ID : ".$rslt->row(0)->parent_id;
			
			
			$this->string.="<li id=".$id."><br><br><br><a href='#' title='' class='tooltip' style='cursor:pointer'> ".$id."<span>".$data."</span></a>";
			$this->string.=$this->checkChild($id);
			$this->str_chd = '';
			$this->string.="</li>";
	    }
		$this->string.="</ul>";
		//echo ($this->string);
		return $this->string;
		//echo htmlentities($this->string);
	}
	public function checkChild($id)
	{
		
		$str_query = "select user_id, business_name, username from tblusers where parent_id=?";
		$result_md = $this->db->query($str_query,array($id));
		
		$numrows = $result_md->num_rows();
		if($numrows>0)
		{
			$this->str_chd.="<ul>";
			foreach ($result_md->result() as $row)
	    	{
				$id = $row->user_id;
				$Name=$row->business_name;
				$uname=$row->username;
				$str_query = "select tblusers.*,(select b.business_name from tblusers b where b.user_id = tblusers.parent_id) as parent_name,(select c.username from tblusers c where c.user_id = tblusers.parent_id) as parent_id from tblusers where user_id=?";
				$rslt  =$this->db->query($str_query,array($id));
				$data = "Name : ".$rslt->row(0)->business_name."<br>UserType : ".$rslt->row(0)->usertype_name."<br>OnePay ID : ".$rslt->row(0)->username."<br>Mobile_No :".$rslt->row(0)->mobile_no."<br>Sponcer Name : ".$rslt->row(0)->parent_name."<br>Sponcer ID : ".$rslt->row(0)->parent_id;
				
				$this->str_chd.="<li id=".$id."><br><br><br><a href='#' title='' class='tooltip' style='cursor:pointer'> ".$id."<span>".$data."</span></a>";
				$this->checkChild($id);
				$this->str_chd.="</li>";
				
	    	}
			$this->str_chd.="</ul>";
			//echo htmlentities($this->str_chd);
		 		return $this->str_chd;	
		}
		else
		{
			echo "</li>";
		}
		//echo "child of ".$id."  =". $numrows."<br>";

		
	}
}