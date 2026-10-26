@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-12" 
     x-data="checkoutManager({{ collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']) }})">
    
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-black text-slate-900 mb-12 tracking-tight">Review <span class="text-indigo-600">Order.</span></h1>

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- Product List --}}
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-slate-50">
                            <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest">Your Items</h2>
                        </div>
                        <div class="divide-y divide-slate-50">
                            @foreach($cart as $id => $details)
                                <div class="p-6 flex items-center gap-6">
                                    <div class="w-20 h-20 bg-slate-50 rounded-2xl flex-shrink-0 flex items-center justify-center overflow-hidden">
                                        @if($details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-black text-slate-900">{{ $details['name'] }}</h4>
                                        <div class="flex items-center gap-3 mt-2">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                                <button type="submit" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center font-bold hover:bg-slate-100">-</button>
                                            </form>
                                            <span class="font-black text-slate-900 w-4 text-center">{{ $details['quantity'] }}</span>
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                                <button type="submit" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center font-bold hover:bg-slate-100">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="font-black text-slate-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Delivery Details --}}
                    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                        <h2 class="text-xs font-black text-indigo-600 uppercase tracking-widest mb-6">Delivery Details</h2>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-slate-500 ml-4 mb-2 block">Phone Number (Required)</label>
                                    <input type="tel" id="checkout-phone" required class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-600 rounded-2xl px-6 py-4 font-bold outline-none transition-all" placeholder="+1...">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500 ml-4 mb-2 block">Neighborhood Coordinate</label>
                                    <input type="text" id="auto-address" readonly class="w-full bg-slate-100 border-0 rounded-2xl px-6 py-4 font-bold text-slate-500 cursor-not-allowed" placeholder="Waiting for location access...">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-slate-500 ml-4 mb-2 block">Apartment/Building Name (Optional)</label>
                                    <input type="text" id="apartment_name" class="w-full bg-white border-2 border-slate-100 focus:border-indigo-600 rounded-2xl px-6 py-4 font-bold outline-none transition-all" placeholder="e.g. Riverside Heights">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500 ml-4 mb-2 block">House/Suite Number (Optional)</label>
                                    <input type="text" id="house_no" class="w-full bg-white border-2 border-slate-100 focus:border-indigo-600 rounded-2xl px-6 py-4 font-bold outline-none transition-all" placeholder="e.g. Appt 4B">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tipping --}}
                    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xs font-black text-indigo-600 uppercase tracking-widest">Tip Your Courier</h2>
                            <span class="text-[10px] font-black bg-slate-100 px-3 py-1 rounded-full text-slate-500 uppercase">Optional</span>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <template x-for="p in [0, 5, 10, 15]">
                                <button type="button" @click="tipPercent = p" 
                                        :class="tipPercent == p ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-50 text-slate-500'" 
                                        class="py-4 rounded-2xl font-black transition-all text-xs uppercase tracking-widest" 
                                        x-text="p == 0 ? 'None' : p+'%'"></button>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-slate-900 rounded-[3rem] p-8 text-white sticky top-24 shadow-2xl">
                        <div class="mb-8 p-6 rounded-[2rem] border border-white/5"
                             :class="locationEnabled ? 'bg-indigo-600/20' : 'bg-slate-800'">
                            <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Estimated Arrival</p>
                            <p class="text-2xl font-black" x-text="locationEnabled ? deliveryTime + ' mins' : 'Enable Location'"></p>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-slate-400 font-bold text-sm">
                                <span>Subtotal</span>
                                <span x-text="'$'+subtotal.toFixed(2)"></span>
                            </div>
                            <div class="flex justify-between text-slate-400 font-bold text-sm">
                                <span>Courier Tip</span>
                                <span x-text="'$'+tipAmount.toFixed(2)"></span>
                            </div>
                            <div class="h-px bg-slate-800 my-4"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-slate-400 font-bold text-sm">Grand Total</span>
                                <span class="text-4xl font-black" x-text="'$'+grandTotal.toFixed(2)"></span>
                            </div>
                        </div>

                        <button id="checkout-button" @click="proceedToPayment()" :disabled="!locationEnabled" 
                                class="w-full bg-indigo-600 py-6 rounded-2xl font-black uppercase tracking-widest transition-all shadow-xl shadow-indigo-900/40 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-indigo-500 active:scale-95">
                            Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[3rem] border border-slate-100 shadow-sm">
                <h2 class="text-2xl font-black text-slate-900 mb-2">Your shopping bag is empty</h2>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-slate-900 shadow-lg mt-6">Start Shopping</a>
            </div>
        @endif
    </div>
</div>

<script>
function checkoutManager(subtotalValue) {
    return {
        subtotal: subtotalValue,
        tipPercent: 0,
        deliveryTime: '...',
        locationEnabled: false,
        
        get tipAmount() { return (this.subtotal * (this.tipPercent / 100)); },
        get grandTotal() { return this.subtotal + this.tipAmount; },

        // Function name synchronized with the button's @click
        proceedToPayment() {
            const phone = document.getElementById('checkout-phone').value;
            const apt = document.getElementById('apartment_name').value;
            const house = document.getElementById('house_no').value;

            if(!phone) { alert("Phone number is required."); return; }

            fetch("{{ route('order.process') }}", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json", 
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                },
                body: JSON.stringify({ 
                    phone: phone, 
                    apartment: apt,
                    house_no: house,
                    tip_amount: this.tipAmount,
                    total_amount: this.grandTotal 
                })
            })
            .then(response => response.json())
            .then(data => {
                // Ensure your CartController@processOrder returns a 'redirect_url'
                if(data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else if (data.status === 'success') {
                    // Fallback if you haven't updated the controller yet
                    window.location.href = "{{ route('payment.index') }}";
                }
            })
            .catch(error => console.error('Error:', error));
        },

        init() {
            window.addEventListener('location-granted', (event) => {
                this.locationEnabled = true;
                this.deliveryTime = Math.floor(Math.random() * 20) + 15;
                
                const neighborhood = document.getElementById('auto-address');
                if(neighborhood) {
                    neighborhood.value = "Coordinate: " + event.detail.lat.toFixed(4) + ", " + event.detail.lng.toFixed(4);
                }
            });
        }
    }
}
</script>
@endsection