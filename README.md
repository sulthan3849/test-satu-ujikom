# Clinic Outpatient & Medical Records System (SIMKlinik) 🏥

Sistem Informasi Pelayanan Poliklinik dan Pengelolaan Rekam Medis Pasien Rawat Jalan berbasis **PHP & MySQL**. Dirancang untuk mengelola alur pelayanan klinik mulai dari pendaftaran pasien, penugasan poli, rekam medis diagnosis dokter, hingga cetak laporan berkala.

---

## ✨ Fitur Utama

- 👨‍⚕️ **Manajemen Tenaga Medis (Dokter)**: Pendataan dokter spesialis, jadwal praktik, dan poli terkait.
- 🧑‍🤝‍🧑 **Pendataan Pasien**: Registrasi pasien baru, pencarian identitas, dan riwayat kunjungan.
- 🏢 **Manajemen Unit Poliklinik (Poli)**: Pengelolaan unit layanan (Poli Umum, Gigi, Anak, Mata, dll.).
- 🩺 **Pelayanan Rawat Jalan & Berobat**: Pencatatan keluhan, pemeriksaan dokter, dan rekam medis pasien.
- 🖨️ **Laporan & Rekapitulasi**: Cetak laporan data dokter, laporan kunjungan pasien, dan laporan riwayat berobat.

---

## 📁 Struktur Direktori

```text
clinic-medical-record-system/
├── database/              # Skema database clinic_db.sql
├── dokter.php             # Modul daftar dokter
├── tambahdokter.php       # Form registrasi dokter
├── editdokter.php         # Pembaruan profil dokter
├── pasien.php             # Modul direktori pasien
├── tambahpasien.php       # Form pendaftaran pasien
├── editpasien.php         # Pembaruan data pasien
├── poli.php               # Manajemen daftar poliklinik
├── listberobat.php        # Daftar transaksi rawat jalan
├── laporan_berobat.php    # Modul pelaporan & cetak rekam medis
├── header.php / footer.php# Template tata letak antarmuka
├── koneksi.php            # Konfigurasi koneksi MySQL
└── README.md
```

---

## 🚀 Panduan Instalasi Lokal

1. Salin folder proyek ke direktori web server (misal: `htdocs/` untuk XAMPP).
2. Impor file basis data `database/clinic_db.sql` ke dalam MySQL / phpMyAdmin.
3. Sesuaikan konfigurasi koneksi pada `koneksi.php` (nama database, user, dan password).
4. Buka peramban dan akses melalui `http://localhost/clinic-medical-record-system/`.

---

## 📄 Lisensi
Distributed under the MIT License.
