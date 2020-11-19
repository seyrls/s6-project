<?php

namespace App\Http\Controllers;


use App\Http\Transformers\Products\ProductTransformer;
use App\Managers\Product\ProductManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    private $manager;

    public function __construct(ProductManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    public function cgetAction()
    {

    }

    public function getAction(int $id)
    {
        try {
            $data = $this->manager->getProduct($id);
        } catch (ModelNotFoundException $ex) {
            return $this->setStatusCode(404)
                        ->respondWithError('Product not found. Please, try it again.');
        } catch (\Exception $ex) {
            return $this->setStatusCode(500)
                        ->respondWithError('Internal error.');
        }

        return $this->respondWithItem($data->toArray(), new ProductTransformer());
    }

    public function postAction()
    {

    }

    public function patchAction()
    {

    }
}