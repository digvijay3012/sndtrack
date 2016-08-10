<?php
require 'lib/Stripe.php';
 echo "<pre>";
 print_r($_POST);
 echo "</pre>";
 die;	
if ($_POST) {	
  Stripe::setApiKey("sk_test_dlRBa2orDqy8K2UypiDxgDtX");
  $error = '';
  $success = '';

  try {
	if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
      throw new Exception("Fill out all required fields.");
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => 6000,
                                "currency" => "eur",
                                "card" => $_POST['stripeToken'],
								"description" => $_POST['email']));
    $success = '<div class="alert alert-success">
                <strong>Success!</strong> Your payment was successful.
				</div>';
  }
  catch (Exception $e) {
	$error = '<div class="alert alert-danger">
			  <strong>Error!</strong> '.$e->getMessage().'
			  </div>';
  }
}
?>