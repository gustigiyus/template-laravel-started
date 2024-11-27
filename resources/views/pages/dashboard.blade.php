<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 gap-4">
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 min-h-[100px]">
            <div class="w-full h-full">
                <h3 class="text-sm font-normal text-gray-500 dark:text-gray-400">Total visit this Month</h3>
                <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
                    300 Kunjungan
                </span>
            </div>
        </div>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 min-h-[100px]">
            <div class="w-full h-full">
                <h3 class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Billing Today</h3>
                <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
                    {{ 'Rp. ' . number_format(42500000, 0, ',', '.') }}
                </span>
            </div>
        </div>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 min-h-[100px]">
            <div class="w-full h-full">
                <h3 class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Billing this Month</h3>
                <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
                    {{ 'Rp. ' . number_format(8500000000, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

</x-app-layout>
