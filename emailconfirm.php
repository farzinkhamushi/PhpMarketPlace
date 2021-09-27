<!-- start of Header -->
<?php	
	
	include('includes/Header.php');
	
	
?>
<!-- end of Header -->


<!-- start of content -->   
<div id="templatemo_content">
	
	<!-- start of left ocntent -->
	<div id="templatemo_content_left">
		<div class="cleaner_with_height">&nbsp;</div>
		<?php
			
			if(isset($_GET["customer_ip"])){
				
				$con=mysqli_connect("localhost","root","","ecommerce");
				
				if(mysqli_connect_errno())
				{
					echo "ارتباط با پایگاه داده برقرار نیست . شماره خطا :".mysqli_connect_errno();
				}
				
				$ip=$_GET["customer_ip"];
				
				$code=$_GET["code"]; 
				
				$query="SELECT * FROM customers WHERE customer_ip LIKE '%{$ip}%'";
				
				$result=mysqli_query($con,$query);
				
				while ($row = mysqli_fetch_array($result))
				{
					$confirm_code=$row['confirm_code'];
					$c_name = $row['customer_name'];
					$c_lastname = $row['customer_lastname'];
					$c_email = $row['customer_email'];
					
				}
				
				if( $confirm_code == $code){
					
					mysqli_query($con,"update customers set confirmed='1' ");
					
					mysqli_query($con,"update customers set confirm_code='0' ");
					
					echo "<script>alert(' ایمیل آدرس شما تایید و ثبت نام شما تکمیل شد. ')</script>";
					
					$sel_cart = "select * from cart where ip_add='$ip'";
					$run_cart = mysqli_query($con,$sel_cart);
					$check_cart = mysqli_num_rows($run_cart);
										
					if($check_cart == 0){
						
						$_SESSION['customer_name'] = $c_name;
						$_SESSION['customer_lastname'] = $c_lastname;
						$_SESSION['customer_email'] = $c_email;
						echo "<script>window.open('customer/my_account.php','_self')</script>";
						
						}else{
						
						$_SESSION['customer_name'] = $c_name;
						$_SESSION['customer_lastname'] = $c_lastname;
						$_SESSION['customer_email'] = $c_email;
						echo "<script>window.open('checkout.php','_self')</script>";
					}
					
					}else{
					
					echo "<script>alert('ایمیل با کد تایید مطابقت ندارد.')</script>";
					echo "<script>window.open('customer_register.php','_self')</script>";
					
				}	
				
				
				}else{
				echo "<p style='background: red; padding: 27px;	font-size: 20px; border-radius: 15px;border: 5px dashed white;'>  باید به ایمیلتان مراجعه کرده و لینک فرستاده شده را تایید نمایید!!!</p>";
				}
			
			
		?>				
		
		<div class="cleaner_with_height">&nbsp;</div>
	</div>
	<!-- end of left content  -->
	
	
	<div class="cleaner">&nbsp;</div>
</div>
<!-- end of content -->

<!-- start of footer -->
<?php include('includes/Footer.php');	?>
			<!-- end of footer -->