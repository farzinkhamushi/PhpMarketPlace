<?php
	
	include('server.php'); 
	
?>
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
		
		<div>
			
			<form action="customer_register.php" method="post" enctype="multipart/form-data" >
				
				<?php include('includes/errors.php'); ?>
				
				<table align="center">
					
					<tr >
						<td colspan="6" >
							<h2>  ثبت نام</h2>
						</td>
					</tr>
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">نام   :   </b>
						</td>
						<td colspan="3" >
							<input type="text"    size="35" name="c_name" placeholder="نام خود را وارد نمایید." value="<?php echo $c_name; ?>" />
						</td>
					</tr>
					
					<tr>
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">نام خانوادگی  :  </b>
						</td>
						<td colspan="3" >
							<input type="text"    size="35" name="c_lastname" placeholder="نام خانوادگی خود را وارد نمایید." value="<?php echo $c_lastname; ?>" />
						</td> 
					</tr>
					
					<tr>
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">جنسیت  :  </b>
						</td>
						<td colspan="3" >
							<select name="c_gender" >
								<?php 
									if(isset($c_gender)){
										echo ('<option value="'.$c_gender.'" >'.$c_gender.'</option>"');
									}?>
									<option value="0">جنسیت مورد نظرتان را انتخاب نمایید.</option>
									<option value="مرد" >مرد</option>
									<option value="زن" >زن</option>
							</select>
						</td>
					</tr>
					
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">تصویری از خودتان  :  </b>
						</td>
						<td colspan="3" >
							<?php 
								if(!isset($c_image)){
									echo('<input type="file" name="c_image"  />
									<b style="font-family:b nazanin;font-size:14px;">فایلی را انتخاب کنید . پسوند مجاز برای تصویر شامل jpeg و jpg و png می باشد و حجم آن نباید بیشتر از 2 مگابایت باشد.</b>');
									}else{
									echo $c_image;
								} 
							?>
						</td>
					</tr>
					
					<tr>
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">ایمیل  :  </b>
						</td>
						<td colspan="3" >
							<input type="text"    size="35" name="c_email" placeholder="ایمیل خود را وارد نمایید." value="<?php echo $c_email; ?>" />
						</td>
					</tr>
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">نام استان  :  </b>
						</td>
						<td colspan="3" >
							<select name="state" onChange="iranwebsv(this.value);">
								<?php if(isset($c_province)){echo ('<option value="'.$c_province.'" >'.$c_province.'</option>"');}?>
								<option value="0">لطفا استان را انتخاب نمایید</option>
								<option value="تهران">تهران</option>
								<option value="گیلان">گیلان</option>
								<option value="آذربایجان شرقی">آذربایجان شرقی</option>
								<option value="خوزستان">خوزستان</option>
								<option value="فارس">فارس</option>
								<option value="اصفهان">اصفهان</option>
								<option value="خراسان رضوی">خراسان رضوی</option>
								<option value="قزوین">قزوین</option>
								<option value="سمنان">سمنان</option>
								<option value="قم">قم</option>
								<option value="مرکزی">مرکزی</option>
								<option value="زنجان">زنجان</option>
								<option value="مازندران">مازندران</option>
								<option value="گلستان">گلستان</option>
								<option value="اردبیل">اردبیل</option>
								<option value="آذربایجان غربی">آذربایجان غربی</option>
								<option value="همدان">همدان</option>
								<option value="کردستان">کردستان</option>
								<option value="کرمانشاه">کرمانشاه</option>
								<option value="لرستان">لرستان</option>
								<option value="بوشهر">بوشهر</option>
								<option value="کرمان">کرمان</option>
								<option value="هرمزگان">هرمزگان</option>
								<option value="چهارمحال و بختیاری">چهارمحال و بختیاری</option>
								<option value="یزد">یزد</option>
								<option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
								<option value="ایلام">ایلام</option>
								<option value="کهگلویه و بویراحمد">کهگلویه و بویراحمد</option>
								<option value="خراسان شمالی">خراسان شمالی</option>
								<option value="خراسان جنوبی">خراسان جنوبی</option>
								<option value="البرز">البرز</option>
							</select>
						</td>
					</tr>
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">نام شهر  :  </b>
						</td>
						<td colspan="3" >
							<select name="city" id="city">
								<?php if(isset($c_city)){ echo ('<option value="'.$c_city.'" >'.$c_city.'</option>"');}?>
								<option value="0">لطفا استان را انتخاب نمایید</option>
							</select>
						</td>
					</tr>
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">آدرس  :  </b>
						</td>
						<td colspan="3" >
							<input type="text"  size="35" name="c_address" placeholder="آدرس خود را وارد نمایید." value="<?php echo $c_address; ?>" />
						</td>
					</tr>
					
					<tr >
						<td colspan="3" >
							<b style="font-family:b nazanin;font-size:18px;">تلفن همراه  :  </b>
						</td>
						<td colspan="3" >
							<input type="text"  size="35" name="c_phone" placeholder="تلفن خود را وارد نمایید ." value="<?php echo $c_phone; ?>" />
						</td>
					</tr>
					
					
					<tr>
						<td colspan="6">
							<div class="tooltip" style="font-family:b nazanin;font-size:18px;color:yellow;">قبل از انتخاب پسورد حتما این قوانین را مطالعه بفرمایید.
								<span class="tooltiptext">•	پسورد شما باید حداقل 6 کاراکتر و حداکثر 12 کاراکتر باشد.<br><br>
									•	در پسورد خود حتما باید از ارقام 0تا 9 استفاده کنید.<br><br>
									•	در پسورد خود از حروف بزرگ  یا کوچک انگلیسی استفاده کنید.<br><br>
								•	در پسورد خود حتما باید از علامت @ یا $ استفاده نمایید.<br><br>
								
								</span>
								</div>
								</td>
								</tr>
								
								<tr >
								<td colspan="3" >
								<b style="font-family:b nazanin;font-size:18px;">پسورد  :  </b>
								</td>
								<td colspan="3" >
								<input type="password" size="35" name="c_password_1" placeholder="پسوردتان را وارد نمایید" id="myInput_1" />
								
								<!-- An element to toggle between password visibility -->
								<input type="checkbox" onclick="myFunction()" >
								<b style="font-family:b nazanin;font-size:18px;"> نمایش پسورد</b>	
								<script>
								function myFunction() {
								var x = document.getElementById("myInput_1");
								var y = document.getElementById("myInput_2");
								if (x.type === "password") {
								x.type = "text";
								} else {
								x.type = "password";
								}
								if (y.type === "password") {
								y.type = "text";
								} else {
								y.type = "password";
								}
								}
								</script>
								
								</td>
								
								</tr>
								
								
								<tr >
								<td colspan="3" >
								<b style="font-family:b nazanin;font-size:18px;">پسورد را دوباره وارد نمایید :   </b>
								</td>
								<td colspan="3" >
								<input type="password" size="35" name="c_password_2" placeholder="پسورد را دوباره وارد نمایید" id="myInput_2" />
								</td>
								</tr>
								
								<tr align="center">
								<td colspan="6" height="55">
								<input type="submit" name="register" value="ایجاد نام کاربری">
								</td>
								</tr>
								
								</table>
								
								</form>
								
								</div>
								
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