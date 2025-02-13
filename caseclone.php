<?php

require_once 'caseclone.civix.php';
use CRM_Caseclone_ExtensionUtil as E;

function caseclone_civicrm_searchTasks($objectName, &$tasks) {
  if ($objectName == 'case') {
    $tasks[] = [
      'title' => 'Clone Case (Default Activities)',
      'class' => 'CRM_Caseclone_Form_CaseClone',
      'result' => FALSE,
    ];
    $tasks[] = [
      'title' => 'Clone Case (Clone Activities)',
      'class' => 'CRM_Caseclone_Form_CaseCloneActivities',
      'result' => FALSE,
    ];
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function caseclone_civicrm_config(&$config) {
  _caseclone_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function caseclone_civicrm_install() {
  _caseclone_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function caseclone_civicrm_enable() {
  _caseclone_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function caseclone_civicrm_navigationMenu(&$menu) {
  _caseclone_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _caseclone_civix_navigationMenu($menu);
} // */
