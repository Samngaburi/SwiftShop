<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
         class="fixed top-5 right-5 z-[200] bg-emerald-500 text-white px-6 py-3 rounded-2xl shadow-lg font-bold">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

    <header class="bg-white pt-16 pb-20 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            
            <div class="inline-flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-full mb-6 border border-slate-100">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <p id="user-location" class="text-xs font-bold text-slate-500 uppercase tracking-widest">Detecting location...</p>
            </div>

            <h2 class="text-5xl font-black text-slate-900 mb-8 tracking-tight">Find Your <span class="text-indigo-600">Essentials.</span></h2>
            
            <div class="max-w-2xl mx-auto bg-white p-2 rounded-2xl shadow-2xl border border-slate-100 flex items-center">
                <div class="pl-4 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <form action="<?php echo e(route('search')); ?>" method="GET" class="flex-1 flex">
                    <input type="text" name="query" value="<?php echo e(request('query')); ?>" placeholder="Search products..." class="w-full px-4 py-3 text-slate-700 focus:outline-none bg-transparent">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all">Search</button>
                </form>
            </div>
        </div>
    </header>

    
    <section class="max-w-[1600px] mx-auto px-4 py-16">
        <?php $__empty_1 = true; $__currentLoopData = $groupedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-widest"><?php echo e($category); ?></h3>
                    <div class="h-px bg-slate-100 flex-1 ml-8"></div>
                </div>

                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-5 hover:shadow-2xl transition-all duration-500">
                            <div class="relative mb-5 overflow-hidden rounded-[2rem] bg-slate-50 aspect-square flex items-center justify-center">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                                <?php else: ?>
                                    <span class="text-slate-300 font-bold">No Image</span>
                                <?php endif; ?>
                            </div>

                            <div class="space-y-1">
                                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest"><?php echo e($product->category); ?></p>
                                <h4 class="text-lg font-black text-slate-900 leading-tight h-12 overflow-hidden"><?php echo e($product->name); ?></h4>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-xl font-black text-slate-900">$<?php echo e(number_format($product->price, 2)); ?></p>
                                    
                                    <button 
                                        @click="$dispatch('open-cart-modal', { name: '<?php echo e($product->name); ?>', id: '<?php echo e($product->id); ?>', price: '<?php echo e($product->price); ?>' })"
                                        class="bg-slate-900 text-white p-3 rounded-2xl hover:bg-indigo-600 transition-colors shadow-xl active:scale-95"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-20">
                <p class="text-slate-500 text-xl font-bold">No items found.</p>
                <a href="/" class="text-indigo-600 font-bold mt-4 inline-block underline">Refresh Catalog</a>
            </div>
        <?php endif; ?>
    </section>

    
    <div x-data="{ open: false, productName: '', productId: '', quantity: 1, price: 0 }" 
         @open-cart-modal.window="open = true; productName = $event.detail.name; productId = $event.detail.id; price = $event.detail.price" 
         x-show="open" 
         x-cloak 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>

        <div class="relative bg-white p-8 rounded-[2.5rem] shadow-2xl w-full max-w-md">
            <h3 class="text-2xl font-black text-slate-900 mb-1 text-center" x-text="productName"></h3>
            <p class="text-slate-500 text-center mb-6">Enter quantity to add to cart</p>

            <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" :value="productId">
                
                <div class="bg-slate-50 p-6 rounded-3xl mb-8">
                    <div class="flex justify-between mb-2">
                        <label class="font-black text-slate-700 uppercase tracking-widest text-xs">Quantity</label>
                        <span class="text-indigo-600 font-black" x-text="'Total: $' + (price * quantity).toFixed(2)"></span>
                    </div>
                    <input type="number" name="qty" x-model="quantity" min="1" required
                           class="w-full bg-white px-6 py-4 rounded-2xl border-2 border-transparent focus:border-indigo-600 outline-none text-xl font-bold">
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <button type="submit" name="action" value="checkout" class="bg-indigo-600 text-white py-5 rounded-3xl font-black uppercase tracking-widest text-sm">
                        Checkout Now
                    </button>
                    <button type="submit" name="action" value="continue" class="bg-white text-slate-400 py-4 rounded-3xl font-black uppercase tracking-widest text-xs hover:text-slate-900">
                        Continue Shopping
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationEl = document.getElementById('user-location');
            
            fetch('https://ipapi.co/json/')
                .then(response => response.json())
                .then(data => {
                    if (data.city && data.country_name) {
                        locationEl.innerText = `Delivering to: ${data.city}, ${data.country_name}`;
                    } else {
                        locationEl.innerText = `Online Store`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching location:', error);
                    locationEl.innerText = `Online Store`;
                });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\shoppingb\resources\views/home.blade.php ENDPATH**/ ?>