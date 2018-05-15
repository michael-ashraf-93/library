<!DOCTYPE html>
<html>
<head>
    <style>
        #ah:hover span {
            display: none
        }

        #ah:hover:before {
            content: "Library";
            font-weight: bold;
        }
    </style>

    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="skin-blue sidebar-mini">

<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a id="ah" href="/home" class="logo">
            <b><span>Dashboard</span></b>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
        <?php if(Auth::user()): ?>
            <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="https://cssanimation.rocks/images/posts/wwdc15/step1.png"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo Auth::user()->name; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="https://cssanimation.rocks/images/posts/wwdc15/step1.png"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        <?php echo Auth::user()->name; ?>

                                        <small>Member since <?php echo Auth::user()->created_at->format('D. M. Y'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    
                                    
                                    
                                    <?php if(Auth::User()): ?>
                                        <?php if(Auth::user()->role == 'admin'): ?>
                                            <div class="pull-left">
                                                <a href="/admin">
                                                    <button class="btn btn-default">Admin Dashboard</button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <div class="pull-right">
                                        <a href="/logout">
                                            <button class="btn btn-default">Logout</button>
                                        </a>
                                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST"
                                              style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
            <h4>
                <span style="float: right;">

                            

                            
                    <span class="label label-primary"><a href="/login"> <span style="color: #FFFFFF" > Login</span></a></span>
                    <span class="label label-primary"><a href="/register"> <span style="color: #FFFFFF" > Sign Up</span></a></span>
                    </span>
            </h4>
            <?php endif; ?>

        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
<?php echo $__env->make('.user.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer" style="max-height: 100px;text-align: center">
        <strong>Copyright © 2018 <a href="/">News Blog</a>.</strong> All rights reserved.
    </footer>

</div>

<!-- jQuery 3.1.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>