

<?php $__env->startSection('content'); ?>
<div class="min-h-[80-vh] flex items-center justify-center py-20 px-4">
    <div class="max-w-md w-full text-center"
         x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 100)">
        
        
        <div x-show="show" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-50 rotate-45"
             x-transition:enter-end="opacity-100 scale-100 rotate-0"
             class="w-24 h-24 bg-emerald-500 text-white rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-emerald-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Order Received!</h1>
        <p class="text-slate-500 font-bold mb-8 leading-relaxed">
            Thank you for shopping with us. Your items are being prepared and will be dispatched to your location shortly.
        </p>

        
        <div class="bg-white border border-slate-100 p-8 rounded-[3rem] shadow-sm mb-10 text-left">
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Order Status</span>
                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Paid</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Receipt ID</span>
                    <span class="text-sm font-black text-slate-900"><?php echo e($tracking_id); ?></span>
                </div>
                <div class="h-px bg-slate-50"></div>
                <p class="text-[10px] font-bold text-slate-400 text-center italic">
                    A confirmation SMS has been sent to your phone.
                </p>
            </div>
        </div>

        
        <div class="flex flex-col gap-4">
            <a href="<?php echo e(route('home')); ?>" 
               class="bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl hover:bg-indigo-600 transition-all active:scale-95">
                Continue Shopping
            </a>
            <button onclick="window.print()" class="text-slate-400 font-black uppercase tracking-widest text-[10px] hover:text-slate-600 transition-colors">
                Print Receipt
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\shoppingb\resources\views/order-success.blade.php ENDPATH**/ ?>