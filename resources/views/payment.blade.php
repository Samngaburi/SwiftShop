@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-20" x-data="paymentSimulator()">
    <div class="max-w-md mx-auto px-4">
        
        <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100">
            {{-- Header --}}
            <div class="bg-indigo-600 p-10 text-white text-center">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04z" />
                    </svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-widest">Secure Payment</h2>
                <p class="text-indigo-100 text-[10px] font-bold uppercase opacity-80 tracking-widest">Simulation Mode</p>
            </div>

            <div class="p-8">
                {{-- Tab Switcher --}}
                <div class="flex bg-slate-100 p-1.5 rounded-2xl mb-8" x-show="!isProcessing">
                    <button @click="method = 'mobile'" :class="method === 'mobile' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="flex-1 py-3 rounded-xl font-black text-[10px] uppercase transition-all">Mobile Money</button>
                    <button @click="method = 'card'" :class="method === 'card' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="flex-1 py-3 rounded-xl font-black text-[10px] uppercase transition-all">Credit Card</button>
                </div>

                {{-- Mobile Money Simulation --}}
                <div x-show="!isProcessing && method === 'mobile'" class="space-y-6">
                    <div class="p-6 bg-emerald-50 rounded-3xl border-2 border-emerald-100 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-emerald-600 uppercase mb-1">Total Amount</p>
                            <p class="text-3xl font-black text-slate-900">${{ number_format($order['total_amount'] ?? 0, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-400 uppercase">Phone</p>
                            <p class="font-bold text-slate-700">{{ $order['phone'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <button @click="startSimulation()" class="w-full bg-slate-900 text-white py-6 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                        Pay via M-Pesa
                    </button>
                </div>

                {{-- Credit Card Simulation --}}
                <div x-show="!isProcessing && method === 'card'" class="space-y-4">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-slate-500 ml-2 mb-2 block">Cardholder Name</label>
                            <input type="text" id="card-name" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 font-bold outline-none focus:border-indigo-600 transition-all" placeholder="John Doe">
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-slate-500 ml-2 mb-2 block">Card Number</label>
                            <input type="tel" id="card-number" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 font-bold outline-none focus:border-indigo-600 transition-all" placeholder="4242 4242 4242 4242" maxlength="19">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-slate-500 ml-2 mb-2 block">Expiry (MM/YY)</label>
                                <input type="tel" id="card-expiry" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 font-bold outline-none focus:border-indigo-600 transition-all" placeholder="12/26" maxlength="5">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-500 ml-2 mb-2 block">CVV</label>
                                <input type="tel" id="card-cvv" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 font-bold outline-none focus:border-indigo-600 transition-all" placeholder="123" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <button @click="validateAndPay()" class="w-full bg-slate-900 text-white py-6 rounded-2xl font-black uppercase tracking-widest text-xs mt-4 hover:bg-indigo-600 transition-all shadow-xl">
                        Pay ${{ number_format($order['total_amount'] ?? 0, 2) }}
                    </button>
                </div>

                {{-- Processing State --}}
                <div class="py-16 text-center" x-show="isProcessing">
                    <div class="w-16 h-16 border-4 border-slate-100 border-t-indigo-600 rounded-full animate-spin mx-auto mb-6"></div>
                    <p class="font-black text-slate-900 uppercase tracking-widest text-sm">Authorizing Payment...</p>
                    <p class="text-slate-400 text-[10px] font-bold uppercase mt-2">Connecting to Bank Gateway</p>
                </div>
            </div>
        </div>
        
        <p class="text-center mt-8 text-slate-400 text-[10px] font-black uppercase tracking-widest">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            256-bit Encrypted Connection
        </p>
    </div>
</div>

<script>
function paymentSimulator() {
    return {
        method: 'mobile',
        isProcessing: false,
        
        validateAndPay() {
            if (this.method === 'card') {
                const name = document.getElementById('card-name').value;
                const num = document.getElementById('card-number').value;
                const exp = document.getElementById('card-expiry').value;
                const cvv = document.getElementById('card-cvv').value;

                if (!name || !num || !exp || !cvv) {
                    alert("Please fill in all card details to proceed with the simulation.");
                    return;
                }
            }
            
            this.startSimulation();
        },

        startSimulation() {
            this.isProcessing = true;
            
            // Artificial delay to simulate real-world API latency
            setTimeout(() => {
                window.location.href = "{{ route('order.success') }}?state=DEMO&tracking_id=SWIFT-{{ strtoupper(str()->random(8)) }}";
            }, 3500);
        }
    }
}
</script>
@endsection