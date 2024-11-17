async function addCourse() {
  const courseSelect = document.getElementById("courses");
  const courseList = document.getElementById("courseList");
  const selectedCourse = courseSelect.value;

  if (!selectedCourse) return;

  try {
    const courseData = JSON.parse(selectedCourse); 
    const { kodemk, nama, sks, semester } = courseData;

    // Cek apakah mata kuliah sudah ada di daftar
    const existingCourses = Array.from(courseList.children).map(item => {
      return item.textContent.split(" - ")[0].trim(); 
    });

    if (existingCourses.includes(kodemk)) {
      alert("Mata kuliah sudah ada di daftar.");
      return;
    }

    // Tambahkan ke daftar mata kuliah yang dipilih
    const listItem = document.createElement("li");
    listItem.className = "course-item";
    listItem.textContent = `${kodemk} - ${nama} (${sks} SKS, Semester ${semester})`;
    
    // Tombol untuk menghapus mata kuliah dari daftar
    const removeBtn = document.createElement("span");
    removeBtn.className = "text-white bg-red-700 rounded-full text-xs px-2 py-1 ml-2";
    removeBtn.textContent = "X";
    removeBtn.onclick = function () {
      // Cek apakah mata kuliah sudah diambil (dengan warna hijau)
      const selectedCourseBox = document.querySelector(`.courseBox-${kodemk}[style*="background-color: rgb(40, 167, 69)"]`); // Warna hijau

      if (selectedCourseBox) {
        // Jika mata kuliah sudah dipilih, tampilkan modal konfirmasi
        showCancelModal(kodemk, selectedCourseBox);
        const confirmCancelButton = document.getElementById("confirmCancelButton");
        const cancelCancelButton = document.getElementById("cancelCancelButton");
        const cancelModal = document.getElementById("cancelConfirmationModal");

        confirmCancelButton.onclick = () => {
          // Hapus dari daftar kursus
          courseList.removeChild(listItem);

          removeFromSidebarTable(kodemk);
    
          // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
          const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
          courseBoxes.forEach(box => box.remove());
    
          // Tutup modal
          cancelModal.classList.add("hidden");
        };
      } else {
        // Jika belum dipilih, langsung hapus dari daftar
        const courseList = document.getElementById("courseList");
        courseList.removeChild(listItem);

        // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
        const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
        courseBoxes.forEach(box => box.remove());
      }
    };

    listItem.appendChild(removeBtn);
    courseList.appendChild(listItem);

    courseSelect.value = "";

    await fetchAndDisplaySchedule(kodemk);
  } catch (error) {
    console.error("Error parsing course data:", error);
  }
}

async function fetchAndDisplaySchedule(kodemk) {
  try {
    const response = await fetch(`/jadwal/${kodemk}`, { cache: "no-store" });
    const jadwalList = await response.json();
    
    // Fungsi untuk merapikan waktu ke format HH:00
    function normalizeTimeToHour(waktu) {
      const [jam] = waktu.split(':').map(Number); // Ambil bagian jam
      return `${String(jam).padStart(2, '0')}:00`; // Kembalikan waktu dengan menit diatur ke 00
    }

    jadwalList.forEach(jadwal => {
      const { hari, waktu_mulai, waktu_selesai, kelas, ruang_id } = jadwal;

      // Cari kolom hari berdasarkan nama hari
      const normalizedDay = hari.charAt(0).toUpperCase() + hari.slice(1).toLowerCase();
      const dayColumn = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"].indexOf(normalizedDay);

      // Normalisasi waktu mulai
      const startTime = normalizeTimeToHour(waktu_mulai); // Normalisasi waktu ke format HH:00
      const row = document.querySelector(`#scheduleDisplay tbody tr[data-time="${startTime}"]`);

      if (row && dayColumn >= 0) {
        const cell = row.children[dayColumn + 1]; // Ambil sel yang sesuai dengan kolom hari

        // Bungkus courseBox di dalam wrapper div untuk menambahkan ke cell
        const wrapper = document.createElement("div");
        wrapper.className = "mb-2"; // Tambahkan margin bawah antar elemen jika dibutuhkan

        const courseBox = document.createElement("button");
        courseBox.className = `bg-gray-100 text-black border border-black shadow-md rounded-md p-1 text-[8px] font-medium text-center w-[50px] courseBox-${kodemk}`;
        courseBox.style.cursor = "pointer";

        // Isi informasi jadwal mata kuliah
        courseBox.innerHTML = `
          <div>${kodemk}</div>
          <div>Kelas: ${kelas}</div>
          <div>Ruang: ${ruang_id}</div>
          <div>${waktu_mulai} - ${waktu_selesai}</div>
        `;

        // Tambahkan event klik untuk membuka modal konfirmasi
        courseBox.onclick = () => showConfirmationModal(kodemk, courseBox);

        // Tambahkan courseBox ke dalam wrapper dan masukkan wrapper ke dalam sel tabel
        wrapper.appendChild(courseBox);
        cell.appendChild(wrapper);

        console.log("Menambahkan courseBox:", {
          kodemk,
          kelas,
          hari,
          ruang_id,
          waktu_mulai,
          waktu_selesai
        });
      } else {
        console.warn(`Tidak dapat menemukan row atau cell untuk waktu: ${startTime} pada hari: ${hari}`);
      }
    });
  } catch (error) {
    console.error("Error fetching schedule for", kodemk, error);
  }
}


