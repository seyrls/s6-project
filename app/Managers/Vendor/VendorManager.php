<?php

namespace App\Managers\Vendor;


use App\Models\Vendor;

class VendorManager
{
    private $repo;

    public function __construct(Vendor $repo)
    {
        $this->repo = $repo;
    }

    public function getOrders(int $vendor_id)
    {
        return $this->repo::where('vendor_id', $vendor_id);
    }
}