<?php

require_once '../libraries/Database.php';

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (first_name, last_name, adress, city, phone, email, password) 
        VALUES (:first_name, :last_name, :adress, :city, :phone, :email, :password)');
        //Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':adress', $data['adress']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $row = $this->findUserByEmail($email);

        if ($row == false) return false;

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE users SET password=:password WHERE email=:email');
        $this->db->bind(':password', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deteleUser($email)
    {
        $this->db->query('DELETE * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}