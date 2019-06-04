<?php

namespace Api\Auth;


use Api\Models\User;

class Auth
{
    function attemp(String $user, String $password) : bool {
        $user = User::where("usuario", $user)->first();
        if (! $user instanceof User) {
            return false;
        }
        if (md5($password) == $user->clave) {
            $_SESSION["user_api_tdea"] = $user->toArray();
            return true;
        }
        return false;
    }

    public function user() {
        return $_SESSION["user_api_tdea"];
    }

    public function logout() {
        return session_destroy();
    }

    public function check() {
        if (isset($_SESSION['user_api_tdea'])) {
            return true;
        }
        return false;
    }

}