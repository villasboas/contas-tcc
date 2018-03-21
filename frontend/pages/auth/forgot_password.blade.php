@extends('layouts.master')
@section('content')
    @include( 'components.helpbar.helpbar' )
    <div class="container mt-5">
        @include( 'components.header.header' )

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
                                    <a href="{{ site_url( 'auth' ) }}">
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
                                    <a href="{{ site_url( 'auth/signup' ) }}">
                                        Clique aqui para criar uma conta
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- link criar conta -->

            </div>

            {!! form_open( 'auth/forgot_password', [ 'class' => 'pb-5 col-md-6'] ) !!}
                <div class="page-header">
                    <h4>Esqueci minha senha</h4>
                </div>
                
                {!! inputEmail( 'E-mail','email', [ 'attr' => [ 'value' => $user->email, 'required' => 'required' ]  ] ) !!}
                <br>
                @include( 'components.error-alert.error-alert' )
                @include( 'components.success-alert.success-alert' )
                
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Entrar</button>
                    </div>
                </div><!-- botao de login -->
            {!! form_close() !!}
        </div>

        @include( 'components.footer.footer' )
    </div>
@endsection