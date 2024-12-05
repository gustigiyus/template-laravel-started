<x-app-layout>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white">App Setting</h1>
        </div>

        <x-loading-skeleton />

        <div class="relative overflow-x-auto w-full bg-white p-8 hidden" id="boxTable">
            <table id="myTableAppSetting"
                class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 table-fixed">
                    <tr>
                        <th class="w-[10%] p-2" hidden>No</th>
                        <th class="w-[10%] p-2">Logo App</th>
                        <th class="w-[10%] p-2">Name App</th>
                        <th class="p-2">Description</th>
                        <th class="w-[10%] p-2">Update At</th>
                        <th class="w-[10%] p-2 text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('myscript')
        <script type="module">
            $(document).ready(function() {

                setTimeout(() => {
                    // Hide skeleton and show table after data is loaded
                    $('#skeletonTable').hide();
                    $('#boxTable').removeClass('hidden');
                }, 600);

                // Init Datatables
                var table = $('#myTableAppSetting').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 20, -1],
                        [5, 10, 20, 'All']
                    ],
                    ajax: "{{ route('settingAppList') }}",
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
                        data: 'logo_app',
                        name: 'logo_app',
                        orderable: false,
                        render: function(data, type, row) {
                            // Check if the image URL is empty or null
                            var imageUrl = row.logo_app ?
                                '/storage/logo/' + row.logo_app :
                                '/images/default-image.png';

                            return `
                            <div class="flex flex-row items-start text-gray-900 whitespace-nowrap dark:text-white space-x-2 w-full">
                                <img class="w-14 md:w-20 duration-300 rounded-lg hover:scale-125 transition-transform"
                                    src="${imageUrl}"
                                    alt="Product Image">
                            </div>`;
                        }
                    }, {
                        data: 'name_app',
                        name: 'name_app',
                        orderable: false,
                        className: 'align-top',
                    }, {
                        data: 'desc_app',
                        name: 'desc_app',
                        orderable: false,
                        className: 'align-top',
                        defaultContent: '-',
                    }, {
                        data: 'updated_at',
                        name: 'updated_at',
                        searchable: false,
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
                        $(row).find('td:last-child').addClass('text-center');
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

                    $('#myTableAppSetting thead tr th').addClass('p-4')
                    $('#myTableAppSetting tbody tr').addClass('border-b')

                    // Footer Table
                    $('#myTableAppSetting_info').closest('.grid.grid-cols-2.gap-4.mb-4').addClass(
                        'flex justify-between p-2 items-center text-sm')
                    $('#myTableAppSetting_info').closest('.grid.grid-cols-2.gap-4.mb-4').removeClass(
                        'grid grid-cols-2 gap-4 mb-4')

                    // Style Table
                    $('.dt-search-0').addClass('ml-2')
                    $('.dt-empty').text('Data tidak ditemukan');
                }, 50);
            });
        </script>
    @endpush
</x-app-layout>
