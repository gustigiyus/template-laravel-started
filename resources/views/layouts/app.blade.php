<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HRM APP') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.tailwindcss.js"></script>

    {{-- Simple Datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

    {{-- Toastr Js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Leaflet's --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        /* Custom animation for loading notification */
        .loading-bar-alert {
            width: 100%;
        }

        .loading-bar-alert.active {
            width: 0%;
            transition: width 0.8s linear;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-slate-50">
        @include('layouts.navigation')

        {{-- Notification Toastr --}}
        @if (!request()->is('/'))
            {!! Toastr::message() !!}
        @endif

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset


        <!-- Page Content -->
        <main class="p-4 sm:ml-64 ">
            <div class="p-4 rounded-lg mt-14">
                {{ $slot }}
            </div>
        </main>
    </div>

    <x-modal-alert title="Are you sure you want to save this data?" confirmText="Yes, save it"
        cancelText="Don't save" />
    <x-modal-error title="Invalid data, please fill in the correct data" confirmText="Okay, I'll fix it" />
    <x-modal-success title="" confirmText="Okay" />

    <script>
        // Define modal variables globally
        let alertConfirm, alertError, alertSuccess;

        // Function loading bar
        function startLoadingBar() {
            const loadingBar = document.querySelector('.loading-bar-alert');
            loadingBar.classList.remove('active');

            setTimeout(() => {
                loadingBar.classList.add('active');
            }, 50);
        }

        // Function to format currency as IDR
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(value);
        }

        // Function to parse currency IDR to normal integer
        function parseCurrency(formattedValue) {
            const trimmedValue = formattedValue.trim();
            const isNegative = trimmedValue.startsWith('-');
            let value = trimmedValue.replace(/[Rp.\s,]/g, '');

            if (value === '0') {
                return 0;
            }

            if (isNegative) {
                value = '-' + value.replace('-', '');
            }

            return parseInt(value) || 0;
        }

        // Function date format
        function formatDate(data) {
            if (data) {
                // Peta nama bulan custom
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

                // Parse tanggal dari format MM/DD/YYYY
                const date = new Date(data);
                const day = date.getDate().toString().padStart(2, '0'); // Pastikan 2 digit
                const month = months[date.getMonth()]; // Ambil nama bulan dari array
                const year = date.getFullYear();

                // Format akhir: 01 Nov 2020
                return `${day} ${month} ${year}`;
            }
            return '-'; // Jika data kosong, tampilkan "-"
        }


        // Function Custom Alert
        $(document).ready(function() {
            // Init Modal (Confirm Alert & Error Alert)
            const $modalConfirmAlert = document.getElementById('modalAlertConfirm');
            const $modalErrorAlert = document.getElementById('modalAlertError');
            const $modalSuccessAlert = document.getElementById('modalAlertSuccess');

            const instanceOptionsAlertConfirm = {
                id: 'modalAlertConfirm',
                override: true
            };

            const instanceOptionsAlertError = {
                id: 'modalAlertError',
                override: true
            };

            const instanceOptionsAlertSuccess = {
                id: 'modalAlertSuccess',
                override: true
            };

            const optionsAlertConfirm = {
                placement: 'bottom-right',
                backdrop: 'static',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onShow: () => {
                    setTimeout(() => {
                        $modalConfirmAlert.classList.add('scale-100', 'opacity-100',
                            'translate-y-0');
                        $modalConfirmAlert.classList.remove('scale-0', 'opacity-0',
                            'translate-y-4');
                    }, 50);
                },
                onHide: () => {
                    $modalConfirmAlert.classList.add('scale-0', 'opacity-0', 'translate-y-4');
                    $modalConfirmAlert.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
                }
            };

            const optionsAlertError = {
                placement: 'center',
                backdrop: 'static',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onShow: () => {
                    setTimeout(() => {
                        $modalErrorAlert.classList.add('scale-100', 'opacity-100',
                            'translate-y-0');
                        $modalErrorAlert.classList.remove('scale-0', 'opacity-0',
                            'translate-y-4');
                    }, 50);
                },
                onHide: () => {
                    $modalErrorAlert.classList.add('scale-0', 'opacity-0', 'translate-y-4');
                    $modalErrorAlert.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
                }
            };

            const optionsAlertSuccess = {
                placement: 'top-right',
                backdrop: 'static',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onShow: () => {
                    setTimeout(() => {
                        $modalSuccessAlert.classList.remove('opacity-0', '-translate-y-10');
                        startLoadingBar();
                    }, 50);
                },
                onHide: () => {
                    $modalSuccessAlert.classList.add('opacity-0', '-translate-y-10');
                }
            };

            alertConfirm = new Modal($modalConfirmAlert, optionsAlertConfirm, instanceOptionsAlertConfirm);
            alertError = new Modal($modalErrorAlert, optionsAlertError, instanceOptionsAlertError);
            alertSuccess = new Modal($modalSuccessAlert, optionsAlertSuccess, instanceOptionsAlertSuccess);

            $('#btn-cancel-alert').click(function(e) {
                e.preventDefault();
                alertConfirm.hide();
            });

            $('#btn-comfirm-error').click(function(e) {
                e.preventDefault();
                alertError.hide();
            });
        });
    </script>

    {{-- Scirpt push from other file --}}
    @stack('myscript')

</body>

</html>
