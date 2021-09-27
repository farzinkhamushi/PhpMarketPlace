<?php include('includes/db.php'); ?>

<div>
	
	<form method="post" action="" >
		
		<table width="100%" align="center" bgcolor="#EBBCE5">
			
			<tr align="center" >
				<th colspan="3">
					<h2>کاربر گرامی لطفا لاگین کنید و سپس خرید<br/><br/> های خود را ثبت نهایی کنید!</h2>
				</th>
			</tr>
			
			
			<tr>
				<td colspan="2" align="left">
					<b style="color:#440522;">ایمیل:</b>
				</td>
				
				<td>
					<input type="text" name="email" placeholder="لطفا ایمیل خودتان را وارد کنید...." size="50" >
				</td>
			</tr>
			
			
			<tr>
				<td colspan="2" align="left">
					<b style="color:#440522;">پسورد:</b>
				</td>
				
				<td>
					<input type="password" name="pass" placeholder="لطفا پسورد خودتان را وارد کنید...." size="50" >
				</td>
			</tr>
			
			<tr>
				<td colspan="3" align="center">
					<input name="send_U_P" type="submit" value="وارد می شوم!" />
				</td>
			</tr>
		</table>
		
	</form>
	<?php	
		
		if(isset($_POST['send_U_P']))
		
		{
			// receive email value from the form 
			$c_email_no_empty = mysqli_real_escape_string($con ,$_POST['email']);
			// receive password value from the form
			$c_password_1_validate=mysqli_real_escape_string($con ,$_POST['pass']);
			
			if (empty($c_email_no_empty)) 
			{
				if (empty($c_password_1_validate)) 
				{
					echo "<script>alert('ایمیل و پسورد خود را وارد نکرده اید!!! آنها را وارد کنید!!!.')</script>";
					}else{
					echo "<script>alert('ایمیل خود را وارد نکرده ایید !!! آن را وارد نمایید.')</script>";
				}	
				}else{
				if (empty($c_password_1_validate)){
					echo "<script>alert('پسورد خود را وارد نکرده ایید آن را وارد نمایید!!!')</script>";
					}else{
					$c_email_validate=$c_email_no_empty;
					if(filter_var($c_email_validate,FILTER_VALIDATE_EMAIL) == true){
						if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[$@])\S{6,12}$/", $c_password_1_validate))
						{
							// email is valid
							$c_email=$c_email_validate;
							// password is valid
							$c_pass = $c_password_1_validate;
							
							}else{
							echo "<script>alert('پسورد شما طبق الگو نمی باشد!!! پسورد صحیحی وارد نمایید.')</script>";
						}
						}else{
						echo "<script>alert('ایمیل شما صحیح نیست !!! یک ایمیل صحیح وارد کنید!')</script>";
						
					}
				}
			}	
			
			
			if(	(isset($c_pass))	 and	 (isset($c_email))	)
			{
				
				$sel_c = "select * from customers where `customer_pass`='$c_pass' AND `customer_email`='$c_email' ";
				
				$run_c = mysqli_query($con,"SET NAMES utf8");
				$run_c = mysqli_query($con,"SET CHARACTER SET utf8");
				$run_c = mysqli_query($con,$sel_c);
				
				$check_customer = mysqli_num_rows($run_c);
				
				if($check_customer==0)
				{
					echo "<script>alert('نام کاربری و یا رمز عبور خود را اشتباه وارد کرده اید ، لطفا دوباره امتحان کنید!')</script>";
					}else{
					
					$sel_login = "select * from customers where `customer_email`='$c_email' ";
					$run_login = mysqli_query($con,"SET NAMES utf8");
					$run_login = mysqli_query($con,"SET CHARACTER SET utf8");
					$run_login = mysqli_query($con,$sel_login);
					
					while($run_customer_login=@mysqli_fetch_array($run_login))
					{
						$customer_login_name =	$run_customer_login['customer_name'];
						
						$customer_login_lastname =	$run_customer_login['customer_lastname'];
						
						$customer_confirmed	=	$run_customer_login['confirmed'];
						
					}
					if($customer_confirmed==1){	
						//creating or using cookie 
						if(isset($_COOKIE["ipUserEcommerce"]))
						{
							$ip	= $_COOKIE["ipUserEcommerce"];
							}else{
							$ip=getIp();
							setcookie('ipUserEcommerce',$ip,time()+1206900);
						}
						
						$sel_cart = "select * from cart  where	ip_add='$ip'";
						$run_cart = mysqli_query($con,$sel_cart);
						$check_cart = mysqli_num_rows($run_cart);
						
						##### Getting the name and lastname and place them in the Session variable ####
						$_SESSION['customer_name'] = $customer_login_name;
						$_SESSION['customer_lastname'] = $customer_login_lastname;
						
						##### Getting the email customer in the Session variable ####						
						$_SESSION['customer_email'] = $c_email;
						if($check_cart==0){
							echo "<script>alert('$customer_login_name  $customer_login_lastname خوش آمدید، لاگین شما با موفقیت انجام شد. اکنون به صفحه پروفایل خود خواهید رفت!!!')</script>";
							echo "<script>window.open('customer/my_account.php','_self')</script>";
						}else{
							echo "<script>alert('$customer_login_name  $customer_login_lastname خوش آمدید، لاگین شما با موفقیت انجام شد. اکنون برای پرداخت صورت حساب خود به درگاه زرین پال متصل خواهید شد!!!')</script>";
							echo "<script>window.open('checkout.php','_self')</script>";
						}
					}else
					{
						echo "<script>alert('$customer_login_name  $customer_login_lastname  چرا ایمیل خودت را تایید نکرده ایی؟ به ایمیل خودت مراجعه کن و لینک ثبت نام را تایید کن!!!')</script>";
					}						
					
				}	
				
				
			}
		}
		
	?>	
	
	<a class="new_account" href="customer_register.php">جدیدی؟ خب از اینجا ثبت نام کن.</a>
	
	<a class="forget_button" href="checkout.php?forgot_pass">پسورد خود را فراموش کرده اید؟</a>
	
</div>