// async function addCourse() {
//   const courseSelect = document.getElementById("courses");
//   const courseList = document.getElementById("courseList");
//   const selectedCourse = courseSelect.value;

//   if (!selectedCourse) return;

//   try {
//     const courseData = JSON.parse(selectedCourse); 
//     const { kodemk, nama, sks, semester } = courseData;

//     // Cek apakah mata kuliah sudah ada di daftar
//     const existingCourses = Array.from(courseList.children).map(item => {
//       return item.textContent.split(" - ")[0].trim(); 
//     });

//     if (existingCourses.includes(kodemk)) {
//       alert("Mata kuliah sudah ada di daftar.");
//       return;
//     }

//     // Tambahkanroute ke daftar mata kuliah yang dipilih
//     const listItem = document.createElement("li");
//     listItem.className = "course-item";
//     listItem.textContent = `${kodemk} - ${nama} (${sks} SKS, Semester ${semester})`;
    
//     // Tombol untuk menghapus mata kuliah dari daftar
//     const removeBtn = document.createElement("span");
//     removeBtn.className = "text-white bg-red-700 rounded-full text-xs px-2 py-1 ml-2";
//     removeBtn.textContent = "X";
//     removeBtn.onclick = function () {
//       const selectedCourseBox = document.querySelector(`.courseBox-${kodemk}[style*="background-color: rgb(40, 167, 69)"]`); // Kotak yang sudah dipilih
    
//       if (selectedCourseBox) {
//         // Jika mata kuliah sudah dipilih, tampilkan modal konfirmasi
//         const cancelModal = document.getElementById("cancelConfirmationModal");
//         const confirmCancelButton = document.getElementById("confirmCancelButton");
//         const cancelCancelButton = document.getElementById("cancelCancelButton");
    
//         // Pastikan modal terlihat
//         cancelModal.classList.remove("hidden");
    
//         // Reset event listener sebelumnya
//         confirmCancelButton.onclick = null;
//         cancelCancelButton.onclick = null;
    
//         // Tambahkan event listener untuk tombol "Ya" (konfirmasi)
//         confirmCancelButton.onclick = () => {
//           // Hapus elemen dari courseList
//           courseList.removeChild(listItem);
    
//           // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
//           const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
//           courseBoxes.forEach(box => box.remove());
    
//           // Hapus dari selectedCourses
//           selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
    
//           // Hapus dari bottomSheetData
//           bottomSheetData = bottomSheetData.filter(course => course.kodemk !== kodemk);
    
//           // Perbarui tampilan bottom sheet
//           updateBottomSheet();
    
//           // Tutup modal
//           cancelModal.classList.add("hidden");
          
//         };
    
//         // Tambahkan event listener untuk tombol "Batal"
//         cancelCancelButton.onclick = () => {
//           cancelModal.classList.add("hidden"); // Tutup modal tanpa perubahan
//         };
//       } else {
//         // Jika belum dipilih, langsung hapus dari daftar
//         courseList.removeChild(listItem);
    
//         // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
//         const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
//         courseBoxes.forEach(box => box.remove());
    
//         // Hapus dari selectedCourses
//         selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
    
//         // Hapus dari bottomSheetData
//         bottomSheetData = bottomSheetData.filter(course => course.kodemk !== kodemk);
    
//         // Perbarui tampilan bottom sheet
//         updateBottomSheet();
//       }
//     };    

//   listItem.appendChild(removeBtn);
//   courseList.appendChild(listItem);

//   courseSelect.value = "";

