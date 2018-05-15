<?php $__env->startSection('content'); ?>




    <section class="content-header">
        <h1 class="pull-left">Borrows : </h1>
        
        
        
        
        
        
        
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Borrowed</th>
                        <th>Expires</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td>
                                <?php if(isset($borrow->user->name)): ?>

                                    <span style="color:#33cc33"><?php echo e($borrow->user->name); ?> </span>

                                <?php else: ?>

                                    <span style="color:#ff0000">Unknown User</span>

                                <?php endif; ?>

                            </td>

                            <td>
                                <?php if(isset($borrow->book->book_name)): ?>
                                    <?php echo $borrow->book->book_name; ?>

                                <?php else: ?>
                                    <span style="color:#ff0000">Unknown </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($borrow->borrow_at)): ?>
                                    <?php echo $borrow->borrow_at->diffForHumans(); ?>

                                <?php else: ?>
                                    <span style="color:#ff0000">Unknown </span>
                                <?php endif; ?>
                            </td>

                            <td>

                                <?php if(isset($borrow->expires_at)): ?>
                                    <?php echo $borrow->expires_at->diffForHumans(); ?>

                                <?php else: ?>
                                    <span style="color:#ff0000">Unknown </span>
                                <?php endif; ?>

                            </td>

                            <td><?php echo $borrow->created_at->diffForHumans(); ?></td>
                            <td><?php echo $borrow->updated_at->diffForHumans(); ?></td>


                            <td>
                                
                                            

                                <?php if(isset($comment->post_id)): ?>
                                    <a href="/admin/<?php echo e($comment->post_id); ?>/showcomments"
                                       class='btn btn-default btn-xs'><i
                                                class="glyphicon glyphicon-eye-open"></i></a>
                                <?php endif; ?>


                                <a href="/admin/<?php echo e($borrow->id); ?>/destroyBorrow" class='btn btn-success btn-xs'
                                   type="submit"
                                   name="Delete" value="Delete" onclick="return confirm('Are you sure?')">Book Returned <i
                                            class="glyphicon glyphicon-ok"></i></a>


                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('.admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>