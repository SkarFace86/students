<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 2/13/2019
 * Time: 10:12 AM
 */

require_once('/home/bskargre/config.php');

function connect()
{
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        return $dbh;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function getStudents()
{
    global $dbh;

    $sql = "SELECT * FROM student ORDER BY last, first";

    $statement = $dbh->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function addStudent($sid, $last, $first, $birthdate, $gpa, $advisor)
{
    global $dbh;

    $sql = "INSERT INTO student(sid, last, first, birthdate,
          gpa, advisor)
           VALUES (:sid, :last, :first,
          :birthdate, :gpa, :advisor)";
    $statement = $dbh->prepare($sql);

    $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
    $statement->bindParam(':last', $last, PDO::PARAM_STR);
    $statement->bindParam(':first', $first, PDO::PARAM_STR);
    $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
    $statement->bindParam(':gpa', $gpa, PDO::PARAM_STR);
    $statement->bindParam(':advisor', $advisor, PDO::PARAM_STR);

    $statement->execute();
    $arr = $statement->errorInfo();
    if(isset($arr[2])) {
        print_r($arr[2]);
    }
    return $statement;
}

function getStudent($sid)
{
    global $dbh;

    $sql = "SELECT * FROM student
            WHERE sid = :sid";
    $statement = $dbh->prepare($sql);

    $statement->bindParam(':sid', $sid, PDO::PARAM_STR);

    $statement->execute();
    $arr = $statement->errorInfo();
    if(isset($arr[2])) {
        print_r($arr[2]);
    }

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $student = new Student($result['sid'], $result['last'], $result['first'],
        $result['birthdate'], $result['gpa'], $result['advisor']);
    return $student;
}