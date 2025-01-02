<div class="border">
    {{-- The whole world belongs to you. --}}
    <form wire:submit="addContact">
    <div class="row m-2">
        <div class="col-4">
            <label class="form-label" for="apelido">Apelido</label>
            <input class="form-control" type="text" wire:model="name">
        </div>
        <div class="col-5">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" type="email" wire:model="email">
        </div>
    </div>

    <button type="submit" class="m-4 button button-primary">Adicionar</button>

    </form>

    <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
        <div class="text-center text-sm sm:text-left">
            <h3>Pessoas Adicionadas</h3>
            <table class="table table-hover bg-white rounded-3">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                    <tbody>
                        @foreach ($contacts as $index => $contact)
                        <tr>
                            <td class="mb-3">
                                <span>
                                    {{ $contact['name'] }}
                                </span>
                            </td>
                            <td class="mb-3">
                                <span>
                                    {{ $contact['email'] }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-danger filled" wire:click="removeContact({{ $index }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endForeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    @if (count($contacts))
        <button wire:click="handle" class="btn btn-success ml-4 mb-4">Enviar</button>
    @endif
</div>
