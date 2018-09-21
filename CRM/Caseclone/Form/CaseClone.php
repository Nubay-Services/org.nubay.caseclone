<?php
use CRM_Caseclone_ExtensionUtil as E;

class CRM_Caseclone_Form_CaseClone extends CRM_Case_Form_Task {

  public function preProcess() {
    $queryParams = $this->get('queryParams');
    $count = 0;
    foreach ($queryParams as $case) {
      $mark = explode('_', $case[0]);
      if ( $mark[0] == 'mark') {
        try {
          $result = civicrm_api3('Case', 'getsingle', [
            'id' => $mark[2],
          ]);
        }
        catch (CiviCRM_API3_Exception $e) {
          $error = $e->getMessage();
          watchdog('Case Clone', $error);
          CRM_Core_Error::debug_log_message($error);
        }
        if (isset($result)) {
          unset($result['activities']);
          unset($result['id']);
          $params = $result;
          try {
            $result = civicrm_api3('Case', 'create', $params);
          }
          catch (CiviCRM_API3_Exception $e) {
            $error = $e->getMessage();
            watchdog('Case Clone', $error);
            CRM_Core_Error::debug_log_message($error);
          }
          $rows[] = $result;
          $count += 1;
        }
      }
    }
    $message = $count . " New Case(s) Successfully Created";
    CRM_Core_Session::setStatus($message, "Cases Cloned", "success");
    $url = "/civicrm/case/search?reset=1";
    CRM_Utils_System::redirect($url);
    parent::preProcess();
  }

}
