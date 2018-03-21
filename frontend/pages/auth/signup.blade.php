@extends('layouts.master')
@section('content')
    @include( 'components.helpbar.helpbar' )
    <div class="container">
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
            </div>

            {!! form_open( 'auth/signup', [ 'class' => 'pb-5 col-md-6'] ) !!}

                <div class="page-header" >
                    <h2>Cadastre-se</h2>
                </div>

                {!! inputText( 'Nome', 'name', [ 'attr' => [ 'value' => $user->name ] ] ) !!}
                {!! inputEmail( 'E-mail','email', [ 'attr' => [ 'value' => $user->email ]  ] ) !!}
                {!! inputPassword( 'Senha', 'password', [ 'lock' ] ) !!}
                {!! inputPassword( 'Digite a senha novamente', 'confirm' ) !!}

                @include( 'components.error-alert.error-alert' )
            
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Criar conta</button>
                    </div>
                </div><!-- botao de login -->
            {!! form_close() !!}
        </div>

        @include( 'components.footer.footer' )
    </div>
@endsection