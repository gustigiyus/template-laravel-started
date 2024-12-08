<x-app-layout>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">{{ $pageTitle }}</h1>
            <a href="{{ route('dashboard') }}"
                class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                Back to dashboard
                <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        @foreach ($users as $usr)
            <div class="w-full sm:col-span-3" hidden>
                <x-input-label for="ids" class="label-alert-ids" :value="__('ID User')" />
                <x-text-input id="ids" class="block w-full input-alert-ids" type="text" name="ids"
                    placeholder="Type id user" required autofocus autocomplete="off" value="{{ $usr->id }}" />
                <x-input-error-v2 class="msg-alert-ids"></x-input-error-v2>
            </div>

            <div class="flex xl:flex-row lg:flex-col md:flex-col sm:flex-col flex-col gap-6 mb-6">
                <div
                    class="photo-error p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:w-1/3 lg:w-w-full md:w-full sm:w-full w-full h-fit">
                    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                        <img id="profile_photo_path"
                            class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 object-scale-down"
                            src="{{ $usr->profile_photo_path ? asset('storage/user-profile/' . $usr->profile_photo_path) : '/images/default-image.png' }}"
                            alt="Employee picture">
                        <div>
                            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture</h3>
                            <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                JPG or PNG / Maximum: 1 Mb
                            </div>
                            <div class="flex items-center space-x-4">
                                <button id="uploadButton" type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-bold text-center text-white rounded-lg bg-purple-700 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                        </path>
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                                    </svg>
                                    Upload picture
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="msg-alert-photo-error mt-1 text-sm"></p>

                    <!-- Input file yang disembunyikan -->
                    <input type="file" id="fileInput" accept="image/*" style="display: none;">
                </div>

                <div class="flex flex-col md:flex-col sm:flex-col lg:flex-col xl:flex-row gap-6 w-full">
                    <div class="w-full space-y-6">
                        <div class="bg-white border border-slate-200 rounded-lg shadow-sm col-span-2 w-full">
                            <div class="border-b border-slate-300 py-4 px-4 flex justify-between items-center">
                                <h3 class="text-[15px] font-bold dark:text-white">
                                    General Information
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="w-full sm:col-span-3" hidden>
                                    <x-input-label for="ids" class="label-alert-ids" :value="__('ID User')" />
                                    <x-text-input id="ids" class="block w-full input-alert-ids" type="text"
                                        name="ids" placeholder="Type id user" required autofocus autocomplete="off"
                                        value="{{ $usr->id }}" />
                                    <x-input-error-v2 class="msg-alert-ids"></x-input-error-v2>
                                </div>
                                <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="username" class="label-alert-username" :value="__('Username')" />
                                        <x-text-input id="username" class="block w-full input-alert-username"
                                            type="text" name="username" placeholder="Type username" required
                                            autofocus autocomplete="off" value="{{ $usr->username }}" />
                                        <x-input-error-v2 class="msg-alert-username"></x-input-error-v2>
                                    </div>
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="name" class="label-alert-name" :value="__('Name')" />
                                        <x-text-input id="name" class="block w-full input-alert-name"
                                            type="numeric" name="name" placeholder="Type full name" required
                                            autofocus autocomplete="off" value="{{ $usr->user_detail->name }}" />
                                        <x-input-error-v2 class="msg-alert-name"></x-input-error-v2>
                                    </div>
                                </div>
                                <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="password" class="label-alert-password" :value="__('Password')" />
                                        <x-text-input id="password" class="block w-full input-alert-password"
                                            type="text" name="password" placeholder="Type password" required
                                            autofocus autocomplete="off" />
                                        <x-input-error-v2 class="msg-alert-password"></x-input-error-v2>
                                    </div>
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="password_confirm" class="label-alert-password_confirm"
                                            :value="__('Password Confirmation')" />
                                        <x-text-input id="password_confirm"
                                            class="block w-full input-alert-password_confirm" type="text"
                                            name="password_confirm" placeholder="Type password confirmation" required
                                            autofocus autocomplete="off" />
                                        <x-input-error-v2 class="msg-alert-password_confirm"></x-input-error-v2>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="nik" class="label-alert-nik" :value="__('Nik')" />
                                        <x-text-input id="nik" class="block w-full input-alert-nik"
                                            type="text" name="nik" placeholder="Type nik" required autofocus
                                            autocomplete="off" value="{{ $usr->user_detail->nik }}" />
                                        <x-input-error-v2 class="msg-alert-nik"></x-input-error-v2>
                                    </div>
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="dob" class="label-alert-dob" :value="__('Date of Brith')" />
                                        <x-text-date-input id="dob" class="block w-full input-alert-dob"
                                            type="text" name="dob" placeholder="Type dob" required autofocus
                                            autocomplete="off" value="{{ $usr->user_detail->dob }}" />
                                        <x-input-error-v2 class="msg-alert-dob"></x-input-error-v2>
                                    </div>
                                </div>
                                <div class="flex flex-col xl:flex-row lg:flex-row md:flex-row mb-4 gap-5">
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="email" class="label-alert-email" :value="__('Email Address')" />
                                        <x-text-input id="email" class="block w-full input-alert-email"
                                            type="email" name="email" placeholder="Type email address" required
                                            autofocus autocomplete="off" value="{{ $usr->email }}" />
                                        <x-input-error-v2 class="msg-alert-email"></x-input-error-v2>
                                    </div>
                                    <div class="w-full sm:col-span-3">
                                        <x-input-label for="gender" class="label-alert-gender" :value="__('Gender')" />
                                        <select id="gender" name="gender"
                                            class="input-alert-gender block w-full p-2.5 text-sm rounded-lg input-normal">
                                            <option selected value="">Select Gender</option>
                                            <option value="Male"
                                                {{ $usr->user_detail->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female"
                                                {{ $usr->user_detail->gender == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        <x-input-error-v2 class="msg-alert-gender"></x-input-error-v2>
                                    </div>
                                </div>
                                <div class="w-full sm:col-span-3">
                                    <x-input-label for="address" class="label-alert-address" :value="__('Address Home')" />
                                    <x-textarea-input class="w-full input-alert-address" name="address"
                                        id="address" rows="6"
                                        placeholder="Type address home">{{ $usr->user_detail->address ? $usr->user_detail->address : '-' }}</x-textarea-input>
                                    <x-input-error-v2 class="msg-alert-address"></x-input-error-v2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="w-full text-end flex xl:gap-10">
            <div class="xl:w-1/3"></div>
            <x-button-save class="w-full" id="btn-save">
                {{ __('Save Data') }}
            </x-button-save>
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
                            document.getElementById("profile_photo_path").src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Event listener untuk membuka input file saat gambar diklik
                document.getElementById("profile_photo_path").addEventListener("click", function() {
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
                    let username = $('input[name="username"]').val()
                    let name = $('input[name="name"]').val()
                    let password = $('input[name="password"]').val()
                    let password_confirm = $('input[name="password_confirm"]').val()

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

                    formData.append('nik', nik);
                    formData.append('dob', dob);
                    formData.append('email', email);
                    formData.append('gender', gender);
                    formData.append('address', address);

                    // Ambil gambar dari input file
                    const fileInput = document.getElementById("fileInput").files[0];
                    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                    if (fileInput && allowedExtensions.exec(fileInput.name)) {
                        formData.append("profile_photo_path", fileInput); // tambahkan gambar ke formData
                    } else if (fileInput) {
                        alert("Only JPG and PNG files are allowed for the user image!");
                        return; // hentikan proses jika gambar tidak valid
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('profileUpdate', ['id' => 'ID']) }}".replace('ID', usrId),
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
                                    alertSuccess.hide();
                                    location.reload();
                                }
                            }, 1000);
                        },
                        error: function(response) {
                            let res = response.responseJSON.errors
                            let msg = response.responseJSON.messages

                            alertError.show();

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

                            if (res.profile_photo_path) {
                                $('.msg-alert-photo-error').text(res.profile_photo_path).addClass(
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
