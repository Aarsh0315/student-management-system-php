<?php

class School extends Model
{
    protected $table = "schools";

    public function findAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY id DESC";

        return $this->query($query);
    }
}