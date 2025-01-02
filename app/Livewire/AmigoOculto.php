<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class AmigoOculto extends Component
{
    public $contacts = [];
    
    public $name = '';
    
    public $email = '';

    public function addContact()
    {
        $this->contacts[] = ['name' => $this->name, 'email' => $this->email];
    }
    
    public function removeContact($index = 2)
    {
        $this->contacts = collect($this->contacts)->filter(function ($value, $key) use ($index) {
            return $key != $index;
        });
    }
    
    public function handle()
    {
        foreach($this->contacts as $contact) {
            $contact['name'];
        }

        // $arr = 
    }

    public function render()
    {
        return view('livewire.amigo-oculto');
    }
}
