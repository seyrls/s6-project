<?php

namespace App\Http\Controllers;

use App\Http\Transformers\NestedDataSerializer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

abstract class AbstractController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fractal;
    protected $status_code = 200;

    public function __construct()
    {
        $this->fractal = new Manager();
    }

    public function setStatusCode(int $status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    public function respondWithItem($item, $callback, $resource_key = 'data')
    {
        $this->fractal->setSerializer(new NestedDataSerializer());
        $resource = new Item($item, $callback, $resource_key);
        $root_scope = $this->fractal->createData($resource);

        return $this->respondWithArray($root_scope->toArray());
    }

    public function respondWithCollection($collection, $callback, string $resource_key = 'data')
    {
        $this->fractal->setSerializer(new NestedDataSerializer());
        $resource = new Collection($collection, $callback, $resource_key);
        $root_scope = $this->fractal->createData($resource);

        return $this->respondWithArray($root_scope->toArray());
    }

    protected function respondWithNothing($headers = [])
    {
        return \response()->json(null, $this->status_code, $headers);
    }

    protected function respondWithArray(array $data, array $headers = [])
    {
        return \response()->json($data, $this->status_code, $headers);
    }

    protected function respondWithError(string $message)
    {
        return $this->respondWithArray(
            [
                'error' => [
                    'http_code' => $this->status_code,
                    'message' => $message,
                ],
            ],
            [
                'Content-Type' => 'application/problem+json',
            ]
        );
    }

}
