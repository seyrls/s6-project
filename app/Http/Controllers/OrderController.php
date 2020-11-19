<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequestValidator;
use App\Http\Transformers\Orders\OrderTransformer;
use App\Managers\Order\OrderManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    private $manager;

    public function __construct(OrderManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    public function cgetAction(int $user_id)
    {
        $data = $this->manager->getOrders($user_id);

        return $this->respondWithCollection($data, new OrderTransformer());
    }

    public function getAction(int $order_id)
    {
        try {
            $data = $this->manager->getOrder($order_id);
        } catch (ModelNotFoundException $ex) {
            return $this->setStatusCode(404)
                        ->respondWithError('Order not found. Please, try it again.');
        } catch (\Exception $ex) {
            return $this->setStatusCode(500)
                        ->respondWithError($ex->getMessage());
        }

        return $this->respondWithItem($data, new OrderTransformer());
    }

    public function postAction(OrderRequestValidator $request)
    {
        $validation = $request->validate($request->rules());

        if (empty($validation) === false) {
            return $this->setStatusCode(400)
                        ->respondWithError('Invalid fields.');
        }

        try {
            $this->manager->createOrder($request->toArray());
        } catch (\Exception $ex) {
            return $this->setStatusCode(500)->respondWithError('Internal error.');
        }

        return $this->setStatusCode(204)->respondWithNothing();
    }
}