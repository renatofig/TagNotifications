<?php
 
 require_once('Mage/Tag/controllers/IndexController.php');

 class Openstream_TagNotifications_IndexController extends Mage_Tag_IndexController
 {
 
  protected function _fillMessageBox($counter){
   parent::_fillMessageBox($counter);
   
   if($number_of_new_tags = $counter->getNew()){
    $templateId = Mage::getStoreConfig('tagnotifications/admin_notification_email/template');
	$name_to = '';
	$email_to = Mage::getStoreConfig('contacts/email/recipient_email');
    $sender = Array('name'  => Mage::getStoreConfig('trans_email/ident_general/name'), 'email' => Mage::getStoreConfig('trans_email/ident_general/email'));

    $vars = Array('number_of_new_tags' => $number_of_new_tags);
    $storeId = Mage::app()->getStore()->getId(); 

    $translate  = Mage::getSingleton('core/translate');
    Mage::getModel('core/email_template')
        ->setTemplateSubject($this->__('New Tags'))
        ->sendTransactional($templateId, $sender, $email_to, $name_to, $vars, $storeId);
    $translate->setTranslateInline(true);
   }
  }

 }

?>