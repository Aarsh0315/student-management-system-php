<?php

class StudentModel extends Model
{
    public function getAllStudents()
    {
        $query = "SELECT
                    st.student_id,
                    st.user_id,
                    st.school_id,
                    st.admission_number,
                    st.class,
                    st.division,
                    st.roll_number,
                    st.date_of_birth,
                    st.admission_date,
                    st.parent_name,
                    st.parent_phone,
                    st.parent_email,
                    st.address,
                    st.status,

                    u.firstname,
                    u.lastname,
                    u.email,
                    u.gender,

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM students st

                  INNER JOIN users u
                  ON st.user_id = u.user_id

                  LEFT JOIN schools sc
                  ON st.school_id = sc.id

                  ORDER BY st.student_id DESC";

        return $this->query($query);
    }

    public function getStudentDetails($student_id)
{
    $query = "SELECT

                st.student_id,
                st.user_id,
                st.school_id,
                st.admission_number,
                st.class,
                st.division,
                st.roll_number,
                st.date_of_birth,
                st.admission_date,
                st.parent_name,
                st.parent_phone,
                st.parent_email,
                st.address,
                st.status,
                st.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM students st

              INNER JOIN users u
              ON st.user_id = u.user_id

              LEFT JOIN schools sc
              ON st.school_id = sc.id

              WHERE st.student_id = :student_id

              LIMIT 1";

    $result = $this->query($query, [
        'student_id' => $student_id
    ]);

    return $result[0] ?? false;
}
}