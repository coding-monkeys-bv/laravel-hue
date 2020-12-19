<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hue Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                
                <table>
                    @foreach($groups as $group)
                    <thead>
                        <tr>
                            <th>{{ $group->name }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Naam</td>
                            <td>Ingeschakeld</td>
                        </tr>
                        @foreach($group->lights as $light)
                        <tr>
                            <td>{{ $light->name }}</td>
                            <td>{{ $light->on }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
