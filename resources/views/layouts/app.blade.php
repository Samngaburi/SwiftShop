<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftShop | Premium Online Store</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://www.intasend.com/libs/intasend-inlinejs-sdk/v1/intasend-inlinejs-sdk.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif !important; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased" 
      x-data="locationPromptManager()">

    {{-- CUSTOM LOCATION BANNER --}}
    <div x-show="isVisible" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-cloak 
         class="fixed bottom-6 left-6 right-6 z-[100] md:left-auto md:w-96">
        <div class="bg-slate-900 text-white p-6 rounded-[2.5rem] shadow-2xl border border-white/10">
            <div class="flex items-start gap-4">
                <div class="bg-indigo-600 p-3 rounded-2xl flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-black uppercase tracking-widest text-xs text-indigo-400 mb-1">Personalize Your Delivery</h4>
                    <p class="text-sm text-slate-300 leading-relaxed mb-4">
                        Enable location services so we can calculate the fastest delivery time to your doorstep.
                    </p>
                    <div class="flex gap-3">
                        <button @click="requestLocation()" class="bg-white text-slate-900 px-6 py-2 rounded-xl font-black text-xs uppercase hover:bg-indigo-400 transition-colors">
                            Allow
                        </button>
                        <button @click="dismiss()" class="text-slate-500 px-4 py-2 rounded-xl font-bold text-xs uppercase hover:text-white transition-colors">
                            Deny
                        </button>
                    </div>
                </div>
            </div>
        </div>                                                        
    </div>

    {{-- NAVIGATION --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-white font-black">S</span>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">Swift<span class="text-indigo-600">Shop</span></span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('checkout.index') }}" 
                       class="flex items-center gap-3 bg-slate-900 text-white pl-6 pr-4 py-3 rounded-2xl hover:bg-indigo-600 transition-all shadow-xl active:scale-95 group">
                        <span class="text-sm font-black uppercase tracking-widest">Checkout</span>
                        <div class="relative bg-white/10 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <script>
        function locationPromptManager() {
            return {
                isVisible: false,
                
                init() {
                    // 1. Check if user already dismissed it this session
                    const isDismissed = sessionStorage.getItem('location-dismissed');
                    if (isDismissed) {
                        this.isVisible = false;
                        this.checkExistingPermission(); // Still try to get location if already granted
                        return;
                    }

                    // 2. Check browser permission state
                    this.checkExistingPermission();
                },

                checkExistingPermission() {
                    if (navigator.permissions) {
                        navigator.permissions.query({name: 'geolocation'}).then((result) => {
                            if (result.state === 'granted') {
                                this.isVisible = false;
                                this.triggerGeolocation();
                            } else if (result.state === 'prompt') {
                                // Only show our custom banner if they haven't decided yet
                                this.isVisible = true;
                            } else {
                                // If denied, we still show the banner (per your requirement) 
                                // so they can be informed, unless already dismissed
                                this.isVisible = !sessionStorage.getItem('location-dismissed');
                            }
                        });
                    }
                },

                requestLocation() {
                    if (navigator.geolocation) {
                        this.triggerGeolocation();
                    }
                },

                triggerGeolocation() {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            // On Success: Hide banner and broadcast event
                            this.isVisible = false;
                            window.dispatchEvent(new CustomEvent('location-granted', {
                                detail: { lat: position.coords.latitude, lng: position.coords.longitude }
                            }));
                        },
                        (error) => {
                            if (error.code === error.PERMISSION_DENIED) {
                                alert("To enable delivery tracking, please allow location access in your browser settings.");
                            }
                        }
                    );
                },

                dismiss() {
                    this.isVisible = false;
                    sessionStorage.setItem('location-dismissed', 'true');
                }
            }
        }
    </script>
</body>
</html>