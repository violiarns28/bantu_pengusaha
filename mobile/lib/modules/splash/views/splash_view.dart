import 'package:bantu_pengusaha/core/routes/routes.dart'; // Mengimpor definisi rute aplikasi
import 'package:flutter/material.dart'; // Mengimpor library Flutter
import 'package:get/get.dart'; // Mengimpor GetX library untuk manajemen state dan navigasi

import '../controllers/splash_controller.dart'; // Mengimpor kontroler SplashController

class SplashView extends GetView<SplashController> {
  const SplashView({super.key});

  @override
  Widget build(BuildContext context) {
    // Delay navigasi ke halaman LOGIN menggunakan Future.delayed
    Future.delayed(const Duration(seconds: 3), () {
      Get.toNamed(Routes.LOGIN);
    });

    // Menggunakan Scaffold untuk tata letak dasar aplikasi
    return Scaffold(
      body: Center(
        child: Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [
                Color(0xFFFFFFFF),
                Color(0xFFDCE5FF),
                Color(0xFF7DBBE8),
              ],
            ),
          ),
          child: Center(
            child: Container(
              decoration: const BoxDecoration(
                image: DecorationImage(
                  // Path untuk aset gambar logo
                  image: AssetImage('assets/images/logoBantuPengusaha.png'),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
