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

    // Tambahkan mata kuliah ke daftar
    const listItem = document.createElement("li");
    listItem.className = "course-item";
    listItem.textContent = `${kodemk} - ${nama} (${sks} SKS, Semester ${semester})`;

    // Tombol untuk menghapus mata kuliah dari daftar
    const removeBtn = document.createElement("span");
    removeBtn.className = "text-white bg-red-700 rounded-full text-xs px-2 py-1 ml-2";
    removeBtn.textContent = "X";
    removeBtn.onclick = function () {

      const selectedCourseBox = document.querySelector(`.courseBox-${kodemk}[style*="background-color: rgb(40, 167, 69)"]`); // Kotak yang sudah dipilih
    
      if (selectedCourseBox) {
          // Jika mata kuliah sudah dipilih, tampilkan modal konfirmasi
          const cancelModal = document.getElementById("cancelConfirmationModal");
          const confirmCancelButton = document.getElementById("confirmCancelButton");
          const cancelCancelButton = document.getElementById("cancelCancelButton");
          
          // Pastikan modal terlihat
          cancelModal.classList.remove("hidden");
          
          // Reset event listener sebelumnya
          confirmCancelButton.onclick = null;
          cancelCancelButton.onclick = null;
          
          // Tambahkan event listener untuk tombol "Ya" (konfirmasi)
          confirmCancelButton.onclick = () => {
              // Hapus elemen dari courseList
              courseList.removeChild(listItem);
          
              // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
              const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
              courseBoxes.forEach(box => box.remove());
          
              // Hapus dari selectedCourses
              selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
          
              // Hapus dari bottomSheetData
              bottomSheetData = bottomSheetData.filter(course => course.kodemk !== kodemk);
          
              // Perbarui tampilan bottom sheet
              updateBottomSheet();
          
              // Tutup modal
              cancelModal.classList.add("hidden");
                
          };
          
          // Tambahkan event listener untuk tombol "Batal"
          cancelCancelButton.onclick = () => {
              cancelModal.classList.add("hidden"); // Tutup modal tanpa perubahan
          };
      } else {
            // Jika belum dipilih, langsung hapus dari daftar
            courseList.removeChild(listItem);
          
            // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
            const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
            courseBoxes.forEach(box => box.remove());
          
            // Hapus dari selectedCourses
            selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
          
            // Hapus dari bottomSheetData
            bottomSheetData = bottomSheetData.filter(course => course.kodemk !== kodemk);
          
            // Perbarui tampilan bottom sheet
            updateBottomSheet();
            }
    };    

    listItem.appendChild(removeBtn);
    courseList.appendChild(listItem);
    
    courseSelect.value = "";

    await fetchAndDisplaySchedule(kodemk, nama);
  } catch (error) {
    console.error("Error parsing course data:", error);
  }
}


async function getMaxBebanSks() {
  try {
    const response = await fetch('/api/getMaxBebanSks'); // Endpoint backend untuk batas maksimal SKS
    if (!response.ok) {
      throw new Error('Gagal mendapatkan maksimal beban SKS.');
    }

    const data = await response.json();
    return data.maxBebanSks; // Pastikan backend mengembalikan key ini
  } catch (error) {
    console.error(error);
    return 21; // Default jika terjadi kesalahan
  }
}

