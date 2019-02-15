<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 1/9/2019
 * Time: 1:30 PM
 * Initiate fat free
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
//Require fat-free
require_once('vendor/autoload.php');
require_once('model/db-functions.php');

//connect to database
$dbh = connect();
//print_r($dbh);
if(!$dbh) {
    exit;
}

//Create an instance of the Base class
$f3 = Base::instance();

//Turn of fat free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function($f3) {

    $students = getStudents();
    //print_r($students);

    $f3->set('students', $students);

    $template = new Template();
    echo $template->render('views/all-students.html');
});

$f3->route('GET|POST /add', function($f3) {

    if(isset($_POST['submit'])) {
        $sid = $_POST['sid'];
        $last = $_POST['last'];
        $first = $_POST['first'];
        $birthdate = $_POST['birthdate'];
        $gpa = $_POST['gpa'];
        $advisor = $_POST['advisor'];

        $success = addStudent($sid, $last, $first,
        $birthdate, $gpa, $advisor);

        if($success) {
            echo "<h3>Student added successfully.</h3>";
        } else {
            echo "<h3>NOT ADDED SUCCESSFULLY</h3>";
        }


    }
    //Test add student function
    //$success = addStudent(111222333, "Skar", "Brandon",
    //    "1986-02-18", "3.2", "Andy Orr");
    $template = new Template();
    echo $template->render('views/add-student.html');
});


//Run fat-free
$f3->run();
