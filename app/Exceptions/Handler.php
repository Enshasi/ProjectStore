<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [   //Dont Save in Old Request
        'current_password',
        'password',
        'password_confirmation',
        'credit_card',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        //Handle Query Exception and Redirect Back with Error Message
        $this->renderable(function (QueryException $e) {

               // if($e->getCode() == 23000){
            //     return redirect()->back()->withInput()->withErrors([
            //         'error' => 'Something went wrong. Please try again later.'
            //     ]);
            // }

            // return redirect()->back()->withInput()->withErrors([
            //     'error' => 'Something went wrong. Please try again later.'
            // ]);
        });

    }
}
