<?php
namespace controllers\internals;

use \models\ModelApi as ModelApi;

class InternalApi extends \InternalController
{
	public function __construct($pdo) {
        parent::__construct($pdo);
        $this->ModelApi = new ModelApi($pdo);
    }
    
    public function check_api_key($api_key, $admin_only = false) {
        $api_key = $api_key ?? false;
        $user = $this->ModelApi->get_user_from_field('api_key', $api_key);
        return ($user != null) && ($user['is_admin'] == 1 || !$admin_only);
    }
 
    public function get_status_code($url) {
        $headers = get_headers($url);

        for ($i = count($headers); $i >= 0; $i--) {
            if (substr($headers[$i], 0, 4) == "HTTP") {
                return substr($headers[$i], 9, 3);
            }
        }

        return null;
    }

    public function update_one_site($url) {
        $website = $this->ModelApi->get_site_from_field('url_site', $url);

        $code = intval($this->get_status_code($website['url_site']));
        $debut = substr(strval($code), 0, 1);

        if (!(($debut == "2" || $debut == "4" || $debut == "5") && $code >= 200)) {
            $code = 999;
        }

        $this->ModelApi->add_new_history($website['id'], $code);
    }

    public function update_all_sites() {
        foreach ($this->ModelApi->get_all_sites() as $website) {
            $code = intval($this->get_status_code($website['url_site']));
            $debut = substr(strval($code), 0, 1);

            if (!(($debut == "2" || $debut == "4" || $debut == "5") && $code >= 200)) {
                $code = 999;
            }

            $this->ModelApi->add_new_history($website['id'], $code);

        }
    }

    public function update_websites() {
        while (true) {
            $this->update_all_sites();
            sleep(120);
        }
    }
    
}