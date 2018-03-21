<div id="aside">
    <div class="card">
        <div class="card-title-aside">
            Páginas            
        </div>
        <ul class="card-ul">
            <?php if( !auth() ): ?>
            <li>
                <a href="<?php echo e(site_url( 'auth' )); ?>">Login</a>
            </li>
            <li>
                <a href="<?php echo e(site_url( 'auth/signup' )); ?>">Signup</a>
            </li>
            <?php else: ?>
            <li>
                <a href="<?php echo e(site_url( 'auth/logout' )); ?>">Sair</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>