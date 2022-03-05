<div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu mt-3" id="menu"> 
                    <li><a href="<?php echo base_url('welcome');?>"><img src="<?php echo base_url();?>assets/images/Home.svg"><span class="nav-text">Dashboard</span></a>
                    </li>
                    <li><a href="<?php echo base_url('users/usersList'); ?>"><img src="<?php echo base_url();?>assets/images/Document.svg"><span class="nav-text">User Details</span></a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><img src="<?php echo base_url();?>assets/images/Folder.svg"><span class="nav-text">Orders</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('Order/all');?>">Total Orders</a></li>
                            <li><a href="<?php echo base_url('Order/completed');?>">Complete Orders</a></li>
                            <li><a href="<?php echo base_url('Order/pending');?>">Pending Orders</a></li>
                            <li><a href="<?php echo base_url('Order/refund');?>">cancelled Orders   </a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><img src="<?php echo base_url();?>assets/images/Message.svg"><span class="nav-text">Mailbox</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('Email/inbox'); ?>">Inbox</a></li>
                            
                            <li><a href="<?php echo base_url('Email/sent'); ?>">Outbox</a></li>

                             <li><a href="<?php echo base_url('Email/compose'); ?>">Compose</a></li>
                        </ul>
                    </li>
					 <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><img src="<?php echo base_url();?>assets/images/notification.svg"><span class="nav-text">Notification</span></a>
                        <ul aria-expanded="false">
                            <li><a href="#">Profile</a></li>
                            
                            <li><a href="#">Calendar</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">SYSTEM</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><img src="<?php echo base_url();?>assets/images/Setting.svg"><span class="nav-text">Settings</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('App_changes');?>">App Changes</a></li>
                            
                            <li><a href="<?php echo base_url('Integration');?>">Integration</a></li>

                            <li><a href="<?php echo base_url('Legal_doc');?>">Legal Documents</a></li> 

                            <li><a href="<?php echo base_url('Faq');?>">FAQ Data</a></li>

                            <li><a href="<?php echo base_url('Querydata');?>">Query Data</a></li> 

                             <li><a href="#">Feedback</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('user');?>"><img src="<?php echo base_url();?>assets/images/admins.svg"><span class="nav-text">Admin</span></a>
                    </li>
                    <li><a href="<?php echo base_url('Change-Password');?>"><img src="<?php echo base_url();?>assets/images/Edit.svg"><span class="nav-text">Change Password</span></a>
                    </li>
                    <li><a href="<?php echo base_url('About');?>"><img src="<?php echo base_url();?>assets/images/Category.svg"><span class="nav-text">About Us</span></a>
                    </li>
                   <li class="blockLast">
                    <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/blockuser.svg">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">Nishant Bansal</div>
                                    <div class="stat-text">Chartered Accountant</div>
                                </div>
                            </div>
                        </div>

                    </li>
                    
                </ul>
            </div>
        </div>