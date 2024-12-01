<!-- Modal Add -->
<div id="modal-form" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scale-0 opacity-0 transition-all transform duration-300 ease-out">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Form Roles
                </h3>
                <button type="button" id="btn-close"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="form-modal p-4 md:p-5">
                <div class="flex flex-col gap-4 mb-4">
                    <div class="mb-3">
                        <x-input-label for="brand_name" class="label-alert-brand_name" :value="__('Brand Name')" />
                        <x-text-input id="brand_name" class="block w-full input-alert-brand_name" type="text"
                            name="brand_name" placeholder="Type brand name" required autofocus autocomplete="off" />
                        <x-input-error-v2 class="msg-alert-brand_name"></x-input-error-v2>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="brand_desc" class="label-alert-brand_desc" :value="__('Brand Description')" />
                        <x-textarea-input id="brand_desc"
                            class="input-alert-brand_desc block w-full p-2.5 text-sm rounded-lg" rows="4"
                            name="brand_desc" placeholder="Type brand description"
                            autocomplete="off"></x-textarea-input>
                        <x-input-error-v2 class="msg-alert-brand_desc"></x-input-error-v2>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button id="btn-save" type="button"
                        class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Save Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


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
                <form action="{{ route('roleDelete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="e_id" value="">
                    <h3 class="mb-5 text-md font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete?
                        <br>
                        Brands: <span class="deleted-text font-bold"></span>
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
