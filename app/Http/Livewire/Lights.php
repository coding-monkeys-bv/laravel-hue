<?php

namespace App\Http\Livewire;

use App\Models\Light;
use Illuminate\Support\Facades\Artisan;

class Lights extends Datatable
{
    public function sync()
    {
        Artisan::call('hue:sync-lights');
    }

    public function turnOn(String $hueID)
    {
        Artisan::call('hue:turn-on-light '.$hueID);
    }

    public function turnOff(String $hueID)
    {
        Artisan::call('hue:turn-off-light '.$hueID);
    }

    public function delete(String $hueID)
    {
        Artisan::call('hue:delete-light '.$hueID);
    }

    public function render()
    {
        return view('livewire.lights', [
            'lights' => Light::search($this->search)
                ->withCount('groups')
                ->paginate($this->perPage),
        ]);
    }
}
