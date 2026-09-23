<?php

class AuditLogs extends Controller
{
    public function index()
    {
        $this->requireRole('super_admin');

        $auditModel = $this->model('AuditLog');


        $search = trim(
            $_GET['search'] ?? ''
        );

        $role = trim(
            $_GET['role'] ?? ''
        );

        $action = trim(
            $_GET['action'] ?? ''
        );


        $page = max(
            1,
            (int) ($_GET['page'] ?? 1)
        );


        $perPage = 15;

        $offset = ($page - 1) * $perPage;


        /*
        ========================================
        GET LOGS
        ========================================
        */

        $logs = $auditModel->getLogs(
            $search,
            $role,
            $action,
            $perPage,
            $offset
        );


        /*
        ========================================
        TOTAL LOGS
        ========================================
        */

        $totalLogs = $auditModel->countLogs(
            $search,
            $role,
            $action
        );


        $totalPages = max(
            1,
            (int) ceil(
                $totalLogs / $perPage
            )
        );


        /*
        ========================================
        ACTIONS
        ========================================
        */

        $actions = $auditModel->getActions();


        /*
        ========================================
        DATA
        ========================================
        */

        $data = [

            'logs' => $logs,

            'actions' => $actions,

            'search' => $search,

            'role' => $role,

            'action' => $action,

            'page' => $page,

            'totalLogs' => $totalLogs,

            'totalPages' => $totalPages

        ];


        /*
        ========================================
        VIEW
        ========================================
        */

        $this->view(
            'auditlogs/index',
            $data
        );
    }
}