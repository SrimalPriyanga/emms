<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mresult extends CI_Model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_user_records($studentId) {
        $query = $this->db->query(
                'SELECT schools.school_name, students.f_name, students.m_name, students.l_name
                FROM students
                INNER JOIN schools ON students.school_id = schools.school_id
                WHERE students.nsi=' . $studentId);
        return $query->result();
    }
    
    function get_results() {
        $query = $this->db->query(
                'SELECT subjects.subject_id, subjects.subject_name, marks.marks, students.term, grades.grade_num, grades.grade_letter
                FROM marks
                INNER JOIN students ON students.student_id = marks.student_id
                INNER JOIN grades ON marks.grade_id = grades.grade_id
                INNER JOIN subjects ON marks.subject_id = subjects.subject_id
                WHERE students.nsi=' . $this->session->userdata['user_nsi'] . ' AND students.grade = marks.grade_id AND students.term = marks.term
                ORDER by subjects.subject_id;');
        return $query->result();
    }
    
    function previous_results($grade, $term) {
        $query = $this->db->query(
                'SELECT subjects.subject_id, subjects.subject_name, marks.marks, marks.term, grades.grade_num, grades.grade_letter
                FROM marks
                INNER JOIN students ON students.student_id = marks.student_id
                INNER JOIN grades ON marks.grade_id = grades.grade_id
                INNER JOIN subjects ON marks.subject_id = subjects.subject_id
                WHERE students.nsi = ' . $this->session->userdata['user_nsi'] . ' AND grades.grade_num = '.$grade.' AND marks.term = '.$term.'
                ORDER by subjects.subject_id;');
        return $query->result();
    }
    
    function get_resultForHistoryChart($grade) {
        //$obj_resultt = new Result;
        $query = $this->db->query(
                'SELECT subjects.subject_id, marks.marks, marks.term, subjects.subject_name
                FROM marks
                INNER JOIN students ON students.student_id = marks.student_id
                INNER JOIN grades ON marks.grade_id = grades.grade_id
                INNER JOIN subjects ON marks.subject_id = subjects.subject_id
                WHERE students.nsi='.$this->session->userdata['user_nsi'].' AND marks.grade_id = '.$grade.'
                ORDER by subjects.subject_id');
        return $query->result();
    }

}