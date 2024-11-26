<div id="modalAlertSuccess" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transform -translate-y-10 opacity-0 transition-transform duration-500">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 border-2">
            <div class="pt-2 pl-2 pr-2 md:pt-2 md:pl-2 md:pr-2 text-center flex items-center h-[60px]">
                <div class="flex justify-center absolute top-0 left-1 overflow-visible z-40">
                    <img class="h-[60px] max-w-lg rounded-lg" src="/images/check.gif" alt="image description">
                </div>
                <h3 class="mb-2.5 text-md font-semibold text-gray-700 dark:text-gray-400 text-left ml-16"
                    id="success-title">
                    {{ $title }}
                </h3>
            </div>
            <!-- Indikator Loading -->
            <div class="relative h-1  bg-gray-200 dark:bg-gray-600 z-50 rounded-lg">
                <div class="absolute top-0 left-0 h-1 bg-green-600 dark:bg-green-400 loading-bar-alert">
                </div>
            </div>
        </div>
    </div>
</div>
