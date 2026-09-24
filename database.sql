-- Buat Database
CREATE DATABASE IF NOT EXISTS db_klinik;
USE db_klinik;

-- Tabel Poli
CREATE TABLE IF NOT EXISTS Poli (
    Poli_ID VARCHAR(10) PRIMARY KEY,
    Nama_Poli VARCHAR(50) NOT NULL
);

-- Tabel Dokter
CREATE TABLE IF NOT EXISTS Dokter (
    Dokter_ID VARCHAR(10) PRIMARY KEY,
    Nama_Dokter VARCHAR(100) NOT NULL,
    Poli_ID VARCHAR(10),
    FOREIGN KEY (Poli_ID) REFERENCES Poli(Poli_ID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabel Pasien
CREATE TABLE IF NOT EXISTS Pasien (
    PasienKlinik_ID VARCHAR(10) PRIMARY KEY,
    Nama_PasienKlinik VARCHAR(100) NOT NULL,
    Tanggal_LahirPasien DATE NOT NULL,
    Jenis_KelaminPasien ENUM('Laki-Laki', 'Perempuan') NOT NULL,
    Alamat_Pasien TEXT
);

-- Tabel Berobat
CREATE TABLE IF NOT EXISTS Berobat (
    No_Transaksi VARCHAR(20) PRIMARY KEY,
    PasienKlinik_ID VARCHAR(10),
    Tanggal_Berobat DATE NOT NULL,
    Dokter_ID VARCHAR(10),
    Keluhan_Pasien TEXT NOT NULL,
    Biaya_Adm INT NOT NULL,
    FOREIGN KEY (PasienKlinik_ID) REFERENCES Pasien(PasienKlinik_ID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Dokter_ID) REFERENCES Dokter(Dokter_ID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Insert Data Poli
INSERT IGNORE INTO Poli (Poli_ID, Nama_Poli) VALUES 
('P001', 'Gigi'),
('P002', 'Umum'),
('P003', 'THT');

-- Insert Data Dokter
INSERT IGNORE INTO Dokter (Dokter_ID, Nama_Dokter, Poli_ID) VALUES 
('D001', 'dr. Ratna', 'P001'),
('D002', 'dr. Rudy', 'P002'),
('D003', 'dr. Joko', 'P003');

-- Insert Data Pasien
INSERT IGNORE INTO Pasien (PasienKlinik_ID, Nama_PasienKlinik, Tanggal_LahirPasien, Jenis_KelaminPasien, Alamat_Pasien) VALUES 
('PS.001', 'Barata Yuda', '1972-07-29', 'Laki-Laki', 'Alamat Barata'),
('PS.005', 'Indah Susanti', '2000-08-15', 'Perempuan', 'Alamat Indah'),
('PS.003', 'Kurniawan', '2007-08-19', 'Laki-Laki', 'Alamat Kurniawan');

-- Insert Data Berobat
INSERT IGNORE INTO Berobat (No_Transaksi, PasienKlinik_ID, Tanggal_Berobat, Dokter_ID, Keluhan_Pasien, Biaya_Adm) VALUES
('TR001', 'PS.001', '2017-07-29', 'D001', 'Sakit Gigi', 125000),
('TR002', 'PS.005', '2017-08-15', 'D002', 'Demam', 75000),
('TR003', 'PS.003', '2017-08-19', 'D003', 'Pendarahan Telinga', 90000);
