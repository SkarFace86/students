<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 2/13/2019
 * Time: 10:11 AM
 */

class Student
{
    private $_sid;
    private $_last;
    private $_first;
    private $_birthdate;
    private $_gpa;
    private $_advisor;

    /**
     * Student constructor.
     * @param $_sid
     * @param $_last
     * @param $_first
     * @param $_birthdate
     * @param $_gpa
     * @param $_advisor
     */
    public function __construct($sid, $last, $first, $birthdate, $gpa, $advisor)
    {
        $this->_sid = $sid;
        $this->_last = $last;
        $this->_first = $first;
        $this->_birthdate = $birthdate;
        $this->_gpa = $gpa;
        $this->_advisor = $advisor;
    }

    /**
     * @return mixed
     */
    public function getSid()
    {
        return $this->_sid;
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return $this->_last;
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->_first;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->_birthdate;
    }

    /**
     * @return mixed
     */
    public function getGpa()
    {
        return $this->_gpa;
    }

    /**
     * @return mixed
     */
    public function getAdvisor()
    {
        return $this->_advisor;
    }

}