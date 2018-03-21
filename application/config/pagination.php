<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagination configuration
 * 
 */
$config['pagination']['cur_tag_open'] 	  = '<li class="page-item active"><span class="page-link">';
$config['pagination']['num_tag_open'] 	  = '<li class="page-item"><span class="page-link">';
$config['pagination']['last_tag_open'] 	  = '<li class="page-item"><span class="page-link">';
$config['pagination']['full_tag_open'] 	  = '<div class="pagging text-center"><nav><ul class="pagination">';
$config['pagination']['num_tag_close'] 	  = '</span></li>';
$config['pagination']['cur_tag_close'] 	  = '<span class="sr-only">(current)</span></span></li>';
$config['pagination']['next_tag_open'] 	  = '<li class="page-item"><span class="page-link">';
$config['pagination']['prev_tag_open'] 	  = '<li class="page-item"><span class="page-link">';
$config['pagination']['first_tag_open']   = '<li class="page-item"><span class="page-link">';
$config['pagination']['full_tag_close']   = '</ul></nav></div>';
$config['pagination']['last_tagl_close']  = '</span></li>';
$config['pagination']['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['pagination']['prev_tagl_close']  = '</span></li>';
$config['pagination']['first_tagl_close'] = '</span></li>';
$config['pagination']['use_page_numbers'] = TRUE;

// End of file