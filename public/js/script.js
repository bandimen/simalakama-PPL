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

        const cancelModal = document.getElementById("cancelConfirmationModal");

        confirmCancelButton.onclick = () => {
          // Hapus dari daftar kursus
          courseList.removeChild(listItem);

          removeFromSheet(kodemk);
    
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


function showConfirmationModal(kodemk, selectedCourseBox) {
  const modal = document.getElementById("confirmationModal");
  modal.classList.remove("hidden"); // Tampilkan modal

  const confirmButton = document.getElementById("confirmButton");
  const cancelButton = document.getElementById("cancelButton");

  // Reset event listener sebelumnya
  confirmButton.onclick = null;
  cancelButton.onclick = null;

  // Event ketika konfirmasi ditekan
  confirmButton.onclick = () => {
    if (selectedCourseBox.classList.contains("bg-gray-100")) {
      // Ubah warna menjadi hijau
      selectedCourseBox.style.backgroundColor = "#28a745";
      selectedCourseBox.classList.replace("text-black", "text-white");

      // Nonaktifkan klik untuk kotak jadwal lainnya
      const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
      similarCourseBoxes.forEach(box => {
        box.onclick = null; // Matikan klik untuk semua kotak serupa
        if (box !== selectedCourseBox) {
          box.style.backgroundColor = "#D1D5DB"; // Warna abu-abu
          box.classList.replace("text-black", "text-black");
        }
      });

      addToSheet(kodemk, selectedCourseBox);

      // Tambahkan event klik untuk membatalkan pilihan
      selectedCourseBox.onclick = () => showCancelModal(kodemk, selectedCourseBox);

      console.log(`Mata kuliah ${kodemk} dipilih.`);
    } else {
      alert("Mata kuliah ini sudah dipilih.");
    }

    modal.classList.add("hidden"); // Tutup modal setelah konfirmasi
  };

  // Event ketika pembatalan ditekan
  cancelButton.onclick = () => {
    modal.classList.add("hidden"); // Tutup modal
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

    // Hapus baris dari tabel bottomSheet
    removeFromSheet(kodemk);

    // Tutup modal
    cancelModal.classList.add("hidden");
  };

  cancelCancelButton.onclick = () => {
    cancelModal.classList.add("hidden");
  };
}

function addToSheet(kodemk, selectedCourseBox) {
  const bottomSheetTableBody = document.querySelector("#bottomSheetTable tbody");

  // Hapus pesan "Tidak ada jadwal yang dipilih" jika ada
  const emptyMessageRow = document.getElementById("emptyMessage");
  if (emptyMessageRow) {
    bottomSheetTableBody.removeChild(emptyMessageRow);
  }

  // Pastikan tidak ada duplikasi
  const existingRows = Array.from(bottomSheetTableBody.children).map(row => row.dataset.kodemk);
  if (existingRows.includes(kodemk)) {
    console.warn(`Mata kuliah ${kodemk} sudah ada di tabel bottomSheet.`);
    return;
  }

  // Ambil informasi mata kuliah dari courseBox
  const [kodeMK, kelas, ruang, waktu] = selectedCourseBox.innerText.split("\n").map(text => text.trim());
  const matakuliah = kodeMK.split(" - ")[1] || "Mata Kuliah Tidak Diketahui"; // Nama mata kuliah diambil dari teks kodeMK jika ada

  // Tambahkan baris baru ke tabel
  const newRow = document.createElement("tr");
  newRow.dataset.kodemk = kodemk; // Tandai baris dengan kodemk
  newRow.innerHTML = `
    <td class="border px-4 py-2">${bottomSheetTableBody.children.length + 1}</td>
    <td class="border px-4 py-2">${kodeMK.split(" - ")[0]}</td>
    <td class="border px-4 py-2">${matakuliah}</td>
    <td class="border px-4 py-2">${kelas.replace("Kelas: ", "")}</td>
    <td class="border px-4 py-2">${ruang.replace("Ruang: ", "")}</td>
    <td class="border px-4 py-2">${waktu}</td>
  `;
  bottomSheetTableBody.appendChild(newRow);
  
  // saveSelectedCourse(kodemk, selectedCourseBox.dataset.kelas);
}

function removeFromSheet(kodemk) {
  const bottomSheetTableBody = document.querySelector("#bottomSheetTable tbody");
  const rows = Array.from(bottomSheetTableBody.children);

  const rowToRemove = rows.find(row => row.dataset.kodemk === kodemk);
  if (rowToRemove) {
      bottomSheetTableBody.removeChild(rowToRemove);
  }

  const remainingRows = Array.from(bottomSheetTableBody.children).filter(row => row.dataset.kodemk);
  remainingRows.forEach((row, index) => {
      row.children[0].textContent = index + 1; // Update nomor urut
  });

  if (remainingRows.length === 0) {
      const emptyMessageRow = document.createElement("tr");
      emptyMessageRow.id = "emptyMessage";
      emptyMessageRow.innerHTML = `
          <td colspan="6" class="text-center text-gray-500">Tidak ada jadwal yang dipilih</td>
      `;
      bottomSheetTableBody.appendChild(emptyMessageRow);
  }

  // Kirim data terbaru ke backend
  saveBottomSheetData();
}


function getBottomSheetData() {
  const bottomSheetTableBody = document.querySelector("#bottomSheetTable tbody");

  // Ambil semua baris data yang ada di tabel
  const rows = Array.from(bottomSheetTableBody.children);

  // Ekstrak data dari setiap baris
  const data = rows
    .filter(row => row.dataset.kodemk) // Hanya ambil baris yang memiliki atribut dataset.kodemk
    .map(row => {
      const cells = row.querySelectorAll("td");
      return {
        kodemk: row.dataset.kodemk, // Ambil kode MK dari dataset
        kelas: cells[3].textContent.trim(), // Kolom kelas
      };
    });

  return data;
}

// Fungsi untuk menyimpan data secara real-time
function saveBottomSheetData() {
  const bottomSheetData = getBottomSheetData();

  fetch("/irs-detail/store", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({ bottomSheetData }),
  })
      .then(response => {
          if (response.ok) {
              return response.json();
          } else {
              return Promise.reject(response.json());
          }
      })
      .then(result => {
          console.log("Data berhasil disimpan:", result);
      })
      .catch(error => {
          console.error("Kesalahan saat menyimpan data:", error);
      });
}

