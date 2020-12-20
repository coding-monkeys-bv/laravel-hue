<div>
    <h3 class="font-bold text-lg text-indigo-700 leading-tight mb-6">{{ __('Groups') }}</h3>
    <div class="my-6">
        <div class="flex justify-end">
            <input wire:model="search" class="mr-2" type="text" placeholder="{{ __('Search...') }}" />
            <select wire:model="perPage" class="mr-2">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <x-button wire:click="clear" text="Reset" class="mr-2" />
            <x-button wire:click="sync"><x-icon-refresh /></x-button>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Lights') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Any active') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('All active') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($groups as $group)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $group->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $group->lights_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@if($group->any_on) <x-icon-check-circle class="text-green-500" /> @else <x-icon-cross-circle class="text-red-500" /> @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@if($group->all_on) <x-icon-check-circle class="text-green-500" /> @else <x-icon-cross-circle class="text-red-500" /> @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($group->any_on)
                                    <x-button type="danger" wire:click="turnOff('{{ $group->id }}')" text="{{ __('Turn off') }}" />
                                    @else
                                    <x-button type="success" wire:click="turnOn('{{ $group->id }}')" text="{{ __('Turn on') }}" />
                                    @endif
                                    <x-button type="danger" wire:click="delete('{{ $group->id }}')" text="{{ __('Delete') }}" />
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" colspan="4">{{ __('No groups added yet.') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $groups->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