//     await fetchAndDisplaySchedule(kodemk, nama);
//     updateScheduleConflicts();
//   } catch (error) {
//     console.error("Error parsing course data:", error);
//   }
// }

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

    // Hitung total SKS yang sudah dipilih
    let totalSKS = Array.from(courseList.children).reduce((sum, item) => {
      const sksMatch = item.textContent.match(/\((\d+) SKS/); // Ambil SKS dari teks
      const sksValue = sksMatch ? parseInt(sksMatch[1], 10) : 0;
      return sum + sksValue;
    }, 0);

    // Tentukan maksimal beban SKS (gunakan fungsi backend)
    const maxBebanSks = await getMaxBebanSks();

    // Tambahkan SKS mata kuliah yang dipilih
    const newTotalSKS = totalSKS + sks;

    // Cek apakah total SKS melebihi batas maksimal
    if (newTotalSKS > maxBebanSks) {
      alert(`Total SKS melebihi batas maksimal (${maxBebanSks} SKS). Anda tidak dapat menambahkan mata kuliah ini.`);
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

              updateTotalSKS();
          
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

            updateTotalSKS(); // Perbarui total SKS setelah penghapusan
          
            // Perbarui tampilan bottom sheet
            updateBottomSheet();
            }
    };    

    listItem.appendChild(removeBtn);
    courseList.appendChild(listItem);
    
    // Perbarui total SKS
    updateTotalSKS();
    console.log("Daftar mata kuliah saat ini:", Array.from(courseList.children));

    courseSelect.value = "";

    await fetchAndDisplaySchedule(kodemk, nama);
    updateScheduleConflicts();
  } catch (error) {
    console.error("Error parsing course data:", error);
  }
}

function updateTotalSKS() {
  const courseList = document.getElementById("courseList");

  if (!courseList) {
    console.error("Error: Elemen #courseList tidak ditemukan.");
    return;
  }

  // Hitung total SKS dari setiap item di courseList
  const totalSKS = Array.from(courseList.children).reduce((sum, item) => {
    const sksMatch = item.textContent.match(/\((\d+) SKS/); // Cari SKS dari teks
    const sksValue = sksMatch ? parseInt(sksMatch[1], 10) : 0;
    return sum + sksValue;
  }, 0);

  // Update elemen total SKS pada HTML
  const totalSKSElement = document.getElementById("totalSKS");
  if (!totalSKSElement) {
    console.error("Error: Elemen #totalSKS tidak ditemukan.");
    return;
  }

  totalSKSElement.textContent = totalSKS;

  // Update ikon toggle dengan total SKS
  const toggleIcon = document.getElementById("toggleIcon");
  if (!toggleIcon) {
    console.error("Error: Elemen #toggleIcon tidak ditemukan.");
    return;
  }

  toggleIcon.innerHTML = `${totalSKS} SKS`; // Tampilkan total SKS di ikon

  console.log("Total SKS saat ini:", totalSKS);
  
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
    const jadwalList = await response.json();

    // Log seluruh data jadwal dari API
    console.log(`Jadwal untuk ${kodemk}:`, jadwalList);

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

    function isTimeConflict(newStart, newEnd, existingStart, existingEnd) {
      const [startA, endA] = [newStart, newEnd].map(time => new Date(`1970-01-01T${time}:00Z`));
      const [startB, endB] = [existingStart, existingEnd].map(time => new Date(`1970-01-01T${time}:00Z`));
      return (startA < endB && endA > startB);
    }

    jadwalList.forEach(jadwal => {
      const { hari, waktu_mulai, waktu_selesai, kelas, ruang_id } = jadwal;

      const normalizedDay = hari.charAt(0).toUpperCase() + hari.slice(1).toLowerCase();
      const dayColumn = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"].indexOf(normalizedDay);

      const startTime = normalizeTimeToHour(waktu_mulai);
      const row = document.querySelector(`#scheduleDisplay tbody tr[data-time="${startTime}"]`);

      if (row && dayColumn >= 0) {
        const cell = row.children[dayColumn + 1];

        // Bersihkan cell terlebih dahulu untuk menghindari duplikasi
        cell.innerHTML = "";

        const wrapper = document.createElement("div");
        wrapper.className = "mb-2";

        const courseBox = document.createElement("div");
        courseBox.className = `
          bg-gray-100 text-black border border-gray-300 shadow-lg rounded-md p-2
          text-sm font-medium w-[180px] h-[120px] flex flex-col justify-between overflow-hidden
          courseBox-${kodemk}
        `;
        courseBox.style.cursor = "pointer";
        
        // Tambahkan atribut data
        courseBox.setAttribute("data-mataKuliah", nama);
        courseBox.setAttribute("data-kelas", kelas);
        courseBox.setAttribute("data-hari", hari);
        courseBox.setAttribute("data-jam", `${waktu_mulai} - ${waktu_selesai}`);
        courseBox.setAttribute("data-start-time", waktu_mulai);
        courseBox.setAttribute("data-end-time", waktu_selesai);

        // Tambahkan konten ke dalam courseBox
        courseBox.innerHTML = `
          <div class="font-bold text-gray-900 truncate">${nama}</div>
          <div class="text-xs text-gray-600 truncate">Kode: ${kodemk}</div>
          <div class="text-xs text-gray-600 truncate">Kelas: ${kelas}</div>
          <div class="text-xs text-gray-600 truncate">Ruang: ${ruang_id}</div>
          <div class="text-xs text-gray-600 truncate">${waktu_mulai} - ${waktu_selesai}</div>
        `;  

        // Tambahkan event klik dengan pengecekan tabrakan jadwal
        courseBox.onclick = () => {
          if (!checkForTimeConflict(waktu_mulai, waktu_selesai, hari)) {
            showConfirmationModal(kodemk, courseBox);
          } else {
            courseBox.style.backgroundColor = "#FF4D4F"; // Warna merah untuk indikasi tabrakan
            alert("Jadwal ini bertabrakan dengan jadwal lain.");
          }
        };

        // Masukkan courseBox ke dalam wrapper, lalu ke sel tabel
        wrapper.appendChild(courseBox);
        cell.appendChild(wrapper);

        console.log("Menambahkan courseBox:", {
          kodemk,
          nama,
          kelas,
          hari,
          ruang_id,
          waktu_mulai,
          waktu_selesai,
        });
      } else {
        console.warn(`Tidak dapat menemukan row atau cell untuk waktu: ${startTime} pada hari: ${hari}`);
      }
    });
  } catch (error) {
    console.error("Error fetching schedule for", kodemk, error);
  }
}


