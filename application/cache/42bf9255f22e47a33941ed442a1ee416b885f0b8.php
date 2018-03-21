<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
  <a class="navbar-brand" href="<?php echo e(site_url( 'home' )); ?>">Singular</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"></ul>

    <ul class="navbar-nav my-2 my-lg-0">
    
      <?php if( auth() ): ?>
      <li class="nav-item">
        <a class="nav-link">
          <?php echo e(auth()->name); ?>

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(site_url( 'auth/logout' )); ?>">
          Sair
        </a>
      </li>
      <?php endif; ?>

      <?php if( !auth() ): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(site_url( 'auth' )); ?>">
          Login
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(site_url( 'auth/signup' )); ?>">
          Signup
        </a>
      </li>
      <?php endif; ?>

    </ul>
  </div>
</nav>