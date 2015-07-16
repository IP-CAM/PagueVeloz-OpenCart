<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ModelPaymentPagueVeloz extends Model {
	public function getMethod($address, $total) {
		return array();
	}
	
	public function transition($method, $data = array(), $request = 'POST') {
		// Inicia cURL
		$ch = curl_init();

		$action = 'https://www.pagueveloz.com.br/api/' . $method;
		
		$header   = array();
		$header[] = "content-type: application/json";
		$header[] = "Authorization: Basic " . base64_encode($this->config->get('pagueveloz_email') . ':' . $this->config->get('pagueveloz_token'));
		
		// Seta opçoes e parâmetro
		$options = array(
			CURLOPT_URL => $action,
			CURLOPT_CUSTOMREQUEST => $request,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => utf8_encode(json_encode($data))
		);
		curl_setopt_array($ch, $options);
		
		// Executa cURL
		$response = curl_exec($ch);
		
		// Fecha coneçao cURL
		curl_close($ch);
		
		return $response;
	}

	public function addOrder($data = array()) {
		$this->db->query('INSERT INTO ' . DB_PREFIX . 'pagueveloz_billet SET order_id = "' . (int)$data['order_id'] . '", billet_id = "' . $this->db->escape($data['billet_id']) . '", doc = "' . $this->db->escape($data['doc']) . '"');
		
		unset($this->session->data['pagueveloz_data']);
	}
	
	public function updateOrder($order_id) {
		$this->db->query('UPDATE ' . DB_PREFIX . 'pagueveloz_billet SET complete = 1 WHERE order_id = "' . (int)$order_id . '"');
	}
	
	public function getOrders($type = 'billet', $data = array()) {
		$result = array();
		
		$filter_data = array(
			'billet'
		);
		
		if (!in_array($type, $filter_data)){
			return array();
		}
		
		$sql = 'SELECT * FROM ' . DB_PREFIX . 'pagueveloz_' . $this->db->escape($type) . ' WHERE order_id > 0';
			
		if (isset($data['complete'])) {
			$sql .= ' AND complete = "' . (int)$data['complete'] . '"';
		}
		
		$query = $this->db->query($sql);
		
		$result = $query->rows;
		
		return $result;
	}
	
	public function validateCPF($cpf) {
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
	
	public function validateCNPJ($cnpj) {
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