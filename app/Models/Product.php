<?php

class Product extends DB
{
    private $table = "products";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();

        // var_dump($this->connect());
    }

    public function getAllProducts()
    {
        return $this->conn->get($this->table);
    }  


    /**
     * insert new product in db
     * @param array $data => fileds and values of product row 
     */
    public function insertProducts($data)
    {
        return $this->conn->insert($this->table, $data);
    }


    /**
     * delete product from db 
     * @param int $id => id of product 
     */
    public function deleteProduct($id)
    {
        $delete = $this->conn->where('id', $id);
        return $delete->delete($this->table);
    }


    /**
     * get data of product from database
     * @param int $id 
     * @return array 
     */

    public function getProduct($id)
    {
        $product = $this->conn->where('id', $id);
        return $product->get($this->table);
    }

    public function updateProduct($id, $data)
    {
        $product = $this->conn->where('id', $id);
        return $product->update($this->table, $data);
    }
}
