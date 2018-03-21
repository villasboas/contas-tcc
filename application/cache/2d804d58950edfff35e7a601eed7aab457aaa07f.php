<?php $__env->startSection('content'); ?>

    <?php echo form_open( 'auth/signup', [ 'class' => 'pb-5 col-md-4 offset-md-4'] ); ?>


        <?php echo inputText( 'Nome', 'name', [ 'icon' => 'user', 'attr' => [ 'value' => $user->name ] ] ); ?>

        <?php echo inputEmail( 'E-mail','email', [ 'icon' => 'at', 'attr' => [ 'value' => $user->email ]  ] ); ?>

        <?php echo inputPassword( 'Senha', 'password', [ 'icon' => 'lock' ] ); ?>

        <?php echo inputPassword( 'Digite a senha novamente', 'confirm', [ 'icon' => 'lock' ] ); ?>


        <div class="row mt-3">
            <div class="col text-right">
                <a class="text-light" href="<?php echo e(site_url( 'auth' )); ?>">Voltar ao login</a>
            </div>
        </div><!-- links de ação -->

        <?php echo $__env->make( 'components.error-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row mt-3" style="padding-bottom: 100px">
            <div class="col">
                <button class="btn btn-block btn-success">Criar conta</button>
            </div>
        </div><!-- botao de login -->
    <?php echo form_close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>