<?php


namespace App\Http\Controllers;

use App\Http\Transformers\Vendors\VendorTransformer;
use App\Managers\Vendor\VendorManager;

class VendorController extends Controller
{
    private $manager;

    public function __construct(VendorManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    public function cgetAction(int $user_id)
    {
        $data = $this->manager->getOrders($user_id);

        return $this->respondWithCollection($data, new VendorTransformer());
    }
}