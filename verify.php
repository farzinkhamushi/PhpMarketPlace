<!-- start of Header -->
<?php	include('includes/Header.php');	?>
<!-- end of Header -->

<!-- start of content -->   
<div id="templatemo_content">

<?php
	
// We connect to the database	
include("includes/db.php");
	
    $order_id=	$_GET['order_id_for_verify'];
	if ($_GET['Status'] == 'OK') {
		$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
		$Amount = $_GET['Amount']; //Amount will be based on Toman
		$Authority = $_GET['Authority'];
		
		$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
		
		$result = $client->PaymentVerification(
		[
		'MerchantID' => $MerchantID,
		'Authority' => $Authority,
		'Amount' => $Amount,
		]
		);
		
		if ($result->Status == 100) {
			
				echo "<p style='background:green; padding: 27px;	font-size: 20px; border-radius: 15px;border: 5px dashed white;'>از خرید شما متشکریم کد RefID برای پیگیری های بعدی شما :".$result->RefID."می باشد.</p>";
				$RefID=$result->RefID;
				mysqli_query($con,"UPDATE `order_e` SET `order_is_verified`='true', `refid`=$RefID WHERE `order_id`=$order_id ");


				//creating or using cookie for ip customer
				if(isset($_COOKIE["ipUserEcommerce"]))
				{
				$ip	= $_COOKIE["ipUserEcommerce"];
				}else{
				$ip=getIp();
				setcookie('ipUserEcommerce',$ip,time()+1206900);
				}			

				//Copy the data from the cart data table to the pay _cart data table
				mysqli_query($con,"INSERT INTO pay_cart (p_id, ip_add, qty)
				SELECT p_id, ip_add, qty FROM cart
				WHERE ip_add='$ip'");

				//Insert the value in the order_id
				$run_time=mysqli_query($con,"select * from `pay_cart` where ip_add='$ip' order by id_cart desc limit 1");
				while ($run_time = @mysqli_fetch_array($run_time))
				{
				$time=$run_time["order_time"];
				}
				//Updating the order_id filde in the pay_cart table, of course, based on the payout time of the sales order
				mysqli_query($con,"UPDATE `pay_cart` SET `order_id`=$order_id WHERE `order_time`='$time'");					

				//destroying the session 
				unset($_SESSION["order_total_price"]);
				unset($_SESSION["order_id"]);

				//destroying sessions that hold the qty.
				$str_ip= str_replace(".", "", "$ip");
				$query_delete_session="SELECT * FROM `pay_cart` WHERE `order_id`=$order_id";
				$run_delete_session=mysqli_query($con,$query_delete_session);
				while ($row = mysqli_fetch_array($run_delete_session))
				{
				$product_id=$row["p_id"];
				unset($_SESSION["$str_ip"]["$product_id"]);
				}


				//Delete customer data from the cart data table
				mysqli_query($con,"DELETE FROM cart WHERE ip_add='$ip'");



			} else {
			
			echo "<p style='background:red; padding: 27px;	font-size: 20px; border-radius: 15px;border: 5px dashed white;'> تراکنش انجام نشد : 
		  :".$result->Status."</p>";
			
		}
		} else {
		echo "<p style='background:red; padding: 27px;	font-size: 20px; border-radius: 15px;border: 5px dashed white;'> تراکنش توسط کاربر انجام نشد </p>";
	}			
?>	
</div>
<!-- end of content -->

<!-- start of footer -->
<?php include('includes/Footer.php');	?>
<!-- end of footer -->