<?php

namespace App\Collections;

use App\DTO\ProductoCantidadDTO;
use App\Utils\ObjectList;

class ProductoCantidadCollection extends ObjectList
{
    protected $validType = ProductoCantidadDTO::class;

    protected $uniqueProperty = null;

    public function __contruct(array $collection = [])
    {
        parent::__construct($collection);
    }
}
