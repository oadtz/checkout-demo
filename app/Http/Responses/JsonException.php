<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;

class JsonException implements Responsable {
    protected $exception;

    public function __construct (\Exception $exception) {
        $this->exception = $exception;
    }

    public function toResponse ($request) {
        return response()->json([
            'error' =>  $this->exception->getMessage(),
            'code'  =>  $this->getStatusCode()
        ], $this->getStatusCode());
    }

    protected function getStatusCode () {
        if (method_exists($this->exception, 'getStatusCode'))
            return $this->exception->getStatusCode();
        
        return 500;
    }

} 