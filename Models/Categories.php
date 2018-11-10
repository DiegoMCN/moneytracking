<?php

namespace Models;


use Application\Model;

class Categories extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $categories = $this->db->query("SELECT * FROM categories");
        return $categories->fetchAll();
    }

    public function getById($id){
        $query = $this->db->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindParam(":id",$id);
        $query->execute();
        $category = $query->fetch();
        return $category ? $category : false;
    }

    public function create($data = array()){
        $query = $this->db->prepare(
            "INSERT INTO categories(name) VALUES (:name)"
        );
        $query->bindParam(":name", $data["name"]);
        return $query->execute() ? true : false;
    }

    public function update($data = array()){
        $query = $this->db->prepare(
            "UPDATE categories SET name=:name WHERE id=:id"
        );
        $query->bindParam(":id", $data["id"]);
        $query->bindParam(":name", $data["name"]);
        return $query->execute() ? true : false;
    }

    public function delete($id){
        $query = $this->db->prepare(
            "DELETE FROM categories WHERE id=:id"
        );
        $query->bindParam(":id", $id);
        return $query->execute() ? true : false;
    }

}