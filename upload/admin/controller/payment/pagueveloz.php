<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerPaymentPagueVeloz extends Controller {
	
	private $error = array();
	
	public function index() {
		$data = array();
		
		$this->language->load('payment/pagueveloz');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('payment/pagueveloz');
			
			$this->model_payment_pagueveloz->editSetting($this->request->post);
			
			$data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token']));
		}
		
		$data['text_form'] = $this->language->get('text_form');
		$data['text_config'] = $this->language->get('text_config');
		$data['text_billet'] = $this->language->get('text_billet');
		$data['text_sms'] = $this->language->get('text_sms');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_field_requried'] = $this->language->get('text_field_requried');
		$data['text_save'] = $this->language->get('text_save');
		$data['text_geral'] = $this->language->get('text_geral');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_event'] = $this->language->get('text_event');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sms'] = $this->language->get('entry_sms');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_token'] = $this->language->get('entry_token');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_expiration'] = $this->language->get('entry_expiration');
		$data['entry_note'] = $this->language->get('entry_note');
		$data['entry_cedente'] = $this->language->get('entry_cedente');
		$data['entry_cpf_cedente'] = $this->language->get('entry_cpf_cedente');
		$data['entry_order_status_printed'] = $this->language->get('entry_order_status_printed');
		$data['entry_order_status_canceled'] = $this->language->get('entry_order_status_canceled');
		$data['entry_order_status_complete'] = $this->language->get('entry_order_status_complete');
		$data['entry_order'] = $this->language->get('entry_order');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$data['entry_customer'] = $this->language->get('entry_customer');
		
		$data['help_status'] = $this->language->get('help_status');
		$data['help_sms'] = $this->language->get('help_sms');
		$data['help_email'] = $this->language->get('help_email');
		$data['help_telephone'] = $this->language->get('help_telephone');
		$data['help_token'] = $this->language->get('help_token');
		$data['help_geo_zone'] = $this->language->get('help_geo_zone');
		$data['help_sort_order'] = $this->language->get('help_sort_order');
		$data['help_billet_status'] = $this->language->get('help_billet_status');
		$data['help_billet_expiration'] = $this->language->get('help_billet_expiration');
		$data['help_billet_note'] = $this->language->get('help_billet_note');
		$data['help_billet_cedente'] = $this->language->get('help_billet_cedente');
		$data['help_billet_cpfcedente'] = $this->language->get('help_billet_cpfcedente');
		$data['help_order_add'] = $this->language->get('help_order_add');
		$data['help_order_edit'] = $this->language->get('help_order_edit');
		$data['help_order_delete'] = $this->language->get('help_order_delete');
		$data['help_order_history_add'] = $this->language->get('help_order_history_add');
		$data['help_review_edit'] = $this->language->get('help_review_edit');
		$data['help_review_add'] = $this->language->get('help_review_add');
		$data['help_affiliate_approve'] = $this->language->get('help_affiliate_approve');
		$data['help_affiliate_transaction_add'] = $this->language->get('help_affiliate_transaction_add');
		$data['help_affiliate_add'] = $this->language->get('help_affiliate_add');
		$data['help_affiliate_edit'] = $this->language->get('help_affiliate_edit');
		$data['help_customer_add'] = $this->language->get('help_customer_add');
		$data['help_customer_edit'] = $this->language->get('help_customer_edit');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		/* Error */
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = false;
		}
		
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = false;
		}
		
		if (isset($this->error['token'])) {
			$data['error_token'] = $this->error['token'];
		} else {
			$data['error_token'] = false;
		}
		
		if (isset($this->error['sms_telephone'])) {
			$data['error_sms_telephone'] = $this->error['sms_telephone'];
		} else {
			$data['error_sms_telephone'] = false;
		}
		
		if (isset($this->error['cpf_cnpj_cedente'])) {
			$data['error_cpf_cnpj_cedente'] = $this->error['cpf_cnpj_cedente'];
		} else {
			$data['error_cpf_cnpj_cedente'] = false;
		}
		
		/* Breadcrumb */
		$data['breadrumbs'] = array();
		
		$data['breadrumbs'][] = array(
			'href' => $this->url->link('common/dashboard'),
			'name' => $this->language->get('text_home')
		);
		
		$data['breadrumbs'][] = array(
			'href' => $this->url->link('extension/payment'),
			'name' => $this->language->get('text_payment')
		);
		
		$data['breadrumbs'][] = array(
			'href' => $this->url->link('payment/pagueveloz'),
			'name' => $this->language->get('heading_title')
		);
		
		/* Status */
		if (isset($this->request->post['pagueveloz_status'])) {
			$data['pagueveloz_status'] = $this->request->post['pagueveloz_status'];
		} else {
			$data['pagueveloz_status'] = $this->config->get('pagueveloz_status');
		}
		
		/* SMS Status */
		if (isset($this->request->post['pagueveloz_sms_status'])) {
			$data['pagueveloz_sms_status'] = $this->request->post['pagueveloz_sms_status'];
		} else {
			$data['pagueveloz_sms_status'] = $this->config->get('pagueveloz_sms_status');
		}
		
		/* SMS Telephone */
		if (isset($this->request->post['pagueveloz_sms_telephone'])) {
			$data['pagueveloz_sms_telephone'] = $this->request->post['pagueveloz_sms_telephone'];
		} else {
			$data['pagueveloz_sms_telephone'] = $this->config->get('pagueveloz_sms_telephone');
		}
		
		/* Email */
		if (isset($this->request->post['pagueveloz_email'])) {
			$data['pagueveloz_email'] = $this->request->post['pagueveloz_email'];
		} else {
			$data['pagueveloz_email'] = $this->config->get('pagueveloz_email');
		}
		
		/* Token */
		if (isset($this->request->post['pagueveloz_token'])) {
			$data['pagueveloz_token'] = $this->request->post['pagueveloz_token'];
		} else {
			$data['pagueveloz_token'] = $this->config->get('pagueveloz_token');
		}
		
		/* Geo Zone */
		if (isset($this->request->post['pagueveloz_geo_zone'])) {
			$data['pagueveloz_geo_zone'] = $this->request->post['pagueveloz_geo_zone'];
		} else {
			$data['pagueveloz_geo_zone'] = $this->config->get('pagueveloz_geo_zone');
		}
		
		/* Sort Order */
		if (isset($this->request->post['pagueveloz_sort_order'])) {
			$data['pagueveloz_sort_order'] = $this->request->post['pagueveloz_sort_order'];
		} else {
			$data['pagueveloz_sort_order'] = $this->config->get('pagueveloz_sort_order');
		}
		
		/* Billet - Expiration */
		if (isset($this->request->post['pagueveloz_billet_expiration'])) {
			$data['pagueveloz_billet_expiration'] = $this->request->post['pagueveloz_billet_expiration'];
		} else {
			$data['pagueveloz_billet_expiration'] = $this->config->get('pagueveloz_billet_expiration');
		}
		
		/* Billet Note 1 */
		if (isset($this->request->post['pagueveloz_billet_note_1'])) {
			$data['pagueveloz_billet_note_1'] = $this->request->post['pagueveloz_billet_note_1'];
		} else {
			$data['pagueveloz_billet_note_1'] = $this->config->get('pagueveloz_billet_note_1');
		}
		
		
		/* Billet Note 2 */
		if (isset($this->request->post['pagueveloz_billet_note_2'])) {
			$data['pagueveloz_billet_note_2'] = $this->request->post['pagueveloz_billet_note_2'];
		} else {
			$data['pagueveloz_billet_note_2'] = $this->config->get('pagueveloz_billet_note_2');
		}
		
		/* Billet Cedente */
		if (isset($this->request->post['pagueveloz_billet_cedente'])) {
			$data['pagueveloz_billet_cedente'] = $this->request->post['pagueveloz_billet_cedente'];
		} else {
			$data['pagueveloz_billet_cedente'] = $this->config->get('pagueveloz_billet_cedente');
		}
		
		/* Billet CPF/CNPJ */
		if (isset($this->request->post['pagueveloz_billet_cpfcedente'])) {
			$data['pagueveloz_billet_cpfcedente'] = $this->request->post['pagueveloz_billet_cpfcedente'];
		} else {
			$data['pagueveloz_billet_cpfcedente'] = $this->config->get('pagueveloz_billet_cpfcedente');
		}
		
		/* Billet Order Status Pending */
		if (isset($this->request->post['pagueveloz_billet_pending'])) {
			$data['pagueveloz_billet_pending'] = $this->request->post['pagueveloz_billet_pending'];
		} else {
			$data['pagueveloz_billet_pending'] = $this->config->get('pagueveloz_billet_pending');
		}
		
		/* Billet Order Status Canceled */
		if (isset($this->request->post['pagueveloz_billet_canceled'])) {
			$data['pagueveloz_billet_canceled'] = $this->request->post['pagueveloz_billet_canceled'];
		} else {
			$data['pagueveloz_billet_canceled'] = $this->config->get('pagueveloz_billet_canceled');
		}
		
		/* Billet Order Status Complete */
		if (isset($this->request->post['pagueveloz_billet_complete'])) {
			$data['pagueveloz_billet_complete'] = $this->request->post['pagueveloz_billet_complete'];
		} else {
			$data['pagueveloz_billet_complete'] = $this->config->get('pagueveloz_billet_complete');
		}
		
		/* Payment Method - Billet */
		if (isset($this->request->post['pagueveloz_billet_status'])) {
			$data['pagueveloz_billet_status'] = $this->request->post['pagueveloz_billet_status'];
		} else {
			$data['pagueveloz_billet_status'] = $this->config->get('pagueveloz_billet_status');
		}
		
		/* post.order.add */
		if (isset($this->request->post['pagueveloz_post_order_add'])) {
			$data['pagueveloz_post_order_add'] = $this->request->post['pagueveloz_post_order_add'];
		} else {
			$data['pagueveloz_post_order_add'] = $this->config->get('pagueveloz_post_order_add');
		}
		
		/* post.order.edit */
		if (isset($this->request->post['pagueveloz_post_order_edit'])) {
			$data['pagueveloz_post_order_edit'] = $this->request->post['pagueveloz_post_order_edit'];
		} else {
			$data['pagueveloz_post_order_edit'] = $this->config->get('pagueveloz_post_order_edit');
		}
		
		/* post.order.delete */
		if (isset($this->request->post['pagueveloz_post_order_delete'])) {
			$data['pagueveloz_post_order_delete'] = $this->request->post['pagueveloz_post_order_delete'];
		} else {
			$data['pagueveloz_post_order_delete'] = $this->config->get('pagueveloz_post_order_delete');
		}
		
		/* post.order.history.add */
		if (isset($this->request->post['pagueveloz_post_order_history_add'])) {
			$data['pagueveloz_post_order_history_add'] = $this->request->post['pagueveloz_post_order_history_add'];
		} else {
			$data['pagueveloz_post_order_history_add'] = $this->config->get('pagueveloz_post_order_history_add');
		}
		
		/* post.admin.review.edit */
		if (isset($this->request->post['pagueveloz_post_admin_review_edit'])) {
			$data['pagueveloz_post_admin_review_edit'] = $this->request->post['pagueveloz_post_admin_review_edit'];
		} else {
			$data['pagueveloz_post_admin_review_edit'] = $this->config->get('pagueveloz_post_admin_review_edit');
		}
		
		/* post.review.add */
		if (isset($this->request->post['pagueveloz_post_review_add'])) {
			$data['pagueveloz_post_review_add'] = $this->request->post['pagueveloz_post_review_add'];
		} else {
			$data['pagueveloz_post_review_add'] = $this->config->get('pagueveloz_post_review_add');
		}
		
		/* post.admin.affiliate.approve */
		if (isset($this->request->post['pagueveloz_post_admin_affiliate_approve'])) {
			$data['pagueveloz_post_admin_affiliate_approve'] = $this->request->post['pagueveloz_post_admin_affiliate_approve'];
		} else {
			$data['pagueveloz_post_admin_affiliate_approve'] = $this->config->get('pagueveloz_post_admin_affiliate_approve');
		}
		
		/* post.admin.affiliate.transaction.add */
		if (isset($this->request->post['pagueveloz_post_admin_affiliate_transaction_add'])) {
			$data['pagueveloz_post_admin_affiliate_transaction_add'] = $this->request->post['pagueveloz_post_admin_affiliate_transaction_add'];
		} else {
			$data['pagueveloz_post_admin_affiliate_transaction_add'] = $this->config->get('pagueveloz_post_admin_affiliate_transaction_add');
		}
		
		/* post.affiliate.add */
		if (isset($this->request->post['pagueveloz_post_affiliate_add'])) {
			$data['pagueveloz_post_affiliate_add'] = $this->request->post['pagueveloz_post_affiliate_add'];
		} else {
			$data['pagueveloz_post_affiliate_add'] = $this->config->get('pagueveloz_post_affiliate_add');
		}
		
		/* post.affiliate.edit */
		if (isset($this->request->post['pagueveloz_post_affiliate_edit'])) {
			$data['pagueveloz_post_affiliate_edit'] = $this->request->post['pagueveloz_post_affiliate_edit'];
		} else {
			$data['pagueveloz_post_affiliate_edit'] = $this->config->get('pagueveloz_post_affiliate_edit');
		}
		
		/* post.customer.add */
		if (isset($this->request->post['pagueveloz_post_customer_add'])) {
			$data['pagueveloz_post_customer_add'] = $this->request->post['pagueveloz_post_customer_add'];
		} else {
			$data['pagueveloz_post_customer_add'] = $this->config->get('pagueveloz_post_customer_add');
		}
		
		/* post.customer.edit */
		if (isset($this->request->post['pagueveloz_post_customer_edit'])) {
			$data['pagueveloz_post_customer_edit'] = $this->request->post['pagueveloz_post_customer_edit'];
		} else {
			$data['pagueveloz_post_customer_edit'] = $this->config->get('pagueveloz_post_customer_edit');
		}
		
		#####################
		#       SMS         #
		#####################
		
		/* text.order.add */
		if (isset($this->request->text['pagueveloz_text_order_add'])) {
			$data['pagueveloz_text_order_add'] = $this->request->text['pagueveloz_text_order_add'];
		} elseif ($this->config->get('pagueveloz_text_order_add')) {
			$data['pagueveloz_text_order_add'] = $this->config->get('pagueveloz_text_order_add');
		} else {
			$data['pagueveloz_text_order_add'] = $this->language->get('sms_order_add');
		}
		
		/* text.order.edit */
		if (isset($this->request->text['pagueveloz_text_order_edit'])) {
			$data['pagueveloz_text_order_edit'] = $this->request->text['pagueveloz_text_order_edit'];
		} elseif ($this->config->get('pagueveloz_text_order_edit')) {
			$data['pagueveloz_text_order_edit'] = $this->config->get('pagueveloz_text_order_edit');
		} else {
			$data['pagueveloz_text_order_edit'] = $this->language->get('sms_order_edit');
		}
		
		/* text.order.delete */
		if (isset($this->request->text['pagueveloz_text_order_delete'])) {
			$data['pagueveloz_text_order_delete'] = $this->request->text['pagueveloz_text_order_delete'];
		} elseif ($this->config->get('pagueveloz_text_order_delete')) {
			$data['pagueveloz_text_order_delete'] = $this->config->get('pagueveloz_text_order_delete');
		} else {
			$data['pagueveloz_text_order_delete'] = $this->language->get('sms_order_delete');
		}
		
		/* text.order.history.add */
		if (isset($this->request->text['pagueveloz_text_order_history_add'])) {
			$data['pagueveloz_text_order_history_add'] = $this->request->text['pagueveloz_text_order_history_add'];
		} elseif ($this->config->get('pagueveloz_text_order_history_add')) {
			$data['pagueveloz_text_order_history_add'] = $this->config->get('pagueveloz_text_order_history_add');
		} else {
			$data['pagueveloz_text_order_history_add'] = $this->language->get('sms_order_history_add');
		}
		
		/* text.admin.review.edit */
		if (isset($this->request->text['pagueveloz_text_admin_review_edit'])) {
			$data['pagueveloz_text_admin_review_edit'] = $this->request->text['pagueveloz_text_admin_review_edit'];
		} elseif ($this->config->get('pagueveloz_text_admin_review_edit')) {
			$data['pagueveloz_text_admin_review_edit'] = $this->config->get('pagueveloz_text_admin_review_edit');
		} else {
			$data['pagueveloz_text_admin_review_edit'] = $this->language->get('sms_review_edit');
		}
		
		/* text.review.add */
		if (isset($this->request->text['pagueveloz_text_review_add'])) {
			$data['pagueveloz_text_review_add'] = $this->request->text['pagueveloz_text_review_add'];
		} elseif ($this->config->get('pagueveloz_text_review_add')) {
			$data['pagueveloz_text_review_add'] = $this->config->get('pagueveloz_text_review_add');
		} else {
			$data['pagueveloz_text_review_add'] = $this->language->get('sms_review_add');
		}
		
		/* text.admin.affiliate.approve */
		if (isset($this->request->text['pagueveloz_text_admin_affiliate_approve'])) {
			$data['pagueveloz_text_admin_affiliate_approve'] = $this->request->text['pagueveloz_text_admin_affiliate_approve'];
		} elseif ($this->config->get('pagueveloz_text_admin_affiliate_approve')) {
			$data['pagueveloz_text_admin_affiliate_approve'] = $this->config->get('pagueveloz_text_admin_affiliate_approve');
		} else {
			$data['pagueveloz_text_admin_affiliate_approve'] = $this->language->get('sms_affiliate_approve');
		}
		
		/* text.admin.affiliate.transaction.add */
		if (isset($this->request->text['pagueveloz_text_admin_affiliate_transaction_add'])) {
			$data['pagueveloz_text_admin_affiliate_transaction_add'] = $this->request->text['pagueveloz_text_admin_affiliate_transaction_add'];
		} elseif ($this->config->get('pagueveloz_text_admin_affiliate_transaction_add')) {
			$data['pagueveloz_text_admin_affiliate_transaction_add'] = $this->config->get('pagueveloz_text_admin_affiliate_transaction_add');
		} else {
			$data['pagueveloz_text_admin_affiliate_transaction_add'] = $this->language->get('sms_affiliate_transaction_add');
		}
		
		/* text.affiliate.add */
		if (isset($this->request->text['pagueveloz_text_affiliate_add'])) {
			$data['pagueveloz_text_affiliate_add'] = $this->request->text['pagueveloz_text_affiliate_add'];
		} elseif ($this->config->get('pagueveloz_text_affiliate_add')) {
			$data['pagueveloz_text_affiliate_add'] = $this->config->get('pagueveloz_text_affiliate_add');
		} else {
			$data['pagueveloz_text_affiliate_add'] = $this->language->get('sms_affiliate_add');
		}
		
		/* text.affiliate.edit */
		if (isset($this->request->text['pagueveloz_text_affiliate_edit'])) {
			$data['pagueveloz_text_affiliate_edit'] = $this->request->text['pagueveloz_text_affiliate_edit'];
		} elseif ($this->config->get('pagueveloz_text_affiliate_edit')) {
			$data['pagueveloz_text_affiliate_edit'] = $this->config->get('pagueveloz_text_affiliate_edit');
		} else {
			$data['pagueveloz_text_affiliate_edit'] = $this->language->get('sms_affiliate_edit');
		}
		
		/* text.customer.add */
		if (isset($this->request->text['pagueveloz_text_customer_add'])) {
			$data['pagueveloz_text_customer_add'] = $this->request->text['pagueveloz_text_customer_add'];
		} elseif ($this->config->get('pagueveloz_text_customer_add')) {
			$data['pagueveloz_text_customer_add'] = $this->config->get('pagueveloz_text_customer_add');
		} else {
			$data['pagueveloz_text_customer_add'] = $this->language->get('sms_customer_add');
		}
		
		/* text.customer.edit */
		if (isset($this->request->text['pagueveloz_text_customer_edit'])) {
			$data['pagueveloz_text_customer_edit'] = $this->request->text['pagueveloz_text_customer_edit'];
		} elseif ($this->config->get('pagueveloz_text_customer_edit')) {
			$data['pagueveloz_text_customer_edit'] = $this->config->get('pagueveloz_text_customer_edit');
		} else {
			$data['pagueveloz_text_customer_edit'] = $this->language->get('sms_customer_edit');
		}
		
		$data['action'] = $this->url->link('payment/pagueveloz', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('localisation/geo_zone');
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/pagueveloz.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/pagueveloz')) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!filter_var($this->request->post['pagueveloz_email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if (empty($this->request->post['pagueveloz_token'])) {
			$this->error['token'] = $this->language->get('error_token');
		}
		
		if (($this->request->post['pagueveloz_sms_status'] == 1) && strlen($this->request->post['pagueveloz_sms_telephone']) < 10 || strlen($this->request->post['pagueveloz_sms_telephone']) > 11) {
			$this->error['sms_telephone'] = $this->language->get('error_sms_telephone');
		}
		
		$cpf_cnpj_cedente = preg_replace('/\D/', '', $this->request->post['pagueveloz_billet_cpfcedente']);
		
		if ((strlen($cpf_cnpj_cedente) == 11) && $this->validateCPF($cpf_cnpj_cedente) === false) {
			$this->error['cpf_cnpj_cedente'] = $this->language->get('error_cpf_cnpj_cedente');
		} 
		
		if ((strlen($cpf_cnpj_cedente) == 15) && $this->validateCNPJ($cpf_cnpj_cedente) === false) {
			$this->error['cpf_cnpj_cedente'] = $this->language->get('error_cpf_cnpj_cedente');
		}
		
		return !$this->error;
	}
	
	protected function validateCPF($cpf) {
		
		if (empty($cpf))
			return true;
		
		// Code ported from jsfromhell.com
        $c = preg_replace('/\D/', '', $cpf);
		
        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }
		
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
		
        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
		
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
		
        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
		
        return true;
	}
	
	protected function validateCNPJ($cnpj) {
		if (empty($cnpj))
			return true;
		
		//Code ported from jsfromhell.com
        $c = preg_replace('/\D/', '', $cnpj);
		
        $b = array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
		
        if (strlen($c) != 14) {
            return false;
        }
		
        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);
		
        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
		
        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);
		
        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
		
        return true;
	}
}