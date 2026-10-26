<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold">Garage Inventory Summary</h3>
                        <p class="text-gray-600">Total spare parts in stock: <strong>{{ $totalProducts }}</strong></p>
                    </div>
                    <a href="{{ route('admin.inventory') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Manage Inventory
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="py-3 px-2">Image</th>
                            <th class="py-3 px-2">Part Name</th>
                            <th class="py-3 px-2">Description</th>
                            <th class="py-3 px-2">Price</th>
                            <th class="py-3 px-2">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-2 px-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 flex items-center justify-center text-xs text-gray-500 rounded">No Image</div>
                                @endif
                            </td>
                            <td class="py-2 px-2 font-medium">{{ $product->name }}</td>
                            <td class="py-2 px-2 text-sm text-gray-600">{{ Str::limit($product->description, 50) }}</td>
                            <td class="py-2 px-2 font-bold text-green-600">${{ number_format($product->price, 2) }}</td>
                            <td class="py-2 px-2">
                                <span class="{{ $product->stock < 5 ? 'text-red-600 font-bold' : '' }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>