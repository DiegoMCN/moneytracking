<?php

namespace Controllers;


use Application\Controller;
use Models\Transactions as TransactionsModel;
use Models\Categories as CategoriesModel;
use Models\Accounts as AccountsModel;

class Transactions extends Controller
{
    public function __contruct(){
        parent::__construct();
    }

    public function index()
    {
        $model = new TransactionsModel();
        try {
            $transactions = $model->getAll();
            $balance = 0;
            $ingress = 0;
            $egress = 0;
            foreach ($transactions as $transaction){
                $balance += $transaction["amount"];
                if ($transaction["amount"]> 0){
                    $ingress += $transaction["amount"];
                } else {
                    $egress += $transaction["amount"];
                }
            }
            $this->view->set("transactions", $transactions);
            $this->view->set("balance", $balance);
            $this->view->set("ingress", $ingress);
            $this->view->set("egress", $egress);

            $this->view->set("title", "Listado de transacciones");
            //print_r($transactions);
            //echo $balance;
            // El método render se encarga de renderizar la vista
            $this->view->render("index");
        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    // Si quieres el nombre de español dejalo así si lo quieres en ingles ponlo en ingles
    public function crear(){
        $modelTransactions = new TransactionsModel();
        $modelCategories = new CategoriesModel();
        $modelAccounts = new AccountsModel();

        if ($_POST){
            try {
                $result = $modelTransactions->create($_POST);
                if ($result){
                    header("Location: ".$this->redirect(array("controller"=>"transactions")));
                    
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {
                $categories = $modelCategories->getAll();
                $accounts = $modelAccounts->getAll();

                $this->view->set("categories", $categories);
                $this->view->set("accounts", $accounts);

                $this->view->set("title", "Crea una transacción");
                //print_r($categories);
                //print_r($accounts);
                // El método render se encarga de renderizar la vista
                $this->view->render("crear");
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function editar($id){
        $modelTransactions = new TransactionsModel();
        $modelCategories = new CategoriesModel();
        $modelAccounts = new AccountsModel();

        if ($_POST){
            try {
                $result = $modelTransactions->update($_POST);
                if ($result){
                    $this->redirect(array("controller"=>"transactions"));
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {
                $categories = $modelCategories->getAll();
                $accounts = $modelAccounts->getAll();
                $transaction = $modelTransactions->getById($id);
                if ($transaction){
                    $this->view->set("categories", $categories);
                    $this->view->set("accounts", $accounts);

                    $this->view->set("title", "Crea una transacción");
                    //print_r($categories);
                    //print_r($accounts);
                    //print_r($transaction);
                    // El método render se encarga de renderizar la vista
                    $this->view->render("index");
                } else {
                    // SI no encuentra el id debe decirle al usuario que no existe
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function eliminar($id){
        $model = new TransactionsModel();
        try {
            $result = $model->delete($id);
            if ($result){
                print_r($result);

            } else {
                //Algo debe decir si falla
            }

        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

}