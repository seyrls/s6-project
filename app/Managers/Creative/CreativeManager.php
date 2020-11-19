<?php

namespace App\Managers\Creative;

use App\Models\Creative;

class CreativeManager {

    private $repo;

    public function __construct(Creative $creative)
    {
        $this->repo = $creative;
    }

    public function getCreatives()
    {
        return $this->repo::all();
    }

    public function getCreative(int $id)
    {
        return $this->repo::findOrFail($id);
    }

    public function createCreative(array $data)
    {
        $repo = new Creative();
        $repo->name = $data['name'];
        $repo->description = $data['description'];

        return $repo->saveOrFail();
    }

    public function updateCreative()
    {

    }

    public function isCreativeValid(): bool
    {

    }
}