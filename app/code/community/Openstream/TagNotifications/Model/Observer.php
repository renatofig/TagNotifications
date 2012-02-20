<?php

class Openstream_TagNotifications_Model_Observer
{
	public function sendNewTagsNotification($observer)
	{
		$templateId = Mage::getStoreConfig('tagnotifications/admin_notification_email/template');
		$name_to = '';
		$email_to = Mage::getStoreConfig('contacts/email/recipient_email');
		$sender = Array('name'  => Mage::getStoreConfig('trans_email/ident_general/name'), 'email' => Mage::getStoreConfig('trans_email/ident_general/email'));
		$storeId = Mage::app()->getStore()->getId(); 
	
		$translate  = Mage::getSingleton('core/translate');
		Mage::getModel('core/email_template')
			->setTemplateSubject(Mage::helper('tagnotifications')->__('New Tags'))
			->sendTransactional($templateId, $sender, $email_to, $name_to, $vars, $storeId);
		$translate->setTranslateInline(true);
	}
}

?>