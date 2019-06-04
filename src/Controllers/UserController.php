<?php

namespace Api\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{
    public function singIn(Request $request, Response $response)
    {
        $response->withHeader("Content-type", "application/json");
        if ($this->auth->attemp($request->getParam("usuario"), $request->getParam("password"))) {

            return $response->withJson([
                "status" => 200,
                "message" => "Usuario correcto",
                "data" => $this->auth->user()

            ], 200);
        }

        return $response->withJson([
            "status" => 201,
            "message" => "Usuario incorrecto",
            "data" => []

        ], 200);
    }

    public function logout(Request $request, Response $response)
    {
        $response->withHeader("Content-type", "application/json");
        $this->auth->logout();
        $response->withJson([
            "status" => 202,
            "message" => "Usuario desconectado",
            "data" => []

        ], 200);

    }

}