<?php
namespace models;

class ModelApi extends \Model {

    public function get_user_from_field($field, $value) {
        return $this->get_one('users', [
            $field => $value,
        ]);
    }

    public function get_site_from_field($field, $value) {
        return $this->get_one('sites', [
            $field => $value,
        ]);
    }

    public function get_last_history($website) {
        return $this->get_one('history_site', [
            'id_site' => $website
        ], 'update_at', true);
    }

    public function get_all_history($website) {
        return $this->get('history_site', [
            'id_site' => $website
        ], 'update_at', true);
    }

    public function get_user_with_creds($mail, $pass) {
        $user = $this->get_one('users', [
            'email' => $mail,
        ]);
        
        if ($user['pass'] == md5($pass . $user['salt'])) {
            return $user;
        }

        return null;
    }

    public function get_all_sites() {
        return $this->get('sites');
    }

    public function add_new_site($url) {
        if ($url == null)
            return false;
        
        return $this->insert('sites', [
            'url_site' => $url
        ]);
    }

    public function delete_history($site_id) {
        return $this->delete('history_site', [
            'id_site' => $site_id
        ]);
    }

    public function delete_site($id) {
        return $this->delete('sites', [
            'id' => $id
        ]);
    }

    public function add_new_history($id_site, $status) {
        $update_at = (new \DateTime())->format('Y-m-d H:i:s');

        return $this->insert('history_site', [
            'id_site' => $id_site,
            'status_code' => $status,
            'update_at' => $update_at
        ]);
    }
}