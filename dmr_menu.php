<?php
$text = $_SERVER["REQUEST_URI"];
$string = str_replace('/', '', $text );
$class = ' class="active"';
?>
<div class="container">
       <div class="features-tab--nav">
                <ul>
                    <li<?php if($string == 'money_transfer'){echo $class;}?>><a href="money_transfer" class="btn btn-lg btn-custom">Money Transfer</a></li>
                    <li<?php if($string == 'sender_registration'){echo $class;}?>><a href="sender_registration" class="btn btn-lg btn-custom">Sender Registration</a></li>
                    <li<?php if($string == 'add_beneficiary'){echo $class;}?>><a href="add_beneficiary" class="btn btn-lg btn-custom">Add Beneficiary</a></li>
                    <li<?php if($string == 'verify_beneficiary'){echo $class;}?>><a href="verify_beneficiary" class="btn btn-lg btn-custom">Verify Beneficiary</a></li>
                    <li<?php if($string == 'search_beneficiary'){echo $class;}?>><a href="search_beneficiary" class="btn btn-lg btn-custom">Search Beneficiary</a></li>
                    
                    
                </ul>
            </div>
           </div>