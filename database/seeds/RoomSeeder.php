<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomSeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    $mushola = 'Mushola';
    $ruang_kelas = 'Ruang Kelas';
    $ruang_rapat = 'Ruang TV / Rapat';
    $ruang_dosen = 'Ruang Dosen';
    $laboratorium = 'Laboratorium';
    $aula = 'Aula';
    $pikti = 'PIKTI';
    $perpustakaan = 'Perpustakaan Informatika / RBTC';
    $hmtc = 'Ruang Himpunan Teknik Informatika';
    $ruang_sidang = 'Ruang Sidang';
    $akademik = 'Bagian Akademik';
    $kemahasiswaan = 'Bagian Kemahasiswaan dan Kepegawaian';
    $ketua_pasca = 'Ruang Ketua Pasca Sarjana';
    $sekret_pasca = 'Ruang Sekretaris Pasca Sarjana';

    for ($i=101; $i <=104 ; $i++) { 
      Room::create([
        'room_code' => 'IF-'.$i,
        'room_name' => $ruang_kelas,
      ]);
    }
    Room::create([
      'room_code' => 'IF-105A',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-105B',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-106',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-107',
      'room_name' => $perpustakaan,
    ]);
    Room::create([
      'room_code' => 'IF-108',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-109',
      'room_name' => $laboratorium.' S2',
    ]);
    Room::create([
      'room_code' => 'IF-110',
      'room_name' => $laboratorium.' S3',
    ]);
    Room::create([
      'room_code' => 'IF-111',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-112',
      'room_name' => $ruang_kelas,
    ]);
    Room::create([
      'room_code' => 'IF-113',
      'room_name' => $pikti,
    ]);
    Room::create([
      'room_code' => 'MUSHOLA',
      'room_name' => $mushola,
    ]);
    Room::create([
      'room_code' => 'IF-201',
      'room_name' => $ruang_dosen,
    ]);
    Room::create([
      'room_code' => 'IF-202',
      'room_name' => $mushola,
    ]);
    for ($i=203; $i <=213 ; $i++) { 
      Room::create([
        'room_code' => 'IF-'.$i,
        'room_name' => $ruang_dosen,
      ]);
    }
    Room::create([
      'room_code' => 'IF-214',
      'room_name' => $ketua_pasca,
    ]);
    Room::create([
      'room_code' => 'IF-215A',
      'room_name' => $ruang_dosen,
    ]);
    Room::create([
      'room_code' => 'IF-215B',
      'room_name' => $ruang_rapat,
    ]);
    Room::create([
      'room_code' => 'IF-216',
      'room_name' => $sekret_pasca,
    ]);
    Room::create([
      'room_code' => 'IF-217',
      'room_name' => $ruang_rapat.' 2',
    ]);
    Room::create([
      'room_code' => 'SIDANG',
      'room_name' => $ruang_sidang,
    ]);
    Room::create([
      'room_code' => 'AULA',
      'room_name' => $aula,
    ]);
    Room::create([
      'room_code' => 'IF-220',
      'room_name' => $akademik,
    ]);
    Room::create([
      'room_code' => 'IF-221',
      'room_name' => $ruang_rapat.' 1',
    ]);
    Room::create([
      'room_code' => 'IF-222',
      'room_name' => $kemahasiswaan,
    ]);
    for ($i=223; $i <=237 ; $i++) { 
      Room::create([
        'room_code' => 'IF-'.$i,
        'room_name' => $ruang_dosen,
      ]);
    }
    Room::create([
      'room_code' => 'IF-301',
      'room_name' => $laboratorium.' Rekayasa Perangkat Lunak',
    ]);
    Room::create([
      'room_code' => 'IF-302',
      'room_name' => $laboratorium.' Komputasi Berbasis Jaringan',
    ]);
    Room::create([
      'room_code' => 'IF-303',
      'room_name' => $laboratorium.' Komputasi Cerdas dan Visi',
    ]);
    Room::create([
      'room_code' => 'IF-304',
      'room_name' => $laboratorium.' Workshop Pemrograman',
    ]);
    Room::create([
      'room_code' => 'HMTC',
      'room_name' => $hmtc,
    ]);
    Room::create([
      'room_code' => 'IF-305',
      'room_name' => $laboratorium.' Workshop Pengembangan Game',
    ]);
    Room::create([
      'room_code' => 'IF-306',
      'room_name' => $laboratorium.' Arsitektur Jaringan Komputer',
    ]);
    Room::create([
      'room_code' => 'IF-307',
      'room_name' => $laboratorium.' Interaksi Grafika dan Seni',
    ]);
    Room::create([
      'room_code' => 'MIS',
      'room_name' => $laboratorium.' Mobile Innovation Studio',
    ]);
    Room::create([
      'room_code' => 'IF-308',
      'room_name' => $laboratorium.' Workshop Pemrograman II',
    ]);
    Room::create([
      'room_code' => 'IF-309',
      'room_name' => $laboratorium.' Algoritma dan Pemrograman',
    ]);
    Room::create([
      'room_code' => 'IF-310A',
      'room_name' => $laboratorium.' Manajemen Informasi',
    ]);
    Room::create([
      'room_code' => 'IF-310B',
      'room_name' => $laboratorium.' Dasar Terapan Komputasi',
    ]);
  }
}