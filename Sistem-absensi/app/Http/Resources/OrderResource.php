<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    private $success;
    private $message;

    /**
     * __construct
     *
     * @param  mixed $status                                         * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */

    public function __construct($success, $message, $resource)
    {
        parent::__construct($resource);
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * toArray
     *
     * @param  mixed $request
     * @return array
     */

    public function toArray($request): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data'    => $this->resource,
        ];
    }
}

