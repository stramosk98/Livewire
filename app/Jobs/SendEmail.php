<?php

namespace App\Jobs;

use App\Mail\ParticipantEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $participants;

    /**
     * Create a new job instance.
     */
    public function __construct(array $participants)
    {
        $this->participants = $participants;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->participants as $participant) {
            try {
                Mail::to($participant['email'])->send(new ParticipantEmail($participant['name']));
            } catch (Throwable $e) {
                Log::error('Erro ao enviar e-mail para participante.', [
                    'email' => $participant['email'],
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
