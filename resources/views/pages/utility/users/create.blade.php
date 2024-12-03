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

        <div class="flex flex-col md:flex-col sm:flex-col lg:flex-col xl:flex-row gap-6">
            <div class="w-full xl:w-3/5 lg:w-full md:w-full space-y-6">
                <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                    <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                        <h3 class="text-[15px] font-bold dark:text-white">
                            General Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
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
                        <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="password" class="label-alert-password" :value="__('Password')" />
                                <x-text-input id="password" class="block w-full input-alert-password" type="text"
                                    name="password" placeholder="Type password" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-password"></x-input-error-v2>
                            </div>
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="password_confirm" class="label-alert-password_confirm"
                                    :value="__('Password Confirmation')" />
                                <x-text-input id="password_confirm" class="block w-full input-alert-password_confirm"
                                    type="text" name="password_confirm" placeholder="Type password confirmation"
                                    required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-password_confirm"></x-input-error-v2>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <x-input-label for="roles" class="label-alert-roles" :value="__('Roles')" />
                            <div class="flex w-full">
                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    @foreach ($roles as $r)
                                        <li>
                                            <input type="radio" id="roles-{{ $loop->index }}" name="roles"
                                                value="{{ $r->id }}" class="hidden peer" required />
                                            <label for="roles-{{ $loop->index }}"
                                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 input-alert-roles">
                                                <div class="block">
                                                    <div
                                                        class="w-full xl:text-[16px] lg:text-sm md:text-sm text-xs font-semibold">
                                                        {{ $r->role_name }}</div>
                                                    <div class="w-full xl:text-sm lg:text-sm md:text-sm text-xs">
                                                        {{ $r->role_desc ? $r->role_desc : '-' }}</div>
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

                <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                    <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                        <h3 class="text-[15px] font-bold dark:text-white">
                            Additional Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="nik" class="label-alert-nik" :value="__('Nik')" />
                                <x-text-input id="nik" class="block w-full input-alert-nik" type="text"
                                    name="nik" placeholder="Type nik" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-nik"></x-input-error-v2>
                            </div>
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="dob" class="label-alert-dob" :value="__('Date of Brith')" />
                                <x-text-date-input id="dob" class="block w-full input-alert-dob" type="text"
                                    name="dob" placeholder="Type dob" required autofocus autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-dob"></x-input-error-v2>
                            </div>
                        </div>
                        <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="email" class="label-alert-email" :value="__('Email Address')" />
                                <x-text-input id="email" class="block w-full input-alert-email" type="email"
                                    name="email" placeholder="Type email address" required autofocus
                                    autocomplete="off" />
                                <x-input-error-v2 class="msg-alert-email"></x-input-error-v2>
                            </div>
                            <div class="w-full sm:col-span-3">
                                <x-input-label for="gender" class="label-alert-gender" :value="__('Gender')" />
                                <select id="gender" name="gender"
                                    class="input-alert-gender block w-full p-2.5 text-sm rounded-lg input-normal">
                                    <option selected value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <x-input-error-v2 class="msg-alert-gender"></x-input-error-v2>
                            </div>



                        </div>
                        <div class="w-full sm:col-span-3">
                            <x-input-label for="address" class="label-alert-address" :value="__('Address Home')" />
                            <x-textarea-input class="w-full input-alert-address" name="address" id="address"
                                rows="6" placeholder="Type address home"></x-textarea-input>
                            <x-input-error-v2 class="msg-alert-address"></x-input-error-v2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full xl:w-2/5 lg:w-full md:w-full">
                <div class="flex flex-col mb-6 gap-6">
                    <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full box-brand">
                        <div
                            class="border-b border-slate-300 py-4 px-4 flex justify-between items-center box-inner-brand">
                            <h3 class="text-[15px] font-bold box-title-brand">
                                Brand Access
                            </h3>
                        </div>
                        <div class="p-6">
                            @php
                                $count = $brands->count(); // Hitung jumlah item
                                $gridCols =
                                    $count === 1
                                        ? 'md:grid-cols-1'
                                        : ($count === 2
                                            ? 'md:grid-cols-2'
                                            : 'md:grid-cols-3');
                            @endphp
                            <ul class="grid w-full gap-6 {{ $gridCols }}">
                                @foreach ($brands as $br)
                                    <li>
                                        <input type="checkbox" id="brand-{{ $br->id }}"
                                            value="{{ $br->id }}" name="brand_lists" class="hidden peer"
                                            required="">
                                        <label for="brand-{{ $br->id }}"
                                            class="inline-flex items-center justify-center w-full p-4 md:p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-[16px] font-semibold">Brand
                                                    {{ $br->brand_name }}
                                                </div>
                                            </div>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full box-menu">
                        <div
                            class="border-b border-slate-300 py-4 px-4 flex justify-between items-center box-inner-menu">
                            <h3 class="text-[15px] font-bold dark:text-white box-title-menu">
                                Menu Access
                            </h3>
                        </div>
                        <div class="p-6 flex flex-wrap justify-evenly flex-row">
                            @foreach ($menus as $m)
                                <div class="lg:w-2/5 md:w-2/5 w-[44%]">
                                    <label for="menu_title"
                                        class="inline-flex items-center justify-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 mb-1.5">
                                        <div class="block">
                                            <div
                                                class="w-full xl:text-[16px] lg:text-[16px] md:text-sm text-sm font-semibold">
                                                {{ $m->menu_name }}
                                            </div>
                                        </div>
                                    </label>

                                    <div class="flex justify-center mb-5">
                                        <div class="flex items-center lg:me-3 md:me-3 me-2">
                                            <input id="edit-{{ $m->id }}" type="checkbox"
                                                value="{{ $m->id }}" name="menu-edit"
                                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="edit-{{ $m->id }}"
                                                class="lg:ms-2 md:ms-2 ms-1 xl:text-sm lg:text-xs md:text-xs text-xs font-medium text-gray-900 dark:text-gray-300">
                                                Edit
                                            </label>
                                        </div>
                                        <div class="flex items-center lg:me-3 md:me-3 me-2">
                                            <input id="add-{{ $m->id }}" type="checkbox"
                                                value="{{ $m->id }}" name="menu-add"
                                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="add-{{ $m->id }}"
                                                class="lg:ms-2 md:ms-2 ms-1 xl:text-sm lg:text-xs md:text-xs text-xs font-medium text-gray-900 dark:text-gray-300">
                                                Add
                                            </label>
                                        </div>
                                        <div class="flex items-center lg:me-3 md:me-3 me-2">
                                            <input id="view-{{ $m->id }}" type="checkbox"
                                                value="{{ $m->id }}" name="menu-view"
                                                class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="view->{{ $m->id }}"
                                                class="xl:ms-2 lg:ms-1 md:ms-1 ms-1 xl:text-sm lg:text-xs md:text-xs text-xs font-medium text-gray-900 dark:text-gray-300">
                                                View
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-button-save class="w-full" id="btn-save">
                    {{ __('Save Data') }}
                </x-button-save>
            </div>
        </div>
    </div>

    @push('myscript')
        <script type="module">
            $(document).ready(function() {
                const buttonSave = $('#btn-save');

                buttonSave.click(function(e) {
                    e.preventDefault()
                    save()
                })

                function save() {
                    const formData = new FormData()

                    let username = $('input[name="username"]').val()
                    let name = $('input[name="name"]').val()
                    let password = $('input[name="password"]').val()
                    let password_confirm = $('input[name="password_confirm"]').val()
                    let roles = $('input[name="roles"]:checked').val()

                    let nik = $('input[name="nik"]').val()
                    let dob = $('input[name="dob"]').val()
                    let email = $('input[name="email"]').val()
                    let gender = $('select[name="gender"]').val()
                    let address = $('textarea[name="address"]').val()

                    // Menambahkan data ke dalam objek FormData
                    formData.append('username', username);
                    formData.append('name', name);
                    formData.append('password', password);
                    formData.append('password_confirm', password_confirm);
                    formData.append('roles', roles);

                    formData.append('nik', nik);
                    formData.append('dob', dob);
                    formData.append('email', email);
                    formData.append('gender', gender);
                    formData.append('address', address);

                    let selectedBrands = [];
                    $('input[name="brand_lists"]:checked').each(function() {
                        selectedBrands.push($(this).val());
                    });
                    formData.append('brand_lists', selectedBrands);


                    let selectedMenusAdd = [];
                    let selectedMenusEdit = [];
                    let selectedMenusView = [];

                    $('input[name="menu-add"]:checked').each(function() {
                        selectedMenusAdd.push($(this).val());
                    });

                    $('input[name="menu-edit"]:checked').each(function() {
                        selectedMenusEdit.push($(this).val());
                    });

                    $('input[name="menu-view"]:checked').each(function() {
                        selectedMenusView.push($(this).val());
                    });

                    let allSelectedMenus = {
                        add: selectedMenusAdd,
                        edit: selectedMenusEdit,
                        view: selectedMenusView
                    };
                    let allSelectedMenusJSON = JSON.stringify(allSelectedMenus);
                    formData.append('menu_lists', allSelectedMenusJSON);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('userStore') }}",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        timeout: 60000,
                        // beforeSend: showSpinner,
                        success: function(response) {
                            let res = response.success
                            $('#success-title').text(res);
                            console.log(res)
                            alertSuccess.show();

                            setTimeout(() => {
                                if (res) {
                                    window.location.href = "{{ route('userIndex') }}";
                                }
                            }, 1000);
                        },
                        error: function(response) {
                            let res = response.responseJSON.errors
                            let msg = response.responseJSON.messages

                            alertError.show();
                            console.log(msg)

                            if (res.username) {
                                $('.msg-alert-username').text(res.username).addClass(
                                    'message-error')
                                $('.input-alert-username').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-username').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-username').text('').removeClass('message-error')
                                $('.input-alert-username').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-username').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.name) {
                                $('.msg-alert-name').text(res.name).addClass(
                                    'message-error')
                                $('.input-alert-name').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-name').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-name').text('').removeClass('message-error')
                                $('.input-alert-name').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-name').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.password) {
                                $('.msg-alert-password').text(res.password).addClass(
                                    'message-error')
                                $('.input-alert-password').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-password').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-password').text('').removeClass('message-error')
                                $('.input-alert-password').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-password').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.password_confirm) {
                                $('.msg-alert-password_confirm').text(res.password_confirm).addClass(
                                    'message-error')
                                $('.input-alert-password_confirm').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-password_confirm').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-password_confirm').text('').removeClass('message-error')
                                $('.input-alert-password_confirm').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-password_confirm').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.nik) {
                                $('.msg-alert-nik').text(res.nik).addClass(
                                    'message-error')
                                $('.input-alert-nik').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-nik').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-nik').text('').removeClass('message-error')
                                $('.input-alert-nik').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-nik').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.dob) {
                                $('.msg-alert-dob').text(res.dob).addClass(
                                    'message-error')
                                $('.input-alert-dob').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-dob').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-dob').text('').removeClass('message-error')
                                $('.input-alert-dob').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-dob').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.email) {
                                $('.msg-alert-email').text(res.email).addClass(
                                    'message-error')
                                $('.input-alert-email').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-email').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-email').text('').removeClass('message-error')
                                $('.input-alert-email').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-email').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.gender) {
                                $('.msg-alert-gender').text(res.gender).addClass(
                                    'message-error')
                                $('.input-alert-gender').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-gender').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-gender').text('').removeClass('message-error')
                                $('.input-alert-gender').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-gender').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.address) {
                                $('.msg-alert-address').text(res.address).addClass(
                                    'message-error')
                                $('.input-alert-address').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-address').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-address').text('').removeClass('message-error')
                                $('.input-alert-address').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-address').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.roles) {
                                $('.msg-alert-roles').text(res.roles).addClass(
                                    'message-error')
                                $('.input-alert-roles').addClass('border-red-500').removeClass(
                                    'border-gray-200')
                                $('.label-alert-roles').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-roles').text('').removeClass('message-error')
                                $('.input-alert-roles').addClass('').removeClass(
                                    'border-red-500 border-gray-200')
                                $('.label-alert-roles').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.brand_lists) {
                                $('.box-brand').addClass('border-red-500').removeClass(
                                    'border-slate-200')
                                $('.box-inner-brand').addClass('border-red-500').removeClass(
                                    'border-slate-300')
                                $('.box-title-brand').addClass('text-red-500')
                            } else {
                                $('.box-brand').addClass('border-slate-200').removeClass(
                                    'border-red-500')
                                $('.box-inner-brand').addClass('border-slate-300').removeClass(
                                    'border-red-500')
                                $('.box-title-brand').removeClass('text-red-500')
                            }

                            if (res.menu_lists) {
                                $('.box-menu').addClass('border-red-500').removeClass(
                                    'border-slate-200')
                                $('.box-inner-menu').addClass('border-red-500').removeClass(
                                    'border-slate-300')
                                $('.box-title-menu').addClass('text-red-500')
                            } else {
                                $('.box-menu').addClass('border-slate-200').removeClass(
                                    'border-red-500')
                                $('.box-inner-menu').addClass('border-slate-300').removeClass(
                                    'border-red-500')
                                $('.box-title-menu').removeClass('text-red-500')
                            }
                        }
                    });

                }

            });
        </script>
    @endpush
</x-app-layout>
