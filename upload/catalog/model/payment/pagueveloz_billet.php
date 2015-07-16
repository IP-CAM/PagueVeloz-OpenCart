<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ModelPaymentPagueVelozBillet extends Model {
	public function getMethod($address, $total) {
		$this->load->language('payment/pagueveloz');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('cod_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('pagueveloz_geo_zone')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'pagueveloz_billet',
				'title'      => $this->language->get('text_title_billet'),
				'terms'      => '',
				'sort_order' => $this->config->get('pagueveloz_sort_order')
			);
		}

		return $method_data;
	}
}