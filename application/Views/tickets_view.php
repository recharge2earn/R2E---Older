<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>rechargeportal</title>
        <style type="text/css">
            <!--
            body {
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
            }
            .style1 {	font-family: tahoma;
                      font-size: 12px;
            }
            .style3 {font-family: tahoma; font-size: 12px; font-weight: bold; }
            -->
        </style></head>

    <body>
        <script type="text/javascript">
    function Hideprint(){
        document.getElementById('printonwards').style.display='none';
        window.print();
    }
</script>
<?php
$this->load->model("Air_insert");
$this->load->model("Booking_model");
	$rslt = $this->db->query("select * from book_tbltbofarearray where Id = ?",array($airbook_rslt->row(0)->Fare_id_one));
	$flight_segment = $this->db->query("select * from book_tbltboflightsegments where Fare_Id = ?",array($rslt->row(0)->Id));
	$logoPath = $this->Air_insert->getLogoPath($flight_segment->row(0)->Segment_AirlineCode);
	$psngr_detail = $this->db->query("select * from air_passangerdetail where tblbookingFlighs_id = ?",array($airbook_rslt->row(0)->Id));
	$baseFare = $rslt->row(0)->BaseFare;
	
	$agentMarkup =$this->Booking_model->getAgentMarkup($flight_segment->row(0)->Segment_AirlineCode);
	$taxes = ($rslt->row(0)->Tax + $rslt->row(0)->ServiceTax + $rslt->row(0)->AdditionalTxnFee + $rslt->row(0)->OtherCharges + $rslt->row(0)->AirTransFee +  $rslt->row(0)->AgentCommission + $agentMarkup);
 ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="850">
    <tbody><tr>
        <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                    <td><div align="center"><span class="style3">E-Ticketing Electronic Reservation Slip</span></div></td>
                </tr>

            </tbody></table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                    <td width="63%">
                       
                        <img src="<?php echo base_url()."images/"?>" alt="flightlogo">
                        
                                            </td>
                    <td width="37%"><p class="style1"><strong>&nbsp;&nbsp;Agent Details:<br>
                            </strong> <br>
                            <strong>&nbsp;&nbsp;&nbsp;<?php echo $agent_detail->row(0)->business_name; ?> </strong><br>
                            &nbsp;&nbsp;&nbsp;<?php echo $agent_detail->row(0)->postal_address; ?><br>
                            &nbsp;&nbsp;&nbsp;<?php echo $agent_detail->row(0)->city_name; ?>, <?php echo $agent_detail->row(0)->state_name; ?><br>
                            &nbsp;&nbsp;&nbsp;Tel: <?php echo $agent_detail->row(0)->mobile_no; ?><br>
                            &nbsp;&nbsp;&nbsp;<?php echo $agent_detail->row(0)->emailid; ?></p></td>
                </tr>
            </tbody></table>
                            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tbody><tr>
                        <td colspan="3" align="center"><strong>Ticket Detail</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Reference Number :</strong><?php echo "F".$airbook_rslt->row(0)->Id; ?></td>
                        <td><strong>&nbsp;&nbsp;Booking Date :</strong> <?php echo $airbook_rslt->row(0)->add_date; ?></td>
                        <td><strong>&nbsp;&nbsp;Airline PNR :</strong><span style="color: green; font-weight: bold"><?php echo $airbook_rslt->row(0)->pnr_no; ?></span></td>
                    </tr>
                </tbody></table>
                        <br><br>
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tbody><tr>
                    <td colspan="5" align="center"><strong>Itinerary Information</strong></td>
                </tr>
                <tr>
                    <th align="center">Airline</th>
                    <th align="center">Departs</th>
                    <th align="center">Departs Time</th>
                    <th align="center">Arrives</th>
                    <th align="center">Arrives Time</th>
                </tr>
                                    <tr>
                        <td>
                            <img src="<?php echo base_url()."images/air_logo/".$logoPath;?>" style="width:60px;" align="absmiddle">
                            &nbsp;&nbsp;<span class="style1"><?php echo $flight_segment->row(0)->Segment_AirlineName; ?>-<?php echo $flight_segment->row(0)->Segment_FlightNumber; ?>-<?php echo $flight_segment->row(0)->Segment_FareClass; ?></span> </td>
                                                <td><span class="style1"><?php echo $flight_segment->row(0)->Segment_Origin_CityName; ?> ( <?php echo $flight_segment->row(0)->Segment_Origin_CityCode; ?> ) </span> </td>
                        <td><span class="style1"><?php echo $flight_segment->row(0)->Segment_DepTIme; ?></span></td>

                        <td><span class="style1"><?php echo $flight_segment->row(0)->Segment_Destination_CityName; ?> ( <?php echo $flight_segment->row(0)->Segment_Destination_CityCode; ?> )  </span> </td>
                        <td><span class="style1"><?php echo $flight_segment->row(0)->Segment_ArrTime; ?></span></td>
                    </tr>
                                </tbody></table>
            <br><br>
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tbody><tr>
                    <th colspan="6" align="center">Passenger Details</th>
                </tr>
                <tr>
                    <th align="center">No</th>
                    <th align="center">Name</th>
                    <th align="center">Type</th>
                    <th align="center">Ticket Id</th>
                    <th align="center">Ticket No</th>
                    <th align="center">Status</th>
                </tr>
                <?php
					foreach($psngr_detail->result() as $rw)
					{
				 ?>
                         <tr>
                        <td align="center"><span class="style1">1</span></td>
                        <td><span class="style1">
                               <?php echo $rw->prefix." ".$rw->Fname." ".$rw->lastName; ?> </span>
                        </td>
                        <td align="center"><span class="style1">Adult</span></td>
                        <td align="center"><span class="style1"><?php echo $rw->pnrNo;?></span></td>
                        <td align="center"><span class="style1"><?php echo $rw->eticketNo;?></span></td>
                        <td align="center"><span class="style1"><span style="color: green; font-weight: bold"> Confirmed </span></span></td>

                    </tr>
                  <?php } ?>

                                        

                                </tbody></table>
            <br><br>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">

                <tbody><tr>
                    <td>
                        <table width="100%">
                            <tbody><tr>
                                <td class="style1" width="40%">
                                    <table with="100%">
                                        <tbody><tr>
                                            <td colspan="2"><strong>Fare details</strong></td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">=============================</td>
                                        </tr>

                                        <tr>
                                            <td width="20%">Actual BaseFare:</td>
                                            <td width="30%">INR <?php echo $baseFare; ?> </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Fees &amp; Taxes:</td>
                                            <td width="30%">INR <?php echo $taxes; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">=============================</td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Total Fare:</td>
                                            <td width="30%"><strong>INR <?php echo $baseFare + $taxes; ?> </strong></td>
                                        </tr>



                                    </tbody></table>
                                </td>


                                <td class="style1" valign="top" width="60%">
                                    <table with="100%">
                                        <tbody><tr>
                                            <td colspan="2"><strong>Passenger Information</strong></td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">===========================================</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Email : gandhivipul79@yahoo.com</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Contact No : 9825697962                                        </td></tr>

                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table border="1" cellpadding="5" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td style="padding: 20px 20px 20px 20px;">
                                    <p class="style3"> Important</p>
                                    <pre style="font-family: tahoma;font-size: 12px;white-space: pre-line; text-align:justify; line-height:20px;">1. All Guests, including children and infants, must present valid identification at check-in. It is your responsibility to ensure you have the appropriate travel documents at all times.