function isTimeConflict(newStart, newEnd, existingStart, existingEnd, minGapMinutes = 0) {
  const parseTime = time => {
    const [hour, minute] = time.split(":").map(Number);
    return hour * 60 + minute; // Waktu dalam menit
  };

  const newStartMinutes = parseTime(newStart);
  const newEndMinutes = parseTime(newEnd);
  const existingStartMinutes = parseTime(existingStart);
  const existingEndMinutes = parseTime(existingEnd);

  // Periksa jika ada overlap
  const overlap = 
    (newStartMinutes < existingEndMinutes + minGapMinutes && newEndMinutes > existingStartMinutes - minGapMinutes);

  return overlap;
}

function checkForTimeConflict(newStart, newEnd, newDay, excludeKodemk = null, minGapMinutes = 10) {
  // Periksa apakah ada konflik dengan semua jadwal yang dipilih
  return selectedCourses.some(course =>
    course.kodemk !== excludeKodemk && // Abaikan jadwal yang sedang diproses
    course.hari === newDay && // Hari harus sama
    isTimeConflict(newStart, newEnd, course.jam.split(" - ")[0], course.jam.split(" - ")[1], minGapMinutes) // Waktu harus bertabrakan
  );
}

function updateScheduleConflicts() {
  const allCourseBoxes = document.querySelectorAll(".courseBox"); // Ambil semua jadwal dari tabel

  allCourseBoxes.forEach(box => {
    const kodemk = box.className.match(/courseBox-([\w]+)/)[1]; // Ambil kode mata kuliah
    const waktuMulai = box.getAttribute("data-start-time");
    const waktuSelesai = box.getAttribute("data-end-time");
    const hari = box.getAttribute("data-hari");

    // Periksa apakah jadwal ini sedang dipilih
    const isSelected = selectedCourses.some(course => course.kodemk === kodemk);

    // Periksa apakah ada konflik dengan jadwal yang dipilih
    const isConflict = selectedCourses.some(course =>
      course.hari === hari && // Hari harus sama
      isTimeConflict(waktuMulai, waktuSelesai, course.jam.split(" - ")[0], course.jam.split(" - ")[1]) &&
      course.kodemk !== kodemk // Abaikan jadwal dengan kode MK yang sama
    );

    if (isSelected) {
      // Jadwal sudah dipilih
      box.style.backgroundColor = "#B8E986"; // Warna hijau untuk jadwal yang dipilih
      box.classList.remove("conflict"); // Hapus status konflik
      box.onclick = null; // Nonaktifkan klik pada jadwal yang sudah dipilih
    } else if (isConflict || checkGlobalConflict(kodemk, waktuMulai, waktuSelesai, hari)) {
      // Tunjukkan konflik (merah) dan nonaktifkan klik
      box.style.backgroundColor = "#FF4D4F"; // Warna merah untuk indikasi konflik
      box.classList.add("conflict"); // Tambahkan class untuk identifikasi konflik
      box.onclick = null; // Nonaktifkan klik pada jadwal konflik
    } else {
      // Reset ke warna default jika tidak ada konflik
      box.style.backgroundColor = ""; // Kembalikan ke warna default
      box.classList.remove("conflict"); // Hapus status konflik
      box.onclick = () => showConfirmationModal(kodemk, box); // Aktifkan kembali klik
    }
  });
}

