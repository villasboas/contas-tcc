<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA component                                           
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
  'component_id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => true,
  ),
  'slug' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'text' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'link' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
  'context' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
  'icon' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
  'position' => 
  array (
    'type' => 'int',
    'constraint' => 11,
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