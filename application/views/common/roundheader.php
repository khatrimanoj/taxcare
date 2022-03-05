<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>
        </ul>
        <?php 

        $admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);

        ?>
        <ul class="navbar-nav align-items-center right-nav-link">

            <li class="dropdown-item">
                <select name="role_id" class="form-control error">
                    <option value="21" selected="selected">F.Y. - 2020-21</option>
                    <option value="22">F.Y. - 2021-22</option>
                    <option value="23">F.Y. - 2022-23</option>
                </select>
            </li></ul>
            <?php echo $admin_detail['username']; ?>
            <ul class="navbar-nav align-items-center right-nav-link">

              <li class="dropdown-item">
                <a href="<?= base_url('Logout'); ?>"><i class="icon-power mr-2"></i> Logout</a></li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="<?= base_url('assets/img/md.png'); ?>" class="img-circle" alt="user avatar" id="imgavtar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" id='profile'>
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">

                                    <div class="media-body">



                                       <table class="table  table-bordered">
                                         <td><div class="avatar"><img class="align-self-start mr-3" src="<?= base_url('assets/img/md.png'); ?>" alt="user avatar"></div> </td> <td><?php echo $admin_detail['username']; ?></td>
                                         <?php if ($admin_detail['role_name'] != '') { ?>
                                            <tr>    
                                                <td>Role:</td> <td><?php echo $admin_detail['role_name']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>Email:</td> <td><?php echo $admin_detail['email']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Contact:</td> <td><?php echo $admin_detail['mobile']; ?></td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
</header>

<div class="clearfix"></div>