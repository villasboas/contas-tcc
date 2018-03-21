<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA midia                                           
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
    'constraint' => 255,
    'null' => false,
  ),
  'hash' => 
  array (
    'type' => 'varchar',
    'constraint' => 32,
    'null' => false,
  ),
  'type' => 
  array (
    'type' => 'varchar',
    'constraint' => 10,
    'null' => true,
  ),
  'size' => 
  array (
    'type' => 'int',
    'constraint' => 255,
    'null' => true,
  ),
  'ext' => 
  array (
    'type' => 'varchar',
    'constraint' => 4,
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
);

/* end of file */