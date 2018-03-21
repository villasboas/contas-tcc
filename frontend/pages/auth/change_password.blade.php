@extends('layouts.master')
@section('content')
    @include( 'components.helpbar.helpbar' )
    <div class="container mt-5">
        <div class="row">
            {!! form_open( 'auth/change_password/'.$token, [ 'class' => 'pb-5 col-md-6 offset-md-3'] ) !!}

                {!! inputEmail( 'E-mail','email', [ 'attr' => [ 'required' => 'required' ]  ] ) !!}
                {!! inputPassword( 'Nova senha','password', [ 'attr' => [ 'required' => 'required' ]  ] ) !!}
                {!! inputPassword( 'Confirme a nova senha','confirm', [ 'attr' => [ 'required' => 'required' ]  ] ) !!}

                <div class="row mt-3">
                    <div class="col text-right">
                        <a class="text-light" href="{{ site_url( 'auth' ) }}">Voltar ao login</a>
                    </div>
                </div><!-- links de ação -->

                @include( 'components.error-alert.error-alert' )
                @include( 'components.success-alert.success-alert' )
            
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-block btn-success">Entrar</button>
                    </div>
                </div><!-- botao de login -->
            {!! form_close() !!}
        </div>
    </div>
@endsection