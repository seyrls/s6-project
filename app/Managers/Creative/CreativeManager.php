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

    public function updateCreative(array $data)
    {
        $repo = new Creative();
        $repo->name = $data['name'] ?? $repo->getOriginal('name');
        $repo->description = $data['description'] ?? $repo->getOriginal('description');;

        return $repo->saveOrFail();
    }

    public function isCreativeValid(int $id): bool
    {
        $creative = $this->repo::findOrFail($id);

        return isset ($creative->id);
    }
}