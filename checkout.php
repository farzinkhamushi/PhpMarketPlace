<?php 
	include('includes/Header.php');
?>

		
        <!---- Start Online Shopping Cart ----> 
		<?php	include('includes/Shopping_Cart.php');	?>
		<!---- end Online Shopping Cart ---->


	
    
    <div id="templatemo_content">
    
<!-- start of ocntent left -->
				<div id="templatemo_content_left">
					<h1>به سایت الکترونیک دیتیل دات کام خوش آمدید </h1>
					<p>امروزه با افزایش روز افزون تولیدکنندگان مطرح داخلی و خارجی  انواع لوازم، قدرت انتخاب مشتری به شدت بالا رفته است. اما با توجه به اینکه هیچ فروشگاهی به طور فیزیکی، گنجایش تمامی این محصولات را نداشته و نیز هیچ فروشنده‌ای اطلاعات کاملی از تمامی محصولات موجود در فروشگاه خود ندارد و حتی در صورت داشتن تمامی اطلاعات، توضیح تک تک آنها، نیازمند صرف انرژی و زمان بسیار زیادی خواهد بود، جهانگیر پچکم دات کام بر آن شد تا یک مرجع جامع و کامل تخصصی ارزیابی، مشاوره و فروش محصولات  تولید داخل و خارج کشور را بصورت یک فروشگاه اینترنتی در اختیار عموم مردم ایران قرار دهد.</p>
					
					



					<div class="cleaner_with_height">&nbsp;</div>

					

					<?php
						
						if(isset($_GET['forgot_pass']))
						{
							include("Forgot_Password.php");
							}else{
							
							if(isset($_SESSION['customer_email']))
							{
								include("payment.php");
								
								}else{
								
								include("customer_login.php");
								
							}				
							
						}
					?>






												
					<div class="cleaner_with_height">&nbsp;</div>







				</div>
<!-- end of ocntent left -->
        


        <?php 
	        include('includes/Right_Sidebar.php');
        ?>

        <div class="cleaner">&nbsp;</div>
    </div>
    

    <?php 
	    include('includes/Footer.php');
    ?>
    