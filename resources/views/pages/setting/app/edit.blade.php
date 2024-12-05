<x-app-layout>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">{{ $pageTitle }}</h1>
            <a href="{{ route('settingAppIndex') }}"
                class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                Back to list
                <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        @foreach ($setting_app as $dt)
            <div class="w-full sm:col-span-3" hidden>
                <x-input-label for="ids" class="label-alert-ids" :value="__('ID User')" />
                <x-text-input id="ids" class="block w-full input-alert-ids" type="text" name="ids"
                    placeholder="Type id user" required autofocus autocomplete="off" value="{{ $dt->id }}" />
                <x-input-error-v2 class="msg-alert-ids"></x-input-error-v2>
            </div>

            <div class="flex flex-col md:flex-col sm:flex-col lg:flex-col xl:flex-row gap-6">
                <div class="w-full space-y-6">
                    <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                        <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                            <h3 class="text-[15px] font-bold dark:text-white">
                                App Information
                            </h3>
                        </div>
                        <div class="p-6 gap-10 flex flex-col xl:flex-row lg:flex-row md:flex-col">
                            <div
                                class="photo-error p-0 border border-gray-200 bg-white rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:w-1/4 lg:w-1/3 h-fit md:w-full w-full">
                                <div
                                    class="flex flex-row xl:flex-col lg:flex-col md:flex-row xl:p-0 lg:p-0 md:p-0 sm:p-0 p-4 items-center space-x-2 lg:flex lg:space-x-0 ">
                                    <!-- Gambar patient -->
                                    <img id="logo_app"
                                        class="transition-all rounded-lg cursor-pointer object-scale-down lg:w-60 lg:h-60 md:w-40 md:h-fit w-40 h-40 sm:mb-0 xl:mb-0 2xl:mb-0 hover:ring-inherit hover:ring-2 hover:ring-blue-700"
                                        src="{{ $dt->logo_app ? asset('storage/logo/' . $dt->logo_app) : '/images/default-image.png' }}"
                                        alt="Patient picture">
                                    <hr
                                        class="w-60 h-px mt-6 mb-4 bg-gray-200 border-0 dark:bg-gray-700 lg:block md:hidden hidden">

                                    <div class="w-full flex flex-col justify-center items-start space-y-2">
                                        <button id="uploadButton" type="button"
                                            class="flex items-center justify-center w-full px-3 py-2 text-sm font-bold text-center text-white rounded-lg bg-green-700 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            Upload Photo
                                        </button>
                                        <div
                                            class="text-xs text-gray-500 dark:text-gray-400 w-full xl:hidden lg:hidden md:block xl:text-start lg:text-start md:text-center text-center">
                                            Extension Allowed: JPG or PNG
                                        </div>
                                    </div>
                                </div>
                                <p class="msg-alert-photo-error mt-1 text-sm"></p>
                            </div>
                            <!-- Input file yang disembunyikan -->
                            <input type="file" id="fileInput" accept="image/*" style="display: none;">

                            <div class="flex flex-col w-full">
                                <div class="w-full sm:col-span-3 mb-6">
                                    <x-input-label for="name_app" class="label-alert-name_app" :value="__('App Name')" />
                                    <x-text-input id="name_app" class="block w-full input-alert-name_app"
                                        type="text" name="name_app" placeholder="Type name app" required autofocus
                                        autocomplete="off" value="{{ $dt->name_app }}" />
                                    <x-input-error-v2 class="msg-alert-name_app"></x-input-error-v2>
                                </div>
                                <div class="w-full sm:col-span-3 mb-6">
                                    <x-input-label for="desc_app" class="label-alert-desc_app" :value="__('App Description')" />
                                    <x-textarea-input class="w-full input-alert-desc_app" name="desc_app" id="desc_app"
                                        rows="6" placeholder="Type description app">
                                        {{ $dt->desc_app }}
                                    </x-textarea-input>
                                    <x-input-error-v2 class="msg-alert-desc_app"></x-input-error-v2>
                                </div>
                                <x-button-save class="w-full mt-auto" id="btn-save">
                                    {{ __('Save Data') }}
                                </x-button-save>
                            </div>
                        </div>
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

                function changeImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Memeriksa ekstensi file
                        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        if (!allowedExtensions.exec(file.name)) {
                            alert("Only JPG and PNG files are allowed!");
                            event.target.value = ""; // Mengosongkan input file
                            return;
                        }

                        // Membaca file jika ekstensi valid
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById("logo_app").src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Event listener untuk membuka input file saat gambar diklik
                document.getElementById("logo_app").addEventListener("click", function() {
                    document.getElementById("fileInput").click();
                });

                // Event listener untuk membuka input file saat tombol diklik
                document.getElementById("uploadButton").addEventListener("click", function() {
                    document.getElementById("fileInput").click();
                });

                // Event listener untuk memproses gambar setelah dipilih
                document.getElementById("fileInput").addEventListener("change", changeImage);

                function save() {
                    const formData = new FormData()

                    let usrId = $('input[name="ids"]').val()
                    let name_app = $('input[name="name_app"]').val()
                    let desc_app = $('textarea[name="desc_app"]').val()

                    // Menambahkan data ke dalam objek FormData
                    formData.append('name_app', name_app);
                    formData.append('desc_app', desc_app);

                    // Ambil gambar dari input file
                    const fileInput = document.getElementById("fileInput").files[0];
                    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                    if (fileInput && allowedExtensions.exec(fileInput.name)) {
                        formData.append("logo_app", fileInput); // tambahkan gambar ke formData
                    } else if (fileInput) {
                        alert("Only JPG and PNG files are allowed for the user image!");
                        return; // hentikan proses jika gambar tidak valid
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('settingAppUpdate', ['id' => 'ID']) }}".replace('ID', usrId),
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
                                    window.location.href = "{{ route('settingAppIndex') }}";
                                }
                            }, 1000);
                        },
                        error: function(response) {
                            let res = response.responseJSON.errors
                            let msg = response.responseJSON.messages

                            alertError.show();
                            console.log(msg)

                            if (res.name_app) {
                                $('.msg-alert-name_app').text(res.name_app).addClass(
                                    'message-error')
                                $('.input-alert-name_app').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-name_app').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-name_app').text('').removeClass('message-error')
                                $('.input-alert-name_app').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-name_app').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.desc_app) {
                                $('.msg-alert-desc_app').text(res.desc_app).addClass(
                                    'message-error')
                                $('.input-alert-desc_app').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-desc_app').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-desc_app').text('').removeClass('message-error')
                                $('.input-alert-desc_app').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-desc_app').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.logo_app) {
                                $('.msg-alert-photo-error').text(res.logo_app).addClass(
                                    'message-error')
                                $('.photo-error').addClass('border-red-500')
                                    .removeClass(
                                        'border-gray-200')
                            } else {
                                $('.msg-alert-photo-error').text('').removeClass('message-error')
                                $('.photo-error').addClass('border-gray-200')
                                    .removeClass(
                                        'border-red-500')
                            }
                        }
                    });

                }

            });
        </script>
    @endpush
</x-app-layout>
