<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-center text-lg font-semibold mb-6">Add New Item</h3>
                
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="flex justify-center gap-4">
                        <div class="w-full max-w-[216px]">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Product Name</label>
                            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2" required>
                        </div>
                        <div class="w-full max-w-[216px]">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Category</label>
                            <input type="text" name="category" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2" required>
                        </div>
                    </div>

                    <div class="flex justify-center gap-4">
                        <div class="w-full max-w-[216px]">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2" required>
                        </div>
                        <div class="w-full max-w-[216px]">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2" required>
                        </div>
                    </div>

                    

                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-md">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Product Image</label>
                            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                        </div>
                    </div>

                    <div class="flex justify-center pt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-10 py-2 rounded-md hover:bg-indigo-700 font-bold">
                            Add to Store Inventory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>