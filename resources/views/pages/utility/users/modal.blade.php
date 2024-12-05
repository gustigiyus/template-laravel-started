<!-- Modal Delete -->
<div id="modal-delete" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scale-0 opacity-0 transition-all transform duration-300 ease-out">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 border-2 border-red-500">
            <div class="p-4 md:p-5 text-center">
                <div class="flex justify-center items-center">
                    <svg class="mx-auto mb-4 text-red-600 w-[45px] h-[45px] dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <form action="{{ route('userDelete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="e_id" value="">
                    <h3 class="mb-5 text-md font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete?
                        <br>
                        User: <span class="deleted-text font-bold"></span>
                    </h3>
                    <button type="submit"
                        class="mr-1 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center transition-all ease-in-out delay-150 hover:scale-125 duration-150 hover:font-semibold">
                        Yes, I'm sure
                    </button>
                    <button id="btn-cancel" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all ease-in-out delay-150 hover:scale-125 duration-150 hover:font-semibold">No,
                        cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
