<?php

namespace App\Livewire;

use App\Jobs\SendEmail;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class AmigoOculto extends Component
{
    use Toastable;

    public $participants = [];

    public $name = '';

    public $email = '';

    private $usedEmailsIndex = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    /**
     * Adiciona participante
     * @return void
     */
    public function addParticipant(): void
    {
        $this->validate();

        $this->participants[] = ['name' => $this->name, 'email' => $this->email];

        $this->reset(['name', 'email']);
    }

    /**
     * Remove participante
     * @param mixed $index
     * @return void
     */
    public function removeParticipant($index): void
    {
        if (isset($this->participants[$index])) {
            unset($this->participants[$index]);
            $this->participants = array_values($this->participants);
            $this->success('Participante removido!');
        } else {
            $this->error('Participante não encontrado');
        }
    }

    /**
     * Sorteia participantes e envia emails
     * @return void
     */
    public function handle()
    {
        if (count($this->participants) < 2) {
            $this->warning('É necessário mais de um participante');
            return;
        }

        $newParticipants = [];
        $this->usedEmailsIndex = [];

        foreach($this->participants as $key => $participant) {
            $rand = $this->getRandomIndex(0, count($this->participants) - 1, $key);
            $newParticipants[] = ['name' => $participant['name'], 'email' => $this->participants[$rand]['email']];
        }

        SendEmail::dispatch($newParticipants);

        $this->participants = [];

        $this->success('E-mails enviados com sucesso!');
    }

    /**
     * Retorna um número randômico
     * @param int $min
     * @param int $max
     * @param int $currentIndex
     * @return int
     */
    private function getRandomIndex($min, $max, $currentIndex): int
    {
        do {
            $rand = rand($min, $max);
        } while ($rand == $currentIndex || in_array($rand, $this->usedEmailsIndex));

        $this->usedEmailsIndex[] = $rand;

        return $rand;
    }

    public function render()
    {
        return view('livewire.amigo-oculto');
    }
}
