<?php
use CRM_Caseclone_ExtensionUtil as E;

class CRM_Caseclone_Form_CaseClone extends CRM_Core_Form {

  public function buildQuickForm() {
    $queryParams = $this->get('queryParams');
    $this->assign('queryParams', $queryParams);
    $count = 0;
    foreach ($queryParams as $case) {
      $mark = explode('_', $case[0]);
      if ($mark[0] == 'mark') {
        $count += 1;
      }
    }
    $message = ts($count . ' case(s) will be cloned, are you sure you want to continue?');
    $this->assign('message', $message);
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ),
      array(
        'type' => 'back',
        'name' => E::ts('Cancel'),
        'isDefault' => TRUE,
      ),
    ));
    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $queryParams = $this->get('queryParams');
    $count = 0;
    foreach ($queryParams as $case) {
      $mark = explode('_', $case[0]);
      if ($mark[0] == 'mark') {
        try {
          $result = civicrm_api3('Case', 'getsingle', [
            'id' => $mark[2],
          ]);
          $relationships = civicrm_api3('Relationship', 'get', [
            'sequential' => 1,
            'case_id' => $result['id'],
          ]);
        }
        catch (CiviCRM_API3_Exception $e) {
          $error = $e->getMessage();
          CRM_Core_Error::debug_log_message($error);
        }
        if (isset($relationships)) {
          foreach ($relationships['values'] as $relParams) {
            try {
              unset($relParams['id']);
              unset($relParams['start_date']);
              unset($relParams['case_id']);
              $relParams['case_id'] = $newcase['id'];
              $new = civicrm_api3('Relationship', 'create',
                $relParams);
            }
            catch (CiviCRM_API3_Exception $e) {
              $error = $e->getMessage();
              CRM_Core_Error::debug_log_message($error);
            }
          }
        }
        if (isset($result)) {
          unset($result['activities']);
          unset($result['id']);
          $params = $result;
          $params['subject'] = 'Copy of ' . $params['subject'];
          try {
            $result = civicrm_api3('Case', 'create', $params);
          }
          catch (CiviCRM_API3_Exception $e) {
            $error = $e->getMessage();
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
    parent::postProcess();
  }

  public function getRenderableElementNames() {
    $elementNames = array();
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
