@props(['disabled' => false])

<input {{ $attributes->class(['bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5', 'bg-gray-100 cursor-default' => $disabled, '!p-0 file:p-2 file:rounded-l-lg file:border-0 file:bg-gray-500 file:text-white' => $attributes->get('type') == 'file'])->merge(['type' => 'text']) }}/>