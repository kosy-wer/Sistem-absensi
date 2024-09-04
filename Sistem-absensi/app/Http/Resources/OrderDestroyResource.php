<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDestroyResource extends JsonResource
{
    private $success;
    private $message;

    /**
     * __construct
     *
     * @param  mixed $success
     * @param  mixed $message
     * @return void
     */
    public function __construct($success, $message)
    {
        parent::__construct(null);
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
        ];
    }
}