2. Rescheduling - Rs. 1000 per pax per segment plus difference of fare.
3. Check-in starts \"2 hours\" before scheduled departure, and closes 45 minutes prior to the scheduled departure time. Guests are requested to report at least 2 hours prior to departure time, at Go Air Check-in counters.
4. Cancellation / Changes within \"2 hours\" of departure or failure to check-in for a Go Air flight at least 45 minutes prior to the scheduled departure time will result in the fare being forfeited. We require the request atleast 4 hours prior to departure, After that ticket will be count as a No show.
5. Cancellation- Rs. 1000 per pax per segment plus difference of fare.
6. Schedule is subject to change and regulatory authority approvals.
</pre>                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><table border="1" cellpadding="5" cellspacing="0" width="100%"><tbody><tr><td><div align="center">Thank you for booking with Jainam . This is your E-ticket.
                                        Jainam  wishes you a pleasant journey and hopes to serve you again in the future.
                                    </div></td></tr></tbody></table></td>
                </tr>
            </tbody></table>
                            <div id="printonwards">
                    <table>
                        <tbody><tr>
                            <td>
                                <input value="Print" onclick="javascript: Hideprint();" type="button">
                            </td>
                        </tr>
                    </tbody></table>
                </div>                                            
                    </td>
    </tr>
</tbody></table>    

</body></html>