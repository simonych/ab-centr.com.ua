<?php if(!get_option(SN."_banner_type") || get_option(SN."_banner_type")=="Image Banner" ) : ?>

<div class="top-ads-section">
<?php
$dur = (!get_option(SN."_banner_limit")) ? "3000" : (int)(get_option(SN."_banner_limit")) * 1000 ; 
 $i = 1;
 for(;$i<=5;$i++)
 {
	 $temp = get_option(SN."_banner_link{$i}");
	 
	 if($temp)
	 {
		 echo "<a href='$temp'><img src='".get_option(SN."_banner_img{$i}")."' alt='".get_option(SN."_banner_img{$i}")."'/></a>";
	 }
	 
 }


?>

 
     
 </div>
 <input type="hidden" id="bduration" value="<?php echo $dur;?>" />
 
 <?php else : ?>
 
 <div class='adsense-code'>
 
 <?php echo stripslashes(get_option(SN."_ads_sense")); ?>
 </div>
 
 <?php endif; ?>