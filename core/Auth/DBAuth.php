<?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 22/06/2018
 * Time: 10:05
 */

namespace Core\Auth;



Class DBAuth {


    private $db;

    public function __construct(\Core\Database\MysqlDatabase $db)
    {

        $this->db = $db;
    }


    public function login($username,$password){

        $user=$this->db->prepareSMEF('SELECT * FROM users WHERE email = ?',[$username]);
        var_dump($user);

    }

    public function logged(){

        return isset($_SESSION['auth']);
    }


}