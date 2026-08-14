<?php

class Database
{
    private function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;

        try {

            $con = new PDO($string, DBUSER, DBPASS);

            $con->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $con;

        } catch (PDOException $e) {

            die("Could not connect to database");
        }
    }


    public function query($query, $data = array(), $data_type = "object")
    {
        $con = $this->connect();

        $stm = $con->prepare($query);

        if (!$stm) {
            return false;
        }

        if (!$stm->execute($data)) {
            return false;
        }

        /*
         * SELECT queries return data.
         */
        if (stripos(trim($query), "SELECT") === 0) {

            if ($data_type == "object") {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
            } else {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            }

            return $result;
        }

        /*
         * INSERT / UPDATE / DELETE
         */
        return true;
    }
}