<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ErrorAlertMail;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // Don't report these exception types
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Only send email on production
            if (app()->environment('production')) {
                try {
                    Mail::to(config('app.error_alert_email', config('mail.from.address')))
                        ->send(new ErrorAlertMail($e));
                } catch (Throwable $mailException) {
                    // Silently fail — don't cause infinite loop
                    logger()->error('Error alert mail failed: ' . $mailException->getMessage());
                }
            }
        });
    }
}
