<div>
    <h3 class="font-bold text-lg text-indigo-700 leading-tight mb-6">{{ __('Lights') }}</h3>
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
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Type') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product Name') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('On') }}</th>
                                <th scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Reachable') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($lights as $light)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $light->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $light->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $light->productname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@if($light->on) <x-icon-check-circle class="text-green-500" /> @else <x-icon-cross-circle class="text-red-500" /> @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@if($light->reachable) <x-icon-check-circle class="text-green-500" /> @else <x-icon-cross-circle class="text-red-500" /> @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($light->on)
                                    <x-button type="danger" wire:click="turnOff('{{ $light->id }}')" text="{{ __('Turn off') }}" />
                                    @else
                                    <x-button type="success" wire:click="turnOn('{{ $light->id }}')" text="{{ __('Turn on') }}" />
                                    @endif
                                    <x-button type="danger" wire:click="delete('{{ $light->id }}')" text="{{ __('Delete') }}" />
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" colspan="4">{{ __('No lights added yet.') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $lights->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
