<?php include __DIR__ . '/../admin-templates/header.php'; ?>

<div class="container px-6 py-8 mx-auto">
    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>

    <div class="mt-4">
        <div class="flex flex-wrap -mx-6 ">
            <a href="/barang/show" class="w-full my-4 px-6 sm:w-1/2 xl:w-1/3 cursor-pointer">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="w-12 h-12 flex justify-center items-center bg-indigo-600 bg-opacity-75 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                            <path d="m400-570 80-40 80 40v-190H400v190ZM280-280v-80h200v80H280Zm-80 160q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-640v560-560Zm0 560h560v-560H640v320l-160-80-160 80v-320H200v560Z" />
                        </svg>
                    </div>

                    <div class="mx-3">
                        <h4 class="text-2xl font-semibold text-gray-700">Data Barang</h4>
                        <div class="text-gray-500">Barang lab kesehatan</div>
                    </div>
                </div>
            </a>
            <a href="/barangmasuk/show" class="w-full my-4 px-6 sm:w-1/2 xl:w-1/3 cursor-pointer">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="w-12 h-12 flex justify-center items-center bg-lime-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M640-640h120-120Zm-440 0h338-18 14-334Zm16-80h528l-34-40H250l-34 40Zm184 270 80-40 80 40v-190H400v190Zm182 330H200q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v196q-19-7-39-11t-41-4v-122H640v153q-35 20-61 49.5T538-371l-58-29-160 80v-320H200v440h334q8 23 20 43t28 37Zm138 0v-120H600v-80h120v-120h80v120h120v80H800v120h-80Z"/></svg>
                    </div>

                    <div class="mx-3">
                        <h4 class="text-2xl font-semibold text-gray-700">Data Masuk</h4>
                        <div class="text-gray-500">Kelola Barang Masuk</div>
                    </div>
                </div>
            </a>
            <a href="/barangkeluar/show" class="w-full my-4 px-6 sm:w-1/2 xl:w-1/3 cursor-pointer">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="w-12 h-12 flex justify-center items-center bg-amber-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m356-300 204-204v90h80v-226H414v80h89L300-357l56 57ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                    </div>

                    <div class="mx-3">
                        <h4 class="text-2xl font-semibold text-gray-700">Data Keluar</h4>
                        <div class="text-gray-500">Kelola barang keluar</div>
                    </div>
                </div>
            </a>
            <a href="/barangrusak/show" class="w-full my-4 px-6 sm:w-1/2 xl:w-1/3 cursor-pointer">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="w-12 h-12 flex justify-center items-center bg-emerald-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M754-81q-8 0-15-2.5T726-92L522-296q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l85-85q6-6 13-8.5t15-2.5q8 0 15 2.5t13 8.5l204 204q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13l-85 85q-6 6-13 8.5T754-81Zm0-95 29-29-147-147-29 29 147 147ZM205-80q-8 0-15.5-3T176-92l-84-84q-6-6-9-13.5T80-205q0-8 3-15t9-13l212-212h85l34-34-165-165h-57L80-765l113-113 121 121v57l165 165 116-116-43-43 56-56H495l-28-28 142-142 28 28v113l56-56 142 142q17 17 26 38.5t9 45.5q0 24-9 46t-26 39l-85-85-56 56-42-42-207 207v84L233-92q-6 6-13 9t-15 3Zm0-96 170-170v-29h-29L176-205l29 29Zm0 0-29-29 15 14 14 15Zm549 0 29-29-29 29Z"/></svg>
                    </div>

                    <div class="mx-3">
                        <h4 class="text-2xl font-semibold text-gray-700">Data Barang Rusak</h4>
                        <div class="text-gray-500">Kelola Barang Rusak</div>
                    </div>
                </div>
            </a>
            <a href="/baranghabis/show" class="w-full my-4 px-6 sm:w-1/2 xl:w-1/3 cursor-pointer">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="w-12 h-12 flex justify-center items-center bg-sky-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M200-120q-33 0-56.5-23.5T120-200v-160h80v160h160v80H200Zm560 0H600v-80h160v-160h80v160q0 33-23.5 56.5T760-120ZM120-760q0-33 23.5-56.5T200-840h160v80H200v160h-80v-160Zm720 0v160h-80v-160H600v-80h160q33 0 56.5 23.5T840-760ZM480-240q21 0 35.5-14.5T530-290q0-21-14.5-35.5T480-340q-21 0-35.5 14.5T430-290q0 21 14.5 35.5T480-240Zm-36-153h73q0-34 8-52t35-45q35-35 46.5-56.5T618-598q0-54-39-88t-99-34q-50 0-86 26t-52 74l66 27q7-26 26.5-42.5T480-652q29 0 46.5 15.5T544-595q0 20-9.5 37.5T502-521q-33 29-45.5 56T444-393Z"/></svg>
                    </div>

                    <div class="mx-3">
                        <h4 class="text-2xl font-semibold text-gray-700">Data Barang Habis</h4>
                        <div class="text-gray-500">Barang dengan stok kosong</div>
                    </div>
                </div>
            </a>

        </div>
    </div>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">

            </div>
        </div>
    </div>
</div>



<?php include __DIR__ . '/../admin-templates/footer.php'; ?>