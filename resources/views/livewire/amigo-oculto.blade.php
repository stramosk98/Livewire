<div class="border">
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="addParticipant">
        <div class="row m-2">
            <div class="col-4">
                <label class="form-label" for="name">Apelido</label>
                <input id="name" class="form-control" type="text" wire:model.lazy="name" placeholder="Digite o apelido">
            </div>
            <div class="col-5">
                <label class="form-label" for="email">E-mail</label>
                <input id="email" class="form-control" type="email" wire:model.lazy="email" placeholder="Digite o e-mail">
            </div>
        </div>
        <button type="submit" class="m-4 btn btn-primary">Adicionar</button>
    </form>
    <div class="ml-4 mr-4">
        <h3 class="text-center">Pessoas Adicionadas</h3>
        @if (count($participants))
            <table class="table table-hover bg-white rounded-3">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $index => $participant)
                        <tr>
                            <td>{{ $participant['name'] }}</td>
                            <td>{{ $participant['email'] }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="removeParticipant({{ $index }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button wire:click="handle" class="btn btn-success ml-4 mb-4">Enviar</button>
        @else
            <p class="text-center mt-4 text-muted">Nenhum contato adicionado ainda.</p>
        @endif
        <x-toaster-hub />
    </div>
</div>
