<table>
    <tr>
        <td>id</td>
        <?php $__currentLoopData = $model->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <td><?php echo e($item); ?></td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    <?php $__currentLoopData = $dados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <tr>
        <td><?php echo e($dado->id); ?></td>
        <?php $__currentLoopData = $model->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <td><?php echo e($dado->{$item}); ?></td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>