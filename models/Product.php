<?php
require_once '../libraries/Database.php';

class Product
{
    private $db;

    public function __construct()
    {
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
        $this->db->query('SELECT * FROM products ');

        $rows = $this->db->resultSet();
        return $rows;

    }

    public function createNewProduct($data)
    {
        $this->db->query('INSERT INTO products (product_name, description, price, weight, quantity, img) 
        VALUES (:product_name, :description, :price, :weight, :quantity, :img)');
        //Bind values
        return $this->bindValues($data);
    }

    public function editProduct($id)
    {
     $this->db->query('UPDATE products SET product_name=:product_name, description=:description, price=:price, weight=:weight, quantity=:quantity, img=:img');

        return $this->bindValues($id);

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