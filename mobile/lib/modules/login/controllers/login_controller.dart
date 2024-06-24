import 'package:bantu_pengusaha/core/routes/app_pages.dart'; // Mengimpor definisi rute aplikasi
import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor layanan-layanan yang diperlukan
import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor repositori-repositori yang diperlukan
import 'package:flutter/material.dart'; // Mengimpor Flutter Material library
import 'package:get/get.dart'; // Mengimpor GetX library

class LoginController extends GetxController {
  late TextEditingController email; // Controller untuk field email
  late TextEditingController password; // Controller untuk field password
  final AuthRepo _authRepo; // Repositori untuk operasi otentikasi
  final LocationService _locationService; // Layanan untuk operasi lokasi

  var isPasswordVisible = false
      .obs; // Variabel observabel untuk mengontrol kevisibilitasan password

  LoginController(this._authRepo, this._locationService);

  @override
  void onInit() {
    super.onInit();
    email = TextEditingController(); // Inisialisasi controller email
    password = TextEditingController(); // Inisialisasi controller password
    initRepo(); // Memanggil fungsi untuk inisialisasi repositori
    _checkLoggedInUser(); // Memeriksa pengguna yang sudah login saat inisialisasi
  }

  void initRepo() async {
    final me = await _authRepo
        .me(); // Memanggil fungsi me() dari repositori autentikasi
    if (me.success) {
      // Jika pengambilan data berhasil
      Get.toNamed(
          Routes.BOTTOM_NAV_BAR); // Navigasi ke halaman bottom navigation bar
    }
  }

  Future<void> _checkLoggedInUser() async {
    final me = await _authRepo.me(); // Memeriksa pengguna yang sudah login
    if (me.success) {
      // Jika pengambilan data berhasil
      Get.toNamed(
          Routes.BOTTOM_NAV_BAR); // Navigasi ke halaman bottom navigation bar
    }
  }

  @override
  void onClose() {
    email.dispose(); // Melepaskan controller email
    password.dispose(); // Melepaskan controller password
    super.onClose();
  }

  void login(String email, String password) async {
    final perm = await _locationService
        .requestPermission(); // Meminta izin lokasi dari pengguna

    if (perm) {
      // Jika izin lokasi diberikan
      final res = await _authRepo.login(email,
          password); // Melakukan login dengan email dan password yang diberikan
      if (res.success) {
        // Jika login berhasil
        Get.offAllNamed(Routes
            .BOTTOM_NAV_BAR); // Navigasi ke halaman bottom navigation bar dan menghapus semua rute sebelumnya
      } else {
        Get.snackbar(
            'Error',
            res.message ??
                'Unknown error'); // Menampilkan snackbar dengan pesan error jika login gagal
      }
    } else {
      Get.snackbar('Location permission required',
          "To use this app please allow location permission"); // Menampilkan snackbar jika izin lokasi tidak diberikan
    }
  }

  void togglePasswordVisibility() {
    isPasswordVisible.value = !isPasswordVisible
        .value; // Mengubah visibilitas password (terlihat / tidak terlihat)
  }
}
