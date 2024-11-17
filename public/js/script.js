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
      courseList.removeChild(listItem); // Hapus dari daftar

      // Hapus semua kotak jadwal dari tabel yang terkait dengan kodemk
      const courseBoxes = document.querySelectorAll(`.courseBox-${kodemk}`);
      courseBoxes.forEach(box => box.remove());
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

    console.log("Jadwal yang diterima untuk", kodemk, ":", jadwalList);

    jadwalList.forEach(jadwal => {
      const { hari, waktu_mulai, waktu_selesai, kelas, ruang_id } = jadwal;

      const dayColumn = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"].indexOf(hari);
      const startTime = waktu_mulai.slice(0, 5);
      const row = document.querySelector(`#scheduleDisplay tbody tr[data-time="${startTime}"]`);

      if (row && dayColumn >= 0) {
        const cell = row.children[dayColumn + 1];

        const wrapper = document.createElement("div");
        wrapper.className = "mb-2";

        const courseBox = document.createElement("button");
        courseBox.className = `bg-gray-100 text-black border border-black shadow-md rounded-md p-1 text-[8px] font-medium text-center w-[50px] courseBox-${kodemk}`;
        courseBox.style.cursor = "pointer";

        courseBox.innerHTML = `
          <div>${kodemk}</div>
          <div>Kelas: ${kelas}</div>
          <div>Ruang: ${ruang_id}</div>
          <div>${waktu_mulai} - ${waktu_selesai}</div>
        `;

        // Tambahkan event klik untuk membuka modal
        courseBox.onclick = () => showModal(kodemk, courseBox);

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

// Fungsi untuk menampilkan modal konfirmasi pengambilan mata kuliah
function showModal(kodemk, selectedCourseBox) {
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
      box.onclick = () => showModal(kodemk, box); // Aktifkan kembali klik
    });

    cancelModal.classList.add("hidden");
  };

  cancelCancelButton.onclick = () => {
    cancelModal.classList.add("hidden");
  };
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


