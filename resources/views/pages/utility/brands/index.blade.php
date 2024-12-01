<x-app-layout>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">Roles</h1>
            <button type="button" id="btn-add"
                class="text-white bg-[#050708] hover:bg-[#050708]/80 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#050708]/40 dark:focus:ring-gray-600 me-2 mb-2">

                <svg class="w-5 h-5 me-2 -ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                        clip-rule="evenodd" />
                </svg>
                Add Brands
            </button>
        </div>

        <x-loading-skeleton />

        <div class="relative overflow-x-auto w-full bg-white p-8 hidden" id="boxTable">
            <table id="myTableBrands"
                class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 table-fixed">
                    <tr>
                        <th class="w-[10%] p-2" hidden>No</th>
                        <th class="w-[10%] p-2">Brand Name</th>
                        <th class="p-2">Brand Description</th>
                        <th class="w-[10%] p-2 text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('pages.utility.brands.modal')

    @push('myscript')
        <script type="module">
            $(document).ready(function() {

                setTimeout(() => {
                    // Hide skeleton and show table after data is loaded
                    $('#skeletonTable').hide();
                    $('#boxTable').removeClass('hidden');
                }, 600);

                // Init Datatables
                var table = $('#myTableBrands').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],
                    ajax: "{{ route('brandList') }}",
                    columns: [{
                        data: 'index',
                        name: 'index',
                        title: '#',
                        orderable: false,
                        searchable: false,
                        visible: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: 'brand_name',
                        name: 'brand_name',
                        orderable: false,
                        className: 'align-top',
                    }, {
                        data: 'brand_desc',
                        name: 'brand_desc',
                        orderable: false,
                        className: 'align-top',
                    }, {
                        data: 'Action',
                        name: 'Action',
                        orderable: false,
                        searchable: false,
                        className: 'align-top',
                    }],
                    createdRow: function(row, data, dataIndex) {
                        $(row).find('td').removeClass('p-3').addClass('p-0 px-3 py-2 border-b');
                        $(row).find('td:last-child')
                            .addClass('p-0 px-3 p-3 flex justify-center items-center');
                    },
                });

                // Styling Datatables
                setTimeout(() => {
                    // Hedaer Table
                    $('.dt-length').closest('.grid.grid-cols-2.gap-4.mb-4').addClass(
                        'flex justify-between p-2 items-center text-sm')

                    $('#dt-search-0').addClass('py-1').removeClass('py-2')
                    $('#dt-search-0').attr('placeholder', 'Search...');
                    $('#dt-search-0').css({
                        'font-size': '0.75rem'
                    });

                    $('#dt-length-0').addClass('py-1 text-sm').removeClass('py-2')
                    $('.dt-length').closest('.grid.grid-cols-2.gap-4.mb-4').removeClass(
                        'grid grid-cols-2 gap-4')

                    $('#myTableBrands thead tr th').addClass('p-4')
                    $('#myTableBrands tbody tr').addClass('border-b')

                    // Footer Table
                    $('#myTableBrands_info').closest('.grid.grid-cols-2.gap-4.mb-4').addClass(
                        'flex justify-between p-2 items-center text-sm')
                    $('#myTableBrands_info').closest('.grid.grid-cols-2.gap-4.mb-4').removeClass(
                        'grid grid-cols-2 gap-4 mb-4')

                    // Style Table
                    $('.dt-search-0').addClass('ml-2')
                    $('.dt-empty').text('Data tidak ditemukan');
                }, 50);


                // Set The Modal Menu
                const $modal1 = document.getElementById('modal-form');
                const $modal2 = document.getElementById('modal-delete');

                const instanceOptions1 = {
                    id: 'modal-form',
                    override: true
                };

                const instanceOptions2 = {
                    id: 'modal-delete',
                    override: true
                };

                const options1 = {
                    placement: 'bottom-right',
                    backdrop: 'static',
                    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                    closable: true,
                    onShow: () => {
                        setTimeout(() => {
                            $modal1.classList.add('scale-100', 'opacity-100', 'translate-y-0');
                            $modal1.classList.remove('scale-0', 'opacity-0', 'translate-y-4');
                        }, 50);
                    },
                    onHide: () => {
                        $modal1.classList.add('scale-0', 'opacity-0', 'translate-y-4');
                        $modal1.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
                    }
                };

                const options2 = {
                    placement: 'bottom-right',
                    backdrop: 'static',
                    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                    closable: true,
                    onShow: () => {
                        setTimeout(() => {
                            $modal2.classList.add('scale-100', 'opacity-100', 'translate-y-0');
                            $modal2.classList.remove('scale-0', 'opacity-0', 'translate-y-4');
                        }, 50);
                    },
                    onHide: () => {
                        $modal2.classList.add('scale-0', 'opacity-0', 'translate-y-4');
                        $modal2.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
                    }
                };

                const modal1 = new Modal($modal1, options1, instanceOptions1);
                const modal2 = new Modal($modal2, options2, instanceOptions2);


                // SAVE, DELETE, EDIT AND ADD FUNCTION :
                // Init Data
                const buttonDelete = $('#btn-delete');
                let actionMode = 'Save';
                let editId = null;

                // Save Data Handler Function
                $('#btn-save').click(function(e) {
                    e.preventDefault();
                    confirmAlert(actionMode, editId);
                });

                // Close Function
                $('#btn-close').click(function(e) {
                    e.preventDefault();
                    clearValidation()
                    modal1.hide();
                });

                // Add Function
                $('#btn-add').click(function(e) {
                    clearValidation();
                    actionMode = 'Save';
                    editId = null;
                    modal1.show();
                });

                // Edit Function
                $('body').on('click', '.btn-edit', function(e) {
                    e.preventDefault();
                    clearValidation();
                    let id = $(this).data('id')

                    $.ajax({
                        type: "GET",
                        url: "{{ route('brandShow', ['id' => 'ID']) }}".replace('ID', id),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#brand_name').val(response.data.brand_name)
                            $('#brand_desc').val(response.data.brand_desc)
                            actionMode = 'Update';
                            editId = id;
                            modal1.show();
                        }
                    });
                });

                // Delete Function
                $('body').on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    let deleteName = $(this).closest('tr').find('td:eq(0)').text();
                    let id = $(this).data('id')
                    $('.deleted-text').text(deleteName)
                    $('.e_id').val(id);

                    modal2.show()
                });

                // Cencel Delete Function
                $('#btn-cancel').click(function(e) {
                    e.preventDefault();
                    modal2.hide();
                });

                // Confirm Alert Function
                function confirmAlert(action, id) {
                    alertConfirm.show();

                    $('#btn-confirm-alert').off('click').on('click', function(e) {
                        e.preventDefault();
                        alertConfirm.hide();
                        save(action, id);
                    });

                }

                // Save Function (Save to server)
                function save(action, id) {
                    const formData = new FormData()
                    let brand_name = $('input[name="brand_name"]').val()
                    let brand_desc = $('textarea[name="brand_desc"]').val()

                    formData.append('brand_name', brand_name);
                    formData.append('brand_desc', brand_desc);

                    let url_data = '';
                    if (action == 'Save') {
                        url_data = "{{ route('brandStore') }}";
                    } else if (action == 'Update') {
                        url_data = "{{ route('brandUpdate', ['id' => 'ID']) }}".replace('ID', id);
                    } else {
                        return false
                    }

                    $.ajax({
                        type: "POST",
                        url: url_data,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            let res = response.success

                            $('#success-title').text(res);
                            alertSuccess.show();
                            clearValidation()

                            setTimeout(() => {
                                if (res) {
                                    alertSuccess.hide();
                                    modal1.hide();
                                    table.ajax.reload();
                                }
                            }, 1000);
                        },
                        error: function(response) {
                            let res = response.responseJSON.errors
                            let msg = response.responseJSON.messages

                            alertError.show();

                            if (res.brand_name) {
                                $('.msg-alert-brand_name').text(res.brand_name).addClass(
                                    'message-error')
                                $('.input-alert-brand_name').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-brand_name').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-brand_name').text('').removeClass('message-error')
                                $('.input-alert-brand_name').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-brand_name').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }

                            if (res.brand_desc) {
                                $('.msg-alert-brand_desc').text(res.brand_desc).addClass(
                                    'message-error')
                                $('.input-alert-brand_desc').addClass('input-error').removeClass(
                                    'input-success input-normal')
                                $('.label-alert-brand_desc').addClass('label-error').removeClass(
                                    'label-success label-normal')
                            } else {
                                $('.msg-alert-brand_desc').text('').removeClass('message-error')
                                $('.input-alert-brand_desc').addClass('input-success').removeClass(
                                    'input-normal input-error')
                                $('.label-alert-brand_desc').addClass('label-success').removeClass(
                                    'label-normal label-error')
                            }
                        }
                    });
                }

                // Clear Validation Function
                function clearValidation() {
                    $('.form-modal input, .form-modal select, .form-modal textarea').val('');

                    $('[class*="msg-alert"]').text('').removeClass('message-error');
                    $('[class*="input-alert"]').addClass('input-normal').removeClass(
                        'input-success input-error');
                    $('[class*="label-alert"]').addClass('label-normal').removeClass(
                        'label-success label-error');
                }
            });
        </script>
    @endpush
</x-app-layout>
