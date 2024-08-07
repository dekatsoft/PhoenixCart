<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_admin_products_attributes_add_attribute {

  public function listen_injectBodyEnd() {
    global $action;
    
    $helper = <<<accordion
<script>$(document).ready(function() { var active = sessionStorage.getItem('activeTab'); if (active) { $('#' + active + '').collapse('show'); } $('#accordionAttributes').on('shown.bs.collapse', function (e) { sessionStorage.setItem('activeTab', e.target.id); }) });</script>

accordion;

    if ($action != 'update_attribute') {
      $helper .= <<<addat
<script>$('select[name="products_id"], select[name="options_id"], select[name="values_id"], input[name="price_prefix"], input[name="value_price"]').prop('required', true); $('select[name="options_id"], select[name="values_id"], input[name="price_prefix"], input[name="value_price"]').prop('disabled', true); $('select[name="products_id"]').change(function() { $('select[name="options_id"]').prop('disabled', false); }); $('select[name="options_id"]').change(function(){ $('select[name="values_id"]').prop('selectedIndex',0); $('select[name="values_id"]').prop('disabled', false); $('select[name="values_id"] option').show(); var id = $(this).val(); $('select[name="values_id"] option[data-id]:not([data-id*="' + id + '"])').hide(); }); $('select[name="values_id"]').change(function() { $('input[name="value_price"], input[name="price_prefix"]').prop('disabled', false); });</script>

addat;
    }
    elseif ($action == 'update_attribute') {
      $helper .= <<<addat
<script>var selectedOption = $('select[name="options_id"]').find(':selected').val(); $('select[name="values_id"] option[data-id]:not([data-id*="' + selectedOption + '"])').hide(); $('select[name="options_id"]').change(function() { $('select[name="values_id"]').prop('selectedIndex',0); var id = $(this).val(); $('select[name="values_id"] option').show(); $('select[name="values_id"] option[data-id]:not([data-id*="' + id + '"])').hide(); });</script>

addat;
    }
    
    return $helper;
  } 

}
