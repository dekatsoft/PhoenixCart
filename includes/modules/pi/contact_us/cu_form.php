<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  class cu_form extends abstract_module {

    const CONFIG_KEY_BASE = 'CU_FORM_';

    public $group = 'cu_modules_b';
    public $content_width;

    public function __construct() {
      parent::__construct();

      $this->group = basename(dirname(__FILE__));

      $this->description .= '<div class="alert alert-warning">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';
      $this->description .= '<div class="alert alert-info">' . cm_cu_modular::display_layout() . '</div>';

      if ( $this->enabled ) {
        $this->group = 'cu_modules_' . strtolower(CU_FORM_GROUP);
        $this->content_width = CU_FORM_CONTENT_WIDTH;
      }
    }

    public function getOutput() {
      $contact_us_href = $GLOBALS['Linker']->build('contact_us.php');
      
      $tpl_data = ['group' => $this->group, 'file' => __FILE__];
      include 'includes/modules/block_template.php';
    }

    protected function get_parameters() {
      return [
        'CU_FORM_STATUS' => [
          'title' => 'Enable Form',
          'value' => 'True',
          'desc' => 'Should this module be shown?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        'CU_FORM_GROUP' => [
          'title' => 'Module Display',
          'value' => 'A',
          'desc' => 'Where should this module display?',
          'set_func' => "Config::select_one(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'], ",
        ],
        'CU_FORM_CONTENT_WIDTH' => [
          'title' => 'Content Width',
          'value' => 'col-12',
          'desc' => 'What width container should the content be shown in?',
        ],
        'CU_FORM_SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '115',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
      ];
    }

  }
