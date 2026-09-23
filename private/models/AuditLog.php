<?php

class AuditLog extends Model
{
    protected $table = "audit_logs";


    /*
    ========================================
    CREATE AUDIT LOG
    ========================================
    */

    public function create(
        $action,
        $description = '',
        $userId = null,
        $userName = null,
        $userRole = null
    ) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $userId ?? ($_SESSION['user_id'] ?? null);

        $userName = $userName ?? (
            isset($_SESSION['firstname'])
                ? trim(
                    ($_SESSION['firstname'] ?? '') . ' ' .
                    ($_SESSION['lastname'] ?? '')
                )
                : null
        );

        $userRole = $userRole ?? ($_SESSION['rank'] ?? null);

        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;

        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;


        $query = "
            INSERT INTO audit_logs
            (
                user_id,
                user_name,
                user_role,
                action,
                description,
                ip_address,
                user_agent
            )
            VALUES
            (
                :user_id,
                :user_name,
                :user_role,
                :action,
                :description,
                :ip_address,
                :user_agent
            )
        ";


        return $this->query($query, [
            'user_id'     => $userId,
            'user_name'   => $userName,
            'user_role'   => $userRole,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => $ipAddress,
            'user_agent'  => $userAgent
        ]);
    }


    /*
    ========================================
    GET LOGS
    ========================================
    */

    public function getLogs(
        $search = '',
        $role = '',
        $action = '',
        $limit = 15,
        $offset = 0
    ) {

        $query = "
            SELECT *
            FROM audit_logs
            WHERE 1 = 1
        ";

        $params = [];


        if ($search !== '') {

            $query .= "
                AND (
                    user_name LIKE :search
                    OR user_id LIKE :search_id
                    OR action LIKE :search_action
                    OR description LIKE :search_description
                    OR ip_address LIKE :search_ip
                )
            ";

            $searchValue = '%' . $search . '%';

            $params['search'] = $searchValue;
            $params['search_id'] = $searchValue;
            $params['search_action'] = $searchValue;
            $params['search_description'] = $searchValue;
            $params['search_ip'] = $searchValue;
        }


        if ($role !== '') {

            $query .= "
                AND user_role = :role
            ";

            $params['role'] = $role;
        }


        if ($action !== '') {

            $query .= "
                AND action = :action
            ";

            $params['action'] = $action;
        }


        $limit = (int) $limit;
        $offset = (int) $offset;

        if ($limit <= 0) {
            $limit = 15;
        }

        if ($offset < 0) {
            $offset = 0;
        }


        $query .= "
            ORDER BY created_at DESC, id DESC
            LIMIT {$limit}
            OFFSET {$offset}
        ";


        return $this->query($query, $params);
    }


    /*
    ========================================
    COUNT LOGS
    ========================================
    */

    public function countLogs(
        $search = '',
        $role = '',
        $action = ''
    ) {

        $query = "
            SELECT COUNT(*) AS total
            FROM audit_logs
            WHERE 1 = 1
        ";

        $params = [];


        if ($search !== '') {

            $query .= "
                AND (
                    user_name LIKE :search
                    OR user_id LIKE :search_id
                    OR action LIKE :search_action
                    OR description LIKE :search_description
                    OR ip_address LIKE :search_ip
                )
            ";

            $searchValue = '%' . $search . '%';

            $params['search'] = $searchValue;
            $params['search_id'] = $searchValue;
            $params['search_action'] = $searchValue;
            $params['search_description'] = $searchValue;
            $params['search_ip'] = $searchValue;
        }


        if ($role !== '') {

            $query .= "
                AND user_role = :role
            ";

            $params['role'] = $role;
        }


        if ($action !== '') {

            $query .= "
                AND action = :action
            ";

            $params['action'] = $action;
        }


        $result = $this->query($query, $params);

        return (int) ($result[0]->total ?? 0);
    }


    /*
    ========================================
    GET ACTION LIST
    ========================================
    */

    public function getActions()
    {
        $query = "
            SELECT DISTINCT action
            FROM audit_logs
            WHERE action IS NOT NULL
            AND action != ''
            ORDER BY action ASC
        ";

        return $this->query($query);
    }
}