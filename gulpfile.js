const gulp        = require('gulp');
const connect     = require('gulp-connect-php');
const elixir      = require( 'laravel-elixir' );
require( 'laravel-elixir-livereload' );

// cria o servidor
const server = new connect();

/**
 * connect
 * 
 * conecta o servidor
 * 
 */
gulp.task('connect', function() {
  server.server();
});

/**
 * disconnect
 * 
 * disconecta o servidor
 * 
 */
gulp.task('disconnect', function() {
  server.closeServer();
});

// Setup do elixir
elixir.config.publicPath = 'public/dist';
elixir.config.assetsPath = 'frontend';

// Chama o elixir
elixir( mix => {
  mix.sass( '../app/app.scss' ).webpack( '../app/app.js' ).livereload([
      'frontend/**.*',
      'frontend/components/**.*',
      'frontend/pages/**.*',
      'frontend/layouts/**.*',
      'public/dist/css/*.css',
      'public/dist/js/*.js'
  ]);
});

// End of file