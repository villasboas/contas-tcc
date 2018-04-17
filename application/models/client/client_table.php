<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*                                                               
 |-------------------------------------------------------------- 
 | TABELA client                                           
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
  'cnpj' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'social_name' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'fantasy_name' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'representative' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'cpf' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'email' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'state' => 
  array (
    'type' => 'text',
    'constraint' => 255,
    'null' => false,
  ),
  'city' => 
  array (
    'type' => 'text',
    'constraint' => 255,
    'null' => false,
  ),
  'zip_code' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'address' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'address_number' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'complement' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => true,
  ),
  'neighborhood' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'phone_number' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'cellphone_number' => 
  array (
    'type' => 'varchar',
    'constraint' => 255,
    'null' => false,
  ),
  'status' => 
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