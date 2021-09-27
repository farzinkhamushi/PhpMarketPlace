<?php include('includes/db.php'); ?>

<!-- start of Header -->
<?php	include('includes/Header.php');	?>
<!-- end of Header -->

<!-- start of content -->   
<div id="templatemo_content">
	
	<!-- start of left ocntent -->
	<div id="templatemo_content_left">
		<h1>به سایت جهانگیر پچکم دات کام خوش آمدید </h1>
		<p>امروزه با افزایش روز افزون تولیدکنندگان مطرح داخلی و خارجی  انواع لوازم، قدرت انتخاب مشتری به شدت بالا رفته است. اما با توجه به اینکه هیچ فروشگاهی به طور فیزیکی، گنجایش تمامی این محصولات را نداشته و نیز هیچ فروشنده‌ای اطلاعات کاملی از تمامی محصولات موجود در فروشگاه خود ندارد و حتی در صورت داشتن تمامی اطلاعات، توضیح تک تک آنها، نیازمند صرف انرژی و زمان بسیار زیادی خواهد بود، جهانگیر پچکم دات کام بر آن شد تا یک مرجع جامع و کامل تخصصی ارزیابی، مشاوره و فروش محصولات  تولید داخل و خارج کشور را بصورت یک فروشگاه اینترنتی در اختیار عموم مردم ایران قرار دهد.</p>
		<div class="cleaner_with_height">&nbsp;</div>
		<?php
			if (isset($_GET['email']) && ($_GET['code']!="")) {
				# code...
				$code=$_GET['code'];
				$email=$_GET['email'];
				
				$checkmail = mysqli_query($con,"SET NAMES utf8");
				$checkmail = mysqli_query($con,"SET CHARACTER SET utf8");
				$checkmail=mysqli_query($con,"SELECT customer_email FROM customers WHERE customer_email='$email' AND lost='$code' AND lost!='' ");
				$count=mysqli_num_rows($checkmail);
				if ($count) {
					
					if (isset($_POST['password'])){
						
						// receive password value from the form and validation password value
						$c_password_validate=mysqli_real_escape_string($con ,$_POST['password']);
						if (empty($c_password_validate)) 
						{
							echo "<script>alert('پسورد خود را وارد نکرده اید!')</script>";
							}else{
							if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[$@])\S{6,12}$/", $c_password_validate))
							{
								// password is valid
								$password = $c_password_validate;
								$repassword=$_POST['repassword'];
								if ($password===$repassword) {
									# code...
									$inserted=mysqli_query($con,"UPDATE customers SET lost='', customer_pass='$password' WHERE customer_email='$email' ");
									// insert into our table users with new password
									if ($inserted) {
										# code...
										echo "<script>alert('پسورد شما با موفقیت تغییر کرد! اکنون با این پسورد جدید وارد سایت شوید!!!')</script>";
										echo "<script>window.open('checkout.php','_self')</script>";
									}
									
								}
								else
								{
									echo "<script>alert('چرا پسوردهای شما با هم منطبق نیستند؟ لطفا هر دو پسورد را به یک شکل وارد نمایید.')</script>";
								}
								}else{
								echo "<script>alert('پسوردی که وارد کرده اید، طبق الگو نیست. دوباره پسورد را وارد نمایید!!!')</script>";
							} 
						}					
						
						
						
					}
					# code...
					echo '
					<h2>&nbsp&nbsp&nbsp پسورد جدید خودتان را ایجاد نمایید.</h2>
					
					<div class="tooltip" style="font-family:b nazanin;font-size:18px;color:yellow;">قبل از انتخاب پسورد حتما این قوانین را مطالعه بفرمایید.
					<span class="tooltiptext">•	پسورد شما باید حداقل 6 کاراکتر و حداکثر 12 کاراکتر باشد.<br><br>
					•	در پسورد خود حتما باید از ارقام 0تا 9 استفاده کنید.<br><br>
					•	در پسورد خود از حروف بزرگ  یا کوچک انگلیسی استفاده کنید.<br><br>
					•	در پسورد خود حتما باید از علامت @ یا $ استفاده نمایید.<br><br>
					
					</span>
					</div>
					<br/>
					<br/>
					<form method="post" action="">
					<p><label style="font-size:14px;">پسورد جدید را وارد کنید : </label><input type="text" name="password" size="50"/></p>
					<p><label style="font-size:14px;">از دوباره پسورد جدید را وارد کنید : </label><input type="text" name="repassword" size="50"/></p>
					<p><input type="submit" name="create" value="عوضش کن!"/></p>
					</form>
					';
					
					}else{
					echo "<script>alert('خطایی رخ داده است!!!')</script>";
				}
				
				
			}
			
		?>
		<div class="cleaner_with_height">&nbsp;</div>
	</div>
    <!-- end of left content  -->
	
	<!-- start of right content -->
<?php	include('includes/Right_Sidebar.php');	?>
<!-- end of right content -->
<div class="cleaner">&nbsp;</div>
</div>
<!-- end of content -->

<!-- start of footer -->
<?php include('includes/Footer.php');	?>
<!-- end of footer -->