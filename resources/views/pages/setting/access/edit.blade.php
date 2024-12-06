<x-app-layout>
    <div>
        @foreach ($users as $usr)
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">
                    {{ $pageTitle }} - {{ $usr->user_detail->name }}
                </h1>
                <a href="{{ route('accessUserIndex') }}"
                    class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    Back to list
                    <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>


            <div class="w-full sm:col-span-3" hidden>
                <x-input-label for="ids" class="label-alert-ids" :value="__('ID User')" />
                <x-text-input id="ids" class="block w-full input-alert-ids" type="text" name="ids"
                    placeholder="Type id user" required autofocus autocomplete="off" value="{{ $usr->id }}" />
                <x-input-error-v2 class="msg-alert-ids"></x-input-error-v2>
            </div>

            <div class="flex flex-col md:flex-col sm:flex-col lg:flex-col xl:flex-row gap-6">
                <div class="w-full">
                    <div class="flex xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col mb-6 gap-6">
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
                                                {{ in_array($br->id, $brands_selected) ? 'checked' : '' }}>
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

                                        @php
                                            $menu = $usr->user_menu->firstWhere('id', $m->id);
                                        @endphp

                                        <div class="flex justify-center mb-5">
                                            <div class="flex items-center lg:me-3 md:me-3 me-2">
                                                <input id="edit-{{ $m->id }}" type="checkbox"
                                                    value="{{ $m->id }}" name="menu-edit"
                                                    {{ $menu && $menu->pivot->can_edit ? 'checked' : '' }}
                                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="edit-{{ $m->id }}"
                                                    class="lg:ms-2 md:ms-2 ms-1 xl:text-sm lg:text-xs md:text-xs text-xs font-medium text-gray-900 dark:text-gray-300">
                                                    Edit
                                                </label>
                                            </div>
                                            <div class="flex items-center lg:me-3 md:me-3 me-2">
                                                <input id="add-{{ $m->id }}" type="checkbox"
                                                    value="{{ $m->id }}" name="menu-add"
                                                    {{ $menu && $menu->pivot->can_add ? 'checked' : '' }}
                                                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="add-{{ $m->id }}"
                                                    class="lg:ms-2 md:ms-2 ms-1 xl:text-sm lg:text-xs md:text-xs text-xs font-medium text-gray-900 dark:text-gray-300">
                                                    Add
                                                </label>
                                            </div>
                                            <div class="flex items-center lg:me-3 md:me-3 me-2">
                                                <input id="view-{{ $m->id }}" type="checkbox"
                                                    value="{{ $m->id }}" name="menu-view"
                                                    {{ $menu && $menu->pivot->can_view ? 'checked' : '' }}
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
        @endforeach
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

                    let usrId = $('input[name="ids"]').val()
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
                        url: "{{ route('accessUserUpdate', ['id' => 'ID']) }}".replace('ID', usrId),
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
                            alertSuccess.show();

                            setTimeout(() => {
                                if (res) {
                                    window.location.href = "{{ route('accessUserIndex') }}";
                                }
                            }, 1000);
                        },
                        error: function(response) {
                            let res = response.responseJSON.errors
                            let msg = response.responseJSON.messages

                            alertError.show();

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
