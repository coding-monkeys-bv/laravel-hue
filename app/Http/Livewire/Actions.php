<?php

namespace App\Http\Livewire;

use App\Models\Action;

class Actions extends Datatable
{
    public function render()
    {
        return view('livewire.actions', [
            'actions' => Action::search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
