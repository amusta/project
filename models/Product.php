<?php
require_once '../libraries/Database.php';

class Product
{
    private $db;

    private $product_name;
    private function getProductName(){return $this->product_name;}
    private function setProductName($product_name){$this->product_name = $product_name;}

    private $img;
    private function getProductImg(){return $this->img;}
    private function setProductImg($img){$this->product_name = $img;}

    public function __construct($product_name = '', $img = '')
    {
        $this->product_name = $product_name;
        $this->img=$img;
        $this->db = new Database;
    }

    public function findProductById($id)
    {
        $this->db->query('SELECT * FROM products WHERE product_id = :product_id');
        $this->db->bind(':email', $id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllProducts()
    {
        $models = [];
        $this->db->query('SELECT * FROM products ');
        if($this->db->execute()) {
            while ($this->db->resultSet()) {
                array_push($models);
            }
        }
        return $models;


    }

    public function createNewProduct($data)
    {
        $this->db->query('INSERT INTO products (product_name, description, price, weight, quantity, img) 
        VALUES (:product_name, :description, :price, :weight, :quantity, :img)');
        //Bind values
        $this->bindValues($data);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function editProduct($id)
    {
     $this->db->query('UPDATE products SET product_name=:product_name, description=:description, price=:price, weight=:weight, quantity=:quantity, img=:img');

        $this->bindValues($id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deleteProduct($id)
    {
        $this->db->query('DELETE FROM products WHERE product_id=:product_id');

        $this->db->bind('product_id', $id['product_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }


    public function bindValues($data)
    {
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':img', $data['img']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}