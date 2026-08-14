<?php

/**
 * Main model
 */
class Model extends Database
{
    protected $table = "users";


    public function __construct()
    {
        // code...
    }


    public function where($column, $value)
    {
        $column = addslashes($column);

        $query = "SELECT * FROM $this->table
                  WHERE $column = :value";

        return $this->query($query, [
            'value' => $value
        ]);
    }


    public function findAll()
    {
        $query = "SELECT * FROM $this->table";

        return $this->query($query);
    }


    public function insert($data)
    {
        $columns = array_keys($data);

        $columnString = implode(",", $columns);

        $placeholders = ":" . implode(", :", $columns);

        $query = "INSERT INTO $this->table
                  ($columnString)
                  VALUES
                  ($placeholders)";

        return $this->query($query, $data);
    }


    public function update($column, $value, $whereColumn, $whereValue)
    {
        $column = addslashes($column);
        $whereColumn = addslashes($whereColumn);

        $query = "UPDATE $this->table
                  SET $column = :value
                  WHERE $whereColumn = :whereValue";

        return $this->query($query, [
            'value' => $value,
            'whereValue' => $whereValue
        ]);
    }


    public function delete($column, $value)
    {
        $column = addslashes($column);

        $query = "DELETE FROM $this->table
                  WHERE $column = :value";

        return $this->query($query, [
            'value' => $value
        ]);
    }
}