<?php

class Subject extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Get all subjects for a school
    |--------------------------------------------------------------------------
    */

    public function getAllBySchool($schoolId)
    {
        $query = "
            SELECT
                id,
                school_id,
                name,
                code,
                description,
                status,
                created_at,
                updated_at
            FROM subjects
            WHERE school_id = :school_id
            ORDER BY name ASC
        ";

        return $this->query($query, [
            'school_id' => $schoolId
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Get active subjects for a school
    |--------------------------------------------------------------------------
    */

    public function getActiveBySchool($schoolId)
    {
        $query = "
            SELECT
                id,
                school_id,
                name,
                code,
                description,
                status
            FROM subjects
            WHERE school_id = :school_id
              AND status = 1
            ORDER BY name ASC
        ";

        return $this->query($query, [
            'school_id' => $schoolId
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Get single subject
    |--------------------------------------------------------------------------
    */

    public function getById($id, $schoolId)
    {
        $query = "
            SELECT
                id,
                school_id,
                name,
                code,
                description,
                status,
                created_at,
                updated_at
            FROM subjects
            WHERE id = :id
              AND school_id = :school_id
            LIMIT 1
        ";

        $result = $this->query($query, [
            'id' => $id,
            'school_id' => $schoolId
        ]);

        return $result[0] ?? null;
    }


    /*
    |--------------------------------------------------------------------------
    | Create subject
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $query = "
            INSERT INTO subjects (
                school_id,
                name,
                code,
                description,
                status
            )
            VALUES (
                :school_id,
                :name,
                :code,
                :description,
                :status
            )
        ";

        return $this->query($query, [
            'school_id' => $data['school_id'],
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 1
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update subject
    |--------------------------------------------------------------------------
    */

    public function updateSubject($id, $schoolId, $data)
    {
        $query = "
            UPDATE subjects
            SET
                name = :name,
                code = :code,
                description = :description,
                status = :status
            WHERE id = :id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $schoolId,
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 1
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Activate subject
    |--------------------------------------------------------------------------
    */

    public function activate($id, $schoolId)
    {
        $query = "
            UPDATE subjects
            SET status = 1
            WHERE id = :id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $schoolId
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Deactivate subject
    |--------------------------------------------------------------------------
    */

    public function deactivate($id, $schoolId)
    {
        $query = "
            UPDATE subjects
            SET status = 0
            WHERE id = :id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $schoolId
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete subject
    |--------------------------------------------------------------------------
    */

    public function delete($id, $schoolId)
    {
        $query = "
            DELETE FROM subjects
            WHERE id = :id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $schoolId
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Check duplicate subject code
    |--------------------------------------------------------------------------
    */

    public function codeExists(
        $schoolId,
        $code,
        $excludeId = null
    ) {
        $query = "
            SELECT id
            FROM subjects
            WHERE school_id = :school_id
              AND code = :code
        ";

        $params = [
            'school_id' => $schoolId,
            'code' => $code
        ];

        if ($excludeId !== null) {
            $query .= "
                AND id != :exclude_id
            ";

            $params['exclude_id'] = $excludeId;
        }

        $query .= " LIMIT 1";

        $result = $this->query(
            $query,
            $params
        );

        return !empty($result);
    }
}