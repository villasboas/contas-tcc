<?php $__env->startSection('content'); ?>
    <?php echo $__env->make( 'components.helpbar.helpbar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container mt-5">
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
                            <i class="fa fa-user fa-4x text-muted mr-4"></i>
                            <div class="media-body">
                                <h5 class="mt-0">Criar conta</h5>
                                <p class="font-12">
                                    <small>Ainda não possuí uma conta?</small><br>
                                    <a href="<?php echo e(site_url( 'auth/signup' )); ?>">
                                        Clique aqui para criar uma conta
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- link criar conta -->

            </div>

            <?php echo form_open( 'auth/forgot_password', [ 'class' => 'pb-5 col-md-6'] ); ?>

                <div class="page-header">
                    <h4>Esqueci minha senha</h4>
                </div>
                
                <?php echo inputEmail( 'E-mail','email', [ 'attr' => [ 'value' => $user->email, 'required' => 'required' ]  ] ); ?>

                <br>
                <?php echo $__env->make( 'components.error-alert.error-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make( 'components.success-alert.success-alert' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Entrar</button>
                    </div>
                </div><!-- botao de login -->
            <?php echo form_close(); ?>

        </div>

        <?php echo $__env->make( 'components.footer.footer' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>