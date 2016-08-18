<?php
require 'lib/Stripe.php';
/* 
 echo "<pre>";
 print_r($_POST);
 echo "</pre>";
 	 */
if ($_POST) {
	
  Stripe::setApiKey("sk_test_Bs3DpFMgLHm0KHGAQzqYyFEC");
  $error = '';
  $success = '';

  try {
	  
	if (empty($_POST['full_name']) || empty($_POST['city']) || empty($_POST['zip']))
      throw new Exception("Fill out all required fields.");
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => 6000,
                                "currency" => "eur",
                                "card" => $_POST['stripeToken'],
								"description" => $_POST['full_name']));
							 $return = $_POST;
  
							  //Do what you need to do with the info. The following are some examples.
							  //if ($return["favorite_beverage"] == ""){
							  //  $return["favorite_beverage"] = "Coke";
							  //}
							  //$return["favorite_restaurant"] = "McDonald's";
							  
							  $return["json"] = json_encode($return);
							  echo json_encode($return);
				
  }
  catch (Exception $e) {
	  $e->getMessage();	
	echo '2'; 
  }
  die;
}
?>