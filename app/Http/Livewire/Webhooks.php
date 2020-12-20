<?php

namespace App\Http\Livewire;

use App\Models\Webhook;

class Webhooks extends Datatable
{
    public function delete(Webhook $webhook)
    {
        $webhook->delete();
    }

    public function render()
    {
        return view('livewire.webhooks', [
            'webhooks' => Webhook::search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
