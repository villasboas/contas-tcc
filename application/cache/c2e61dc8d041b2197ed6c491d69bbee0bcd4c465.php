<?php $__env->startSection('content'); ?>
    <?php echo form_open( 'auth', [ 'class' => 'pb-5 col-md-4 offset-md-4'] ); ?>


        <?php echo inputEmail( 'E-mail','email', [ 'icon' => 'at', 'attr' => [ 'value' => $user->email, 'required' => 'required' ]  ] ); ?>

        <?php echo inputPassword( 'Senha', 'password', [ 'icon' => 'lock', 'attr' => [ 'required' => 'required' ] ] ); ?>


        <div class="row mt-3">
            <div class="col">
                <a class="text-light" href="<?php echo e(site_url( 'auth/forgot_password' )); ?>">
                    Esqueci minha senha
                </a>
            </div>
            <div class="col text-right">
                <a class="text-light" href="<?php echo e(site_url( 'auth/signup' )); ?>">
                    Criar uma conta
                </a>
            </div>
        </div><!-- links de ação -->
        
        <?php echo $__env->make( 'components.error-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-block btn-success">Entrar</button>
            </div>
        </div><!-- botao de login -->

    <?php echo form_close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>