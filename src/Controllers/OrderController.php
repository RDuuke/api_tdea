<?php

namespace Api\Controllers;


use Api\Models\Order;
use Api\Models\OrderDetails;
use Slim\Http\Request;
use Slim\Http\Response;

class OrderController extends Controller
{
    public function store(Request $request, Response $response)
    {
        $response->withHeader("Content-type", "application/json");
        try {

            $order = new Order();
            $order->iva = $request->getParam("iva");
            $order->valor = $request->getParam("iva");
            $order->valor_total = $request->getParam("valor_total");
            $order->direccion = $request->getParam("direccion");
            $order->celular = $request->getParam("celular");
            $order->observaciones = $request->getParam("observaciones");
            $order->usuario_id = $this->auth->user()->id;

            if ($order->save() ) {
                foreach ($request->getParam("productos") as $k => $v) {
                    $details = new OrderDetails();
                    $details->pedido_id = $order->id;
                    $details->producto_codigo = $v->producto_codigo;
                    $details->cantidad = $v->cantidad;
                    $details->save();
                }
            }
             return $response->withJson([
                 "status" => 200,
                 "message" => "Pedido guardado",
                 "data" => $order->toArray()
             ]);

        } catch (\Exception $e) {
            return $response->withJson([
                "status" => 201,
                 "message" => "Error al crear el pedido: ". $e->getMessage()
             ], 200);
        }



        function all (Request $request, Response $response)
        {
            if ($this->auth->user()->perfil != SA) {
                $orders = Order::where("usuario_id", $this->auth->user()->id)->get()->toArray();
            } else {
                $orders = Order::all()->toArray();
            }
            return $response->withJson([
                "status" => 201,
                "message" => "Lista de pedidos: ",
                "data" => $orders
            ], 200);
        }

        function delete (Request $request, Response $response, $args)
        {
            try {
                $order = Order::findOrFails($args['id']);
                $order->details->delete();
                $order->delete();
                $response->withJson([
                    "status" => 200,
                    "message" => "Correcto",
                ], 200);

            } catch (\Exception $e) {
                $response->withJson([
                    "status" => 201,
                    "message" => "Error " . $e->getMessage(),
                ], 200);
            }
        }

        function changeState (Request $request, Response $response, $args)
        {
            try {
                $order = Order::findOrFails($args['id']);
                $order->estado = 1;
                $order->save();
                $response->withJson([
                    "status" => 200,
                    "message" => "Correcto",
                    "data" => $order->toArray()
                ], 200);

            } catch (\Exception $e) {
                $response->withJson([
                    "status" => 201,
                    "message" => "Error " . $e->getMessage(),
                ], 200);
            }
        }
    }

}