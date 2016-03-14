<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UtlSession {

    private static $BCK_USER_KEY = "bck_user_key";

    public static function getBckUser() {
        @session_start();
        if (isset($_SESSION[self::$BCK_USER_KEY])) {
            $tmpUsr = $_SESSION[self::$BCK_USER_KEY];
            if($tmpUsr->getId()){
                return $tmpUsr;
            }else{
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public static function setBckUser($bckUser) {
        @session_start();
        $_SESSION[self::$BCK_USER_KEY] = $bckUser;
        @session_commit();
    }

    public static function deleteBckUser() {
        @session_start();
        $_SESSION[self::$BCK_USER_KEY] = NULL;
        @session_commit();
    }

}
