<?php

namespace Api\Controllers;


use Api\Models\Product;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController extends Controller
{
    public function store(Request $request, Response $response)
    {
        $response->withHeader("Content-type", "application/json");
        try {
            if (!empty($request->getParam("nombre")) || !empty($request->getParam("codigo"))) {
                $product = Product::create($request->getParams());
                if ($product instanceof Product) {
                    return $response->withJson([
                        "status" => 200,
                        "message" => "producto correcto",
                        "data" => $product->toArray()

                    ], 200);
                }
            }
            return $response->withJson([
                "status" => 202,
                "message" => "Error al crear producto, todos los campos son obligatorios"

            ], 200);
        } catch ( \Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => "Error al crear producto: " . $e->getMessage(),
            ], 200);
        }
    }

    public function all (Request $request, Response $response)
    {
        return $response->withJson([
            "status" => 200,
            "message" => "Lista de productos",
            "data" => Product::all()->toArray()
        ], 200);
    }

    public function find (Request $request, Response $response, $args)
    {
        try {
            return $response->withJson([
                "status" => 200,
                "message" => "Producto especifico",
                "data" => Product::findOrFail($args['id'])
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
            $p = Product::findOrFail($args['id']);
            $p->delete();
            return $response->withJson([
                "status" => 200,
                "message" => "Producto eliminado",
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
            if (!empty($request->getParam("nombre")) || !empty($request->getParam("codigo"))) {
                $product = Product::createOrUpdate(["id" => $args['id']], $request->getParams());
                if ($product instanceof Product) {
                    return $response->withJson([
                        "status" => 200,
                        "message" => "producto actualizado",
                        "data" => $product->toArray()

                    ], 200);
                }
            }
            return $response->withJson([
                "status" => 202,
                "message" => "Error al actualizar el producto, todos los campos son obligatorios"

            ], 200);
        } catch ( \Exception $e) {
            return $response->withJson([
                "status" => 201,
                "message" => "Error al actualizar el producto: " . $e->getMessage(),
            ], 200);
        }
    }


}