<?php /* <marquee class="noting">The data entry in the portal for IMI 2.0 Round 1 (December 2019) has been closed.</marquee>
*/
?>
<?php $data = setScrollText(1); 
if(isset($data->description) && trim($data->description) != '' ){  ?>
 <marquee class="noting">
    <?php echo $data->description; ?>
 </marquee>
<?php } ?>

