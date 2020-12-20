@props([
    'type' => 'submit',
    'classes' => [
        'submit' => 'border-transparent text-white bg-indigo-600 hover:bg-indigo-500 focus:border-indigo-700 active:bg-indigo-700',
        'button' => 'text-indigo-500 hover:text-indigo-700 focus:border-indigo-300 active:bg-gray-50 active:text-gray-800',
        'danger' => 'border-transparent text-white bg-red-600 hover:bg-red-500 focus:border-red-700 active:bg-red-700',
        'success' => 'border-transparent text-white bg-green-600 hover:bg-green-500 focus:border-green-700 active:bg-green-700',
    ],
    'text' => null,
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes[$type].' whitespace-nowrap py-2 px-4 rounded-md font-bold focus:outline-none focus:shadow-outline-indigo no-underline transition duration-150 ease-in-out']) }}>
    @if(! is_null($text))
    {{ __($text) }}
    @else
    {{ $slot }}
    @endif
</button>