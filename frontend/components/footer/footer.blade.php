<div id="footer" class="row mt-5 pt-5">
    <div class="col">
        <div class="row">
                        
            @foreach( components( 'footer') as $ordem => $item )
            <div class="col-md-3 footer-item">
                <div class="footer-item-title">
                    <span>
                        {{ $item->text }}
                        @if( editMode() )
                            <a href="{{ deleteLink( $item->id ) }}">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            <a href="{{  editLink( 'edit', 'footer', $ordem + 1, $item->id ) }}">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="{{  editLink( 'add', 'footer', $ordem + 1)  }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        @endif
                    </span>
                </div>
                
                @foreach( components( 'footer-item', $item->id ) as $index => $link )
                <a href="{{ $link->link }}" class="footer-item-link" style="display: inline-block">

                    @if( $link->icon )
                    <i class="fa fa-{{ $link->icon }}"></i>
                    @endif

                    &nbsp;&nbsp;{{ $link->text }}

                    @if( editMode() )
                        <a href="{{ deleteLink( $link->id ) }}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        <a href="{{  editLink( 'edit', 'footer-item', $index + 1, $link->id, $item->id ) }}">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a href="{{  editLink( 'add', 'footer-item', $index + 1, false, $item->id )  }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </a>
                <br>
                @endforeach

                @if( editMode() )
                <a  href="{{  editLink( 'add', 'footer-item', $ordem + 1, false, $item->id )  }}" class="footer-item-link" 
                    style="display: inline-block; border: 1px dashed #999; color: #999">
                    Novo item                    
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                @endif
            </div>
            @endforeach

            @if( editMode() )
            <div class="col-md-2 footer-item" >
                <div class="footer-item-title">
                    <a href="{{ editLink( 'add', 'footer', count( components( 'footer') ) + 1 ) }}" class="p-2 clicable" style="border: 1px dashed #999; color: #999">
                        Novo grupo
                        <i class="fa fa-plus"></i>     
                    </a>
                </div>
            </div>
            @endif
        </div>
        <div class="row footer-rights mt-4 pt-4 pb-5">
            <div class="col text-center">
                <b>{{ sitename() }} 2017 - Todos os direitos reservados.</b>                
            </div>
        </div>
    </div>
</div>