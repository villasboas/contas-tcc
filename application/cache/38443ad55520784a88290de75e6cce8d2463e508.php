<?php if( isset( $successBody ) && !empty( $successBody ) ): ?>
<div class="alert alert-danger">
    <?php if( $successTitle ): ?>
    <b><?php echo e($successTitle); ?></b>
    <?php endif; ?>
    <p><?php echo $successBody; ?></p>
</div>
<?php endif; ?>