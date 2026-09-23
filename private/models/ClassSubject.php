<?php

class ClassSubject extends Model
{
    /*
    =====================================================
    GET ALL ASSIGNMENTS FOR A SCHOOL
    =====================================================
    */

    public function getAllBySchool($school_id)
    {
        $query = "SELECT
                    cs.id,
                    cs.school_id,
                    cs.class,
                    cs.division,
                    cs.subject_id,
                    cs.teacher_id,
                    cs.status,
                    cs.created_at,
                    cs.updated_at,

                    s.name AS subject_name,
                    s.code AS subject_code,

                    st.user_id,
                    u.firstname,
                    u.lastname,
                    u.email

                  FROM class_subjects cs

                  INNER JOIN subjects s
                    ON cs.subject_id = s.id

                  INNER JOIN staff st
                    ON cs.teacher_id = st.staff_id
                    AND st.school_id = cs.school_id

                  INNER JOIN users u
                    ON st.user_id = u.user_id

                  WHERE cs.school_id = :school_id

                  ORDER BY
                    cs.class ASC,
                    cs.division ASC,
                    s.name ASC";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    GET ASSIGNMENTS BY CLASS
    =====================================================
    */

    public function getByClass(
        $school_id,
        $class,
        $division
    ) {
        $query = "SELECT
                    cs.id,
                    cs.school_id,
                    cs.class,
                    cs.division,
                    cs.subject_id,
                    cs.teacher_id,
                    cs.status,

                    s.name AS subject_name,
                    s.code AS subject_code,

                    st.user_id,
                    u.firstname,
                    u.lastname

                  FROM class_subjects cs

                  INNER JOIN subjects s
                    ON cs.subject_id = s.id

                  INNER JOIN staff st
                    ON cs.teacher_id = st.staff_id
                    AND st.school_id = cs.school_id

                  INNER JOIN users u
                    ON st.user_id = u.user_id

                  WHERE cs.school_id = :school_id
                  AND cs.class = :class
                  AND cs.division = :division

                  ORDER BY s.name ASC";

        return $this->query($query, [
            'school_id' => $school_id,
            'class' => $class,
            'division' => $division
        ]);
    }


    /*
    =====================================================
    GET SINGLE ASSIGNMENT
    =====================================================
    */

    public function getById(
        $id,
        $school_id
    ) {
        $query = "SELECT
                    cs.id,
                    cs.school_id,
                    cs.class,
                    cs.division,
                    cs.subject_id,
                    cs.teacher_id,
                    cs.status,

                    s.name AS subject_name,
                    s.code AS subject_code,

                    st.user_id,
                    u.firstname,
                    u.lastname,
                    u.email

                  FROM class_subjects cs

                  INNER JOIN subjects s
                    ON cs.subject_id = s.id

                  INNER JOIN staff st
                    ON cs.teacher_id = st.staff_id
                    AND st.school_id = cs.school_id

                  INNER JOIN users u
                    ON st.user_id = u.user_id

                  WHERE cs.id = :id
                  AND cs.school_id = :school_id

                  LIMIT 1";

        $result = $this->query($query, [
            'id' => $id,
            'school_id' => $school_id
        ]);

        return $result[0] ?? false;
    }


    /*
    =====================================================
    CREATE ASSIGNMENT
    =====================================================
    */

    public function createAssignment(
        $school_id,
        $class,
        $division,
        $subject_id,
        $teacher_id
    ) {
        $query = "INSERT INTO class_subjects
                    (
                        school_id,
                        class,
                        division,
                        subject_id,
                        teacher_id,
                        status
                    )

                  VALUES
                    (
                        :school_id,
                        :class,
                        :division,
                        :subject_id,
                        :teacher_id,
                        1
                    )";

        return $this->query($query, [
            'school_id' => $school_id,
            'class' => $class,
            'division' => $division,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id
        ]);
    }


    /*
    =====================================================
    UPDATE ASSIGNMENT
    =====================================================
    */

    public function updateAssignment(
        $id,
        $school_id,
        $class,
        $division,
        $subject_id,
        $teacher_id
    ) {
        $query = "UPDATE class_subjects

                  SET
                    class = :class,
                    division = :division,
                    subject_id = :subject_id,
                    teacher_id = :teacher_id

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $school_id,
            'class' => $class,
            'division' => $division,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id
        ]);
    }


    /*
    =====================================================
    ACTIVATE
    =====================================================
    */

    public function activate(
        $id,
        $school_id
    ) {
        $query = "UPDATE class_subjects

                  SET status = 1

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    DEACTIVATE
    =====================================================
    */

    public function deactivate(
        $id,
        $school_id
    ) {
        $query = "UPDATE class_subjects

                  SET status = 0

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    DELETE
    =====================================================
    */

    public function deleteAssignment(
        $id,
        $school_id
    ) {
        $query = "DELETE FROM class_subjects

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id' => $id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    CHECK DUPLICATE SUBJECT ASSIGNMENT
    =====================================================
    */

    public function assignmentExists(
        $school_id,
        $class,
        $division,
        $subject_id,
        $exclude_id = null
    ) {
        $query = "SELECT id

                  FROM class_subjects

                  WHERE school_id = :school_id
                  AND class = :class
                  AND division = :division
                  AND subject_id = :subject_id";

        $params = [
            'school_id' => $school_id,
            'class' => $class,
            'division' => $division,
            'subject_id' => $subject_id
        ];

        if ($exclude_id !== null) {

            $query .= "
                AND id != :exclude_id
            ";

            $params['exclude_id'] = $exclude_id;
        }

        $query .= " LIMIT 1";

        $result = $this->query(
            $query,
            $params
        );

        return !empty($result);
    }
}