<div id="modalAlertConfirm" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scale-0 opacity-0 transition-all transform duration-300 ease-out">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 border-2 border-green-500">
            <div class="p-4 md:p-5 text-center">

                <div class="flex justify-center mb-2 mt-3">
                    <svg class="animate-bounce w-[50px] h-[50px] text-green-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1"
                            d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3 class="mb-7 text-lg font-normal text-gray-700 dark:text-gray-400 title-alert-confirm">
                    {{ $title }}</h3>
                <div class="flex justify-center gap-1.5">
                    <button id="btn-confirm-alert" type="button"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center transition-all ease-in-out delay-150 hover:scale-125 duration-150 hover:font-semibold">
                        {{ $confirmText }}
                    </button>
                    <button id="btn-cancel-alert" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all ease-in-out delay-150 hover:scale-125 duration-150 hover:font-semibold">
                        {{ $cancelText }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