function checkGlobalConflict(kodemk, waktuMulai, waktuSelesai, hari) {
  // Periksa jika ada jadwal lain yang memicu konflik
  return selectedCourses.some(course =>
    course.hari === hari && // Hari sama
    isTimeConflict(waktuMulai, waktuSelesai, course.jam.split(" - ")[0], course.jam.split(" - ")[1]) &&
    course.kodemk !== kodemk // Abaikan jadwal dengan kode MK yang sama
  );
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
    if (selectedCourseBox.classList.contains("bg-gray-100")) {
      selectedCourseBox.style.backgroundColor = "#28a745";
      selectedCourseBox.classList.replace("text-black", "text-white");
  
      const courseInfo = {
        kodemk,
        mataKuliah: selectedCourseBox.getAttribute("data-mataKuliah"),
        kelas: selectedCourseBox.getAttribute("data-kelas"),
        hari: selectedCourseBox.getAttribute("data-hari"),
        jam: selectedCourseBox.getAttribute("data-jam"),
      };
  
      if (!courseInfo.mataKuliah || !courseInfo.kelas || !courseInfo.hari || !courseInfo.jam) {
        alert("Data jadwal tidak lengkap. Periksa elemen.");
        return;
      }
  
      selectedCourses.push(courseInfo);
      updateBottomSheet();
  
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
    // Perbarui konflik jadwal
    updateScheduleConflicts();
  
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
document.getElementById("toggleButton").onclick = () => {
  const bottomSheet = document.getElementById("bottomSheet");
  const content = document.getElementById("content");

  if (bottomSheet.classList.contains("translate-y-full")) {
    bottomSheet.classList.remove("translate-y-full");
    bottomSheet.classList.add("translate-y-0");
    content.classList.remove("hidden");
  } else {
    bottomSheet.classList.add("translate-y-full");
    bottomSheet.classList.remove("translate-y-0");
    content.classList.add("hidden");
  }
};

document.addEventListener("DOMContentLoaded", () => {
  const bottomSheet = document.getElementById("bottomSheet");
  const toggleButton = document.getElementById("toggleButton");
  const toggleIcon = document.getElementById("toggleIcon");
  const content = document.getElementById("content");

  let isExpanded = false; // Status awal collapsed

  toggleButton.addEventListener("click", () => {
    if (isExpanded) {
      // Collapse
      bottomSheet.classList.remove("expand");
      content.classList.add("hidden");
    } else {
      // Expand
      bottomSheet.classList.add("expand");
      content.classList.remove("hidden");
    }

    isExpanded = !isExpanded; // Toggle status
  });
});

document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM sepenuhnya dimuat. Elemen tersedia.");
});