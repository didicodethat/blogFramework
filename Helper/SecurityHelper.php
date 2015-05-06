<?php
namespace Helper;

class SecurityHelper{
    public static function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
}