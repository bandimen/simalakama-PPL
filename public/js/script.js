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

    // Tambahkanroute ke daftar mata kuliah yang dipilih
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
    
          // Simpan perubahan
          saveProgress();
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
    
        // Simpan perubahan
        saveProgress();
      }
    };    

    listItem.appendChild(removeBtn);
    courseList.appendChild(listItem);

    courseSelect.value = "";

    await fetchAndDisplaySchedule(kodemk, nama);
    updateScheduleConflicts();
  } catch (error) {
    console.error("Error parsing course data:", error);
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
      const { hari, waktu_mulai, waktu_selesai, kelas, ruang_id, tahun_ajaran } = jadwal;

      // Log data tahun_ajaran untuk setiap jadwal
      console.log(`Processing jadwal untuk ${kodemk}, Tahun Ajaran: ${tahun_ajaran}, Hari: ${hari}, Jam: ${waktu_mulai} - ${waktu_selesai}`);

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
        courseBox.setAttribute("data-tahunajaran", tahun_ajaran); // Tambahkan atribut tahun ajaran

        // Tambahkan konten ke dalam courseBox
        courseBox.innerHTML = `
          <div class="font-bold text-gray-900 truncate">${nama}</div>
          <div class="text-xs text-gray-600 truncate">Kode: ${kodemk}</div>
          <div class="text-xs text-gray-600 truncate">Kelas: ${kelas}</div>
          <div class="text-xs text-gray-600 truncate">Ruang: ${ruang_id}</div>
          <div class="text-xs text-gray-600 truncate">${waktu_mulai} - ${waktu_selesai}</div>
          <div class="text-xs text-gray-600 truncate">Tahun Ajaran: ${tahun_ajaran}</div> <!-- Tambahkan tahun ajaran di konten -->
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
          tahun_ajaran
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
  for (const course of selectedCourses) {
    if (
      course.kodemk !== excludeKodemk && // Abaikan jadwal yang sedang dihapus
      course.hari === newDay && 
      isTimeConflict(newStart, newEnd, course.jam.split(" - ")[0], course.jam.split(" - ")[1], minGapMinutes)
    ) {
      return true; // Ada tabrakan
    }
  }
  return false; // Tidak ada tabrakan
}

function updateScheduleConflicts() {
  const allCourseBoxes = document.querySelectorAll(".courseBox"); // Semua jadwal di tabel

  allCourseBoxes.forEach(box => {
    const kodemk = box.className.match(/courseBox-([\w]+)/)[1]; // Ambil kode mata kuliah
    const waktuMulai = box.getAttribute("data-start-time");
    const waktuSelesai = box.getAttribute("data-end-time");
    const hari = box.getAttribute("data-hari");

    // Periksa apakah ada konflik dengan semua jadwal yang dipilih
    const isConflict = selectedCourses.some(course =>
      course.hari === hari && // Hari harus sama
      isTimeConflict(waktuMulai, waktuSelesai, course.jam.split(" - ")[0], course.jam.split(" - ")[1])
    );

    if (isConflict) {
      // Tunjukkan konflik (merah) dan nonaktifkan klik
      box.style.backgroundColor = "#FF4D4F"; // Warna merah untuk indikasi konflik
      box.classList.add("conflict"); // Tambahkan class untuk identifikasi konflik
      box.onclick = null; // Nonaktifkan klik pada jadwal konflik
    } else {
      // Jika tidak ada konflik, reset warna
      box.style.backgroundColor = ""; // Kembalikan ke warna default
      box.classList.remove("conflict"); // Hapus status konflik

      // Aktifkan kembali klik jika jadwal tidak dipilih
      const isSelected = selectedCourses.some(course => course.kodemk === kodemk);
      if (!isSelected) {
        box.onclick = () => showConfirmationModal(kodemk, box);
      }
    }
  });
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
        tahunajaran: selectedCourseBox.getAttribute("data-tahunajaran"),
      };
  
      if (!courseInfo.mataKuliah || !courseInfo.kelas || !courseInfo.hari || !courseInfo.jam  ||  !courseInfo.tahunajaran) {
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
          box.classList.replace("text-black");
        }
      });
  
      selectedCourseBox.onclick = () => showCancelModal(kodemk, selectedCourseBox);
      console.log(`Mata kuliah ${kodemk} dipilih.`);
  
      // Perbarui konflik jadwal
      updateScheduleConflicts();
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
  
    // Mata kuliah dibatalkan, kembalikan warna dan aktifkan kembali klik
    selectedCourseBox.style.backgroundColor = ""; // Kembalikan ke warna semula
    selectedCourseBox.classList.replace("text-white", "text-black");
  
    const similarCourseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
    similarCourseBoxes.forEach(box => {
      box.style.backgroundColor = ""; // Kembalikan ke warna semula
      box.classList.replace("text-white", "text-black");
      box.onclick = () => showConfirmationModal(kodemk, box); // Aktifkan kembali klik
    });
  
    // Perbarui konflik jadwal
    updateScheduleConflicts();
  
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
    // Log tahun ajaran dari setiap entri jadwal
    console.log(`Tahun Ajaran untuk ${course.kodemk}: ${course.jadwal?.map(j => j.tahun_ajaran).join(", ")}`);

    bottomSheetTable.innerHTML += `
      <tr>
        <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
        <td class="border border-gray-300 px-4 py-2">${course.kodemk}</td>
        <td class="border border-gray-300 px-4 py-2">${course.mataKuliah}</td>
        <td class="border border-gray-300 px-4 py-2">${course.kelas}</td>
        <td class="border border-gray-300 px-4 py-2">${course.hari}</td>
        <td class="border border-gray-300 px-4 py-2">${course.jam}</td>
        <td class="border border-gray-300 px-4 py-2">${course.tahunajaran}</td>
      </tr>
    `;

    // Update data array
    bottomSheetData.push({
      kodemk: course.kodemk,
      kelas: course.kelas,
      tahun_ajaran: course.jadwal?.map(j => j.tahun_ajaran), // Tambahkan tahun ajaran ke data
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


// async function saveProgress() {
//   try {
//     const progressData = {
//       bottomSheetData, // Data yang akan disimpan ke backend
//     };

//     await fetch("/irs-detail/store", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//       },
//       body: JSON.stringify(progressData),
//     });

//     console.log("Progress saved successfully");
//   } catch (error) {
//     console.error("Failed to save progress:", error);
//   }
// }

// async function loadProgress() {
//   try {
//     const response = await fetch("/irs-detail/load", {
//       method: "GET",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//       },
//     });

//     if (response.ok) {
//       const progressData = await response.json();
//       bottomSheetData = progressData.bottomSheetData || [];

//       // Render ulang data ke tampilan
//       bottomSheetData.forEach((data) => {
//         selectedCourses.push({
//           kodemk: data.kodemk,
//           mataKuliah: data.mataKuliah,
//           kelas: data.kelas,
//           hari: data.hari,
//           jam: data.jam,
//         });

//         // Tambahkan ke bottom sheet dan jadwal
//         updateBottomSheet();
//         fetchAndDisplaySchedule(data.kodemk, data.mataKuliah);
//       });
//     } else {
//       console.warn("No progress found for the current student.");
//     }
//   } catch (error) {
//     console.error("Failed to load progress:", error);
//   }
// }

// document.addEventListener("DOMContentLoaded", () => {
//   loadProgress();
// });

// async function saveProgress() {
//   try {
//     const progressData = {
//       courseList: Array.from(courseList.children).map(item => item.textContent),
//       selectedCourses,
//       bottomSheetData,
//     };

//     // Simpan ke localStorage sebagai cadangan sementara
//     localStorage.setItem("irsProgress", JSON.stringify(progressData));

//     // Kirim progres ke backend untuk penyimpanan permanen
//     await fetch("/irs-progress/save", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//       },
//       body: JSON.stringify(progressData),
//     });
//     console.log("Progress saved successfully");
//   } catch (error) {
//     console.error("Failed to save progress:", error);
//   }
// }

// async function loadProgress() {
//   try {
//     // Coba ambil progres dari backend
//     const response = await fetch("/irs-progress/load", {
//       method: "GET",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//       },
//     });

//     if (response.ok) {
//       const progressData = await response.json();

//       // Pulihkan data ke tampilan
//       restoreCourseList(progressData.courseList);
//       selectedCourses = progressData.selectedCourses || [];
//       bottomSheetData = progressData.bottomSheetData || [];

//       // Muat ulang jadwal untuk setiap mata kuliah yang dipilih
//       for (const course of selectedCourses) {
//         if (course.kodemk && course.jadwal) {
//           course.jadwal.forEach(jadwal => {
//             // Render jadwal ke tabel berdasarkan data
//             renderSchedule(course.kodemk, course.nama, jadwal);
//           });
//         } else if (course.kodemk) {
//           // Jika jadwal tidak ditemukan, fetch ulang
//           await fetchAndDisplaySchedule(course.kodemk, course.nama);
//         }
//       }

//       updateBottomSheet();
//       updateScheduleConflicts();
//     } else {
//       console.warn("No progress found on server. Falling back to localStorage.");
//       // Jika backend gagal, coba dari localStorage
//       const localProgress = localStorage.getItem("irsProgress");
//       if (localProgress) {
//         const progressData = JSON.parse(localProgress);
//         restoreCourseList(progressData.courseList);
//         selectedCourses = progressData.selectedCourses || [];
//         bottomSheetData = progressData.bottomSheetData || [];
//         updateBottomSheet();
//         updateScheduleConflicts();
//       }
//     }
//   } catch (error) {
//     console.error("Failed to load progress:", error);
//   }
// }

// // Fungsi untuk memulihkan daftar courseList
// function restoreCourseList(courseListData) {
//   courseList.innerHTML = ""; // Hapus daftar sebelumnya

//   courseListData.forEach(itemText => {
//     const listItem = document.createElement("li");
//     listItem.className = "course-item";
//     listItem.textContent = itemText;

//     // Tombol X untuk menghapus item
//     const removeBtn = document.createElement("span");
//     removeBtn.className = "text-white bg-red-700 rounded-full text-xs px-2 py-1 ml-2";
//     removeBtn.textContent = "X";

//     removeBtn.onclick = function () {
//       // Ambil kode mata kuliah dari teks item
//       const kodemk = itemText.split(" - ")[0].trim();

//       // Cek apakah ada data terkait di selectedCourses
//       const courseIndex = selectedCourses.findIndex(course => course.kodemk === kodemk);

//       if (courseIndex !== -1) {
//         // Jika ada data terkait, tampilkan modal konfirmasi
//         showCancelModal(kodemk, listItem);
//       } else {
//         // Jika tidak ada data terkait, langsung hapus dari daftar
//         courseList.removeChild(listItem);
//         saveProgress(); // Simpan progres setelah penghapusan
//       }
//     };

//     listItem.appendChild(removeBtn);
//     courseList.appendChild(listItem);
//   });
// }

// document.addEventListener("DOMContentLoaded", () => {
//   loadProgress();
// });

// window.addEventListener("beforeunload", saveProgress); // Simpan otomatis saat keluar halaman

// async function loadCancellationProgress() {
//   try {
//     const response = await fetch("/irs-progress/load", {
//       method: "GET",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//       },
//     });

//     if (response.ok) {
//       const progress = await response.json();
//       const bottomSheetData = progress?.bottomSheetData || [];

//       // Perbarui tabel cancellation dengan data bottomSheetData
//       updateCancellationTable(bottomSheetData);
//     } else {
//       console.warn("Failed to load progress data from server.");
//       updateCancellationTable([]);
//     }
//   } catch (error) {
//     console.error("Failed to load cancellation progress:", error);
//   }
// }

// function updateCancellationTable(data) {
//   console.log("Data received for table update:", data);
//   const cancellationTableBody = document.getElementById("cancellationTableBodyContent");
//   if (!cancellationTableBody) {
//     console.error("Element cancellationTableBodyContent not found!");
//     return;
//   }

//   cancellationTableBody.innerHTML = ""; // Kosongkan tabel sebelum menambahkan data baru

//   if (!data || data.length === 0) {
//     cancellationTableBody.innerHTML = `
//       <tr>
//         <td colspan="7" class="text-center text-gray-500">Belum ada jadwal yang dipilih untuk pembatalan.</td>
//       </tr>
//     `;
//     return;
//   }

//   data.forEach((item, index) => {
//     console.log("Adding row:", item);
//     cancellationTableBody.innerHTML += `
//       <tr>
//         <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
//         <td class="border border-gray-300 px-4 py-2">${item.kodemk}</td>
//         <td class="border border-gray-300 px-4 py-2">${item.mataKuliah || "-"}</td>
//         <td class="border border-gray-300 px-4 py-2">${item.kelas || "-"}</td>
//         <td class="border border-gray-300 px-4 py-2">${item.hari || "-"}</td>
//         <td class="border border-gray-300 px-4 py-2">${item.jam || "-"}</td>
//         <td class="border border-gray-300 px-4 py-2">
//           <button class="text-red-500 hover:underline" onclick="removeCancellation(${index})">Batalkan</button>
//         </td>
//       </tr>
//     `;
//   });
// }


// document.addEventListener("DOMContentLoaded", loadCancellationProgress);



// function updateCancellationTable() {
//   const tableBody = document.getElementById("cancellationTableBody");
//   tableBody.innerHTML = ""; // Bersihkan konten tabel

//   if (bottomSheetData.length === 0) {
//       // Tampilkan pesan jika tidak ada data
//       tableBody.innerHTML = `
//           <tr>
//               <td colspan="7" class="text-center text-gray-500">Tidak ada mata kuliah yang diambil untuk dibatalkan.</td>
//           </tr>
//       `;
//       return;
//   }

//   // Iterasi data dari bottomSheetData
//   bottomSheetData.forEach((course, index) => {
//       const row = document.createElement("tr");
//       row.innerHTML = `
//           <td class="px-2 py-2 border border-gray-300">${index + 1}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.kodemk}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.mataKuliah || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.kelas || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.hari || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.jam || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">
//               <button 
//                   class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
//                   onclick="showCancelModal('${course.kodemk}')"
//               >
//                   Batal
//               </button>
//           </td>
//       `;
//       tableBody.appendChild(row);
//   });
// }

// function updateCancellationTable() {
//   const tableBody = document.getElementById("cancellationTableBody");
//   tableBody.innerHTML = ""; // Bersihkan konten tabel

//   if (bottomSheetData.length === 0) {
//       // Tampilkan pesan jika tidak ada data
//       tableBody.innerHTML = `
//           <tr>
//               <td colspan="7" class="text-center text-gray-500">Tidak ada mata kuliah yang diambil untuk dibatalkan.</td>
//           </tr>
//       `;
//       return;
//   }

//   // Iterasi data dari bottomSheetData
//   bottomSheetData.forEach((course, index) => {
//       const row = document.createElement("tr");
//       row.innerHTML = `
//           <td class="px-2 py-2 border border-gray-300">${index + 1}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.kodemk}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.mataKuliah || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.kelas || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.hari || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">${course.jam || "N/A"}</td>
//           <td class="px-2 py-2 border border-gray-300">
//               <button 
//                   class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
//                   onclick="showCancelModal('${course.kodemk}')"
//               >
//                   Batal
//               </button>
//           </td>
//       `;
//       tableBody.appendChild(row);
//   });
// }

// document.addEventListener("DOMContentLoaded", () => {
//   // Panggil fungsi untuk memperbarui tabel pembatalan
//   updateCancellationTable();
// });


// // Fungsi untuk menyimpan progres
// function saveProgress() {
//   const courseBoxes = Array.from(document.querySelectorAll("[data-mataKuliah]"));
//   const courseBoxData = courseBoxes.map(box => ({
//     kodemk: box.getAttribute("data-mataKuliah"),
//     kelas: box.getAttribute("data-kelas"),
//     hari: box.getAttribute("data-hari"),
//     jam: box.getAttribute("data-jam"),
//     startTime: box.getAttribute("data-start-time"),
//     endTime: box.getAttribute("data-end-time"),
//     style: box.getAttribute("style"), // Simpan gaya (warna hijau untuk dipilih)
//   }));

//   const courseListItems = Array.from(document.querySelectorAll("#courseList .course-item")).map(item => item.textContent);

//   const dataToSave = {
//     selectedCourses,
//     bottomSheetData,
//     courseBoxData,
//     courseListData: courseListItems,
//   };

//   localStorage.setItem("irsProgress", JSON.stringify(dataToSave));
//   console.log("Progress berhasil disimpan:", dataToSave);
// }

// // Fungsi untuk memuat progres
// function loadProgress() {
//   const savedData = localStorage.getItem("irsProgress");

//   if (savedData) {
//     const {
//       selectedCourses: savedSelectedCourses,
//       bottomSheetData: savedBottomSheetData,
//       courseBoxData: savedCourseBoxData,
//       courseListData: savedCourseListData,
//     } = JSON.parse(savedData);

//     // Pulihkan selectedCourses
//     selectedCourses = savedSelectedCourses || [];

//     // Pulihkan bottomSheetData dan perbarui bottom sheet
//     bottomSheetData = savedBottomSheetData || [];
//     updateBottomSheet();

//     // Pulihkan daftar kursus (courseList)
//     if (savedCourseListData) {
//       const courseList = document.getElementById("courseList");
//       courseList.innerHTML = ""; // Kosongkan terlebih dahulu
//       savedCourseListData.forEach(courseText => {
//         const listItem = document.createElement("li");
//         listItem.className = "course-item";
//         listItem.textContent = courseText;

//         const removeBtn = document.createElement("span");
//         removeBtn.className = "text-white bg-red-700 rounded-full text-xs px-2 py-1 ml-2";
//         removeBtn.textContent = "X";
//         removeBtn.onclick = function () {
//           const kodemk = courseText.split(" - ")[0].trim();
//           courseList.removeChild(listItem);

//           const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
//           courseBoxes.forEach(box => box.remove());

//           selectedCourses = selectedCourses.filter(course => course.kodemk !== kodemk);
//           updateBottomSheet();
//           saveProgress();
//         };

//         listItem.appendChild(removeBtn);
//         courseList.appendChild(listItem);
//       });
//     }

//     // Pulihkan elemen jadwal (courseBox)
//     if (savedCourseBoxData) {
//       savedCourseBoxData.forEach(boxData => {
//         const dayColumn = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"].indexOf(boxData.hari);
//         const row = document.querySelector(`#scheduleDisplay tbody tr[data-time="${boxData.startTime}"]`);
    
//         if (!row || dayColumn < 0) {
//           console.warn(`Elemen jadwal untuk waktu ${boxData.startTime} dan hari ${boxData.hari} tidak ditemukan.`);
//           return; // Jika tidak ditemukan, lewati pemulihan elemen ini
//         }
    
//         const cell = row.children[dayColumn + 1];
//         const wrapper = document.createElement("div");
//         wrapper.className = "mb-2";
    
//         const courseBox = document.createElement("div");
//         courseBox.className = `
//           bg-gray-100 text-black border border-gray-300 shadow-lg rounded-md p-2
//           text-sm font-medium w-[180px] h-[120px] flex flex-col justify-between
//           courseBox-${boxData.kodemk}
//         `;
//         courseBox.setAttribute("style", boxData.style);
//         courseBox.setAttribute("data-mataKuliah", boxData.kodemk);
//         courseBox.setAttribute("data-kelas", boxData.kelas);
//         courseBox.setAttribute("data-hari", boxData.hari);
//         courseBox.setAttribute("data-jam", boxData.jam);
//         courseBox.setAttribute("data-start-time", boxData.startTime);
//         courseBox.setAttribute("data-end-time", boxData.endTime);
    
//         courseBox.innerHTML = `
//           <div class="font-bold text-sm text-gray-900">${boxData.kodemk}</div>
//           <div class="text-xs text-gray-600">Kelas: ${boxData.kelas}</div>
//           <div class="text-xs text-gray-600">${boxData.jam}</div>
//         `;
    
//         if (boxData.style.includes("#28a745")) {
//           courseBox.onclick = () => showCancelModal(boxData.kodemk, courseBox);
//         } else {
//           courseBox.onclick = () => showConfirmationModal(boxData.kodemk, courseBox);
//         }
    
//         wrapper.appendChild(courseBox);
//         cell.appendChild(wrapper);
//       });
//     }    

//     console.log("Progress berhasil dimuat:", { selectedCourses, bottomSheetData, savedCourseBoxData, savedCourseListData });
//   } else {
//     console.log("Tidak ada progress yang disimpan.");
//   }
// }

// document.addEventListener("DOMContentLoaded", () => {
//   loadProgress();
// });
