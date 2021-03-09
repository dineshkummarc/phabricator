<?php

final class DiffusionAuditorsSearchEngineAttachment
  extends PhabricatorSearchEngineAttachment {

  public function getAttachmentName() {
    return pht('Diffusion Auditors');
  }

  public function getAttachmentDescription() {
    return pht('Get the auditors for each commit.');
  }

  public function willLoadAttachmentData($query, $spec) {
    $query->needAuditRequests(true);
  }

  public function getAttachmentForObject($object, $data, $spec) {
    $auditors = $object->getAudits();

    $list = array();
    foreach ($auditors as $auditor) {
      $list[] = array(
        'auditorPHID' => $auditor->getAuditorPHID(),
      );
    }

    return array(
      'auditors' => $list,
    );
  }

}