### README ###

*) [My Mini Library v1.1] adalah contoh aplikasi web yang dibangun menggunakan Zend Framework 1.11.9 + Doctrine 1.2.4, dan saya pergunakan untuk menampilkan koleksi buku dan review-nya. 

Komponen-komponen yang saya gunakan dalam aplikasi *service-oriented-arch* ini adalah:

* `Zend_Controller`
* `Zend_View dan Zend_Layout`
* `Zend_Cache`
* `Zend_Form`
* `Zend_Validate`
* `Zend_Service_Recaptcha`
* `Zend_Auth`
* `Zend_Acl`


### CATATAN ###

  *    Dalam aplikasi ini saya menggunakan Doctrine CLI untuk menggenerate basemodel yang ada di library path, 
       dan semua model yang ada di `MODULE_NAME . '/models/'` merujuk pada class tersebut. 
       Anda bisa melihat field-field tabel dan relasinya 
       di method `setTableDefinition()` didalam tiap class basemodel tersebut.
  *    Untuk initial script silahkan dilihat di `book.application/scripts/minilib.sql` (MySQL)

### PENGGUNAAN ###

  *    Persyaratan utama, minimal: Apache 2, PHP 5.2.4+, MySQL, mod_rewrite.
  *    Pastikan anda telah meng-*include*-kan pustaka [Zend Framework](http://framework.zend.com/download/latest) 
       dan [Doctrine1](http://www.doctrine-project.org/projects/orm/1.2/docs/en) di setting php.ini include_path.
  *    Untuk setting aplikasi Zend Framework, silahkan dibaca [disini](http://framework.zend.com/manual/en/learning.quickstart.create-project.html).
  *    Untuk merubah koneksi ke database, silahkan edit file `book.application/configs/application.ini` pada baris berikut `doctrine.dsn = `
  *    Untuk error logging ke file silahkan rubah file `book.application/modules/default/controllers/errorController.php` dan ikuti petunjuk didalam file tersebut.
### DOKUMENTASI ###

  *    Semua kode terdokumentasi di setiap docblock method di setiap class.


### LISENSI ###
Copyright (c) 2011, Sarjono Mukti Aji. All rights reserved.

Untuk lisensi lebih lengkap silahkan dibaca di LICENSE.txt
