<div id="helpbar">
    <div class="container">
        <div class="row">
            <div class="nav-content text-left col">
                <div class="nav-link">Suporte</div>
                <div class="nav-link"  data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Contato</div>
            </div>
            <div class="nav-content text-right col">
                @if ( !auth() )
                <a class="nav-link"  href="{{ site_url( 'auth/signup' ) }}" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Cadastrar</a>               
                <a class="nav-link"  href="{{ site_url( 'auth' ) }}" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Logar</a>               
                @else
                    @if ( admin() )
                    <a class="nav-link"  href="{{ site_url( 'home/modo_de_edicao?redirect='.uri_string() ) }}" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">
                        @if( editMode() )
                        Sair do modo de edição
                        @else
                        Modo de edição
                        @endif
                    </a>
                    @endif     
                <a class="nav-link"  href="{{ site_url( 'auth/logout' ) }}" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Sair</a>               
                @endif
            </div>
        </div>
    </div>
</div>