// Fungsi untuk menampilkan modal konfirmasi pemilihan IRS
function showConfirmationModal(kodemk, selectedCourseBox) {
  const modal = document.getElementById("confirmationModal");
  modal.classList.remove("hidden");

  const confirmButton = document.getElementById("confirmButton");
  const cancelButton = document.getElementById("cancelButton");

  confirmButton.onclick = () => {
    if (selectedCourseBox.classList.contains("bg-gray-100")) {
      // Mata kuliah dipilih, ubah warna menjadi hijau dan matikan klik untuk yang lain
      selectedCourseBox.style.backgroundColor = "#28a745";
      selectedCourseBox.classList.replace("text-black", "text-white");

      const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
      similarCourseBoxes.forEach(box => {
        box.onclick = null; // Matikan klik untuk semua courseBox serupa
        if (box !== selectedCourseBox) {
          box.style.backgroundColor = "#D1D5DB"; // Warna abu-abu gelap
          box.classList.replace("text-black", "text-black");
        }
      });

      addToSidebarTable(kodemk, selectedCourseBox);

      // Tambahkan event klik untuk membatalkan pilihan
      selectedCourseBox.onclick = () => showCancelModal(kodemk, selectedCourseBox);

    } else {
      alert("Mata kuliah ini sudah dipilih.");
    }

    modal.classList.add("hidden");
  };

  cancelButton.onclick = () => {
    modal.classList.add("hidden");
  };
}

// Fungsi untuk menampilkan modal konfirmasi pembatalan pengambilan mata kuliah
function showCancelModal(kodemk, selectedCourseBox) {
  const cancelModal = document.getElementById("cancelConfirmationModal");
  cancelModal.classList.remove("hidden");

  const confirmCancelButton = document.getElementById("confirmCancelButton");
  const cancelCancelButton = document.getElementById("cancelCancelButton");

  confirmCancelButton.onclick = () => {
    // Mata kuliah dibatalkan, kembalikan warna dan aktifkan kembali klik
    selectedCourseBox.style.backgroundColor = ""; // Kembalikan ke warna semula
    selectedCourseBox.classList.replace("text-white", "text-black");

    const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
    similarCourseBoxes.forEach(box => {
      box.style.backgroundColor = ""; // Kembalikan ke warna semula
      box.classList.replace("text-white", "text-black");
      box.onclick = () => showConfirmationModal(kodemk, box); // Aktifkan kembali klik
    });

    // Hapus baris dari tabel sidebar
    removeFromSidebarTable(kodemk);

    // Tutup modal
    cancelModal.classList.add("hidden");
  };

  cancelCancelButton.onclick = () => {
    cancelModal.classList.add("hidden");
  };
}

