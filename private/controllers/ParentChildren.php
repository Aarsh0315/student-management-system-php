<?php

class ParentChildren extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if (($_SESSION['rank'] ?? '') !== 'parent') {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $parent_id = $_SESSION['user_id'];
        $school_id = $_SESSION['school_id'] ?? null;

        if (!$parent_id) {
            die("Parent user ID not found.");
        }

        $parentModel = $this->model('ParentModel');

        $parent = $parentModel->getParentByUserId($parent_id);

        if (!$parent) {
            die("Parent record not found.");
        }

        if ($school_id) {

            $children = $parentModel->getChildrenBySchool(
                $parent_id,
                $school_id
            );

        } else {

            $children = $parentModel->getChildren(
                $parent_id
            );

        }

        $this->view('parent-children', [
            'parent' => $parent,
            'children' => $children
        ]);
    }
}