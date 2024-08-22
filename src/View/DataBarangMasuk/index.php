<?php include __DIR__ . '/../admin-templates/header.php'; ?>

<style>
#addBarangModal {
  display: none;
}

#addBarangModal:not(.hidden) {
  display: block;
}
</style>

<div class="container px-6 py-8 mx-auto">
  <div class="flex items-center space-x-2 ">
    <h3 class="text-3xl font-medium text-gray-700">Pengelolaan Barang Masuk</h3>
    <a class="cetak-container bg-blue-500 flex text-sm space-x-2 rounded-md px-2 py-1 h-fit text-white hover:blue-700"
      href="/barangmasuk/cetak">
      <span class="material-symbols-outlined text-sm">
        print
      </span> <span>Cetak</span>
    </a>
  </div>
  <?php if (!$isKepalaLab) : ?>

  <!-- Button to Open Modal for Adding New Barang -->
  <button id="addBarangButton" class="bg-green-500 text-white px-4 py-2 rounded-md mt-4">
    Tambah Barang Baru
  </button>

  <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
      <h2 class="text-xl font-bold mb-4">Edit Item</h2>
      <form id="editForm">
        <input type="hidden" name="id" id="editId">
        <div class="mb-4">
          <label for="editNamaBarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <input type="text" id="editNamaBarang" name="nama_barang"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50"
            required>
        </div>
        <div class="mb-4">
          <label for="editSatuan" class="block text-sm font-medium text-gray-700">Satuan</label>
          <input type="text" id="editSatuan" name="satuan"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50"
            required>
        </div>
        <div class="mb-4">
          <label for="editHarga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
          <input type="number" id="editHarga" name="harga"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50"
            required>
        </div>

        <div class="flex justify-end">
          <button type="button" id="modalClose" class="bg-gray-500 text-white px-4 py-2 rounded-md">Tutup</button>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Ubah</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Adding New Barang -->
  <div id="addBarangModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mt-3 text-center sm:mt-0 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
              Tambah Barang Baru
            </h3>
          </div>
        </div>
      </div>
      <form id="addBarangForm" class="bg-white px-4 py-5 sm:p-6">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">
              Nama Barang
            </label>
            <input type="text" name="nama_barang" id="nama_barang" required
              class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="satuan" class="block text-sm font-medium text-gray-700">
              Satuan
            </label>
            <input type="text" name="satuan" id="satuan" required
              class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="harga" class="block text-sm font-medium text-gray-700">
              Harga (Rp)
            </label>
            <input type="number" name="harga" id="harga" required
              class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="stok" class="block text-sm font-medium text-gray-700">
              Stok
            </label>
            <input type="number" name="stok" id="stok" required
              class="mt-1 block px-3 py-2 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" id="closeModalButton"
            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
            Tutup
          </button>
          <button type="submit"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
            Tambah Barang
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="flex flex-col mt-8">
    <form id="addBarangMasukForm">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="id_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <select id="id_barang" name="id_barang"
            class="px-4 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-none" required>
            <option value="">Pilih Barang</option>
            <?php foreach ($barangList as $barang) : ?>
            <option value="<?= $barang['id'] ?>"><?= $barang['nama_barang'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
          <input type="number" id="jumlah" name="jumlah"
            class="px-4 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-none" required>
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajukan</button>
      </div>
    </form>
  </div>
  <?php endif; ?>


  <h3 class="mt-4 font-semibold text-zinc-700">
    Pilih Status
  </h3>

  <div class="flex justify-start mb-4">
    <button id="filterAll" class="filter-btn bg-blue-500 text-white px-4 py-2 rounded-md">
      Semua
    </button>
    <button id="filterPending" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Ditunggu
    </button>
    <button id="filterApproved" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Disetujui
    </button>
    <button id="filterRejected" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Ditolak
    </button>
  </div>

  <div class="mt-2">
    <div class="py-2 overflow-x-auto">
      <div class="min-w-full border-b border-gray-200 shadow sm:rounded-lg">
        <table id="barangMasukTable" class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                Barang</th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Jumlah</th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tanggal</th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Admin</th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status</th>
              <?php if ($isKepalaLab) : ?>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions</th>
              <?php endif; ?>
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
  // Initialize DataTable for Barang Masuk
  var table = $('#barangMasukTable').DataTable({
    ajax: {
      url: '/barangmasuk/getall', // URL to fetch data from
      dataSrc: '' // Indicates that data is a flat array
    },
    columns: [{
        data: 'nama_barang'
      },
      {
        data: 'jumlah'
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
        data: 'status',
        render: function(data, type, row) {
          if (data === 'pending') {
            return '<span class="bg-yellow-200 text-yellow-700 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Ditunggu</span>';
          } else if (data === 'disetujui') {
            return '<span class="bg-green-200 text-green-700 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Disetujui</span>';
          } else if (data === 'ditolak') {
            return '<span class="bg-red-200 text-red-700 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Ditolak</span>';
          }
        }
      },
      <?php if ($isKepalaLab) : ?> {
        data: null,
        render: function(data, type, row) {
          if (row.status === 'pending') {
            return '<button class="mr-1 bg-green-500 text-white px-2 py-1 rounded-md approveBtn" data-id="' +
              row.id + '">Setuju</button>' +
              '<button class="bg-red-500 text-white px-2 py-1 rounded-md rejectBtn" data-id="' + row.id +
              '">Tolak</button>';
          } else {
            return '<span class="text-gray-500">Tidak ada aksi</span>';
          }
        }
      }
      <?php endif; ?>

    ]
  });

  // Filter Buttons
  $('#filterAll').on('click', function() {
    table.column(4).search('').draw();
    setActiveButton(this);
  });

  $('#filterPending').on('click', function() {
    table.column(4).search('ditunggu').draw();
    setActiveButton(this);
  });

  $('#filterApproved').on('click', function() {
    table.column(4).search('disetujui').draw();
    setActiveButton(this);
  });

  $('#filterRejected').on('click', function() {
    table.column(4).search('ditolak').draw();
    setActiveButton(this);
  });

  // Function to set active button styling
  function setActiveButton(selectedButton) {
    $('.filter-btn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700');
    $(selectedButton).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white');
  }

  // Open Add Barang Modal
  $('#addBarangButton').on('click', function() {
    $('#addBarangModal').removeClass('hidden');
  });

  // Close Modal on Button Click
  $('#closeModalButton').on('click', function() {
    $('#addBarangModal').addClass('hidden');
  });

  // Close Modal on Outside Click
  $(window).on('click', function(event) {
    if ($(event.target).is('#addBarangModal')) {
      $('#addBarangModal').addClass('hidden');
    }
  });

  // Handle Add Barang Form Submission
  $('#addBarangForm').on('submit', function(e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.post('/barang/add', formData, function(response) {
      if (response.success) {
        $('#addBarangModal').addClass('hidden'); // Close the modal
        Swal.fire({
          icon: 'success',
          title: 'Barang Added',
          text: 'Barang berhasil ditambahkan',
        });
        table.ajax.reload(); // Reload DataTable
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Barang gagal ditambahkan',
        });
      }
    });
  });

  // Handle Add Barang Masuk Form Submission
  $('#addBarangMasukForm').on('submit', function(e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.post('/barangmasuk/add', formData, function(response) {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Diajukan',
          text: 'Barang masuk berhasil diajukan',
        });
        table.ajax.reload(); // Reload DataTable
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Barang masuk gagal diajukan',
        });
      }
    });
  });

  // Handle Approve and Reject Buttons
  $('#barangMasukTable').on('click', '.approveBtn', function() {
    const id = $(this).data('id');

    $.post(`/barangmasuk/approve/${id}`, function(response) {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Pengajuan barang masuk disetujui',
        });
        table.ajax.reload();
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message || 'Pengajuan barang masuk gagal disetujui',
        });
      }
    });
  });


  $('#barangMasukTable').on('click', '.rejectBtn', function() {
    const id = $(this).data('id');

    $.post(`/barangmasuk/reject/${id}`, function(response) {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Barang masuk ditolak',
        });
        table.ajax.reload();
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Gagal menolak barang masuk',
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