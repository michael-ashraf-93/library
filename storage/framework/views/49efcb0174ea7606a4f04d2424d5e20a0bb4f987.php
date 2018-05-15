<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        Show User
    </h1>
</section>
<div class="content">
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">



                <!-- Name Field -->
                <div class="form-group">
                    <?php echo Form::label('name', 'Name:'); ?>

                    <p><?php echo $user->name; ?></p>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <?php echo Form::label('email', 'Email:'); ?>

                    <p><?php echo $user->email; ?></p>
                </div>


                <!-- Created at Field -->
                <div class="form-group">
                    <?php echo Form::label('created_at', 'Created:'); ?>

                    <p><?php echo $user->created_at->diffForHumans(); ?></p>
                </div>

                <!-- Updated at Field -->
                <div class="form-group">
                    <?php echo Form::label('updated_at', 'Update:'); ?>

                    <p><?php echo $user->updated_at->diffForHumans(); ?></p>
                </div>

                <a href="/" class="btn btn-default">Back</a>
                <a href="/user/<?php echo e(Auth::user()->id); ?>/edit" class='btn btn-primary'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/user/<?php echo e(Auth::user()->id); ?>/destroy" class='btn btn-danger'><i class="glyphicon glyphicon-trash"></i></a>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('.user.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>