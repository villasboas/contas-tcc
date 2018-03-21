@extends('layouts.master')
@section('content')
    @include( 'components.helpbar.helpbar' )
    <div class="container">
        @include( 'components.header.header' )
        <div class="container">
            <div class="row">
                
                <div class="col-md-6">

                    <div class="row mt-2">
                        <div class="col">
                            <div class="media clicable">
                                <i class="fa fa-lock fa-4x text-muted mr-4"></i>
                                <div class="media-body">
                                    <h5 class="mt-0">Recuperar senha</h5>
                                    <p class="font-12">
                                        <small>Perdeu ou não se lembra da sua senha?</small><br>
                                        <a href="{{ site_url( 'auth/forgot_password' ) }}">Clique aqui para recuperar sua senha</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- link recuperar senha -->

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

                </div><!-- links -->

                {!! form_open( 'auth', [ 'class' => 'pb-5 col-md-6'] ) !!}

                    <div class="page-header">
                        <h2>Login</h2>
                    </div>

                    {!! inputEmail( 'E-mail','email', [ 'attr' => [ 'value' => $user->email, 'required' => 'required' ]  ] ) !!}
                    {!! inputPassword( 'Senha', 'password', [ 'attr' => [ 'required' => 'required' ] ] ) !!}

                    <br>
                    @include( 'components.error-alert.error-alert' )
                    
                    <div class="row mt-3">
                        <div class="col">
                            <button class="btn btn-block btn-success">Entrar</button>
                        </div>
                    </div><!-- botao de login -->

                {!! form_close() !!}
            </div>
        </div>
        @include( 'components.footer.footer' )
    </div>
@endsection