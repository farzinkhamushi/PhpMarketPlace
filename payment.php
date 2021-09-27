<?php
	include('includes/db.php');
	
	//creating or using cookie for ip customer
	if(isset($_COOKIE["ipUserEcommerce"]))
	{
		$ip	= $_COOKIE["ipUserEcommerce"];
		}else{
		$ip=getIp();
		setcookie('ipUserEcommerce',$ip,time()+1206900);
	}
	
	//Gaining the amount to be paid by the customer
	$sel_ip	=	"select * from total where ip='$ip'";
	$run_ip	=	mysqli_query($con,$sel_ip);
	while($p_ip = mysqli_fetch_array($run_ip))
	{
		$order_total_price = $p_ip['price_total_purchase'];
	}
	
	//Gaining customer email
	/*
	$sel_email	=	"select * from customers where customer_ip='$ip'";
	$run_email	=	mysqli_query($con,$sel_email);
	while($p_email = mysqli_fetch_array($run_email))
	{
		$order_email = $p_email['customer_email'];
	}
	*///////////against this we do bellow
	//Gaining customer email
	$order_email = $_SESSION['customer_email'];




	//Submit the record in the order table
	$query = "INSERT INTO `order_e`(`order_total_price`, `order_is_verified`, `order_email_customer`) VALUES ($order_total_price,'false','$order_email')";
	$run_order = mysqli_query($con, $query);
	
	//Last id based on customer email
	$query_sql="SELECT `order_id` FROM `order_e` WHERE `order_email_customer`='$order_email'";
	$run_myqurey = mysqli_query($con, $query_sql);
	$array_order_id=array();
	while($myqurey_array=mysqli_fetch_array($run_myqurey))
	{
		array_push($array_order_id,$myqurey_array['order_id']);
	}
	;
	$Last_id_based_customer_email=end($array_order_id);
	
	//Gaining last id
	$_SESSION["order_id"]=$Last_id_based_customer_email;
	
	// Set session variables
	$_SESSION["order_total_price"] = $order_total_price;	
	
	if($run_order){
		echo "<script>window.open('request.php','_self')</script>";
	} 
	
?>