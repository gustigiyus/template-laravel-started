<div id="modalAlertError" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scale-0 opacity-0 transition-all transform duration-300 ease-out">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 border-2 border-red-500">
            <div class="p-4 md:p-5 text-center">

                <div class="flex justify-center mb-3 mt-3">
                    <svg class="animate-bounce w-[50px] h-[50px] text-red-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1"
                            d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </div>
                <h3 class="mb-5 text-md font-medium text-gray-700 dark:text-gray-400" id="error-title">
                    {{ $title }}</h3>
                <button id="btn-comfirm-error" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center transition-all ease-in-out delay-150 hover:scale-125 duration-150 hover:font-semibold">
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>
