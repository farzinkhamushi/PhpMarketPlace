<!-- start of Header -->
<?php	include('includes/Header.php');	?>
<!-- end of Header -->


		<!---- Start Online Shopping Cart ----> 
		<?php	include('includes/Shopping_Cart.php');	?>
		<!---- end Online Shopping Cart ---->

	
<!-- start of content -->   
    <div id="templatemo_content">

	<!-- start of left ocntent -->
	<div id="templatemo_content_left">
					<h1>به سایت الکترونیک دیتیل دات کام خوش آمدید </h1>
					<p>امروزه با افزایش روز افزون تولیدکنندگان مطرح داخلی و خارجی  انواع لوازم، قدرت انتخاب مشتری به شدت بالا رفته است. اما با توجه به اینکه هیچ فروشگاهی به طور فیزیکی، گنجایش تمامی این محصولات را نداشته و نیز هیچ فروشنده‌ای اطلاعات کاملی از تمامی محصولات موجود در فروشگاه خود ندارد و حتی در صورت داشتن تمامی اطلاعات، توضیح تک تک آنها، نیازمند صرف انرژی و زمان بسیار زیادی خواهد بود، جهانگیر پچکم دات کام بر آن شد تا یک مرجع جامع و کامل تخصصی ارزیابی، مشاوره و فروش محصولات  تولید داخل و خارج کشور را بصورت یک فروشگاه اینترنتی در اختیار عموم مردم ایران قرار دهد.</p>
					<div class="cleaner_with_height">&nbsp;</div>
										
<?php
		if(isset($_GET['search']))
		{	
			$search_qurey=$_GET['user_query'];
			$get_pro="select * from products where product_keywords like N'%$search_qurey%' ";
			$run_pro=@mysqli_query($con,"SET NAMES utf8");
			$run_pro=@mysqli_query($con,"SET CHARACTER SET utf8");
			$run_pro=mysqli_query($con,$get_pro);
			echo"<h2>$search_qurey</h2>";
			while($row_pro=mysqli_fetch_array($run_pro))
			{
				
				$pro_id=$row_pro['product_id'];
				$pro_cat=$row_pro['product_cat'];
				$pro_brand=$row_pro['product_brand'];
				$pro_title=$row_pro['product_title'];
				$pro_price=$row_pro['product_price'];
				$pro_desc=$row_pro['product_desc'];
				$pro_image=$row_pro['product_image'];
				
				echo"
				<div class='product_box'>
					<h3>$pro_title</h3>
					<img width='200' height='150' src='Admin_area/$pro_image' alt='image' />
					<div class='price'>قیمت:<span>$pro_price تومان</span></div>                           
					<div class='buynow'><a href='index.php?add_cart=$pro_id'>هم اکنون می خرید</a></div>
					<a href='details.php?product_id=$pro_id'>جزئیات</a>
				</div>";
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