<div id="helpbar">
    <div class="container">
        <div class="row">
            <div class="nav-content text-left col">
                <div class="nav-link">Suporte</div>
                <div class="nav-link"  data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Contato</div>
            </div>
            <div class="nav-content text-right col">
                <?php if( !auth() ): ?>
                <a class="nav-link"  href="<?php echo e(site_url( 'auth/signup' )); ?>" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Cadastrar</a>               
                <a class="nav-link"  href="<?php echo e(site_url( 'auth' )); ?>" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Logar</a>               
                <?php else: ?>
                    <?php if( admin() ): ?>
                    <a class="nav-link"  href="<?php echo e(site_url( 'home/modo_de_edicao?redirect='.uri_string() )); ?>" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">
                        <?php if( editMode() ): ?>
                        Sair do modo de edição
                        <?php else: ?>
                        Modo de edição
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>     
                <a class="nav-link"  href="<?php echo e(site_url( 'auth/logout' )); ?>" data-toggle="tooltip" data-placement="bottom" title="Descrição do link">Sair</a>               
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>