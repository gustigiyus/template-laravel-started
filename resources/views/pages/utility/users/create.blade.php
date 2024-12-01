<x-app-layout>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">{{ $pageTitle }}</h1>
            <a href="{{ route('userIndex') }}"
                class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                Back to list
                <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div class="flex flex-col md:flex-row lg:flex-row gap-6">
            <div class="w-full lg:w-2/3 md:w-2/3">
                <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                    <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                        <h3 class="text-[15px] font-bold dark:text-white">
                            Data Keluarga
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex mb-4 gap-6">
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="username" class="label-alert-username" :value="__('Username')" />
                                <x-text-input id="username" class="block w-full input-alert-username" type="text"
                                    name="username" placeholder="Type username" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-username"></x-input-error-v2>
                            </div>
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="name" class="label-alert-name" :value="__('Name')" />
                                <x-text-input id="name" class="block w-full input-alert-name" type="numeric"
                                    name="name" placeholder="Type full name" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-name"></x-input-error-v2>
                            </div>
                        </div>
                        <div class="flex mb-4 gap-6">
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="password" class="label-alert-password" :value="__('Password')" />
                                <x-text-input id="password" class="block w-full input-alert-password" type="text"
                                    name="password" placeholder="Type password" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-password"></x-input-error-v2>
                            </div>
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="password_confirm" class="label-alert-password_confirm"
                                    :value="__('Nama Ibu')" />
                                <x-text-input id="password_confirm" class="block w-full input-alert-password_confirm"
                                    type="text" name="password_confirm" placeholder="Type password confirmation"
                                    required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-password_confirm"></x-input-error-v2>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <x-input-label for="password" class="label-alert-password" :value="__('Roles')" />
                            <div class="flex w-full">
                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    @foreach ($roles as $r)
                                        <li>
                                            <input type="radio" id="roles-{{ $loop->index }}" name="roles"
                                                value="{{ $r->id }}" class="hidden peer" required />
                                            <label for="roles-{{ $loop->index }}"
                                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold">{{ $r->role_name }}</div>
                                                    <div class="w-full">{{ $r->role_desc ? $r->role_desc : '-' }}</div>
                                                </div>
                                                <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 md:w-1/3">
                <div class="flex flex-col gap-6">
                    <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                        <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                            <h3 class="text-[15px] font-bold dark:text-white">
                                Data Keluarga
                            </h3>
                        </div>
                        <div class="p-6">

                            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Choose technology:</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                <li>
                                    <input type="checkbox" id="react-option" value="" class="hidden peer"
                                        required="">
                                    <label for="react-option"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <svg class="mb-2 w-7 h-7 text-sky-500" fill="currentColor"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M418.2 177.2c-5.4-1.8-10.8-3.5-16.2-5.1.9-3.7 1.7-7.4 2.5-11.1 12.3-59.6 4.2-107.5-23.1-123.3-26.3-15.1-69.2.6-112.6 38.4-4.3 3.7-8.5 7.6-12.5 11.5-2.7-2.6-5.5-5.2-8.3-7.7-45.5-40.4-91.1-57.4-118.4-41.5-26.2 15.2-34 60.3-23 116.7 1.1 5.6 2.3 11.1 3.7 16.7-6.4 1.8-12.7 3.8-18.6 5.9C38.3 196.2 0 225.4 0 255.6c0 31.2 40.8 62.5 96.3 81.5 4.5 1.5 9 3 13.6 4.3-1.5 6-2.8 11.9-4 18-10.5 55.5-2.3 99.5 23.9 114.6 27 15.6 72.4-.4 116.6-39.1 3.5-3.1 7-6.3 10.5-9.7 4.4 4.3 9 8.4 13.6 12.4 42.8 36.8 85.1 51.7 111.2 36.6 27-15.6 35.8-62.9 24.4-120.5-.9-4.4-1.9-8.9-3-13.5 3.2-.9 6.3-1.9 9.4-2.9 57.7-19.1 99.5-50 99.5-81.7 0-30.3-39.4-59.7-93.8-78.4zM282.9 92.3c37.2-32.4 71.9-45.1 87.7-36 16.9 9.7 23.4 48.9 12.8 100.4-.7 3.4-1.4 6.7-2.3 10-22.2-5-44.7-8.6-67.3-10.6-13-18.6-27.2-36.4-42.6-53.1 3.9-3.7 7.7-7.2 11.7-10.7zM167.2 307.5c5.1 8.7 10.3 17.4 15.8 25.9-15.6-1.7-31.1-4.2-46.4-7.5 4.4-14.4 9.9-29.3 16.3-44.5 4.6 8.8 9.3 17.5 14.3 26.1zm-30.3-120.3c14.4-3.2 29.7-5.8 45.6-7.8-5.3 8.3-10.5 16.8-15.4 25.4-4.9 8.5-9.7 17.2-14.2 26-6.3-14.9-11.6-29.5-16-43.6zm27.4 68.9c6.6-13.8 13.8-27.3 21.4-40.6s15.8-26.2 24.4-38.9c15-1.1 30.3-1.7 45.9-1.7s31 .6 45.9 1.7c8.5 12.6 16.6 25.5 24.3 38.7s14.9 26.7 21.7 40.4c-6.7 13.8-13.9 27.4-21.6 40.8-7.6 13.3-15.7 26.2-24.2 39-14.9 1.1-30.4 1.6-46.1 1.6s-30.9-.5-45.6-1.4c-8.7-12.7-16.9-25.7-24.6-39s-14.8-26.8-21.5-40.6zm180.6 51.2c5.1-8.8 9.9-17.7 14.6-26.7 6.4 14.5 12 29.2 16.9 44.3-15.5 3.5-31.2 6.2-47 8 5.4-8.4 10.5-17 15.5-25.6zm14.4-76.5c-4.7-8.8-9.5-17.6-14.5-26.2-4.9-8.5-10-16.9-15.3-25.2 16.1 2 31.5 4.7 45.9 8-4.6 14.8-10 29.2-16.1 43.4zM256.2 118.3c10.5 11.4 20.4 23.4 29.6 35.8-19.8-.9-39.7-.9-59.5 0 9.8-12.9 19.9-24.9 29.9-35.8zM140.2 57c16.8-9.8 54.1 4.2 93.4 39 2.5 2.2 5 4.6 7.6 7-15.5 16.7-29.8 34.5-42.9 53.1-22.6 2-45 5.5-67.2 10.4-1.3-5.1-2.4-10.3-3.5-15.5-9.4-48.4-3.2-84.9 12.6-94zm-24.5 263.6c-4.2-1.2-8.3-2.5-12.4-3.9-21.3-6.7-45.5-17.3-63-31.2-10.1-7-16.9-17.8-18.8-29.9 0-18.3 31.6-41.7 77.2-57.6 5.7-2 11.5-3.8 17.3-5.5 6.8 21.7 15 43 24.5 63.6-9.6 20.9-17.9 42.5-24.8 64.5zm116.6 98c-16.5 15.1-35.6 27.1-56.4 35.3-11.1 5.3-23.9 5.8-35.3 1.3-15.9-9.2-22.5-44.5-13.5-92 1.1-5.6 2.3-11.2 3.7-16.7 22.4 4.8 45 8.1 67.9 9.8 13.2 18.7 27.7 36.6 43.2 53.4-3.2 3.1-6.4 6.1-9.6 8.9zm24.5-24.3c-10.2-11-20.4-23.2-30.3-36.3 9.6.4 19.5.6 29.5.6 10.3 0 20.4-.2 30.4-.7-9.2 12.7-19.1 24.8-29.6 36.4zm130.7 30c-.9 12.2-6.9 23.6-16.5 31.3-15.9 9.2-49.8-2.8-86.4-34.2-4.2-3.6-8.4-7.5-12.7-11.5 15.3-16.9 29.4-34.8 42.2-53.6 22.9-1.9 45.7-5.4 68.2-10.5 1 4.1 1.9 8.2 2.7 12.2 4.9 21.6 5.7 44.1 2.5 66.3zm18.2-107.5c-2.8.9-5.6 1.8-8.5 2.6-7-21.8-15.6-43.1-25.5-63.8 9.6-20.4 17.7-41.4 24.5-62.9 5.2 1.5 10.2 3.1 15 4.7 46.6 16 79.3 39.8 79.3 58 0 19.6-34.9 44.9-84.8 61.4zm-149.7-15c25.3 0 45.8-20.5 45.8-45.8s-20.5-45.8-45.8-45.8c-25.3 0-45.8 20.5-45.8 45.8s20.5 45.8 45.8 45.8z" />
                                            </svg>
                                            <div class="w-full text-lg font-semibold">React Js</div>
                                            <div class="w-full text-sm">A JavaScript library for building user
                                                interfaces.
                                            </div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="flowbite-option" value="" class="hidden peer">
                                    <label for="flowbite-option"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <svg class="mb-2 text-green-400 w-7 h-7" fill="currentColor"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512">
                                                <path
                                                    d="M356.9 64.3H280l-56 88.6-48-88.6H0L224 448 448 64.3h-91.1zm-301.2 32h53.8L224 294.5 338.4 96.3h53.8L224 384.5 55.7 96.3z" />
                                            </svg>
                                            <div class="w-full text-lg font-semibold">Vue Js</div>
                                            <div class="w-full text-sm">Vue.js is an model–view front end JavaScript
                                                framework.</div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="angular-option" value="" class="hidden peer">
                                    <label for="angular-option"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <svg class="mb-2 text-red-600 w-7 h-7" fill="currentColor"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512">
                                                <path
                                                    d="M185.7 268.1h76.2l-38.1-91.6-38.1 91.6zM223.8 32L16 106.4l31.8 275.7 176 97.9 176-97.9 31.8-275.7zM354 373.8h-48.6l-26.2-65.4H168.6l-26.2 65.4H93.7L223.8 81.5z" />
                                            </svg>
                                            <div class="w-full text-lg font-semibold">Angular</div>
                                            <div class="w-full text-sm">A TypeScript-based web application framework.
                                            </div>
                                        </div>
                                    </label>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                        <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                            <h3 class="text-[15px] font-bold dark:text-white">
                                Data Keluarga
                            </h3>
                        </div>
                        <div class="p-6">
                            <h1>Test</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('myscript')
        <script type="module">
            $(document).ready(function() {

            });
        </script>
    @endpush
</x-app-layout>
