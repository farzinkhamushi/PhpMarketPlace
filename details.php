<?php 
	include('functions/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fa"  dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>فروشگاه اینترنتی الکریک دیتیل </title>
<meta name="keywords" content="free website template, flower shop, website templates, CSS, HTML" />
<meta name="description" content="Flower Shop - free website template, W3C compliant HTML CSS layout" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<!--  Free CSS Template | Designed by TemplateMo.com  -->
</head>
<body>
<div id="templatemo_container">
<div id="templatemo_top_panel">
    	<div id="templatemo_language_section">
			<a href="#"><img src="images/templatemo_flag_01.gif" alt="flag 1" /></a>
            <a href="#"><img src="images/templatemo_flag_02.gif" alt="flag 2" /></a>
            <a href="#"><img src="images/templatemo_flag_03.gif" alt="flag 3" /></a>
            <a href="#"><img src="images/templatemo_flag_04.gif" alt="flag 4" /></a>
            <a href="#"><img src="images/templatemo_flag_05.gif" alt="flag 5" /></a>
        </div>
        <div id="templatemo_shopping_cart">
       	    Shopping Cart <span>(<a href="#">3 items</a>)</span>      
        </div>
  </div>
     
     <div id="templatemo_header">
     	<img src="images/templatemo_site_header.jpg" alt="Flower Shop" />
     </div>
     
     <div id="templatemo_banner">
     	<a href="#"><img src="images/templatemo_banner_image.jpg" alt="Flower Shop - Free Web Template" title="Flower Shop - Free Web Template" border="0" /></a>     </div>
     
<div id="templatemo_menu_panel">
        <ul>
            <li><a href="#" class="current">خانه</a></li>
            <li><a href="#" target="_parent">همه محصولات</a></li>
            <li><a href="#" target="_parent">حساب من</a></li>
            <li><a href="#" target="_parent">خروج</a></li>  
            <li><a href="#">درباره ما</a></li> 
            <li><a href="#">تماس با ما</a></li>                     
        </ul> 
    </div> 
<!-- end of menu -->


		<!---- Start Online Shopping Cart ----> 
		<?php	include('includes/Shopping_Cart.php');	?>
		<!---- end Online Shopping Cart ---->


	
    
    <div id="templatemo_content">
    
<!-- start of ocntent left -->
				<div id="templatemo_content_left">
					<h1>به سایت جهانگیر پچکم دات کام خوش آمدید </h1>
					<p>امروزه با افزایش روز افزون تولیدکنندگان مطرح داخلی و خارجی  انواع لوازم، قدرت انتخاب مشتری به شدت بالا رفته است. اما با توجه به اینکه هیچ فروشگاهی به طور فیزیکی، گنجایش تمامی این محصولات را نداشته و نیز هیچ فروشنده‌ای اطلاعات کاملی از تمامی محصولات موجود در فروشگاه خود ندارد و حتی در صورت داشتن تمامی اطلاعات، توضیح تک تک آنها، نیازمند صرف انرژی و زمان بسیار زیادی خواهد بود، جهانگیر پچکم دات کام بر آن شد تا یک مرجع جامع و کامل تخصصی ارزیابی، مشاوره و فروش محصولات  تولید داخل و خارج کشور را بصورت یک فروشگاه اینترنتی در اختیار عموم مردم ایران قرار دهد.</p>
					<div class="cleaner_with_height">&nbsp;</div>
										
<?php 
if(isset($_GET['product_id'])){
		global $con;
		$id_product=$_GET['product_id'];
		$get_pro="select * from products where product_id='$id_product'";
		$run_pro=@mysqli_query($con,"SET NAMES utf8");
		$run_pro=@mysqli_query($con,"SET CHARACTER SET utf8");
		$run_pro=mysqli_query($con,$get_pro);
		while($row_pro=mysqli_fetch_array($run_pro))
		{
			$pro_id=$row_pro['product_id'];
			$pro_title=$row_pro['product_title'];
			$pro_price=$row_pro['product_price'];
			$pro_desc=$row_pro['product_desc'];
			$pro_image=$row_pro['product_image'];
			
			echo"
			<div class='product_box_detail'>
				<h3 class='h3_details'>$pro_title
				<br/><br/><div class='price'>قیمت:<span>$pro_price تومان</span></div>
				</h3>
				<div style='width:100%;float:right;'>
				<img style='width:400px;height:400px;float:right;margin:0 15%;' src='Admin_area/$pro_image' alt='image' />
				</div>
				<br/><br/><br/><br/>
				<p>$pro_desc</p>
				<div class='buynow'><a href='index.php?add_cart=$pro_id'>هم اکنون می خرید</a></div>
				<a href='index.php'>بازگشت به صفحه ی اصلی سایت!</a>
			</div>";
		}
	}
						?>
					
						
					<div class="cleaner_with_height">&nbsp;</div>
				</div>
<!-- end of ocntent left -->
        
        <div id="templatemo_content_right">
        	<div class="templatemo_right_section">
            	<h4>Search</h4>
                <div class="templatemo_right_section_content">
                    <form method="get" action="#">
                            <input name="keyword" type="text" id="keyword"/>
                            <input type="submit" name="submit" class="button" value="Search" />
                     </form>
                 </div>
            </div>
            
            
            <div class="templatemo_right_section">
						<h4>دسته بندی ها</h4>
						<div class="templatemo_right_section_content">
							<ul>
								<?php getCat(); ?>
							</ul>
						</div>
			</div>
					
			<div class="templatemo_right_section">
						<h4>برندها</h4>
						<div class="templatemo_right_section_content">
							<ul>
								<?php getBrand() ?>
							</ul>
						</div>
			</div>
					
            

            <div class="templatemo_right_section">
            	<h4>W3C Validations</h4>
            	<div class="templatemo_right_section_content">
                    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
				</div>
            </div>
        </div> <!-- end of content right-->
        
        <div class="cleaner">&nbsp;</div>
    </div>
    
     <div id="templatemo_footer_panel">
        <div id="footer_left">
            <img src="images/mastercard.gif" alt="Master Card" /><img src="images/visa.gif" alt="Visa Card" /><img src="images/paypal.gif" alt="PayPal" /><img src="images/verisignsecured.gif" alt="Verisign Secured" />
        </div>
        <div id="footer_right">
            Copyright © 2024 <a href="#">Your Company Name</a><br />
			<a href="http://www.iwebsitetemplate.com" target="_parent">Website Templates</a> by 
            <a href="http://www.templatemo.com" target="_blank">Free CSS Templates</a>
        </div>
        
        <div class="cleaner">&nbsp;</div>
    </div>
</div>
<!--  Free CSS Template | Designed by TemplateMo.com  --> 
<div align=center>آموزش ساخت فروشگاه اینترنتی با php توسط جهانگیر پچکم</a></div></body>
</html>