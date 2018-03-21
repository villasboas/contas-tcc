<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA user                                           
 |-------------------------------------------------------------- 
 |                                                               
*/
$config['schema'] = array (
  'id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'primary_key' => true,
    'auto_increment' => true,
    'null' => false,
  ),
  'name' => 
  array (
    'type' => 'varchar',
    'constraint' => 60,
    'null' => false,
  ),
  'email' => 
  array (
    'type' => 'varchar',
    'constraint' => 60,
    'null' => false,
  ),
  'password' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'token_api' => 
  array (
    'type' => 'varchar',
    'constraint' => 32,
    'null' => true,
  ),
  'token_session' => 
  array (
    'type' => 'varchar',
    'constraint' => 32,
    'null' => true,
  ),
  'created_at' => 
  array (
    'type' => 'datetime',
    'null' => false,
  ),
  'updated_at' => 
  array (
    'type' => 'datetime',
    'null' => true,
  ),
  'logged_at' => 
  array (
    'type' => 'datetime',
    'null' => true,
  ),
  'last_attempt' => 
  array (
    'type' => 'datetime',
    'null' => true,
  ),
  'attempt_interval' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => true,
  ),
  'forgot_password_token' => 
  array (
    'type' => 'varchar',
    'constraint' => 32,
    'null' => true,
  ),
  'login_attempts' => 
  array (
    'type' => 'int',
    'constraint' => 1,
    'null' => true,
  ),
);

/* end of file */