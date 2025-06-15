<div role="status" id="toaster" x-data="toasterHub(@js($toasts), @js($config))" @class([
    'fixed z-50 p-4 w-full flex flex-col pointer-events-none sm:p-6',
    'bottom-0' => $alignment->is('bottom'),
    'top-1/2 -translate-y-1/2' => $alignment->is('middle'),
    'top-0' => $alignment->is('top'),
    'items-start rtl:items-end' => $position->is('left'),
    'items-center' => $position->is('center'),
    'items-end rtl:items-start' => $position->is('right'),
])>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible" x-init="$nextTick(() => toast.show($el))" @if ($alignment->is('bottom'))
            x-transition:enter-start="translate-y-12 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
        @elseif($alignment->is('top'))
            x-transition:enter-start="-translate-y-12 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
        @else
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            @endif
            x-transition:leave-end="opacity-0 scale-90"
            @class([
                'relative duration-300 transform transition ease-in-out max-w-xs w-full pointer-events-auto border border-gray-200 mb-2 rounded-xl shadow-lg',
                'text-center' => $position->is('center'),
            ])
            :class="toast.select({
                error: 'text-white bg-red-600',
                info: 'text-black bg-gray-100',
                success: 'text-white bg-white',
                warning: 'text-white bg-orange-400'
            })"
            >
            <div class="flex items-center px-4 py-3">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                        </path>
                    </svg>
                </div>

                <div class="ms-3">
                    <span class="flex-grow text-sm text-gray-700 leading-none" x-text="toast.message"></span>
                </div>

                @if ($closeable)
                    <button @click="toast.dispose()" aria-label="@lang('close')"
                        class="ml-4 text-gray-400 hover:text-gray-600 transition duration-200">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </template>
</div>
