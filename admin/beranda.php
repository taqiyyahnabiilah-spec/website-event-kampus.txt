<?php
include "php/koneksi.php";
// Mengambil data dari database untuk ditampilkan di kalender
$schedules = $koneksi->query("SELECT * FROM `schedule_list`");
$sched_res = [];

foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Acara Polibatam</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    <style>
        /* Custom Style untuk Kalender agar pas di layout kamu */
        #calendar {
            width: 100%;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .fc-event {
            cursor: pointer;
        }
        /* Penyesuaian agar modal muncul di atas segalanya */
        .modal { z-index: 1055 !important; }
        .modal-backdrop { z-index: 1050 !important; }
    </style>
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="beranda.html">
            <img src="logopolibatam.png" alt="Logo Politeknik Negeri Batam" height="60" class="d-inline-block align-text-top">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="./beranda.html">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="./tentang.html">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="./login.html">Login</a></li>
            </ul>
            </div>
        </div>
        </nav>

    <div class="main-content">
        <div class="left-panel">
            <div class="title-section">
                <h1>INFORMASI EVENT KAMPUS</h1>
            </div>
            <div class="description">
                <p>Temukan jadwal lengkap seminar, lokakarya, kompetisi, dan festival kampus di satu tempat.</p>
                <p>Selalu update dengan kegiatan terbaru di lingkungan akademikmu.</p>
            </div>
           <div class="search-section">
                <select class="category-input" name="kategori" id="kategoriNavigasi" onchange="goToPage()">
                    <option value="" disabled selected>Kategori</option>
                    <option value="./seminar.html">Seminar</option >
                    <option value="./lokakarya.html">Lokakarya</option>
                    <option value="./kompetisi.html">Kompetisi</option>
                    <option value="./festival.html">Festival</option>
                </select>
            </div>
        </div>
        <div class="right-panel">
             <img src="gedung_polibatam.jpg" alt="Gedung Polibatam" class="building-image">
        </div>
    </div>

    <div class="gallery-announcement-section">
        <div class="gallery-container">
           <div class="gallery-item" onclick="window.location.href='./berita1.html'"><img src="img1.jpeg" alt="Kegiatan 1"></div>
            <div class="gallery-item" onclick="window.location.href='./berita2.html'"><img src="img2.jpg" alt="Kegiatan 2"></div>
           <div class="gallery-item" onclick="window.location.href='./berita3.html'"><img src="img3.jpg" alt="Kegiatan 3"></div>
            <div class="gallery-item" onclick="window.location.href='./berita4.html'"><img src="img4.jpg" alt="Kegiatan 4"></div>
        </div>
    </div>

    <div class="announcement-section">
        <h2 class="announcement-title">Pengumuman</h2>
    </div>

    <div class="event-section">
        <div class="card-container">
            <div class="event-card">
                <div>
                    <h2>Seminar Polibatam</h2>
                    <p>23 Oktober 2025</p>
                    <p>Auditorium Politeknik Negeri Batam</p>
                </div>
                <button class="detail-button" onclick="location.href='./seminar.html'">Lihat Detail</button>
            </div>

            <div class="event-card">
                <div>
                    <h2>Bazar Inovasi Mahasiswa Polibatam 2025</h2>
                    <p>25 Oktober 2025</p>
                    <p>Politeknik Negeri Batam</p>
                </div>
                <button class="detail-button" onclick="location.href='./lokakarya.html'">Lihat Detail</button>
            </div>

            <div class="event-card">
                <div>
                    <h2>Kompetisi Wawasan Bisnis</h2>
                    <p>26 Oktober 2025</p>
                    <p>Auditorium Politeknik Negeri Batam</p>
                </div>
                <button class="detail-button" onclick="location.href='./kompetisi.html'">Lihat Detail</button>
            </div>
        </div>
    </div>

