<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ErrorAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $errorMessage;
    public string $errorClass;
    public string $errorFile;
    public int    $errorLine;
    public string $errorTrace;
    public string $requestUrl;
    public string $requestMethod;
    public string $appEnv;
    public string $occurredAt;

    public function __construct(Throwable $exception)
    {
        $this->errorMessage  = $exception->getMessage() ?: 'No message';
        $this->errorClass    = get_class($exception);
        $this->errorFile     = $exception->getFile();
        $this->errorLine     = $exception->getLine();
        $this->errorTrace    = collect(explode("\n", $exception->getTraceAsString()))
                                    ->take(15)
                                    ->implode("\n");
        $this->requestUrl    = request()->fullUrl();
        $this->requestMethod = request()->method();
        $this->appEnv        = app()->environment();
        $this->occurredAt    = now()->format('Y-m-d H:i:s T');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[' . strtoupper($this->appEnv) . '] Error: ' . $this->errorClass,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.error-alert',
        );
    }
}
