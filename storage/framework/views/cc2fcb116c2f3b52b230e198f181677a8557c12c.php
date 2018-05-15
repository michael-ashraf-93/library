<table class="table table-responsive" id="clients-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Tools</th>


    </tr>
    </thead>
    <tbody>

    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>

            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->role; ?></td>
            <td>
                <?php if($user->status == 'online'): ?>
                    <?php if($user->isOnline()): ?>
                    <span style="color:green">Online</span>
                    <?php else: ?>
                <span style="color:orange">Away</span>
                    <?php endif; ?>
                <?php elseif($user->status == 'offline'): ?>
                <span style="color:red">Offline</span>
                <?php endif; ?>
            </td>
            <td><?php echo $user->created_at->diffForHumans(); ?></td>
            <td><?php echo $user->updated_at->diffForHumans(); ?></td>

            <td>
                <form method="POST" action="/admin/<?php echo e($user->id); ?>/destroy">
                    <?php echo e(csrf_field()); ?>


                    <a href="/admin/<?php echo e($user->id); ?>/show" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>

                    <a href="/admin/<?php echo e($user->id); ?>/edit" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>

                    <button class='btn btn-danger btn-xs' type="submit" name="Delete" value="Delete"
                            onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></button>


                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>