<?php
$us_id = $this->session->userdata("id");
$rslt = $this->db->query("select * from tblusers where user_id = '$us_id'");
$state_id = $rslt->row(0)->state_id;
$rslt1 = $this->db->query("select * from tblstate where state_id = '$state_id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Developer API</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="">
    <meta name="author" content="">

 <?php include("app_css.php"); ?>
    

</head>

<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
    

      <?php
    if($this->session->flashdata('message')){
    echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";} 
    if($message != ''){
    echo "<div class='alert alert-danger fade in'>".$message."</div>";}
    ?>
  
    
<!-- FAQ Area Start -->
<div id="faq">
    <div class="container">
        <!-- FAQ Categories Start -->
        <div class="col-md-3 faq-categories">
            <h3>
                API DOCUMENT</h3>
            <ul class="nav" role="tablist">
                <li class="active" role="presentation">
                    <a aria-controls="sharedTab" data-toggle="tab" href="#recharge" role="tab">Recharge API</a></li>
                <li role="presentation">
                    <a aria-controls="vpsTab" data-toggle="tab" href="#dmr" role="tab">Money Transfer API</a></li>
                   
            </ul>
        </div>
        <!-- FAQ Categories End --><!-- FAQ Content Start -->
        <div class="col-md-9 faq-content">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="recharge" role="tabpanel">
                    <div class="panel-group accordion" id="accordion1" role="tablist">
                        <!-- Accordion Item Start -->
                        <div class="panel panel-default active">
                            <div class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a data-parent="#accordion1" data-toggle="collapse" href="#sharedTabQ1" role="button">Mobile Recharge API Document</a></h4>
                            </div>
                            <div class="panel-collapse collapse in" id="sharedTabQ1" role="tabpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <h1>
                                            API For Mobile,DTH,Postpaid,Utility Recharge</h1>
                                        <div class="alert alert-info">
                                            <strong>Recharge API</strong> .</div>
                                        <p>
                                            Send a GET/POST request to</p>
                                        <p>
                                            https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/api?username=[Value]&amp;pwd=[Value]&amp;circlecode=[Value]&amp;operatorcode=[Value]&amp;number=[Value]&amp;amount=[Value]&amp;orderid=[Value]&amp;format=[Value]<br />
                                            &nbsp;</p>
                                        <p>
                                            <em>eg.</em><span style="color:#222222; font-family:Arial,Verdana,sans-serif; font-size:12px">https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/api?username=500011&amp;pwd=123&amp;circlecode=2&amp;operatorcode=A&amp;number=980000000&amp;amount=10&amp;orderid=485668&amp;format=json</span></p>
                                        <p>
                                            &nbsp;</p>
                                        <p>
                                            <span style="color:#222222">Whenever you submit or enquire any request through our API&#39;s the system immediately gives you the response in any one of the following three different formats:</span></p>
                                        <div>
                                            Comma separated format(<strong>csv</strong>) &ndash; Default Response</div>
                                        <div>
                                            <strong>json </strong>Format</div>
                                        <div>
                                            <strong>xml </strong>Format</div>
                                        <p>
                                            <strong>Sample CSV Response</strong></p>
                                        <p>
                                            1225,Success,WB22565584,980000000,10,485668</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        Position</th>
                                                    <th scope="col">
                                                        Parameter</th>
                                                    <th scope="col">
                                                        Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        0</td>
                                                    <td>
                                                        txid</td>
                                                    <td>
                                                        Transaction id of every recharge request&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1</td>
                                                    <td>
                                                        status</td>
                                                    <td>
                                                        It is status&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2</td>
                                                    <td>
                                                        opid</td>
                                                    <td>
                                                        It is Operator id from operaor end</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3</td>
                                                    <td>
                                                        number</td>
                                                    <td>
                                                        It is recharge number&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        4</td>
                                                    <td>
                                                        amount</td>
                                                    <td>
                                                        It is amount</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        5</td>
                                                    <td>
                                                        orderid</td>
                                                    <td>
                                                        It is your unique order id ,&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            <strong>JSON Format</strong></div>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            To get the response in JSON format, you need to pass the parameter &#39;format=json&#39;</div>
                                        <div>
                                            Sample JSON Response</div>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            {&quot;txid&quot;:&quot;5804&quot;,&quot;status&quot;:&quot;Success&quot;,&quot;opid&quot;:&quot;RJ0317161622000269New&quot;,&quot;number&quot;:&quot;980000000&quot;,&quot;amount&quot;:&quot;10&quot;,&quot;orderid&quot;:&quot;485668&quot;}</div>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            <strong>XML Format</strong></div>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            Pass &#39;format=xml&#39; in your API call to see the XML format response.</div>
                                        <div>
                                            Sample XML Response</div>
                                        <div>
                                            &nbsp;</div>
                                        <div>
                                            
                                            <Recharge>
<txid>5804</txid>
<status>Success</status>
<opid>RJ0317161622000269New</opid>
<number>9134350662</number>
<amount>10</amount>
<orderid>485668</orderid>
</Recharge>
                                        </div>
                                        <div class="alert alert-info">
                                            <strong>Balance API</strong></div>
                                        <p>
                                            Send a GET/POST request to</p>
                                        <p>
                                            https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/balance?username=[Value]&amp;pwd=[Value]&format=[Value]<br />
                                            &nbsp;</p>
                                        <p>
                                            <em>eg.</em><span style="color:#222222; font-family:Arial,Verdana,sans-serif; font-size:12px">https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/balance?username=500011&amp;pwd=123&format=[Value]</span></p>
                                        <p>
                                            &nbsp;</p>
                                        <div class="alert alert-info">
                                            <strong>Status API</strong></div>
                                        <p>
                                            Send a GET/POST request to</p>
                                        <p>
                                            https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/status?username=[Value]&amp;pwd=[Value]&amp;orderid=[Value]&amp;format=[Value]<br />
                                            &nbsp;</p>
                                        <p>
                                            <em>eg.</em><span style="color:#222222; font-family:Arial,Verdana,sans-serif; font-size:12px">http://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/status?username=500011&amp;pwd=123&amp;orderid=485668&amp;format=json</span></p>
                                        <p>
                                            &nbsp;</p>
                                        <div>
                                           
                                            <div class="alert alert-info">
                                                <strong>Call Back URL</strong>.</div>
                                            <p>
                                                With the help of callback URL you will get auto status update.</p>
                                            <p>
                                                This option allows you to automate the reversal of the dispute transactions</p>
                                            <p>
                                                Whenever a dispute transaction is reversed we will trigger the URL configured by you along with the Operator&nbsp;ID, Status and txid&nbsp;</p>
                                            <p>
                                                <span style="color:#222222">URL</span></p>
                                            <div>
                                                <div>
                                                    www.yourdomain.com/yourfile?txid=YOUR ORDER ID&amp;status=Success/Failure&amp;opid=OPERATOR ID</div>
                                                <div>
                                                    &nbsp;</div>
                                                <div>
                                                    Parameters&rsquo;</div>
                                                <div>
                                                    &nbsp;</div>
                                                <div>
                                                    txid=&nbsp; Unique recharge id provided by you&nbsp; on every recharge</div>
                                                <div>
                                                    status= Success / Failure</div>
                                                <div>
                                                    opid = Operator id</div>
                                            </div>
                                        </div>
                                        <p>
                                            &nbsp;</p>





<div class="alert alert-info">
                                                <strong>FOR LANDLINE AND UTILITY</strong>.</div>

                                            please pass extra parameter value1, and value2 in case following condtion
                                            <li>AIRTEL LANDLINE: Pass Landline Number in 'number' and STD Code in 'value1'</li>
                                            <li>BSNL LANDLINE: Pass Landline Number in 'number', STD Code in 'value1', Account Number in 'value2'</li>
                                            <li>MTNL DELHI LANDLINE : Pass Landline Number in 'number', and CA Number in 'value1'</li>
                                            <li>Mahanagar Gas: pass Customer Account Number in 'number' and Bill Group Number in 'value1'</li>
                                            <li>MSEDC - MAHARASHTRA: pass Consumer Number in 'number', Billing Unit in 'value1' and Processing Cycle in 'value2'</li>
                                            <li>Reliance Energy - MUMBAI: pass Account Number in 'number' and Cycle Number in 'value1''</li>
                                            <li>For insurance - pass Policy Number in 'number' and Date of Birth (DD-MM-YYYY) in 'value1''</li>
                                            

 <p>
                                            <em>eg.</em><span style="color:#222222; font-family:Arial,Verdana,sans-serif; font-size:12px">https://<?php echo $_SERVER['SERVER_NAME'];?>/recharge/api?username=500011&amp;pwd=123&amp;circlecode=2&amp;operatorcode=A&amp;number=980000000&amp;amount=10&amp;orderid=485668&amp;format=json&value1=123&value2=123</span></p>
                                        


                                        <div class="alert alert-info">
                                            <strong>Operator Code</strong></div>
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>Operator Name</th>
                                                <th>Operator code </th>
                                                <th>Service </th>                                           </tr>

                                                    <tr>
      <?php
    $result_company = $this->db->query("select company_name, provider, CASE tblcompany.service_id WHEN 1 THEN 'Mobile' WHEN 2 THEN 'DTH' WHEN 4 THEN 'PostPaid' WHEN 5 THEN 'Electricity' WHEN 6 THEN 'Gas' WHEN 7 THEN 'Insurance' WHEN 8 THEN 'Money Transfer' WHEN 9 THEN 'Data Card' END service_name FROM tblcompany  order by service_id"); 


  $i = 0;foreach($result_company->result() as $result)  {  
  
           $service_id = $result->service_id;


?>

<td><?php echo $result->company_name;?></td>

<td><?php echo $result->provider;?></td>
<td><?php echo $si = $result->service_name;?></td>

</tr>
<?php }?>
                                        </table>



                                        <div class="alert alert-info">
                                            <strong>Circle Code</strong></div>
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>State</th>
                                                <th>circle code </th>
                                                                                     </tr>

                                                    <tr>
      <?php
    $result_state = $this->db->query("select state_name, circle_code FROM tblstate order by state_id"); 


  $i = 0;foreach($result_state->result() as $result)  {  
  
           


?>

<td><?php echo $result->state_name;?></td>

<td><?php echo $result->circle_code;?></td>


</tr>
<?php }?>
                                        </table>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion Item End --><!-- Accordion Item Start --><!-- Accordion Item End --><!-- Accordion Item Start -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    &nbsp;</h4>
                            </div>
                            <div class="panel-collapse collapse" id="sharedTabQ5" role="tabpanel">
                                <div class="panel-body">
                                    <p>
                                        &nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion Item End --></div>
                </div>
                <div class="tab-pane fade" id="dmr" role="tabpanel">
                    <div class="panel-group accordion" id="accordion2" role="tablist">
                        <!-- Accordian Item Start -->
                        <div class="panel panel-default active">
                            <div class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a data-parent="#accordion2" data-toggle="collapse" href="#vpsTabQ1" role="button">MONEY TRANSFER API DETAILS</a></h4>
                            </div>
                            <div class="panel-collapse collapse in" id="vpsTabQ1" role="tabpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <p>
                                            &nbsp;</p>
                                        <h4>
                                            TRANSFER MONEY API</h4>
                                        <p>
                                            &nbsp;</p>
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/api?username=500011&amp;pwd=123&amp;sender_mobile=980000000&amp;mode=IMPS&amp;ben_id=225&amp;amount=10&amp;orderid=466558&amp;format=json </code><br />
                                        <p>
                                            sender_mobile = SENDER MOBILE NUMBER<br />
                                            mode = PAYMENT MODE<br />
                                            ben_id = BENEFICIARY ID (YOU WILL GET WHEN YOU ADD BENEFICIARY)<br />
                                            amount = TRANSFER AMOUNT<br />
                                            orderid = THIS IS YOUR UNIQUE ORDER ID<br />
                                            format = JSON FORMAT</p>
                                        <p>
                                            OUTPUT RESPONSE</p>
                                        <p>
                                            <code>{"txid":2183589,"status":"Success","opid":"90134433445","number":"324424242","ifsc_code":"SBIN0031744","orderid":"466558"}</code></p>
                                        <p>
                                            if status 200 -&gt; Fund successfully transferred , 201 -&gt; Fund transfer request accepted, Other than 201 please follow message</p>
                                        <p>
                                            &nbsp;</p>
                                        <h4>
                                            SENDER REGISTERATION</h4>
                                        <p>
                                            &nbsp;</p>
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/sender_registration?username=500011&amp;pwd=123&amp;name=etechdital&amp;pincode=734010&amp;sender_mobile=980000000 </code>
                                      
                                        <h4>ADD BENEFICIARY</h4>
                                        
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/add_beneficiary?username=500011&amp;pwd=123&amp;sender_mobile=980000000&amp;ben_name=RAHUL&amp;ben_mobile=980000000&amp;account_number=1000100&amp;ifsc_code=SBIN0007745 </code>
                                        
                                        <h4>VERIFY BENEFICIARY</h4>
                                       
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/verify_beneficiary?username=500011&amp;pwd=123&amp;sender_mobile=980000000&amp;otp=123&amp;ben_id=12365 </code>
                                       
                                        <h4> SEARCH BENEFICIARY</h4>
                                       
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/search_beneficiary?username=500011&amp;pwd=123&amp;sender_mobile=980000000 </code>
                                        
                                        <h4> BANK VERIFICATION</h4>
                                      
                                        <code>http://<?php echo $_SERVER['SERVER_NAME'];?>/money/verify_bank?username=500151&pwd=143&sender_mobile=3221423423423&account_number=323232324444&ifsc_code=SBIN0031744&orderid=466558&mode=VIMPS&format=json </code>
                                        
                                        
                                        
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordian Item End --><!-- Accordian Item Start --></div>
                </div>


<!-- SAND BOX START HERE-->












<!-- SAND BOX END HERE -->



















            </div>
            <!-- FAQ Content End --></div>
    </div>
</div>
<!-- FAQ Area End -->

<?php include("app_js.php"); ?>
    

    <?php include("footer.php"); ?>
   
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

   
</body>
</html>