// Fungsi untuk memantau perubahan pada tabel
function monitorBottomSheetTable() {
  const bottomSheetTable = document.querySelector("#bottomSheetTable tbody");

  // Tambahkan event listener untuk memantau perubahan pada tabel
  const observer = new MutationObserver(() => {
    console.log("Perubahan terdeteksi pada tabel.");
    saveBottomSheetData(); // Simpan data setiap ada perubahan
  });

  // Konfigurasikan observer untuk memantau perubahan pada child nodes
  observer.observe(bottomSheetTable, { childList: true, subtree: false });
}

// Panggil fungsi monitor saat halaman dimuat
document.addEventListener("DOMContentLoaded", monitorBottomSheetTable);

// function saveSelectedCourse(kodemk, kelas) {
//   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
//   fetch('/api/save-selected-course', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': csrfToken,
//     },
//     body: JSON.stringify({
//       kodemk: kodemk,
//       kelas: kelas,
//     }),
//   })
//   .then(response => {
//     if (!response.ok) {
//       console.error('Gagal menyimpan mata kuliah:', response.statusText);
//     }
//   })
//   .catch(error => console.error('Terjadi kesalahan:', error));
// }

// function saveSelectedSchedule(jadwal) {
//   fetch('/irs/store', {
//       method: 'POST',
//       headers: {
//           'Content-Type': 'application/json',
//           'X-CSRF-Token': csrfToken
//       },
//       body: JSON.stringify({
//           nim: "24060122130077",
//           semester: 5,
//           tahun_ajaran: "2023/2024",
//           total_sks: 0,
//           jadwal: jadwal // Mengirim data jadwal yang dipilih
//       })
//   })
//   .then(response => response.json())
//   .then(result => {
//       if (result.success) {
//           alert("Jadwal berhasil disimpan ke IRS.");
//       } else {
//           console.error("Gagal menyimpan jadwal:", result.error);
//           alert("Gagal menyimpan jadwal.");
//       }
//   })
//   .catch(error => console.error('Error saving schedule:', error));
// }

const bottomSheet = document.getElementById('bottomSheet');
const toggleButton = document.getElementById('toggleButton');
const content = document.getElementById('content');
const toggleIcon = document.getElementById('toggleIcon');
let isExpanded = false;

// Toggle Expand/Minimize
toggleButton.addEventListener('click', () => {
  isExpanded = !isExpanded;

  if (isExpanded) {
    bottomSheet.style.transform = 'translateY(0)'; // Expand
    content.classList.remove('hidden');
    toggleIcon.innerHTML = `&#x25BC;`; // Panah ke bawah
  } else {
    bottomSheet.style.transform = 'translateY(90%)'; // Minimize
    content.classList.add('hidden');
    toggleIcon.innerHTML = `&#x25B2;`; // Panah ke atas
  }
});

// // Fungsi untuk menambahkan jadwal yang dipilih ke server
// function addScheduleToIrs(kodemk, jadwalKuliahId) {
//   const irsId = document.getElementById('irsId').value; // Ambil ID IRS (hidden input)

//   // Kirim data ke server menggunakan fetch
//   fetch('/irs-detail/add', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF Token untuk keamanan
//     },
//     body: JSON.stringify({
//       irs_id: irsId,
//       kodemk: kodemk,
//       jadwal_kuliah_id: jadwalKuliahId,
//     }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         console.log('Jadwal berhasil dimasukkan ke IRS Detail:', data);
//       } else {
//         console.error('Gagal memasukkan jadwal ke IRS Detail:', data.error);
//       }
//     })
//     .catch((error) => {
//       console.error('Error:', error);
//     });
// }

// // Fungsi untuk menghapus jadwal dari IRS Detail
// function removeScheduleFromIrs(kodemk) {
//   const irsId = document.getElementById('irsId').value; // Ambil ID IRS

//   // Kirim data ke server untuk menghapus jadwal
//   fetch('/irs-detail/remove', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//     },
//     body: JSON.stringify({
//       irs_id: irsId,
//       kodemk: kodemk,
//     }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         console.log('Jadwal berhasil dihapus dari IRS Detail:', data);
//       } else {
//         console.error('Gagal menghapus jadwal dari IRS Detail:', data.error);
//       }
//     })
//     .catch((error) => {
//       console.error('Error:', error);
//     });
// }

// // Event onclick untuk pilihan jadwal
// document.querySelectorAll('.courseBox').forEach((courseBox) => {
//   courseBox.onclick = () => {
//     const kodemk = courseBox.dataset.kodemk;
//     const jadwalKuliahId = courseBox.dataset.jadwalKuliahId;

//     if (courseBox.classList.contains('selected')) {
//       removeScheduleFromIrs(kodemk); // Hapus jadwal
//       courseBox.classList.remove('selected');
//     } else {
//       addScheduleToIrs(kodemk, jadwalKuliahId); // Tambahkan jadwal
//       courseBox.classList.add('selected');
//     }
//   };
// });


