<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            Edit User
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    <form method="POST" action="/user/<?php echo e($user->id); ?>/update">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('name', 'Name:'); ?>

                            <?php echo Form::text('name', $user->name, ['class' => 'form-control']); ?>

                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('email', 'Email:'); ?>

                            <?php echo Form::text('email', $user->email, ['class' => 'form-control']); ?>

                        </div>


                        <div class="form-group col-sm-6">

                            <strong>Create Date:</strong>

                            <input disabled class="form-control" type="date" name="created_at"
                                   value="<?php echo e(\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')); ?>">
                        </div>


                        <div class="form-group col-sm-6">

                            <strong>Update Date:</strong>

                            <input disabled class="form-control" type="date" name="updated_at"
                                   value="<?php echo e(\Carbon\Carbon::parse($user->updated_at)->format('Y-m-d')); ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                   id="password_confirmation" placeholder="Password Confirmation">
                        </div>


                        <div class="box-body"s>
                            <button class='btn btn-primary btn-xs'>Save</button>
                            <a href="/user/<?php echo e(Auth::user()->id); ?>/profile" class='btn btn-default btn-xs'>Back</i></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('.user.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>