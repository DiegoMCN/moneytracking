<?php

namespace Models;


use Application\Model;

class Accounts extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $accounts = $this->db->query("SELECT * FROM accounts");
        return $accounts->fetchAll();
    }

    public function getById($id){
        $query = $this->db->prepare("SELECT * FROM accounts WHERE id=:id");
        $query->bindParam(":id",$id);
        $query->execute();
        $account = $query->fetch();
        return $account ? $account : false;
    }

    public function create($data = array()){
        $query = $this->db->prepare(
            "INSERT INTO accounts(name) VALUES (:name)"
        );
        $query->bindParam(":name", $data["name"]);
        return $query->execute() ? true : false;
    }

    public function update($data = array()){
        $query = $this->db->prepare(
            "UPDATE accounts SET name=:name WHERE id=:id"
        );
        $query->bindParam(":id", $data["id"]);
        $query->bindParam(":name", $data["name"]);
        return $query->execute() ? true : false;
    }

    public function delete($id){
        $query = $this->db->prepare(
            "DELETE FROM accounts WHERE id=:id"
        );
        $query->bindParam(":id", $id);
        return $query->execute() ? true : false;
    }


}