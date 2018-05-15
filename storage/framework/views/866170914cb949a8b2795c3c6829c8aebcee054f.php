<?php if(Auth::user()): ?>

    <li>
        <a href="/user/<?php echo e(Auth::user()->id); ?>/profile"><i class="fa fa-edit"></i><span>Profile</span></a>
    </li>


    
    <li>
        <a href="/user/books"><i class="fa fa-edit"></i><span>Books</span></a>
    </li>


    <li>
        <a href="/user/<?php echo e(Auth::user()->id); ?>/borrows"><i class="fa fa-edit"></i><span>Borrows</span></a>
    </li>

<?php else: ?>

    <li>
        <a href="/user/books"><i class="fa fa-edit"></i><span>Books</span></a>
    </li>

<?php endif; ?>