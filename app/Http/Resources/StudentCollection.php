<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'Students fetched successfully Via Api v1.',
            'data' => StudentResource::collection($this->collection),
        ];
    }

    /**
     * Add extra data to the response.
     */
    public function with(Request $request): array
    {
        return [];
    }
}
