<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    Category::create([
      'category_name' => 'Kuliah',
    ]);
    Category::create([
      'category_name' => 'Ujian / Evaluasi',
    ]);
    Category::create([
      'category_name' => 'Praktikum',
    ]);
    Category::create([
      'category_name' => 'Workshop / Pelatihan',
    ]);
    Category::create([
      'category_name' => 'Keperluan Admin',
    ]);
    Category::create([
      'category_name' => 'Maintenance / Perbaikan',
    ]);
    Category::create([
      'category_name' => 'Lomba',
    ]);
    Category::create([
      'category_name' => 'Rapat Organisasi',
    ]);
    Category::create([
      'category_name' => 'Forum Warga',
    ]);
    Category::create([
      'category_name' => 'Lain - Lain',
    ]); 
  }
}