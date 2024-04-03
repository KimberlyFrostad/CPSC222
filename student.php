<?php
class Student {
    private $first;
    private $last;
    private $ID;
    private $courses = array();

    public function __construct($first, $last, $ID, $courses) {
        $this->setFirstName($first);
        $this->setLastName($last);
        $this->setStudentID($ID);
        $this->setCourses($courses);
    }

    public function setFirstName($first) {
        $this->firstName = $first;
    }

    public function setLastName($last) {
        $this->lastName = $last;
    }

    public function setStudentID($ID) {
        $this->studentID = $ID;
    }

    public function setCourses($courses) {
        $this->courses = $courses;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getStudentID() {
        return $this->studentID;
    }

    public function getCourses() {
        return $this->courses;
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

