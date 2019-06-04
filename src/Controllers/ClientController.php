<?php

namespace Api\Controllers;


use Api\Models\Client;

class ClientController extends Controller
{
    public function store(Request $request, Response $response)
    {
        $response->withHeader("Content-type", "application/json");
        try {
            if (!empty($request->getParam("nombre")) || !empty($request->getParam("apellido")) || empty($request->getParam("nit"))) {
                $client = Client::create($request->getParams());
                if ($client instanceof Client) {
                    return $response->withJson([
                        "status" => 200,
                        "message" => "cliente correcto",
                        "data" => $client->toArray()

                    ], 200);
                }
            }
            return $response->withJson([
                "status" => 202,
                "message" => "Error al crear el cliente, campos nombre, apeliido y nit obligatorio"

            ], 200);
        } catch ( \Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => "Error al crear el cliente: " . $e->getMessage(),
            ], 200);
        }
    }

    public function all (Request $request, Response $response)
    {
        return $response->withJson([
            "status" => 200,
            "message" => "Lista de clientes",
            "data" => Client::all()->toArray()
        ], 200);
    }

    public function find (Request $request, Response $response, $args)
    {
        try {
            return $response->withJson([
                "status" => 200,
                "message" => "Cliente especifico",
                "data" => Client::findOrFail($args['id'])
            ], 200);
        } catch (\Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => $e->getMessage(),
            ], 200);
        }
    }

    public function delete (Request $request, Response $response, $args)
    {
        try {
            $p = Client::findOrFail($args['id']);
            $p->delete();
            return $response->withJson([
                "status" => 200,
                "message" => "Cliente eliminado",
            ], 200);
        } catch (\Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => $e->getMessage(),
            ], 200);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        $response->withHeader("Content-type", "application/json");
        try {
            if (!empty($request->getParam("nombre")) || !empty($request->getParam("apellido")) || !empty($request->getParam("nit"))) {
                $client = Client::createOrUpdate(["id" => $args['id']], $request->getParams());
                if ($client instanceof Client) {
                    return $response->withJson([
                        "status" => 200,
                        "message" => "Cliente actualizado",
                        "data" => $client->toArray()

                    ], 200);
                }
            }
            return $response->withJson([
                "status" => 202,
                "message" => "Error al actualizar el cliente,faltan algunos campos obligatorios"

            ], 200);
        } catch ( \Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => "Error al actualizar el cliente: " . $e->getMessage(),
            ], 200);
        }
    }

}