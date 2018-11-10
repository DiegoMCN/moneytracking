<?php

namespace Controllers;


use Application\Controller;
use Models\Accounts as AccountsModel;

class Accounts extends Controller
{
    public function __contruct(){
        parent::__construct();

    }
    public function index()
    {
        $model = new AccountsModel();
        try {
            $accounts = $model->getAll();
            $this->view->set("accounts", $accounts);
            $this->view->set("title", "Listado de cuentas");
            //print_r($accounts);
            $this->view->render("index");
        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
    // Si quieres el nombre de español dejalo así si lo quieres en ingles ponlo en ingles
    public function crear(){
        $modelAccounts = new AccountsModel();

        if ($_POST){
            //print_r($_POST);
            try {
                $result = $modelAccounts->create($_POST);
                if ($result){
                    header("Location: ".$this->redirect(array("controller"=>"accounts")));
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }
                
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {

                $this->view->set("title", "Crea una transacción");

                // El método render se encarga de renderizar la vista
            $this->view->render("crear");
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function editar($id){
        $modelAccounts = new AccountsModel();

        if ($_POST){
            try {
                $result = $modelAccounts->update($_POST);
                if ($result){
                    header("Location: ".$this->redirect(array("controller"=>"accounts")));
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {

                $this->view->set("title", "Actualizar una cuenta");
                $account = $modelAccounts->getById($id);
                if ($account){
                    //print_r($account);
                    $this->view->set("account", $account);
                    $this->view->render("editar");
                } else{
                    // Un error si no encuentra
                }
                // El método render se encarga de renderizar la vista
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function eliminar($id){
        $model = new AccountsModel();
        try {
            $result = $model->delete($id);
            if ($result){
                //print_r($result);
                header("Location: ".$this->redirect(array("controller"=>"accounts")));
            } else {
                //Algo debe decir si falla
            }

        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
}