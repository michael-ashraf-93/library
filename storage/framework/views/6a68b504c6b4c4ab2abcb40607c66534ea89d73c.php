<?php $__env->startSection('content'); ?>




    <section class="content-header">
        <h1 class="pull-left">Books :</h1>

        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="/admin/create/book">Add
                New Book</a>
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
                        <th>Book</th>
                        <th>Serial</th>
                        <th>Category</th>
                        <th>Author Name</th>
                        <th>Status</th>
                        <th>Publication Date</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>


                            <td>


                                <?php if(isset($book->book_name)): ?>

                                    <span style="color:#33cc33"><?php echo e($book->book_name); ?> </span>

                                <?php else: ?>

                                    <span style="color:#ff0000">Unknown </span>

                                <?php endif; ?>


                            </td>
                            <td><?php echo $book->serial; ?></td>
                            <td><?php echo $book->category; ?></td>
                            <td><?php echo $book->author_name; ?></td>

                            <td>

                                <?php if($book->status == 'available'): ?>
                                    <span style="color:#33cc33"> Available </span>
                                <?php elseif($book->status == 'unavailable'): ?>
                                    <span style="color:#ff0000"> Unavailable </span>
                                <?php endif; ?>

                            <td><?php echo \Carbon\Carbon::parse($book->publication_date)->format('d-m-Y'); ?></td>


                            </td>

                            <td><?php echo $book->created_at->diffForHumans(); ?></td>
                            <td><?php echo $book->updated_at->diffForHumans(); ?></td>


                            <td>

                                <a href="/admin/<?php echo e($book->id); ?>/editBook" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-edit"></i></a>


                                <?php if($book->status == 'available'): ?>

                                    <a href="/admin/<?php echo e($book->id); ?>/unavailableBook" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>


                                <?php elseif($book->status == 'unavailable'): ?>
                                    <a href="/admin/<?php echo e($book->id); ?>/availableBook" class='btn btn-success btn-xs'>Book Returned<i
                                                class="glyphicon glyphicon-ok"></i></a>

                                <?php endif; ?>

                                <a href="/admin/<?php echo e($book->id); ?>/destroyBook" class='btn btn-danger btn-xs' type="submit"
                                   name="Delete" value="Delete" onclick="return confirm('Are you sure?')"><i
                                            class="glyphicon glyphicon-trash"></i></a>


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