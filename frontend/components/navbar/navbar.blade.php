<div id="navbar" class="row">
    <div class="access-content">
        
        @foreach( components( 'navbar') as $ordem => $item )
            <div class="access-link {{ navbar( $item->text, true ) }}" {!! clickOpen( $item->link ) !!}>
                {{ $item->text }}
 
                @if( editMode() )
                    <a href="{{ deleteLink( $item->id ) }}">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    <a href="{{  editLink( 'edit', 'navbar', $ordem + 1, $item->id ) }}">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="{{  editLink( 'add', 'navbar', $ordem + 1)  }}">
                        <i class="fa fa-plus"></i>
                    </a>
                @endif
            </div>        
        @endforeach

        @if( editMode() )
        <div    class="access-link rounded" 
                style="border: 1px dashed #999; color: #999"
                data-toggle="modal" 
                data-target="#exampleModal"
                onclick="location.href = '{{  editLink( 'add', 'navbar', count( components( 'navbar') ) + 1 )  }}'"
                title="Adicionar item ao navbar" >
            <i class="fa fa-plus"></i>
        </div><!-- item de edição -->
        @endif
        
    </div>
    <div class="clearfix"></div>
</div>