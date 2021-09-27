<?php
	include('includes/db.php');
	// initializing variables
	$c_name = "";
	$c_lastname    = "";
	$c_email    = "";
	$c_address    = "";
	$c_phone    = "";
	$c_password_1 = "";
	$errors = array(); 
	
	// REGISTER USER
	if(isset($_POST['register'])) {
		// receive all input values from the form
		// form validation: ensure that the form is correctly filled ...
		// by adding (array_push()) corresponding error unto $errors array
		
		// receive name value from the form
		$c_name = mysqli_real_escape_string($con , $_POST['c_name']);
		if (empty($c_name)) { array_push($errors, "نام خود را وارد نکردید!"); }
		
		// receive lastname value from the form
		$c_lastname = mysqli_real_escape_string($con ,$_POST['c_lastname']);
		if (empty($c_lastname)) { array_push($errors, "نام خانوادگی خود را وارد نکردید!"); }
		
		// receive gender value from the form
		$c_gender = $_POST['c_gender'];
		if (empty($c_gender)) { array_push($errors, "جنسیت خود را انتخاب نکردید!"); }
		
		// receive image value from the form and validation image value
		if(isset($_COOKIE["CustomerImage"]))
		{
			if(isset($_COOKIE["CustomerImageTmp"]))
			
			{
				$c_image = $_COOKIE["CustomerImage"];
				$c_image_tmp = $_COOKIE["CustomerImageTmp"];
				$new_address_image ="customer/customer_images/".$c_image;
				
			}
			}else{
			if (empty($_FILES["c_image"]["name"])) 
			{ 
				array_push($errors, "تصویر خود را انتخاب کنید!"); 
				}else{
				$Allowextension = array("jpeg" , "jpg" , "png");
				$FileExtension=explode(".",$_FILES["c_image"]["name"]);
				$extension=end($FileExtension);
				if(in_array($extension,$Allowextension )&&($_FILES["c_image"]["size"]<=20971520))
				{
					if($_FILES["c_image"]["error"]==0)
					{
						$c_image = $_FILES['c_image']['name'];
						$c_image_tmp = $_FILES['c_image']['tmp_name'];
						setcookie('CustomerImage',$c_image,time()+600);
						setcookie('CustomerImageTmp',$c_image_tmp,time()+600);
						
						$new_address_image ="customer/customer_images/".$c_image;
						move_uploaded_file($c_image_tmp,$new_address_image);
						
						}else{
						array_push($errors, "فایل به درستی آپلود نشد!!!");	
					}
					}else{
					array_push($errors, "تصویر مناسب را انتخاب کنید! پسوند مجاز برای تصویر شامل jpeg و jpg و png می باشد و حجم آن نباید بیشتر از 2 مگابایت باشد!!!");
				}
			}
		}
		
		// receive email value from the form and validation email value
		$c_email_no_empty = mysqli_real_escape_string($con ,$_POST['c_email']);
		if (empty($c_email_no_empty)) 
		{
			array_push($errors, "ایمیل خود را وارد کنید!"); 
			}else{
			$c_email_validate=$c_email_no_empty;
			if(filter_var($c_email_validate,FILTER_VALIDATE_EMAIL) == true){
				$c_email=$c_email_validate;
				}else{
				array_push($errors, "ایمیل نادرستی  وارد کرده اید!!! ایمیل درستی وارد کنید.");
			}
		}
		
		// receive state value from the form
		$c_province = $_POST['state'];
		if (empty($c_province)) { array_push($errors, "استان خود را وارد نکردید!"); }  
		
		// receive city value from the form
		$c_city = $_POST['city'];
		if (empty($c_city)) { array_push($errors, "شهر خود را وارد نکردید!"); }		
		
		// receive address value from the form
		$c_address = mysqli_real_escape_string($con ,$_POST['c_address']);
		if (empty($c_address)) { array_push($errors, "آدرس خود را وارد نکردید!"); }
		
		// receive phone value from the form and validation phone value
		$c_phone_validate=mysqli_real_escape_string($con ,$_POST['c_phone']);
		if (empty($c_phone_validate)) 
		{
			array_push($errors, "تلفن خود را وارد نکردید!"); 
			}else{
			if(preg_match("/^[0]{1}[9]{1}\d{9}$/", $c_phone_validate))
			{
				// phone is valid
				$c_phone=$c_phone_validate;
				}else{
				array_push($errors, "تلفنی که وارد کردید صحیح نمی باشد!!!");
			} 
		}
		
		// receive password value from the form and validation password value
		$c_password_1_validate=mysqli_real_escape_string($con ,$_POST['c_password_1']);
		if (empty($c_password_1_validate)) 
		{
			array_push($errors, "پسورد خود را وارد نکرده اید!"); 
			}else{
			if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[$@])\S{6,12}$/", $c_password_1_validate))
			{
				// phone is valid
				$c_password_1 = $c_password_1_validate;
				}else{
				array_push($errors, "پسوردی که وارد کرده اید، طبق الگو نیست. دوباره پسورد را وارد نمایید!!!");
			} 
		}	
		
		
		$c_password_2 =mysqli_real_escape_string($con ,$_POST['c_password_2']);
		if (empty($c_password_2)){array_push($errors, "پسورد دوم را وارد نکرده اید!!!");}
		
		if((!empty($c_password_1_validate))&&(!empty($c_password_2)))
		{
			
			if ($c_password_1 != $c_password_2)
			{
				array_push($errors, "پسورد های وارد شده یکسان نیستند!");
			}
		}
		
		//creating or using cookie for ip customer
		if(isset($_COOKIE["ipUserEcommerce"]))
		{
			$ip	= $_COOKIE["ipUserEcommerce"];
			}else{
			$ip=getIp();
			setcookie('ipUserEcommerce',$ip,time()+1206900);
		}	
		
		// Finally, register user if there are no errors in the form
		if (count($errors) == 0) {
			//confirm email
			$confirmcode = rand();
			$query = "INSERT INTO customers 
			(customer_ip,customer_name,customer_lastname,customer_gender,customer_image,customer_email,customer_province,customer_city,customer_address,customer_phone,customer_pass,confirmed,confirm_code) 
			VALUES('$ip',N'$c_name',N'$c_lastname',N'$c_gender',N'$new_address_image',N'$c_email',N'$c_province',N'$c_city',N'$c_address',N'$c_phone',N'$c_password_1','0','$confirmcode')";
			
			$run_c = mysqli_query($con, $query);
			if($run_c)
			{
				$message="
				به منظور تکمیل کردن ثبت‌نام خود، لطفا با کلیک کردن روی لینک زیر آدرس ایمیل خود را تائید کنید.
				http://yourip.ngrok.io/ecommerce/emailconfirm.php?customer_name=$c_name&customer_ip=$ip&code=$confirmcode";
				mail($c_email,"از طرف سایت جهانگیر پچکم", $message ,"Form:DoNotReplay@yoursite.com");
				
				echo "<script>alert('با تشکر از ثبت نام شما. برای تکمیل فرآیند ثبت نام لطفا بر روی لینک فعال سازی که از طریق ایمیل برای شما ارسال شده است، کلیک کنید. ')</script>";
				echo "<script>window.open('emailconfirm.php','_self')</script>";
				
			}
			
		}		
		
	}
?>