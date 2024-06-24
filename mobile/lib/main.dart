import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:oktoast/oktoast.dart';

void main() {
  // Memastikan widget binding Flutter sudah diinisialisasi sebelum menjalankan aplikasi
  WidgetsFlutterBinding.ensureInitialized();

  // Menginisialisasi layanan yang diperlukan
  initServices();

  // Menginisialisasi repositori data
  initRepo();

  // Menjalankan aplikasi Flutter dengan OKToast sebagai widget utama
  runApp(
    OKToast(
      // Menggunakan GetMaterialApp untuk manajemen rute dan status dengan GetX
      child: GetMaterialApp(
        debugShowCheckedModeBanner: false, // Menyembunyikan banner debug
        title: "Application", // Judul aplikasi
        initialRoute: AppPages.INITIAL, // Rute awal saat aplikasi dibuka
        getPages: AppPages.routes, // Daftar rute aplikasi yang didefinisikan
      ),
    ),
  );
}
