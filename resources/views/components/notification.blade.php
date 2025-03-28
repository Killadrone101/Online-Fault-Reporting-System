<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-10"
    x-init="setTimeout(() => show = false, 3000)"
    @class([
        'fixed z-[9999] px-4 py-3 rounded-md shadow-lg text-white flex items-center justify-between min-w-[300px]',
        'bg-green-600' => $type === 'success',
        'bg-red-600' => $type === 'error',
        'bg-blue-600' => $type === 'info',
        'bg-yellow-600' => $type === 'warning',
    ])
    style="top: 20px; right: 20px;"
>
    <span class="flex-1">{{ $message }}</span>
    <button 
        @click="show = false" 
        class="ml-4 hover:opacity-80 focus:outline-none"
        aria-label="Close notification"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>