async function fetchAndDisplaySchedule(kodemk, nama) {
  try {
    const response = await fetch(`/jadwal/${kodemk}`, { cache: "no-store" });
    console.log("Response object:", response);
    const jadwalList = await response.json();

    // Log seluruh data jadwal dari API
    console.log(`Jadwal list dari ${kodemk}:`, jadwalList);

    // Simpan jadwal ke selectedCourses
    selectedCourses = selectedCourses.map(course => {
      if (course.kodemk === kodemk) {
        return { ...course, jadwal: jadwalList }; // Tambahkan jadwal ke dalam course
      }
      return course;
    });

    function normalizeTimeToHour(waktu) {
      const [jam] = waktu.split(':').map(Number);
      return `${String(jam).padStart(2, '0')}:00`;
    }

    jadwalList.forEach(jadwal => {
      const { hari, waktu_mulai, waktu_selesai, kelas, ruang, mataKuliah, kodemk } = jadwal;

      // Gunakan data relasi mataKuliah
      const mataKuliahNama = mataKuliah?.nama || nama || "Tidak tersedia";

      console.log('Mata Kuliah:', mataKuliah);
      console.log('Mata Ruang:', ruang);

      // Normalisasi nama hari
      const normalizedDay = hari.charAt(0).toUpperCase() + hari.slice(1).toLowerCase();
      const dayColumn = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"].indexOf(normalizedDay);

      const startTime = normalizeTimeToHour(waktu_mulai);
      const row = document.querySelector(`#scheduleDisplay tbody tr[data-time="${startTime}"]`);

      if (row && dayColumn >= 0) {
        const cell = row.children[dayColumn + 1];

        // Tambahkan jadwal baru tanpa menghapus konten sebelumnya
        const wrapper = document.createElement("div");
        wrapper.className = "mb-2";

        const courseBox = document.createElement("div");
        courseBox.className = `
          bg-gray-100 text-black border border-gray-300 shadow-lg rounded-md p-2
          text-sm font-medium w-[180px] h-[120px] flex flex-col justify-between overflow-hidden
          courseBox-${kodemk}
        `;
        courseBox.style.cursor = "pointer";

        // Ambil nama ruang dari data jadwal
        const ruangNama = ruang?.nama || "Tidak tersedia";

        // Tambahkan atribut data
        courseBox.setAttribute("data-mataKuliah", mataKuliahNama);
        courseBox.setAttribute("data-kelas", kelas);
        courseBox.setAttribute("data-hari", hari);
        courseBox.setAttribute("data-jam", `${waktu_mulai} - ${waktu_selesai}`);
        courseBox.setAttribute("data-start-time", waktu_mulai);
        courseBox.setAttribute("data-end-time", waktu_selesai);
        courseBox.setAttribute("data-ruang-id", ruang?.id);

        // Tambahkan konten ke dalam courseBox
        courseBox.innerHTML = `
          <div class="font-bold text-gray-900 truncate">${mataKuliahNama}</div>
          <div class="text-xs text-gray-600 truncate">Kode: ${kodemk}</div>
          <div class="text-xs text-gray-600 truncate">Kelas: ${kelas}</div>
          <div class="text-xs text-gray-600 truncate">Ruang: ${ruangNama}</div>
          <div class="text-xs text-gray-600 truncate">${waktu_mulai} - ${waktu_selesai}</div>
        `;

        // Tambahkan event klik tanpa pengecekan
        courseBox.onclick = () => {
          showConfirmationModal(kodemk, courseBox);
        };

        // Masukkan courseBox ke dalam wrapper, lalu ke sel tabel
        wrapper.appendChild(courseBox);
        cell.appendChild(wrapper); // Append tanpa menghapus konten sebelumnya
      } else {
        console.warn(`Tidak dapat menemukan row atau cell untuk waktu: ${startTime} pada hari: ${hari}`);
      }
    });
  } catch (error) {
    console.error("Error fetching schedule for", kodemk, error);
  }
}


// Tempat penyimpanan sementara untuk jadwal yang dipilih
let selectedCourses = [];

