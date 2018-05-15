<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://cssanimation.rocks/images/posts/wwdc15/step1.png" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <?php if(Auth::guest()): ?>
                <p>Dashboard</p>
                <?php else: ?>
                    <p><?php echo e(Auth::user()->name); ?></p>
                <?php endif; ?>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i><?php echo e(ucfirst(Auth::user()->role)); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            <?php echo $__env->make('.admin.layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>