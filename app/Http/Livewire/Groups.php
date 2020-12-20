<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Illuminate\Support\Facades\Artisan;

class Groups extends Datatable
{
    public function sync()
    {
        Artisan::call('hue:sync-groups');
    }

    public function turnOn(String $hueID)
    {
        Artisan::call('hue:turn-on-group '.$hueID);
    }

    public function turnOff(String $hueID)
    {
        Artisan::call('hue:turn-off-group '.$hueID);
    }

    public function delete(String $hueID)
    {
        Artisan::call('hue:delete-group '.$hueID);
    }

    public function render()
    {
        return view('livewire.groups', [
            'groups' => Group::search($this->search)
                ->withCount('lights')
                ->paginate($this->perPage),
        ]);
    }
}