function showConfirmationModal(kodemk, selectedCourseBox) {
  const modal = document.getElementById("confirmationModal");
  modal.classList.remove("hidden");

  const confirmButton = document.getElementById("confirmButton");
  const cancelButton = document.getElementById("cancelButton");

  confirmButton.onclick = null;
  cancelButton.onclick = null;

  confirmButton.onclick = () => {
    // Ambil informasi jadwal yang akan dipilih
    const hariBaru = selectedCourseBox.getAttribute("data-hari");
    const waktuMulaiBaru = selectedCourseBox.getAttribute("data-start-time");
    const waktuSelesaiBaru = selectedCourseBox.getAttribute("data-end-time");

    // Cek konflik dengan jadwal yang sudah dipilih
    const isConflict = selectedCourses.some(course => {
      const hariTerpilih = course.hari;
      const waktuMulaiTerpilih = course.jam.split(" - ")[0];
      const waktuSelesaiTerpilih = course.jam.split(" - ")[1];

      // Periksa apakah hari sama dan waktu bertabrakan
      return (
        hariBaru === hariTerpilih &&
        (waktuMulaiBaru < waktuSelesaiTerpilih && waktuSelesaiBaru > waktuMulaiTerpilih)
      );
    });

    if (isConflict) {
      // Ubah warna courseBox menjadi merah untuk menunjukkan konflik
      selectedCourseBox.style.backgroundColor = "#dc3545"; // Warna merah
      selectedCourseBox.classList.replace("text-black", "text-white");

      // Nonaktifkan klik pada elemen
      // selectedCourseBox.onclick = null;

      alert("Jadwal yang dipilih bertabrakan dengan jadwal lain.");
      modal.classList.add("hidden");
      return; // Batalkan pemilihan
    }

    // Jika tidak ada konflik, lanjutkan pemilihan
    if (selectedCourseBox.classList.contains("bg-gray-100")) {
      selectedCourseBox.style.backgroundColor = "#28a745"; // Warna hijau untuk jadwal terpilih
      selectedCourseBox.classList.replace("text-black", "text-white");

      const courseInfo = {
        kodemk,
        mataKuliah: selectedCourseBox.getAttribute("data-mataKuliah"),
        kelas: selectedCourseBox.getAttribute("data-kelas"),
        hari: selectedCourseBox.getAttribute("data-hari"),
        jam: `${waktuMulaiBaru} - ${waktuSelesaiBaru}`,
        sks: selectedCourseBox.getAttribute("data-sks"),
      };

      console.log("Info:", courseInfo);

      if (!courseInfo.mataKuliah || !courseInfo.kelas || !courseInfo.hari || !courseInfo.jam) {
        alert("Data jadwal tidak lengkap. Periksa elemen.");
        return;
      }

      selectedCourses.push(courseInfo);
      updateBottomSheet();
      calculateTotalSKS();

      const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
      similarCourseBoxes.forEach(box => {
        box.onclick = null;
        if (box !== selectedCourseBox) {
          box.style.backgroundColor = "#D1D5DB";
          box.classList.remove("text-black");
        }
      });

      selectedCourseBox.onclick = () => showCancelModal(kodemk, selectedCourseBox);
      console.log(`Mata kuliah ${kodemk} dipilih.`);
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
    // Hapus dari array
    selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
    updateBottomSheet();
    calculateTotalSKS(); // Hitung ulang total SKS
  
    // Mata kuliah dibatalkan, kembalikan warna dan aktifkan kembali klik
    selectedCourseBox.style.backgroundColor = ""; // Kembalikan ke warna semula
    selectedCourseBox.classList.replace("text-white", "text-black");
  
    const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
    similarCourseBoxes.forEach(box => {
      box.style.backgroundColor = ""; // Kembalikan ke warna semula
      box.classList.replace("text-white", "text-black");
      box.onclick = () => showConfirmationModal(kodemk, box); // Aktifkan kembali klik
    });
  
    // Tutup modal
    cancelModal.classList.add("hidden");
  };  

  cancelCancelButton.onclick = () => {
    cancelModal.classList.add("hidden");
  };
}

let totalSKS = 0;

function calculateTotalSKS() {
  // Hitung total SKS dari selectedCourses
  totalSKS = selectedCourses.reduce((total, course) => {
    const sks = parseInt(course.sks, 10) || 0; // Pastikan SKS berupa angka
    return total + sks;
  }, 0);

  console.log(`Total SKS saat ini: ${totalSKS}`);

  // Perbarui tampilan total SKS di UI
  const totalSKSElement = document.getElementById("totalsks");
  if (totalSKSElement) {
    totalSKSElement.textContent = totalSKS;
  }
}

let bottomSheetData = []; // Variabel untuk menyimpan data bottomSheet

// Fungsi untuk memperbarui konten bottom sheet
function updateBottomSheet() {
  const bottomSheetTable = document.getElementById("bottomSheetTable").querySelector("tbody");
  bottomSheetTable.innerHTML = ""; // Hapus konten sebelumnya

  if (selectedCourses.length === 0) {
    // Tampilkan pesan kosong jika tidak ada jadwal yang dipilih
    bottomSheetTable.innerHTML = `
      <tr>
        <td colspan="6" class="text-center text-gray-500">Belum ada jadwal yang dipilih.</td>
      </tr>
    `;
    return;
  }

  // Kosongkan bottomSheetData sebelum diperbarui
  bottomSheetData = [];

  // Tambahkan jadwal yang dipilih ke tabel dan update bottomSheetData
  selectedCourses.forEach((course, index) => {

    bottomSheetTable.innerHTML += `
      <tr>
        <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
        <td class="border border-gray-300 px-4 py-2">${course.kodemk}</td>
        <td class="border border-gray-300 px-4 py-2">${course.mataKuliah}</td>
        <td class="border border-gray-300 px-4 py-2">${course.kelas}</td>
        <td class="border border-gray-300 px-4 py-2">${course.hari}</td>
        <td class="border border-gray-300 px-4 py-2">${course.jam}</td>
      </tr>
    `;

    // Update data array
    bottomSheetData.push({
      kodemk: course.kodemk,
      kelas: course.kelas,
    });
  });

  // Debug isi bottomSheetData
  console.log("Data yang terkumpul di bottomSheetData:", bottomSheetData);

  // Kirim data terbaru secara otomatis
  sendBottomSheetData();
}

// Fungsi untuk mengirim data ke backend
function sendBottomSheetData() {
  if (bottomSheetData.length === 0) {
    console.log("Tidak ada data untuk dikirim.");
    return;
  }

  console.log("Mengirim data ke backend:", bottomSheetData);

  fetch("/irs-detail/store", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    },
    body: JSON.stringify({ bottomSheetData }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Respon dari server:", data);
      alert(data.message || "Data berhasil dikirim.");
    })
    .catch((error) => {
      console.error("Terjadi kesalahan saat mengirim data:", error);
      alert("Terjadi kesalahan saat mengirim data.");
    });
}

