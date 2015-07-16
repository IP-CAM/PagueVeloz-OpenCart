<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ModelPaymentPagueVeloz extends Model {
	
	public function editSetting($data = array()) {
		
		$this->load->model('extension/event');
		
		$this->model_extension_event->deleteEvent('pagueveloz');
		
		if ($data['pagueveloz_sms_status']) {
			if (isset($data['pagueveloz_post_order_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.order.add', 'event/pagueveloz/postOrderAdd');
			}
			
			if (isset($data['pagueveloz_post_order_edit'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.order.edit', 'event/pagueveloz/postOrderEdit');
			}
			
			if (isset($data['pagueveloz_post_order_delete'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.order.delete', 'event/pagueveloz/postOrderDelete');
			}
			
			if (isset($data['pagueveloz_post_order_history_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.order.history.add', 'event/pagueveloz/postOrderHistoryAdd');
			}
			
			if (isset($data['pagueveloz_post_admin_review_edit'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.admin.review.edit', 'event/pagueveloz/postAdminReviewEdit');
			}
			
			if (isset($data['pagueveloz_post_review_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.review.add', 'event/pagueveloz/postReviewAdd');
			}
			
			if (isset($data['pagueveloz_post_admin_affiliate_approve'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.admin.affiliate.approve', 'event/pagueveloz/postAdminAffiliateApprove');
			}
			
			if (isset($data['pagueveloz_post_admin_affiliate_transaction_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.admin.affiliate.transaction.add', 'event/pagueveloz/affiliateTransactionAdd');
			}
			
			if (isset($data['pagueveloz_post_affiliate_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.affiliate.add', 'event/pagueveloz/postAffiliateAdd');
			}
			
			if (isset($data['pagueveloz_post_affiliate_edit'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.affiliate.edit', 'event/pagueveloz/postAffiliateEdit');
			}
			
			if (isset($data['pagueveloz_post_customer_add'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.customer.add', 'event/pagueveloz/postCustomerAdd');
			}
			
			if (isset($data['pagueveloz_post_customer_edit'])) {
				$this->model_extension_event->addEvent('pagueveloz', 'post.customer.edit', 'event/pagueveloz/postCustomerEdit');
			}
		}
		
		$this->load->model('extension/extension');
		
		$payment_methods = $this->model_extension_extension->getInstalled('payment');
		
		if ($data['pagueveloz_billet_status']) {
			if (!in_array('pagueveloz_billet', $payment_methods)) {
				$this->model_extension_extension->install('payment', 'pagueveloz_billet');
			}
		} else {
			$this->model_extension_extension->uninstall('payment', 'pagueveloz_billet');
		}
		
		$this->load->model('setting/setting');
		
		$this->model_setting_setting->editSetting('pagueveloz', $data);
	}
}