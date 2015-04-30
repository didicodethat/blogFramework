<?php
namespace Helper;

class SecurityHelper{
    public static function function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
}