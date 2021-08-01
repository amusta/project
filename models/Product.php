<?php
require_once '../libraries/Database.php';
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProducts($email)
    {
        $this->db->query('SELECT * FROM products ');

        $rows = $this->db->resultSet();

    }
}