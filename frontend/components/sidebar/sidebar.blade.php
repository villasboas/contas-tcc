<div id="sidebar" class="pl-2 pr-2 pb-5 z-depth-1">

    @foreach( components( 'sidebar-group') as $ordem => $item )
    <div class="group-divider">
        <span>
            {{ $item->text }}

            @if( editMode() )
                &nbsp;&nbsp;
                <a href="{{ deleteLink( $item->id ) }}">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a href="{{  editLink( 'edit', 'sidebar-group', $ordem + 1, $item->id ) }}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="{{  editLink( 'add', 'sidebar-group', $ordem + 1)  }}">
                    <i class="fa fa-plus"></i>
                </a>
            @endif
        </span>
    </div>

        @foreach( components( 'sidebar-item', $item->id ) as $index => $link )
        <div class="sidebar-item {{ sidebar( $link->text, true ) }}" {!! clickOpen( $link->link ) !!}>
            <fa class="fa fa-{{$link->icon}}"></fa>
            {{ $link->text }}

            @if( editMode() )
                &nbsp;&nbsp;
                <a href="{{ deleteLink( $link->id ) }}">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a href="{{  editLink( 'edit', 'sidebar-item', $index + 1, $link->id, $item->id ) }}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="{{  editLink( 'add', 'sidebar-item', $index + 1, false, $item->id )  }}">
                    <i class="fa fa-plus"></i>
                </a>
            @endif
        </div>
        @endforeach

        @if( editMode() )
        <a  class="sidebar-item" 
            href="{{  editLink( 'add', 'sidebar-item', $ordem + 1, false, $item->id )  }}"
            style="display:block; border: 1px dashed #999" data-toggle="tooltip" data-placement="left" title="Descrição do link">
            <fa class="fa fa-plus"></fa>
            Novo item
        </a>
        @endif

    @endforeach

    

    @if( editMode() )
    
    <div class="group-divider" style="border: 1px dashed #999">
        <a href="{{ editLink( 'add', 'sidebar-group', count( components( 'sidebar-group') ) + 1 ) }}">
            &nbsp; <fa class="fa fa-plus"></fa> Novo grupo
        </a>
    </div>
    @endif
</div>