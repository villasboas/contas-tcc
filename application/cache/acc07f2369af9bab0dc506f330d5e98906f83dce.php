<?php if( isset( $errorBody ) && !empty( $errorBody ) ): ?>
<div class="alert alert-danger">
    <?php if( $errorTitle ): ?>
    <b><?php echo e($errorTitle); ?></b>
    <?php endif; ?>
    <p><?php echo $errorBody; ?></p>
</div>
<?php endif; ?>