<div class="top-header-yellow"></div> 

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Kalender Akademik & Event</h5>
                        <button class="btn btn-sm btn-light" id="add_event_btn"><i class="fa fa-plus"></i> Tambah Event</button>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Detail Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <form action="php/save_schedule.php" method="post" id="schedule-form">
                            <input type="hidden" name="id" value="">
                            <div class="mb-3">
                                <label for="title" class="control-label">Judul Event</label>
                                <input type="text" class="form-control rounded-0" name="title" id="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="control-label">Deskripsi</label>
                                <textarea rows="3" class="form-control rounded-0" name="description" id="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="start_datetime" class="control-label">Mulai</label>
                                <input type="datetime-local" class="form-control rounded-0" name="start_datetime" id="start_datetime" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_datetime" class="control-label">Selesai</label>
                                <input type="datetime-local" class="form-control rounded-0" name="end_datetime" id="end_datetime" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" form="schedule-form" onclick="document.getElementById('schedule-form').submit()">Simpan</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="contact-section" id="kontak">
    <div class="map-container">
        <a href="https://www.google.com/maps/place/Politeknik+Negeri+Batam/@1.118721,104.048478,17z/data=!4m6!3m5!1s0x31d98921856ddfab:0xf9d9fc65ca00c9d!8m2!3d1.1187205!4d104.0484566!16s%2Fg%2F1hc0g0x3x!5m1!1e4?entry=tts&g_ep=EgoyMDI1MTAxNC4wIPu8ASoASAFQAw%3D%3D&skid=ecfbb60e-8d0d-4fe0-b765-361eb6dafce0" target="_blank">
            <img src="peta_polibatam.png" alt="Peta Lokasi Polibatam" class="map-image"> 
        </a>
    </div>
    <div class="contact-info">
        <h2>Hubungi Kami</h2>
        <p>Jika memiliki pertanyaan ataupun keperluan, silakan menghubungi kami melalui kontak di bawah ini:</p>
        <p><strong>Alamat:</strong> Jl. Ahmad Yani Batam Kota, Kota Batam, Kepulauan Riau Indonesia</p>
        <p><strong>Phone:</strong> +62-778-469858 Ext. 1017</p>
        <p><strong>Fax:</strong> +62-778-463620</p>
        <p><strong>Email:</strong> info@polibatam.ac.id</p>
    </div>
</div>

    <div class="footer-bottom">
        <div class="footer-content">
            <div class="footer-social">
                <a href="https://www.instagram.com/polibatamofficial?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fab fa-instagram"></i></a>
                <a href="https://youtube.com/@polibatamtv?si=1MjmnocfPAumN7qy"><i class="fab fa-youtube"></i></a>
            </div>
            <p>&copy; 2025 Politeknik Negeri Batam. All Rights Reserved.</p>
        </div>
    </div>

</body>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="fullcalendar/lib/main.min.js"></script>

    <script>
        var scheds = <?= json_encode($sched_res) ?>;
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap5',
                events: [
                    <?php 
                    // Mengubah data PHP ke format Event FullCalendar
                    foreach($sched_res as $row){ 
                    ?>
                    {
                        id: '<?= $row['id'] ?>',
                        title: '<?= $row['title'] ?>',
                        start: '<?= str_replace(' ', 'T', $row['start_datetime']) ?>',
                        end: '<?= str_replace(' ', 'T', $row['end_datetime']) ?>',
                    },
                    <?php } ?>
                ],
                // Ketika event diklik (Edit/Delete)
                eventClick: function(info) {
                    var _details = scheds[info.event.id];
                    var id = _details.id;
                    
                    if (!!scheds[id]) {
                        // Isi form modal dengan data event
                        $('#schedule-form').find('[name="id"]').val(id);
                        $('#schedule-form').find('[name="title"]').val(_details.title);
                        $('#schedule-form').find('[name="description"]').val(_details.description);
                        $('#schedule-form').find('[name="start_datetime"]').val(String(_details.start_datetime).replace(" ", "T"));
                        $('#schedule-form').find('[name="end_datetime"]').val(String(_details.end_datetime).replace(" ", "T"));
                        
                        // Setup tombol delete
                        $('#delete').attr("data-id", id);
                        $('#delete').show();
                        
                        // Tampilkan modal
                        var myModal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                        myModal.show();
                    } else {
                        alert("Event is undefined");
                    }
                },
                // Bisa ditambahkan select callback untuk klik tanggal kosong jika diinginkan
                selectable: true,
                select: function(info) {
                    // Reset form
                    $('#schedule-form')[0].reset();
                    $('#schedule-form').find('[name="id"]').val('');
                    $('#delete').hide();
                    
                    // Set tanggal sesuai yang diklik
                    // (Perlu konversi format tanggal agar masuk ke input datetime-local)
                    var start = info.startStr + 'T09:00'; 
                    var end = info.startStr + 'T10:00';
                    
                    $('#schedule-form').find('[name="start_datetime"]').val(start);
                    $('#schedule-form').find('[name="end_datetime"]').val(end);

                    var myModal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                    myModal.show();
                }
            });

            calendar.render();

            // Event Listener untuk Tombol Tambah Manual
            document.getElementById('add_event_btn').addEventListener('click', function() {
                $('#schedule-form')[0].reset();
                $('#schedule-form').find('[name="id"]').val('');
                $('#delete').hide();
                var myModal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                myModal.show();
            });

            // Event Listener untuk tombol Delete di dalam Modal
            document.getElementById('delete').addEventListener('click', function() {
                var id = $(this).attr('data-id');
                if (!!id) {
                    var _conf = confirm("Are you sure to delete this scheduled event?");
                    if (_conf === true) {
                        location.href = "php/delete_schedule.php?id=" + id;
                    }
                } else {
                    alert("Event is undefined");
                }
            });
        });
    </script>
</html>