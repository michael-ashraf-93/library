<?php $__env->startSection('content'); ?>




<section class="content-header">
    <h1 class="pull-left">My Borrows : </h1>
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
                        <th width="25%">Book</th>
                        <th width="25%">Borrowed</th>
                        <th width="25%">Expires</th>
                        <th width="25%">Tools</th>


                    </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        


                        <td>
                            <?php if(isset($borrow->book->book_name)): ?>

                            <span style="color:#33cc33"><?php echo e($borrow->book->book_name); ?> </span>

                            <?php else: ?>

                            <span style="color:#ff0000">Unknown Book</span>

                            <?php endif; ?>
                            


                        </td>

                        
                            
                            
                            
                            
                            
                        
                        
                            
                            
                            
                            
                                
                            


                            

                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                

                            
                            <td><?php echo $borrow->borrow_at->diffForHumans(); ?></td>
                            <td>
                                <?php if(date("Y-m-d H:i:s") >= $borrow->expires_at): ?>
                                <span style="color: red"> You Are Late <i
                                    class="glyphicon glyphicon-time"></i></span>

                                    
                                        
                                        <?php else: ?>
                                        <span style="color: green"><?php echo $borrow->expires_at->diffForHumans(); ?></span>
                                    </td>

                                    <?php endif; ?>


                                    <td>

                                        <?php if(date("Y-m-d H:i:s") <= $borrow->expires_at): ?>

                                        <button disabled class='btn btn-default btn-xs'>Add One More Week <i
                                            class="glyphicon glyphicon-plus"></i></button>

                                            <?php else: ?>
                                            <a href="/user/<?php echo e(Auth::user()->id); ?>/<?php echo e($borrow->id); ?>/addTime"
                                             class='btn btn-success btn-xs'>Add One More Week <i
                                             class="glyphicon glyphicon-plus"></i></a>


                                             <?php endif; ?>


                                             <a href="/user/<?php echo e(Auth::user()->id); ?>/<?php echo e($borrow->id); ?>/returnBook"
                                                 class='btn btn-primary btn-xs'>Return Book  <i
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
<?php echo $__env->make('.user.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>