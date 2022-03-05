<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login </title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/backend/images/taxcare.png">
    <!-- <link href="<?php echo base_url();?>assets/backend/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url();?>assets/backend/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/backend/css/icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<style type="text/css">
    .error {
        font-weight: 600;
        color: #FFF;
        font-size: 15px;
    }
</style>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
				<span class="blockUpperlogin">
				<h4 class="text-center">Welcome Back!</h4>
				<small>Sign in to your account to continue<small>
				</span>
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <?php
                                    $action =   base_url()."login/getlogin";
                                    echo form_open($action);
                                    ?>
                                    <?php
                                    if($this->session->flashdata('message')!=''){
                                    $message    =   $this->session->flashdata('message');
                                    if($message!=''){
                                    echo '<div class="alert alert-warning"><button type="button" class="btn btn-danger" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="error"> &nbsp;&nbsp; '.$message.'.</strong></div>';
                                    }
                                    $this->session->unset_userdata('message');
                                    }
                                    ?>
                                   
                                        <div class="form-group">
                                            <label><strong>User ID</strong></label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Enter User ID" name="username"  required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control form-control-lg" placeholder="Enter your Password" name="password" required>
                                        </div>
                                        <?php if($this->config->item('captcha_enabled')) { ?>
                                        <p id="captImg"><?php echo $captcha['image'];?></p>
                                        <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
                                        Enter the code : 
                                        <input type="text" name="captcha" value="" autocomplete="off"/>
                                        <?php } ?>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" name='remember_me' id="user-checkbox" <?php if(isset($remember_me)){echo "checked";} ?> >
                                                    <label class="form-check-label textlightn" for="user-checkbox">Remember me</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu">Sign in</button>
                                        </div>
                                    <?php echo form_close();?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
     <!-- captcha refresh code -->
    <script>
    jQuery(document).ready(function(){
    jQuery('.refreshCaptcha').on('click', function(){
    jQuery.get('<?php echo base_url().'login/refresh_captcha'; ?>', function(data){
    $('#captImg').html(data);
    });
    });
    });
    </script>

</body>

</html>