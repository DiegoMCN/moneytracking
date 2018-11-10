<?php

namespace Models;


use Application\Model;

class Transactions extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $transactions = $this->db->query("SELECT * FROM transactions");
        return $transactions->fetchAll();
    }

    public function getById($id){
        $query = $this->db->prepare("SELECT * FROM transactions WHERE id=:id");
        $query->bindParam(":id",$id);
        $query->execute();
        $transaction = $query->fetch();
        return $transaction ? $transaction : false;
    }

    public function create($data = array()){
        $query = $this->db->prepare(
            "INSERT INTO transactions(description,amount,date,category_id,account_id) VALUES (:description,:amount,:date,:category_id,:account_id)"
        );
        $query->bindParam(":description", $data["description"]);
        $query->bindParam(":amount", $data["amount"]);
        $query->bindParam(":date", $data["date"]);
        $query->bindParam(":category_id", $data["category_id"]);
        $query->bindParam(":account_id", $data["account_id"]);
        return $query->execute() ? true : false;
    }

    public function update($data = array()){
        $query = $this->db->prepare(
            "UPDATE transactions SET description=:description, amount=:amount, date=:date, category_id=:category_id, account_id=:account_id WHERE id=:id"
        );
        $query->bindParam(":description", $data["description"]);
        $query->bindParam(":amount", $data["amount"]);
        $query->bindParam(":date", $data["date"]);
        $query->bindParam(":category_id", $data["category_id"]);
        $query->bindParam(":account_id", $data["account_id"]);
        $query->bindParam(":id", $data["id"]);
        return $query->execute() ? true : false;
    }

    public function delete($id){
        $query = $this->db->prepare(
            "DELETE FROM transactions WHERE id=:id"
        );
        $query->bindParam("id", $id);
        return $query->execute() ? true : false;
    }
}