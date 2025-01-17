<?php include __DIR__ . '/../admin-templates/header.php'; ?>

<div class="container px-6 py-8 mx-auto">
  <div class="flex items-center space-x-2 ">
    <h3 class="text-3xl font-medium text-gray-700">Pengelolaan Barang Keluar</h3>
    <a class="cetak-container bg-blue-500 flex text-sm space-x-2 rounded-md px-2 py-1 h-fit text-white hover:blue-700"
      href="/barangkeluar/cetak">
      <span class="material-symbols-outlined text-sm">
        print
      </span> <span>Cetak</span>
    </a>
  </div>
  <?php if (!$isKepalaLab) : ?>
  <div class="flex flex-col mt-8">
    <form id="addBarangKeluarForm">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="id_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <select id="id_barang" name="id_barang"
            class="px-4 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-none" required>
            <option value="">Pilih Barang</option>
            <?php foreach ($barangList as $barang) : ?>
            <?php if ($barang['stok'] > 0) : // Check if stock is greater than zero 
                                ?>
            <option value="<?= $barang['id'] ?>">
              <?= $barang['nama_barang'] ?> - Stok: <?= $barang['stok'] ?>
            </option>
            <?php endif; ?>
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
    <button id="filterKeluarAll" class="filter-keluar-btn bg-blue-500 text-white px-4 py-2 rounded-md">
      Semua
    </button>
    <button id="filterKeluarPending" class="filter-keluar-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Ditunggu
    </button>
    <button id="filterKeluarApproved" class="filter-keluar-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Disetujui
    </button>
    <button id="filterKeluarRejected" class="filter-keluar-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
      Ditolak
    </button>
  </div>

  <div class="mt-2">
    <div class="py-2 overflow-x-auto">
      <div class="min-w-full border-b border-gray-200 shadow sm:rounded-lg">
        <table id="barangKeluarTable" class="min-w-full divide-y divide-gray-200">
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
  // Initialize DataTable for Barang Keluar
  var tableKeluar = $('#barangKeluarTable').DataTable({
    ajax: {
      url: '/barangkeluar/getall', // URL to fetch data from
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

  // Filter buttons logic
  function setActiveFilterButton(buttonId) {
    $('.filter-keluar-btn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700');
    $(buttonId).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white');
  }

  $('#filterKeluarAll').on('click', function() {
    setActiveFilterButton('#filterKeluarAll');
    tableKeluar.search('').draw();
  });

  $('#filterKeluarPending').on('click', function() {
    setActiveFilterButton('#filterKeluarPending');
    tableKeluar.search('pending').draw();
  });

  $('#filterKeluarApproved').on('click', function() {
    setActiveFilterButton('#filterKeluarApproved');
    tableKeluar.search('approved').draw();
  });

  $('#filterKeluarRejected').on('click', function() {
    setActiveFilterButton('#filterKeluarRejected');
    tableKeluar.search('rejected').draw();
  });

  // Form submission for new stock requests
  $('#addBarangKeluarForm').on('submit', function(event) {
    event.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
      url: '/barangkeluar/add',
      type: 'POST',
      data: formData,
      success: function(response) {
        if (response.success) {
          $('#barangKeluarTable').DataTable().ajax.reload(); // Reload DataTable data
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Melakukan Pengajuan',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Melakukan Pengajuan!',
            text: response.message || 'Please try again.',
            showConfirmButton: true
          });
        }
      }
    });
  });

  // Approve button handler
  $('#barangKeluarTable').on('click', '.approveBtn', function() {
    const id = $(this).data('id');
    $.post(`/barangkeluar/approve/${id}`, function(response) {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Pengajuan barang keluar disetujui',
        });
        tableKeluar.ajax.reload(); // Corrected to use tableKeluar
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message || 'Pengajuan barang keluar gagal disetujui',
        });
      }
    });
  });

  // Reject button handler
  $('#barangKeluarTable').on('click', '.rejectBtn', function() {
    const id = $(this).data('id');

    $.post(`/barangkeluar/reject/${id}`, function(response) {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Barang keluar ditolak',
        });
        tableKeluar.ajax.reload(); // Corrected to use tableKeluar
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Gagal menolak barang keluar',
        });
      }
    });
  });




  // Function to update status of a request
  function updateStatus(id, status) {
    $.ajax({
      url: '/barangkeluar/updatestatus',
      type: 'POST',
      data: {
        id: id,
        status: status
      },
      success: function(response) {
        if (response.success) {
          $('#barangKeluarTable').DataTable().ajax.reload(); // Reload DataTable data
          Swal.fire({
            icon: 'success',
            title: 'Status updated successfully!',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Failed to update status!',
            text: response.message || 'Please try again.',
            showConfirmButton: true
          });
        }
      }
    });
  }

  // Function to format date and time
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
});
</script>

<?php include __DIR__ . '/../admin-templates/footer.php'; ?>