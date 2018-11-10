<?php

namespace Application;


class Model
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
}