// Event untuk toggle bottom sheet
document.addEventListener("DOMContentLoaded", () => {
  // Tombol untuk menambahkan mata kuliah
  document.querySelector("#addCourseButton").addEventListener("click", function () {
    // Ambil data dari form input
    const kodemk = document.querySelector("#kodemk").value.trim();
    const nama = document.querySelector("#nama").value.trim();
    const sks = parseInt(document.querySelector("#sks").value);

    // Validasi data input
    if (!kodemk || !nama || isNaN(sks) || sks <= 0) {
      alert("Harap isi semua kolom dengan benar.");
      return;
    }

    // Data mata kuliah yang akan dikirim
    const mataKuliahData = [{ kodemk, nama, sks }];

    // Ambil semester saat ini dari dropdown (contoh elemen HTML lain)
    const currentSemester = document.querySelector("#currentSemester")?.value || 1;

    // Kirim data ke server menggunakan Fetch API
    fetch("/updatetotalsks", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
      body: JSON.stringify({ mataKuliahData, semester: currentSemester }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.message === "Total SKS berhasil diperbarui") {
          // Update total SKS pada tampilan
          document.getElementById("total_sks").innerText = data.total_sks;

          // Reset form input
          document.querySelector("#mataKuliahForm").reset();
        } else {
          alert(data.message || "Gagal menambahkan mata kuliah.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Terjadi kesalahan. Silakan coba lagi.");
      });
  });
});



