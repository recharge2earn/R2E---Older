<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test2 extends CI_Controller {
	
	public function index()
	{
		
		if($this->input->post("txtinput"))
		{
			$str =  $this->input->post("txtinput");
			$str_array = explode("<span id=\"tariff\">",$str);
			$mainstr = $str_array[1];
			$mainStrArray = explode("<tr>",$mainstr); // consist of row data
		
			echo "<table border=1><tr><td>Topup</td><td>TalkTime</td><td>Validity</td><td>Description</td></tr>";
			
			for($i=3;$i<count($mainStrArray);$i++)
			{
				try
				{
				$str1 = $mainStrArray[$i]; // important data start row
				$arrayone = explode("class=\"trf\">",$str1);
				if(count($arrayone) >= 4)
				{
				$toptup = str_replace("</td> <td width=\"10\"", "",$arrayone[1]);
				$tocktime = str_replace("</td> <td", "",$arrayone[2]);
				$validity = str_replace("</td><td", "",$arrayone[3]);
				$discription = str_replace("</td> </tr>", "",$arrayone[4]);
				echo "<tr><td>".$toptup."</td>";
				echo "<td>".$tocktime."</td>";
				echo "<td> ".$validity."</td>";
				echo "<td>".$discription."</td></tr>";
				}
				}
				catch(Exception $e){}

			}
			echo "</table>";
			
			//print htmlentities($arrayone[1]);
			
			
			
			
			
			
			/*
			toptup
			$newstr = str_replace("</td> <td width=\"10\"", "",$arrayone[1]);
			print htmlentities($newstr);
			*/
			
			/*
			tocktime
				$newstr = str_replace("</td> <td", "",$arrayone[2]);
			print htmlentities($newstr);
			*/
			
			/*
					validity
					$newstr = str_replace("</td><td", "",$arrayone[3]);
					print htmlentities($newstr);
			*/
			/*/////////discription
			$newstr = str_replace("</td> </tr>", "",$arrayone[4]);
			print htmlentities($newstr);
			////////////////*/
		}
		else
		{
			$this->load->view("test_view");
		}

	}
}
