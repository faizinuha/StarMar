
# StarMar 🚀

StarMar adalah proyek **platform media sosial** yang terinspirasi dari Instagram dan Facebook. Proyek ini dikembangkan oleh tim kami untuk memberikan pengalaman terbaik dalam **belajar dan memahami dunia pengembangan web, khususnya di bidang media sosial**.

## 🛠 Teknologi yang Digunakan

- **Laravel** - Backend dan logika bisnis.
- **Tailwind CSS** - Styling frontend.
- **MySQL** - Database utama.
- **JavaScript (Alpine.js / Vue.js)** - Interaksi dinamis.
- **Bootstrap Icons & Boxicons** - Ikon UI.

## 👨‍💻 Tim Pengembang

| Nama       | Peran                | Foto |
|------------|----------------------|------|
| **Alice**  | Backend Developer     | ![Alice](link_foto_1) |
| **Bob**    | Frontend Developer    | ![Bob](link_foto_2) |
| **Charlie**| UI/UX Designer        | ![Charlie](link_foto_3) |
| **David**  | Database Engineer     | ![David](link_foto_4) |
| **Eve**    | DevOps Engineer       | ![Eve](link_foto_5) |

*(Ganti `link_foto_X` dengan link foto masing-masing anggota)*

## 🔥 Cara Berkontribusi

Jika Anda ingin berkontribusi dalam proyek ini, ikuti langkah-langkah berikut:

### 1️⃣ Fork & Clone Repository
1. **Fork** repositori ini ke akun GitHub Anda.  
2. Clone repositori hasil fork:
   ```sh
   git clone https://github.com/USERNAME/StarMar.git
   ```
3. Masuk ke folder proyek:
   ```sh
   cd StarMar
   ```

### 2️⃣ Setup Proyek
1. Install dependensi:
   ```sh
   composer install
   npm install
   ```
2. Salin file `.env` dan atur konfigurasi database:
   ```sh
   cp .env.example .env
   ```
3. Generate key Laravel:
   ```sh
   php artisan key:generate
   ```
4. Jalankan migrasi dan seeder:
   ```sh
   php artisan migrate --seed
   ```

### 3️⃣ Buat Branch Baru
1. Buat branch baru untuk fitur atau perbaikan yang ingin Anda tambahkan:
   ```sh
   git checkout -b fitur-anda
   ```
2. Setelah selesai, commit perubahan:
   ```sh
   git add .
   git commit -m "Menambahkan fitur X"
   ```
3. Push branch ke repositori fork Anda:
   ```sh
   git push origin fitur-anda
   ```

### 4️⃣ Buat Pull Request (PR)
1. Buka repositori **StarMar** asli di GitHub.
2. Klik **"Compare & pull request"**.
3. Isi deskripsi PR dengan jelas dan ajukan.

## 📧 Notifikasi Login di Perangkat Baru
Sistem akan mengirimkan email notifikasi jika akun Anda login dari **perangkat atau browser baru** (contoh: login di Chrome lalu login di Edge). Informasi yang dikirim mencakup:
- **Perangkat & Browser** yang digunakan.
- **Alamat IP**.
- **Waktu Login**.
- **Lokasi Perkiraan** *(jika tersedia)*.

## 📜 Lisensi
Proyek ini menggunakan lisensi **MIT**. Anda bebas menggunakan, memodifikasi, dan mendistribusikan kode ini dengan tetap mencantumkan kredit kepada tim pengembang.

---
