<?php
namespace controllers\publics;
use \models\ModelApi as ModelApi;

class Httpstatus extends \Controller
{
    public function __construct($pdo) {
        $this->ModelApi = new ModelApi($pdo);
    }
	/**
	 * Home Page
	 */	
	public function home()
	{
        $sites = $this->ModelApi->get_all_sites();

        for ($i = 0; $i < count($sites); $i++) {
            $sites[$i]['status'] = $this->ModelApi->get_last_history($sites[$i]['id'])['status_code'];
        }

		return $this->render("index/index", ['sites' => $sites]);
    }
    
    public function historique($id) {
        $history = $this->ModelApi->get_all_history($id);
        
        return $this->render('index/historique', ['sites' => $history]);
    }

    public function login() {
        $mail = $_POST['email'] ?? false;
        $password = $_POST['password'] ?? false;

        if (!$_SESSION['logged'] && $mail && $password) {
            $user = $this->ModelApi->get_user_with_creds($mail, $password);
            
            if ($user != null) {
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['admin'] = $user['is_admin'];
                header('Location: ./');
            } else {
                header('Location: ./connexion');
            } 
        } else {
            header('Location: ./connexion');
        }
    }

    public function connexion() {
        return $this->render('index/connexion');
    }
}
