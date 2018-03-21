<?php if( isset( $errors ) && $errors ): ?>
<br>
<div id="error-alert">
    <div class="alert alert-danger" role="alert">
        <?php echo $errors; ?>

    </div>
</div>
<?php endif; ?>
