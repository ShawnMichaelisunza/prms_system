{{-- Flash Messages --}}
@if (session('success') || session('error') || session('warning') || session('info'))
    @php
        $flashType = session('success')
            ? 'success'
            : (session('error')
                ? 'error'
                : (session('warning') ? 'warning' : 'info'));

        $flashMessage = session($flashType);

        $styles = [
            'success' => 'bg-white border text-green-700',
            'error' => 'bg-white border text-red-700',
            'warning' => 'bg-white border text-yellow-700',
            'info' => 'bg-white border text-blue-700',
        ];

        $titles = [
            'success' => 'Success!',
            'error' => 'Error',
            'warning' => 'Warning',
            'info' => 'Info',
        ];
    @endphp

    <div id="flashMessage"
        class="fixed bottom-2 right-2 w-[350px] shadow-xl overflow-hidden animate-slide-in z-[99] {{ $styles[$flashType] }}">
        <div class="flex justify-between items-start p-4">
            <div>
                <p class="font-semibold">{{ $titles[$flashType] }}</p>
                <p class="text-sm mt-0.5 leading-snug">{{ $flashMessage }}</p>
            </div>
            <button onclick="closeFlashMessage()" class="text-gray-400 hover:text-gray-600 ml-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        setTimeout(() => {
            closeFlashMessage();
        }, 5000);

        function closeFlashMessage() {
            const flashMessage = document.getElementById('flashMessage');
            if (flashMessage) {
                flashMessage.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => flashMessage.remove(), 300);
            }
        }
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .animate-slide-in {
            animation: slide-in 0.25s ease-out;
        }
    </style>
@endif
