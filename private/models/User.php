<?php

class User extends Model
{
    protected $table = "users";


    public function findByEmail($email)
    {
        $query = "SELECT * FROM $this->table
                  WHERE email = :email
                  LIMIT 1";

        $result = $this->query($query, [
            'email' => $email
        ]);

        if ($result) {
            return $result[0];
        }

        return false;
    }


    public function createUser($data)
    {
        $query = "INSERT INTO $this->table
                  (firstname, lastname, email, gender, rank, password)
                  VALUES
                  (:firstname, :lastname, :email, :gender, :rank, :password)";

        return $this->query($query, $data);
    }
}