> "Saya Rama Taufik Azkia dengan NIM 2508497 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin."

*— Janji*

# GARIS BESAR TEMA
Zoo Management System merupakan aplikasi berbasis web mengenai pengelolaan dan penempatan hewan pada enklosur, yaitu tempat khusus yang dibuat sedemikian rupa menyerupai habitat yang nyaman untuk suatu hewan. Pengguna bisa melakukan CRUD standar pada seluruh data tersebut, baik hewan maupun eklosur, juga penempatannya.

# DESIGN DATABASE
Program terdiri dari 4 tabel:
  1. `Category`, kategori pengelompokkan hewan. Pengelompokkan bisa berdasarkan taksonomi seperti mamalia, serangga, ataupun jika terlalu luas maka dari habitatnya, seperti makhluk air yang dibagi ke air tawar, air asin, dan air payau;
  2. `Animal`, tabel yang menyimpan data hewan. Tabel ini ber-relasi dengan kategori, dimana tiap hewan termasuk dalam tepat satu kategori. Jikalau suatu hewan memenuhi kriteria lebih dari satu kategori, tetap dipilih satu kategori yang paling relevan untuk hewan tersebut;
  3. `Enclosure`, tabel yang menyimpan data enklosur, atau penangkaran. Tabel ini berisikan data kondisi dari tiap enklosur, baik kondisi secara karakteristik maupun secara operasional;
  4. `EnclosureAnimal`, tabel asosiasi. Menyimpan data berupa hewan apa, diletakkan di enklosur mana, sejumlah berapa.

# ALUR
Saat pertama kali menjalankan aplikasi, pengguna akan disambut laman kosongan yang baru berisikan navigasi. Untuk melihat maupun merubah data masing-masing tabel, pilih tabel yang diinginkan pada opsi navigasi. Di bawah opsi navigasi akan langsung muncul *form* CRUD beserta tabel data. *Form* CRUD berada di atas tabel karena semakin banyak data yang ada, jika *form* ditaruh di bawah tabel, maka untuk menggapainya perlu *scroll* lebih, sedangkan *form* CRUD secara ukuran tidak akan berubah sehingga ditaruh di atas tabel.

Dari sini, penambahan data bisa langsung dilakukan pada *form* CRUD. Untuk merubah data, tekan tombol *update* pada baris yang ingin diubah, lalu ubah data pada *form*. Perlu diingat bahwa begitu menekan tombol *update*, *form* akan berada pada mode *update* walau di-*refresh*. Untuk menghilangkan mode *update*, cukup berpindah ke laman lain dulu atau hapus parameter GET 'update-id' pada link (*e.g. index.php?page=animals&**update-id=2***). Untuk menghapus data, tekan tombol *delete* lalu konfirmasi untuk menghapus data.

# DOKUMENTASI (VIDEO)
[!Dokumentasi Category](docs/category.mp4)
[!Dokumentasi Animal](docs/animal.mp4)
[!Dokumentasi Enclosure](docs/enclosure.mp4)
[!Dokumentasi EnclosureAnimal](docs/enclosure_animal.mp4)

# CATATAN

<img src="docs/_watermark.png" width="250px" align="right">