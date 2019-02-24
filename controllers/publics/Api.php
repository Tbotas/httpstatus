<?php
namespace controllers\publics;
use \models\ModelApi as ModelApi;
use \controllers\internals\InternalApi as InternalApi;

class Api extends \ApiController
{
	public function __construct($pdo) {
		parent::__construct($pdo);
		$this->ModelApi = new ModelApi($pdo);
		$this->InternalApi = new InternalApi($pdo);
	}

	/**
	 * Endpoint List
	 */	
	public function get_endpoint()
	{
		$isValid = $this->InternalApi->check_api_key($_GET['api_key']);
		
		if ($isValid) {
			return $this->json(array(
				'version' => 1,
				'list' => $_SERVER['SERVER_NAME'] . '/httpsstatus/api/list'
			));
		} else {
			return $this->unknown_api_key();
		}
	}

	public function get_list() {
		$isValid = $this->InternalApi->check_api_key($_GET['api_key']);
		
		if ($isValid) {
			$sites = [
				'version' => 1,
				'websites' => array()	
			];

			foreach ($this->ModelApi->get_all_sites() as $website) {
				$id = $website['id'];
				$base_url = $_SERVER['SERVER_NAME'] . '/httpstatus/api/';

				$sites['websites'][] = array(
					'id' => $id,
					'url' => $website['url_site'],
					'delete' => $base_url . 'delete/' . $id,
					'status' => $base_url . 'status/' . $id,
					'history' => $base_url . 'history/' . $id,
				);
			}

			return $this->json($sites);
		} else {
			return $this->unknown_api_key();
		}
	}

	public function get_status($id) {


		$isValid = $this->InternalApi->check_api_key($_GET['api_key']);
		
		if ($isValid) {
			$website = $this->ModelApi->get_site_from_field('id', $id);
			
			if ($website == null) {
				return $this->json(array(
					'version' => 1,
					'success' => false,
					'error' => "Unknown website id."
				));
			}

			$status_site = $this->ModelApi->get_last_history($id);
			

			if ($status_site == null) {
				$status = null;
			} else {
				$status = array(
					'code' => intval($status_site['status_code']),
					'at' => $status_site['update_at']
				);
			}
			
			return $this->json(array(
				'version' => 1,
				'url' => $website['url_site'],
				'status' => $status
			)); 

		} else {
			return $this->unknown_api_key();
		}
	}

	public function get_history($id) {
		$isValid = $this->InternalApi->check_api_key($_GET['api_key']);
		
		if ($isValid) {
			$website = $this->ModelApi->get_site_from_field('id', $id);
			
			if ($website == null) {
				return $this->json(array(
					'version' => 1,
					'success' => false,
					'error' => "Unknown website id."
				));
			}

			$status_sites = $this->ModelApi->get_all_history($id);
			

			if ($status_sites == null) {
				$status = null;
			} else {
				$status = [];
				foreach ($status_sites as $status_site) {
					$status[] = array(
						'code' => intval($status_site['status_code']),
						'at' => $status_site['update_at']
					);
				}
			}
			
			return $this->json(array(
				'version' => 1,
				'url' => $website['url_site'],
				'status' => $status
			)); 

		} else {
			return $this->unknown_api_key();
		}
	}

	public function get_delete($id) {
		$isValidApi = $this->InternalApi->check_api_key($_GET['api_key'], true);
		
		if (!$isValidApi) {
			return $this->not_enough_permissions_or_unknown();
		}

		$this->ModelApi->delete_history($id);
		$this->ModelApi->delete_site($id);

		return $this->json(array(
			'version' => 1,
			'success' => true
		));
	}

	public function get_add() {
		$isValidApi = $this->InternalApi->check_api_key($_GET['api_key'], true);
		
		if (!$isValidApi) {
			return $this->not_enough_permissions_or_unknown();
		}

		
		$url = $_GET['url'];

		$isValidUrl = filter_var($url, FILTER_VALIDATE_URL);
		if (!$isValidUrl) {
			return $this->json(array(
				'version' => 1,
				'success' => false,
				'error' => 'Unvalid URL.'
			));
		}

		$site_exists = $this->ModelApi->get_site_from_field('url_site', $url) != null;
		if ($site_exists) {
			return $this->json(array(
				'version' => 1,
				'success' => false,
				'error' => 'Website is already registered.'
			));
		}

		$this->ModelApi->add_new_site($url);

		$inserted_site = $this->ModelApi->get_site_from_field('url_site', $url);
		if ($inserted_site == null) {
			return $this->json(array(
				'version' => 1,
				'success' => false,
				'error' => 'There has been problem when adding the new site.'
			));
		}

		$this->InternalApi->update_one_site($url);

		return $this->json(array(
			'version' => 1,
			'success' => true,
			'id' => $inserted_site['id']
		));

	}

	private function not_enough_permissions_or_unknown() {
		return $this->json(array(
			'version' => 1,
			'success' => false,
            'error' => 'Not enough permissions or unknown key.'
        )); 
	}

	private function unknown_api_key() {
        return $this->json(array(
			'version' => 1,
			'success' => false,
            'error' => 'Unknown api key.'
        )); 
    }
}
