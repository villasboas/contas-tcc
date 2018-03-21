<?php $__env->startSection('content'); ?>
    <?php echo $__env->make( 'components.helpbar.helpbar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container mt-5">
        <div class="row">
            <?php echo form_open( 'auth/change_password/'.$token, [ 'class' => 'pb-5 col-md-6 offset-md-3'] ); ?>


                <?php echo inputEmail( 'E-mail','email', [ 'attr' => [ 'required' => 'required' ]  ] ); ?>

                <?php echo inputPassword( 'Nova senha','password', [ 'attr' => [ 'required' => 'required' ]  ] ); ?>

                <?php echo inputPassword( 'Confirme a nova senha','confirm', [ 'attr' => [ 'required' => 'required' ]  ] ); ?>


                <div class="row mt-3">
                    <div class="col text-right">
                        <a class="text-light" href="<?php echo e(site_url( 'auth' )); ?>">Voltar ao login</a>
                    </div>
                </div><!-- links de ação -->

                <?php echo $__env->make( 'components.error-alert.error-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make( 'components.success-alert.success-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Entrar</button>
                    </div>
                </div><!-- botao de login -->
            <?php echo form_close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>