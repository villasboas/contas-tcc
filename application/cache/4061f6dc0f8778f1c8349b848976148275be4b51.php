<?php $__env->startSection('content'); ?>
    <?php echo $__env->make( 'components.helpbar.helpbar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <?php echo $__env->make( 'components.header.header' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
        <div class="row">

            <div class="col-md-6">

                <div class="row mt-2">
                    <div class="col">
                        <div class="media clicable">
                            <i class="fa fa-lock fa-4x text-muted mr-4"></i>
                            <div class="media-body">
                                <h5 class="mt-0">Login</h5>
                                <p class="font-12">
                                    <small>Já possuí uma conta?</small><br>
                                    <a href="<?php echo e(site_url( 'auth' )); ?>">
                                        Clique aqui para voltar ao login
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- link login -->

                <div class="row mt-2">
                    <div class="col">
                        <div class="media clicable">
                            <i class="fa fa-lock fa-4x text-muted mr-4"></i>
                            <div class="media-body">
                                <h5 class="mt-0">Recuperar senha</h5>
                                <p class="font-12">
                                    <small>Perdeu ou não se lembra da sua senha?</small><br>
                                    <a href="<?php echo e(site_url( 'auth/forgot_password' )); ?>">Clique aqui para recuperar sua senha</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- link recuperar senha -->
            </div>

            <?php echo form_open( 'auth/signup', [ 'class' => 'pb-5 col-md-6'] ); ?>


                <div class="page-header" >
                    <h2>Cadastre-se</h2>
                </div>

                <?php echo inputText( 'Nome', 'name', [ 'attr' => [ 'value' => $user->name ] ] ); ?>

                <?php echo inputEmail( 'E-mail','email', [ 'attr' => [ 'value' => $user->email ]  ] ); ?>

                <?php echo inputPassword( 'Senha', 'password', [ 'lock' ] ); ?>

                <?php echo inputPassword( 'Digite a senha novamente', 'confirm' ); ?>


                <?php echo $__env->make( 'components.error-alert.error-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Criar conta</button>
                    </div>
                </div><!-- botao de login -->
            <?php echo form_close(); ?>

        </div>

        <?php echo $__env->make( 'components.footer.footer' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>