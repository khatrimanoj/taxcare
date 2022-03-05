<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    ul li ul li { color: white; font-size: 12px;text-transform:capitalize; text }
</style>
<div id="wrapper">
    <div id="sidebar-wrapper" class="bg-theme bg-theme8" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="<?php echo base_url();?>">
       <h5 class="logo-text"><?php //echo COMPANY_NAME ;?></h5> 
       <img src="<?= base_url('assets/backend/images/textcare-admin-img.jpg'); ?>" class="img-circle" alt="tax care" id="logo" width="120">
   </a>
</div>
<ul class="sidebar-menu do-nicescrol">
  <!-- <li class="sidebar-header">MAIN NAVIGATION</li> -->
  <li><a href="<?php echo base_url('welcome'); ?>" class="waves-effect"><i class="zmdi zmdi-view-welcome ion-home"></i> <span>Dashboard</span></a></li>
  <!--  -->

  <li>  
  <a href="<?php echo base_url('users/usersList'); ?>"><i class="ion-person-stalker"></i> <span>   Users    </span></a>        
 
</li>

<li><a href="javaScript:void();" class="waves-effect"><i class="ion-bag"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i></a>          
   <ul class="sidebar-submenu">


       <li><a href="<?php echo base_url('Order/all'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>All Orders </span></a></li>



       <li><a href="<?php echo base_url('Order/completed'); ?>">
        <i class="zmdi zmdi-long-arrow-right"></i> <span>Completed Orders </span></a></li>

        <li><a href="<?php echo base_url('Order/pending'); ?>">
            <i class="zmdi zmdi-long-arrow-right"></i> <span>  Pending Orders  </span></a></li>
            <li><a href="<?php echo base_url('Order/refund'); ?>">
                <i class="zmdi zmdi-long-arrow-right"></i> <span>  Refund Orders  </span></a></li>



            </ul>

        </li>


        <li><a href="javaScript:void();" class="waves-effect"><i class="ion-email"></i> <span>Mailbox</span> <i class="fa fa-angle-left pull-right"></i></a>

           <ul class="sidebar-submenu">

            <li><a href="<?php echo base_url('Email/compose'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> 

                <i class="fas fa-envelope-open-text"><span> Compose </span></i>
            </a></li>

            <li><a href="<?php echo base_url('Email/inbox'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <i class="fas fa-inbox"><span> Inbox </span></i></a></li>



            <li><a href="<?php echo base_url('Email/sent'); ?>"><i class="zmdi zmdi-long-arrow-right"></i>
                <i class="far fa-envelope"> <span> Sent



                </span></i>
            </a></li>

        </ul>

    </li>



    <li style="background-color:#161624;"><a href="javaScript:void();" class="waves-effect">  <i class="fa fa-gear fa-spin" style="font-size:18px;color:#FFF"></i><span >Settings</span> </a>
    </li>
     
         
    
    <!--   APP Changes -->  

    
        
        
          <li><a href="<?php echo base_url('App-Changes'); ?>" class="waves-effect"><i class="ion-wrench"></i> <span>  APP Changes </span> </a>
        
 </li>
<!-- // APP Changes -->
    <!--   API Integration -->  

    <li><a href="javaScript:void();" class="waves-effect"><i class="ion-wrench"></i> <span>API Integration</span> <i class="fa fa-angle-left pull-right"></i></a>

       <ul class="sidebar-submenu">        
        <li><a href="<?php echo base_url('payment'); ?>" > <i class="ion-card"></i>  Payment Gateway   </a></li>
       <!--  <li><a href="<?php echo base_url('media'); ?>" > <i class="ion-social-youtube"></i>   Youtube       </a></li> -->
  
    </ul> 

</li> 
<!-- //    API Integration -->
    <!--   Policies   -->  

    <li><a href="javaScript:void();" class="waves-effect"><i class="ion-wrench"></i> <span>  Policies</span> <i class="fa fa-angle-left pull-right"></i></a>

       <ul class="sidebar-submenu">        
        <li><a href="<?php echo base_url('policy/privacy/'); ?>" > <i class="ion-document-text"></i>  Privacy Policy   </a></li>
        <li><a href="<?php echo base_url('policy/terms_condition/ '); ?>" > <i class="ion-document-text"></i>  Terms & Conditions  </a></li>
        <li><a href="<?php echo base_url('policy/refund/'); ?>" > <i class="ion-document-text"></i>  Refund Policy </a></li>
        <li><a href="<?php echo base_url('policy/eriddata'); ?>" > <i class="ion-document-text"></i>  ERI Data </a></li>
    </ul> 

</li> 
<!-- //     Policies   -->
    <!--   Tax care Guide   -->  

    <li><a href="javaScript:void();" class="waves-effect"><i class="ion-wrench"></i> <span>  Tax care Guide </span> <i class="fa fa-angle-left pull-right"></i></a>

       <ul class="sidebar-submenu">        
        <li><a href="<?php echo base_url('querydata'); ?>" > <i class="ion-document-text"></i> Query Data   </a></li>
        <li><a href="<?php echo base_url('faq'); ?>" > <i class="ion-document-text"></i>  FAQ Data   </a></li>
 
    </ul> 

</li> 
<!-- //    Tax care Guide    -->
    <li><a href="javaScript:void();" class="waves-effect"><i class="ion-wrench"></i> <span> Feedback </span> <i class="fa fa-angle-left pull-right"></i></a>

   

</li>
 
  
<li><a href="<?php echo base_url('user'); ?>"  class="waves-effect"><i class="fas fa-user-cog"></i><span>Admins </span> </a> </li> 
 
<li><a href="<?php echo base_url('About'); ?>"  class="waves-effect"><i class="fas fa-user"></i><span>About Me </span> </a>  </li> 
</ul>

  
        <div class="card" style="margin:10px;background-color:#2D2D3A;">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                  <span class="user-profile">
                    <img src="<?= base_url('assets/img/md.png'); ?>" class="img-circle" alt="user avatar" id="imgavtar"></span>
                <div class="media-body text-right">
                  <h3 class="h6">Nishant Bansal</h6>
                  <span class="span-tiles">Charted Accountant</span>
                </div>
              </div>
            </div>
          </div>
        </div>
    

</div>



 <style type="text/css" media="screen">
 .card {
  border-radius: 10px;
  padding-right: 0px;
padding-left: 0px;
margin:0 0 10px 0;
}
  .span-tiles{
      color: #B9B9B9;
      font-family: Inter;
      font-size: 14px;
      font-style: normal;
      font-weight: 600;
      line-height: 14px;
      letter-spacing: 0px;
      text-align: left;

  }
  .text-right{
      text-align: left !important;
    margin-left: 10px;
}
</style>