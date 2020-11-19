<?php

namespace App\Http\Controllers;

use App\Http\Transformers\Creatives\CreativeTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\CreativeRequestValidator;
use App\Managers\Creative\CreativeManager;

class CreativeController extends Controller
{
    private $manager;

    public function __construct(CreativeManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    public function cgetAction()
    {
        $data = $this->manager->getCreatives();

        return $this->respondWithCollection($data->toArray(), new CreativeTransformer());
    }

    public function getAction(int $id)
    {
        try {
            $data = $this->manager->getCreative($id);
        } catch (ModelNotFoundException $ex) {
            return $this->setStatusCode(404)
                        ->respondWithError('Creative not found. Please, try it again.');
        } catch (\Exception $ex) {
            return $this->setStatusCode(500)
                        ->respondWithError('Internal error.');
        }

        return $this->respondWithItem($data->toArray(), new CreativeTransformer());
    }

    public function postAction(CreativeRequestValidator $request)
    {
        $validation = $request->validate($request->rules());

        if (empty($validation) === false) {
            return $this->setStatusCode(400)
                        ->respondWithError($validation);
        }

        try {
            $result = $this->manager->createCreative($request->toArray());
        } catch (\Exception $ex) {
            return $this->setStatusCode(500)->respondWithError('Internal error.');
        }

        return $this->setStatusCode(204)->respondWithNothing();
    }

    public function patchAction(Request $request, int $id)
    {

    }
}
