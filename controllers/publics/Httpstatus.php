<?php
namespace controllers\publics;
use \models\ModelApi as ModelApi;
use \controllers\internals\InternalApi as InternalApi;

class Httpstatus extends \Controller
{
    public function __construct($pdo) {
        $this->ModelApi = new ModelApi($pdo);
        $this->InternalApi = new InternalApi($pdo);
    }
	/**
	 * Home Page
	 */	
	public function home()
	{
        session_start();

        $sites = $this->ModelApi->get_all_sites();

        for ($i = 0; $i < count($sites); $i++) {
            $sites[$i]['status'] = $this->ModelApi->get_last_history($sites[$i]['id'])['status_code'];
        }

		return $this->render("index/index", ['sites' => $sites, 'logged' => $_SESSION['logged'], 'admin' => $_SESSION['admin']]);
    }
    
    public function historique($id) {
        session_start();

        $history = $this->ModelApi->get_all_history($id);
        $website = $this->ModelApi->get_site_from_field('id', $id);

        return $this->render('index/historique', ['sites' => $history, 'website' => $website, 'logged' => $_SESSION['logged'], 'admin' => $_SESSION['admin']]);
    }

    public function login() {
        session_start();

        $mail = $_POST['email'] ?? false;
        $password = $_POST['password'] ?? false;

        if ($_SESSION['logged']) {
            header('Location: ./');
        }
        else if ($mail && $password) {
            $user = $this->ModelApi->get_user_with_creds($mail, $password);

            if ($user != null) {
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

    public function ajoutersite() {
        session_start();
        $this->render('index/ajoutersite', ['logged' => $_SESSION['logged']]);
    }

    public function add_website() {
        session_start();
        $url = $_POST['url'] ?? false;
        header('Location: ./');

        if ($url && $_SESSION['logged'] && $_SESSION['admin']) {
            $this->ModelApi->add_new_site($url);

            $this->InternalApi->update_one_site($url);
        }
    }

    public function supprimer($id) {
        session_start();

        header('Location: ../');

        if ($_SESSION['logged'] && $_SESSION['admin']) {
            $this->ModelApi->delete_history($id);
            $this->ModelApi->delete_site($id);
        }
    }

    public function connexion() {
        session_start();

        if ($_SESSION['logged']) {
            header('Location: ./');
        } else {
            return $this->render('index/connexion');
        }
    }

    public function deconnexion() {
        session_start();
        $_SESSION['logged'] = null;
        $_SESSION['admin'] = null;
        header('Location: ./');
    }
}
