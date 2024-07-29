<?php include __DIR__ . '/../admin-templates/header.php'; ?>

<div class="container px-6 py-8 mx-auto">
    <h3 class="text-3xl font-medium text-gray-700">Data Barang</h3>

    <div class="flex flex-col mt-8">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table id="barangTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Satuan
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga (Rp)
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stok
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Data will be populated here by DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
        <h2 class="text-xl font-bold mb-4">Edit Item</h2>
        <form id="editForm">
            <input type="hidden" name="id" id="editId">
            <div class="mb-4">
                <label for="editNamaBarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" id="editNamaBarang" name="nama_barang" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="editSatuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                <input type="text" id="editSatuan" name="satuan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="editHarga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" id="editHarga" name="harga" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            
            <div class="flex justify-end">
                <button type="button" id="modalClose" class="bg-gray-500 text-white px-4 py-2 rounded-md">Tutup</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Ubah</button>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    $('#barangTable').DataTable({
        ajax: {
            url: '/databarang/getall', // URL to fetch data from
            dataSrc: '' // Indicate that data is a flat array
        },
        columns: [
            { data: 'nama_barang' },
            { data: 'satuan' },
            { 
                data: 'harga',
                render: function(data, type, row) {
                    return formatPrice(data);
                }
            },
            { data: 'stok' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="edit-btn bg-blue-500 text-white px-2 py-1 rounded" data-id="${row.id}" data-nama="${row.nama_barang}" data-satuan="${row.satuan}" data-harga="${row.harga}" data-stok="${row.stok}">Edit</button>
                        <button class="delete-btn bg-red-500 text-white px-2 py-1 rounded" data-id="${row.id}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Event delegation for edit button
    $('#barangTable tbody').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var nama_barang = $(this).data('nama');
        var satuan = $(this).data('satuan');
        var harga = $(this).data('harga');

        $('#editId').val(id);
        $('#editNamaBarang').val(nama_barang);
        $('#editSatuan').val(satuan);
        $('#editHarga').val(harga);

        $('#editModal').removeClass('hidden');
    });

    // Event delegation for close button in the modal
    $('#modalClose').on('click', function() {
        $('#editModal').addClass('hidden');
    });

    // Handle form submission
    $('#editForm').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: '/databarang/edit',
            method: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Item berhasil diperbarui.',
                }).then(() => {
                    $('#barangTable').DataTable().ajax.reload(); // Reload table data
                    $('#editModal').addClass('hidden');
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui item.',
                });
            }
        });
    });

    // Event delegation for delete button
    $('#barangTable tbody').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus item ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/databarang/delete/' + id,
                    method: 'POST',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Item berhasil dihapus.',
                        }).then(() => {
                            $('#barangTable').DataTable().ajax.reload(); // Reload table data
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal menghapus item.',
                        });
                    }
                });
            }
        });
    });
});

</script>

<?php include __DIR__ . '/../admin-templates/footer.php'; ?>