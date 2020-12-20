<?php

namespace Database\Seeders;

use App\Models\Webhook;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $colors = [
        'green' => 30000,
        'red' => 65535,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Michael',
            'email' => 'info@voicecode.nl',
            'password' => bcrypt('secret'),
        ]);

        $action = [
            'on' => true,
            'bri' => 254,
            'hue' => $this->colors['red'],
            'sat' => 255,
        ];

        \App\Models\Action::factory()->create([
            'name' => 'Red',
            'description' => 'Turn lights red',
            'action' => (object) $action,
        ]);

        $action['hue'] = $this->colors['green'];

        \App\Models\Action::factory()->create([
            'name' => 'Green',
            'description' => 'Turn lights green',
            'action' => (object) $action,
        ]);

        $action['hue'] = $this->colors['red'];
        $action['alert'] = 'select';

        \App\Models\Action::factory()->create([
            'name' => 'Blink red once',
            'description' => 'Blink red once',
            'action' => (object) $action,
        ]);

        $action['hue'] = $this->colors['green'];

        \App\Models\Action::factory()->create([
            'name' => 'Blink green once',
            'description' => 'Blink green once',
            'action' => (object) $action,
        ]);

        $action['hue'] = $this->colors['red'];
        $action['alert'] = 'lselect';

        \App\Models\Action::factory()->create([
            'name' => 'Blink red for 10 seconds',
            'description' => 'Blink red for 10 seconds',
            'action' => (object) $action,
        ]);

        $action['hue'] = $this->colors['green'];

        \App\Models\Action::factory()->create([
            'name' => 'Blink green for 10 seconds',
            'description' => 'Blink green for 10 seconds',
            'action' => (object) $action,
        ]);

        Webhook::create([
            'action_id' => 5,
            'hue_id' => 1,
            'type' => 'groups',
            'name' => 'Red alert!',
            'description' => 'Red alert group action',
            'token' => 'red-alert',
        ]);

        Webhook::create([
            'action_id' => 6,
            'hue_id' => 4,
            'type' => 'lights',
            'name' => 'Green alert!',
            'description' => 'Green alert light action',
            'token' => 'green-alert',
        ]);
    }
}
