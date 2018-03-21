<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA group                                           
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
  'slug' => 
  array (
    'type' => 'varchar',
    'constraint' => 60,
    'null' => false,
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
);

/* end of file */