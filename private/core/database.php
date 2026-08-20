<?php

class Database
{
    private $con;


    private function connect()
    {
        if ($this->con) {
            return $this->con;
        }

        $string =
            DBDRIVER .
            ":host=" . DBHOST .
            ";dbname=" . DBNAME;

        try {

            $this->con = new PDO(
                $string,
                DBUSER,
                DBPASS
            );

            $this->con->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $this->con;

        } catch (PDOException $e) {

            die("Could not connect to database");
        }
    }


    public function query(
        $query,
        $data = array(),
        $data_type = "object"
    ) {

        $con = $this->connect();

        $stm = $con->prepare($query);

        if (!$stm) {
            return false;
        }

        if (!$stm->execute($data)) {
            return false;
        }


        /*
         * SELECT
         */

        if (
            stripos(
                trim($query),
                "SELECT"
            ) === 0
        ) {

            if ($data_type == "object") {

                return $stm->fetchAll(
                    PDO::FETCH_OBJ
                );

            } else {

                return $stm->fetchAll(
                    PDO::FETCH_ASSOC
                );
            }
        }


        /*
         * INSERT / UPDATE / DELETE
         */

        return true;
    }


    public function lastInsertId()
    {
        return $this->connect()->lastInsertId();
    }
}