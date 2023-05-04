<?php

namespace src\models;

use core\BaseModel;

class Product extends BaseModel
{

    public function __construct()
    {
        $this->table = "product";
        $this->getConnection();
    }
}