<?php include __DIR__ . '/../admin-templates/header.php'; ?>

<div class="container px-6 py-8 mx-auto">
    <h3 class="text-3xl font-medium text-gray-700">Data Barang Rusak</h3>

    <!-- Button to Open Modal for Adding New Barang Rusak -->
    <button id="addBarangRusakButton" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">
        Tambah Barang Rusak
    </button>

    <!-- Modal for Adding New Barang Rusak -->
    <div id="addBarangRusakModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Tambah Barang Rusak
                        </h3>
                    </div>
                </div>
            </div>
            <form id="addBarangRusakForm" class="bg-white px-4 py-5 sm:p-6" enctype="multipart/form-data">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">
                            Nama Barang
                        </label>
                        <!-- Change input to a dropdown with barang options -->
                        <select name="id_barang" id="id_barang" required class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Barang</option>
                            <?php foreach ($barangList as $item) : ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['nama_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="jumlah_rusak" class="block text-sm font-medium text-gray-700">
                            Jumlah Rusak
                        </label>
                        <input type="number" name="jumlah_rusak" id="jumlah_rusak" required class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">
                            Keterangan
                        </label>
                        <textarea name="keterangan" id="keterangan" required class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="col-span-6">
                        <label for="foto_barang" class="block text-sm font-medium text-gray-700">
                            Foto Barang Rusak
                        </label>
                        <input type="file" name="foto_barang" id="foto_barang" required class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closeModalButton" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Tambah Barang Rusak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-2">
        <div class="py-2 overflow-x-auto">
            <div class="min-w-full border-b border-gray-200 shadow sm:rounded-lg">
                <table id="barangRusakTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Rusak</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Table rows will be generated by DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable for Barang Rusak
        var table = $('#barangRusakTable').DataTable({
            ajax: {
                url: '/barangrusak/getall', // URL to fetch data from
                dataSrc: '' // Indicates that data is a flat array
            },
            columns: [{
                    data: 'nama_barang'
                },
                {
                    data: 'foto',
                    render: function(data, type, row) {
                        if (data) {
                            // Construct the full URL for the image
                            var imageUrl = `/Uploads/${data}`;
                            return `
                                <a href="${imageUrl}" target="_blank">
                                    <img src="${imageUrl}" alt="Foto Barang Rusak" style="width: 100px; height: auto; cursor: zoom-in;">
                                </a>
                            `;
                        } else {
                            return 'No Image'; // Placeholder if no image is available
                        }
                    }
                },
                {
                    data: 'jumlah_rusak'
                },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        return formatDateTime(data); // Format date to "12 Januari 2022 Jam 08:00"
                    }
                },
                {
                    data: 'username'
                },
                {
                    data: 'keterangan'
                }
            ]
        });

        // Open Add Barang Rusak Modal
        $('#addBarangRusakButton').on('click', function() {
            $('#addBarangRusakModal').removeClass('hidden');
        });

        // Close Modal on Button Click
        $('#closeModalButton').on('click', function() {
            $('#addBarangRusakModal').addClass('hidden');
        });

        // Close Modal on Outside Click
        $(window).on('click', function(event) {
            if ($(event.target).is('#addBarangRusakModal')) {
                $('#addBarangRusakModal').addClass('hidden');
            }
        });

        // Handle Add Barang Rusak Form Submission
        $('#addBarangRusakForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this); // Use FormData for file uploads

            $.ajax({
                url: '/barangrusak/add', // URL to handle form submission
                type: 'POST',
                data: formData,
                processData: false, // Important for file upload
                contentType: false, // Important for file upload
                success: function(response) {
                    if (response.success) {
                        $('#addBarangRusakModal').addClass('hidden'); // Close the modal
                        Swal.fire({
                            icon: 'success',
                            title: 'Barang Rusak Ditambahkan',
                            text: 'Barang rusak berhasil ditambahkan',
                        });
                        table.ajax.reload(); // Reload DataTable
                    } else {
                        // Display server-side error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'Gagal menambahkan barang rusak',
                        });
                    }
                },

                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data',
                    });
                }
            });
        });

        // Utility Functions
        function formatDateTime(dateTimeStr) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const date = new Date(dateTimeStr);
            return date.toLocaleDateString('id-ID', options).replace(' at ', ' Jam ');
        }

        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    });
</script>

<?php include __DIR__ . '/../admin-templates/footer.php'; ?>