function addToSidebarTable(kodemk, selectedCourseBox) {
  const sidebarTableBody = document.querySelector("#sidebarTable tbody");

  // Hapus pesan "Tidak ada jadwal yang dipilih" jika ada
  const emptyMessageRow = document.getElementById("emptyMessage");
  if (emptyMessageRow) {
    sidebarTableBody.removeChild(emptyMessageRow);
  }

  // Pastikan tidak ada duplikasi
  const existingRows = Array.from(sidebarTableBody.children).map(row => row.dataset.kodemk);
  if (existingRows.includes(kodemk)) {
    console.warn(`Mata kuliah ${kodemk} sudah ada di tabel sidebar.`);
    return;
  }

  // Ambil informasi mata kuliah dari courseBox
  const [kodeMK, kelas, ruang, waktu] = selectedCourseBox.innerText.split("\n").map(text => text.trim());
  const matakuliah = kodeMK.split(" - ")[1] || "Mata Kuliah Tidak Diketahui"; // Nama mata kuliah diambil dari teks kodeMK jika ada

  // Tambahkan baris baru ke tabel
  const newRow = document.createElement("tr");
  newRow.dataset.kodemk = kodemk; // Tandai baris dengan kodemk
  newRow.innerHTML = `
    <td class="border px-4 py-2">${sidebarTableBody.children.length + 1}</td>
    <td class="border px-4 py-2">${kodeMK.split(" - ")[0]}</td>
    <td class="border px-4 py-2">${matakuliah}</td>
    <td class="border px-4 py-2">${kelas.replace("Kelas: ", "")}</td>
    <td class="border px-4 py-2">${ruang.replace("Ruang: ", "")}</td>
    <td class="border px-4 py-2">${waktu}</td>
  `;
  sidebarTableBody.appendChild(newRow);
}

function removeFromSidebarTable(kodemk) {
  const sidebarTableBody = document.querySelector("#sidebarTable tbody");
  const rows = Array.from(sidebarTableBody.children);

  // Cari baris dengan kodemk yang sesuai dan hapus
  const rowToRemove = rows.find(row => row.dataset.kodemk === kodemk);
  if (rowToRemove) {
    sidebarTableBody.removeChild(rowToRemove);
  }

  // Perbarui nomor urut hanya untuk baris yang memiliki atribut dataset.kodemk
  const remainingRows = Array.from(sidebarTableBody.children).filter(row => row.dataset.kodemk);
  remainingRows.forEach((row, index) => {
    row.children[0].textContent = index + 1; // Update nomor urut sesuai index
  });

  // Jika tabel kosong, tambahkan pesan "Tidak ada jadwal yang dipilih"
  if (remainingRows.length === 0) {
    const emptyMessageRow = document.createElement("tr");
    emptyMessageRow.id = "emptyMessage";
    emptyMessageRow.innerHTML = `
      <td colspan="6" class="text-center text-gray-500">Tidak ada jadwal yang dipilih</td>
    `;
    sidebarTableBody.appendChild(emptyMessageRow);
  }
}

function saveSelectedSchedule(jadwal) {
  fetch('/irs/store', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrfToken
      },
      body: JSON.stringify({
          nim: "24060122130077",
          semester: 5,
          tahun_ajaran: "2023/2024",
          total_sks: 0,
          jadwal: jadwal // Mengirim data jadwal yang dipilih
      })
  })
  .then(response => response.json())
  .then(result => {
      if (result.success) {
          alert("Jadwal berhasil disimpan ke IRS.");
      } else {
          console.error("Gagal menyimpan jadwal:", result.error);
          alert("Gagal menyimpan jadwal.");
      }
  })
  .catch(error => console.error('Error saving schedule:', error));
}

function showModal(id) {
  // Dapatkan data dari API atau set data IRS dari server
  fetch(`/api/irs/${id}`)
      .then(response => response.json())
      .then(data => {
          // Update konten modal
          document.getElementById('modal-title').textContent = `IRS ${data.nama} - ${data.nim} (${data.status})`;
          
          // Contoh mengisi tabel dalam modal
          let tableBody = document.getElementById('modal-table-body');
          tableBody.innerHTML = '';
          data.matakuliah.forEach((mk, index) => {
              let row = `<tr>
                  <td>${index + 1}</td>
                  <td>${mk.kode}</td>
                  <td>${mk.nama}</td>
                  <td>${mk.kelas}</td>
                  <td>${mk.sks}</td>
                  <td>${mk.ruang}</td>
                  <td>${mk.status}</td>
                  <td>${mk.dosen}</td>
                  <td><a href="#">Aksi</a></td>
              </tr>`;
              tableBody.insertAdjacentHTML('beforeend', row);
          });

          // Tampilkan modal
          document.getElementById('default-modal').classList.remove('hidden');
      })
      .catch(error => console.error('Error fetching IRS data:', error));
}



