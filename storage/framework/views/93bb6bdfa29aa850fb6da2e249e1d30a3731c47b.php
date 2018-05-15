<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">Books :</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>

                        <th>Book</th>
                        <th>Serial</th>
                        <th width="10%">Category</th>
                        <th>Author Name</th>
                        <th width="10%">Status</th>
                        <th width="12%">Publication Date</th>
                        <th width="10%">Tools</th>

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


                            <td>


                                
                                


                                <?php if($book->status == 'unavailable'): ?>
                                    <button disabled class='btn btn-default btn-xs'><i
                                                class="glyphicon glyphicon-shopping-cart"></i></button>
                                <?php elseif($book->status == 'available'): ?>
                                    <?php if(Auth::user()): ?>
                                        <a href="/user/<?php echo e(Auth::user()->id); ?>/<?php echo e($book->id); ?>/borrowBook"
                                           class='btn btn-success btn-xs'>Borrow Book <i
                                                    class="glyphicon glyphicon-shopping-cart"></i></a>
                                    <?php else: ?>
                                        <button title="You Need To Login First" disabled href="#" class='btn btn-success btn-xs'>Borrow Book <i
                                                    class="glyphicon glyphicon-shopping-cart"></i></button>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>


        <div class="text-center">

        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('.user.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>