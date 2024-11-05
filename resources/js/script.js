function addCourse() {
  const courseSelect = document.getElementById("courses");
  const courseList = document.getElementById("courseList");
  const selectedCourse = courseSelect.value;

  // Memastikan selectedCourse tidak kosong
  if (!selectedCourse) return;

  try {
    const courseData = JSON.parse(selectedCourse); // Mengubah JSON menjadi objek JavaScript
    const { kodemk, nama, sks, semester } = courseData; // Mengambil data yang diperlukan

    // Memeriksa apakah mata kuliah sudah ada di daftar
    const existingCourses = Array.from(courseList.children).map(item => {
      return item.textContent.split(" - ")[0].trim(); // Mendapatkan kode MK dari teks item
    });

    if (existingCourses.includes(kodemk)) {
      alert("Mata kuliah sudah ada di daftar."); // Memberi tahu pengguna jika mata kuliah sudah ada
      return; 
    }

    const listItem = document.createElement("li");
    listItem.className = "course-item";

    // Buat elemen teks untuk nama mata kuliah dan kode
    const courseName = document.createTextNode(`${kodemk} - ${nama} (${sks} SKS, Semester ${semester})`);

    // Buat tombol X untuk menghapus
    const removeBtn = document.createElement("span");
    removeBtn.className = "focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";
    removeBtn.textContent = " X";
    removeBtn.onclick = function () {
      courseList.removeChild(listItem);
      updateScheduleDisplay(); // Memperbarui tampilan jadwal ketika mata kuliah dihapus
    };

    // Tambahkan nama mata kuliah dan tombol X ke dalam item
    listItem.appendChild(courseName);
    listItem.appendChild(removeBtn);

    // Tambahkan item ke dalam list
    courseList.appendChild(listItem);

    // Reset pilihan setelah ditambahkan ke list
    courseSelect.value = "";

    // Memperbarui tampilan jadwal
    updateScheduleDisplay();
  } catch (error) {
    console.error("Error parsing course data:", error);
  }
}

// Fungsi untuk memperbarui tampilan jadwal
function updateScheduleDisplay() {
  const courseList = document.getElementById("courseList");
  const scheduleDisplay = document.getElementById("scheduleDisplay");
  scheduleDisplay.innerHTML = ""; // Menghapus jadwal sebelumnya

  const selectedCourses = Array.from(courseList.children).map(item => {
    return item.textContent.split(" - ")[0].trim(); // Mendapatkan kode MK dari teks item
  });

  const allJadwalPromises = selectedCourses.map(kodemk => {
    // Mengambil jadwal dari server (misalkan melalui AJAX)
    return fetch(`/jadwal/${kodemk}`)
      .then(response => response.json());
  });

  Promise.all(allJadwalPromises)
    .then(results => {
      // Menggabungkan semua jadwal ke dalam satu array
      const allJadwal = results.flat();

      // Mengurutkan jadwal berdasarkan hari dan waktu mulai
      allJadwal.sort((a, b) => {
        const daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        const dayA = daysOrder.indexOf(a.hari);
        const dayB = daysOrder.indexOf(b.hari);
        if (dayA === dayB) {
          return a.waktu_mulai.localeCompare(b.waktu_mulai);
        }
        return dayA - dayB;
      });

      allJadwal.forEach(jadwal => {
        const jadwalItem = document.createElement("div");
        jadwalItem.className = "card m-2"; // Menambahkan class card

        // Menambahkan konten ke dalam card
        jadwalItem.innerHTML = `
          <div class="card-body">
            <h5 class="card-title">${jadwal.kodemk} - ${jadwal.mata_kuliah.nama}</h5>
            <p class="card-text">Kelas: ${jadwal.kelas}</p>
            <p class="card-text">Hari: ${jadwal.hari}</p>
            <p class="card-text">Waktu: ${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}</p>
            <p class="card-text">Ruang: ${jadwal.ruang_id}</p>
          </div>
        `;

        scheduleDisplay.appendChild(jadwalItem);
      });
    })
    .catch(error => console.error('Error fetching schedules:', error));
}
