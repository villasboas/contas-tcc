<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA tranche                                           
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
  'bill_id' => 
  array (
    'type' => 'int',
    'constraint' => 11,
    'null' => false,
  ),
  'value' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'expiration_date' => 
  array (
    'type' => 'datetime',
    'null' => false,
  ),
  'payment_date' => 
  array (
    'type' => 'datetime',
    'null' => true,
  ),
  'paid_value' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
  'status' => 
  array (
    'type' => 'varchar',
    'constraint' => 1,
    'null' => false,
  ),
  'interest_rate' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
);

/* end of file */