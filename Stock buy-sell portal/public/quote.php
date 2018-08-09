<?php

	//configuration
	require("../includes/config.php");
	
	//if form was submitted
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
	
	//lookup stock info
	$_POST = lokup($_POST["symbol"]);
	if($POST === false)
	{
		apologize("Invalid stock symbol");
	}
		
	//else render quote_price
	
	render("quote_price.php",["title" => "Quote"]);

	}
	else
	{
		render("quote_form.php",["title" => "Quote"]);
	}


?>
