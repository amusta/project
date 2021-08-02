<?php

require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Products
{
    private $productModel;

    public function __construct(){
        $this->productModel = new Products;
    }

    public function productListing()
    {
        $product = $this->productModel->getAllProducts();
    }

    public function createNewProduct(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $data = [
            'product_name' => trim($_POST['product_name']),
            'description' => trim($_POST['description']),
            'price' => trim($_POST['price']),
            'weight' => trim($_POST['weight']),
            'quantity' => trim($_POST['quantity']),
            'img' => trim($_POST['img']),
        ];


        if(empty($data['product_name']) || empty($data['description']) || empty($data['price']) ||
            empty($data['weight']) || empty($data['quantity']) || empty($data['img'])){
            flash("register", "Please fill out all inputs");
            redirect("");
        }

    }

    public function deleteProduct()
    {

    }

}