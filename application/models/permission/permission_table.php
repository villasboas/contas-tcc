<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA permission                                           
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
    'null' => false,
  ),
  'group_id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => false,
  ),
  'read' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
    'null' => false,
  ),
  'update' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
    'null' => false,
  ),
  'create' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
    'null' => false,
  ),
  'delete' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
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