<?php

namespace App\Exceptions;

use Exception;

class InvalidException extends Exception
{

    public function render($request)
    {
        return response()->json([
            'message' => 'Invalid data',
            'errors' => $this->getMessage()
        ], 422);
    }
}
