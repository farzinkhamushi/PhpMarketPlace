<?php include('includes/db.php'); ?>

<h2>&nbsp&nbsp&nbspبازیابی رمز عبور &nbsp&nbsp&nbsp   </h2>
<form method="post" action="#">
    
	<p>
		<label style="font-size:14px;">ایمیل خود را وارد کنید :  </label>
		<input type="text" name="email" size="50"/>
	</p>
	
	<p>
		<input type="submit" name="submit" value="بازیابی"/>
	</p>
</form>

<?php
	if (isset($_POST['email']) && ($_POST['email']!="")) {
		# code...
		$email=trim($_POST['email']); // get email address from user form
		$code=md5(uniqid(true)); // random alphernumeric character store in $code variable
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			
			$checkmail = mysqli_query($con,"SET NAMES utf8");
			$checkmail = mysqli_query($con,"SET CHARACTER SET utf8");
			$checkmail=mysqli_query($con,"SELECT customer_email FROM customers WHERE customer_email='$email' ");
			$count=mysqli_num_rows($checkmail); // check if user is on our data base
			
			if ($count==1) { // if email is stored in our database update lost password field with random code for reset
				# code...s
				$inserted=mysqli_query($con,"UPDATE customers SET lost='$code' WHERE customer_email='$email' ");
				// update our table users with unique random code
				/* Send a link to reset password */
				$to = $email;
				$subject = " لینک بازیابی رمز عبور ";
				$header = "By jahangir pachkam";
				$body = "با سلام به شما ، در این ایمیل لینک بازیابی رمز عبور برای شما ارسال شده است.
				کافی است برای تغییر رمز عبور خودتان بر روی لینک زیر فشار داده و مراحل را به صورت کامل انجام دهید با تشکر از شما. 
				آدرسی اینترنتی که برنامه ngrok به ما می دهد/ecommerce/updatepassword.php?email=$email&code=$code";
				
				$sent=mail($to,$subject,$body,$header);
				
				# code...
				if ($inserted) { /* update is successfull */
					# code...
					echo "<script>alert('ایمیل خود را چک کنید . ما برای شما لینکی برای تغییر پسورد ارسال کرده ایم!')</script>";
					
				}
			}
			else
			{
				echo "<script>alert('متاسفم، با ایمیل $email هیچ اکانتی ثبت نشده است، شما می توانید در صفحه بعدی ثبت نام کنید!!!')</script>";
				echo "<script>window.open('checkout.php','_self')</script>";
			}
			
			} else {
			echo "<script>alert(' $email یک آدرس ایمیل معتبر نمی باشد!!! لطفا یک آدرس ایمیل معتبر وارد کنید!!!')</script>";
		}
	}
?>