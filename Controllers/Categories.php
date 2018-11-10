<?php

namespace Controllers;


use Application\Controller;
use Models\Categories as CategoriesModel;

class Categories extends Controller
{

    public function __contruct(){
        parent::__construct();
    }

    public function index()
    {
        $model = new CategoriesModel();
        try {
            $categories = $model->getAll();
            $this->view->set("categories", $categories);
            $this->view->set("title", "Listado de categorías");
            //print_r($categories);
            $this->view->render("index");
        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
    // Si quieres el nombre de español dejalo así si lo quieres en ingles ponlo en ingles
    public function crear(){
        $modelCategories = new CategoriesModel();

        if ($_POST){
            try {
                $result = $modelCategories->create($_POST);
                if ($result){
                    header("Location: ".$this->redirect(array("controller"=>"categories")));
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {

                $this->view->set("title", "Crea una Categoria");

                // El método render se encarga de renderizar la vista
                $this->view->render("crear");
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function editar($id){
        $modelCategories = new CategoriesModel();

        if ($_POST){
            try {
                $result = $modelCategories->update($_POST);
                if ($result){
                    $this->redirect(array("controller"=>"categories"));
                } else{
                    // Algo harás aqui por si acaso no funciona la creacion
                }

            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
        if ($_GET){
            try {

                $this->view->set("title", "Actualizar una Categoria");
                $category = $modelCategories->getById($id);
                if ($category){
                    print_r($category);
                } else{
                    // Un error si no encuentra
                }
                // El método render se encarga de renderizar la vista
                // $this->view->render("editar");
            } catch (\Exception $exception){
                echo $exception->getMessage();
            }
        }
    }

    public function eliminar($id){
        $model = new CategoriesModel();
        try {
            $result = $model->delete($id);
            if ($result){
                //print_r($result);
                header("Location: ".$this->redirect(array("controller"=>"categories")));
            } else {
                //Algo debe decir si falla
            }

        } catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
}