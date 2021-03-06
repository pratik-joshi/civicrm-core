<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.3                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2013                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 * $Id$
 *
 */

/**
 * Adds inline help
 *
 * @param array  $params the function params
 * @param object $smarty reference to the smarty object
 *
 * @return string the help html to be inserted
 * @access public
 */
function smarty_function_help($params, &$smarty) {
  if (!isset($params['id']) || !isset($smarty->_tpl_vars['config'])) {
    return;
  }

  // Legacy support for old-style $params['text']
  // TODO: This is probably no longer used, so remove
  $help = '';
  if (isset($params['text'])) {
    $help = '<div class="crm-help">' . $params['text'] . '</div>';
  }

  if (empty($params['file']) && isset($smarty->_tpl_vars['tplFile'])) {
    $params['file'] = $smarty->_tpl_vars['tplFile'];
  }
  elseif (empty($params['file'])) {
    return $help;
  }

  $params['file'] = str_replace(array('.tpl', '.hlp'), '', $params['file']);

  if (empty($params['title'])) {
    // Avod overwriting existing vars CRM-11900
    $oldID = $smarty->get_template_vars('id');
    $smarty->assign('id', $params['id'] . '-title');
    $name = trim($smarty->fetch($params['file'] . '.hlp'));
    $smarty->assign('id', $oldID);
  }
  else {
    $name = trim(strip_tags($params['title']));
  }
  $title = ts('%1 Help', array(1 => $name));
  unset($params['text'], $params['title']);
  // Format params to survive being passed through json & the url
  foreach ($params as &$param) {
    $param = is_bool($param) || is_numeric($param) ? (int) $param : (string) $param;
  }
  return '<a class="helpicon" title="' . $title . '" href=\'javascript:CRM.help("' . $name . '", ' . json_encode($params) . ')\'>&nbsp;</a>';
}
