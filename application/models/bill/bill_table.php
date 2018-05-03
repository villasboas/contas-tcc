<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA bill                                           
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
  'client_id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => false,
  ),
  'bill_of_sale_id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => false,
  ),
  'cnpj' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'portador' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'description' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'value_total' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'tranche_number' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'expiration_date_first_tranche' => 
  array (
    'type' => 'datetime',
    'null' => false,
  ),
  'status' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
    'null' => false,
  ),
  'updated_at' => 
  array (
    'type' => 'datetime',
    'null' => true,
  ),
  'created_at' => 
  array (
    'type' => 'datetime',
    'null' => false,
  ),
);

/* end of file */