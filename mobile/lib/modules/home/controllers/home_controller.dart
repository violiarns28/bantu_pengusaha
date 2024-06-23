import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor layanan yang diperlukan
import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor model-model yang diperlukan
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart'; // Mengimpor repositori yang diperlukan
import 'package:bantu_pengusaha/modules/attendance/attendance.dart'; // Mengimpor modul kehadiran
import 'package:bantu_pengusaha/utils/logger.dart'; // Mengimpor logger untuk penanganan log
import 'package:geocoding/geocoding.dart'; // Mengimpor paket geocoding untuk mendapatkan alamat dari koordinat
import 'package:get/get.dart'; // Mengimpor GetX untuk manajemen status
import 'package:intl/intl.dart'; // Mengimpor package intl untuk formatting tanggal

class HomeController extends GetxController {
  final AttendanceRepo
      _attendanceRepo; // Repository untuk mengelola data kehadiran
  final LocalService _local; // Layanan lokal untuk manajemen data lokal
  final LocationService
      _locationService; // Layanan lokasi untuk mendapatkan lokasi pengguna

  HomeController(this._attendanceRepo, this._local,
      this._locationService); // Constructor untuk menginisialisasi dependencies

  final name = "".obs; // Variabel reactive untuk nama pengguna
  Rx<AttendanceModel?> today = Rx<AttendanceModel?>(
      null); // Variabel reactive untuk data kehadiran hari ini
  List<AttendanceModel> history = []; // Daftar riwayat kehadiran pengguna

  @override
  void onInit() {
    super.onInit();
    _locationService
        .requestPermission(); // Meminta izin akses lokasi saat inisialisasi controller
    name.value = _local.getUser()?.name ??
        "Folks"; // Mendapatkan nama pengguna dari data lokal, default ke "Folks" jika tidak ada
    getData(); // Memanggil method untuk mengambil data kehadiran
  }

  Future<List<Placemark>?> getCurrentLocation() async {
    final aC = Get.find<
        AttendanceController>(); // Mendapatkan instance AttendanceController dari GetX

    final coor = await Future.delayed(const Duration(seconds: 1), () {
      return aC
          .loc.value; // Mendapatkan koordinat lokasi dari AttendanceController
    });

    if (coor == null) {
      Get.snackbar("Error",
          "Failed to get location"); // Menampilkan snackbar jika gagal mendapatkan lokasi
      return null;
    } else {
      final pMarks = await _locationService.locationFromCoor(coor.latitude ?? 0,
          coor.longitude ?? 0); // Mendapatkan placemark berdasarkan koordinat
      for (var i in pMarks) {
        log.e('PLACEMARKS: $i'); // Log placemark ke konsol untuk debugging
      }
      return pMarks;
    }
  }

  Future<void> getData() async {
    history.clear(); // Mengosongkan daftar riwayat kehadiran
    final res = await _attendanceRepo
        .getAll(); // Memanggil repository untuk mendapatkan semua data kehadiran

    if (res.success && res.data != null) {
      history =
          res.data ?? []; // Menyimpan data kehadiran ke dalam daftar riwayat

      final now = DateTime.now();
      List<AttendanceModel> elementsToAdd = [];

      for (var element in history) {
        if (element.date.day == now.day) {
          today.value =
              element; // Menyimpan data kehadiran hari ini jika ditemukan
        } else {
          elementsToAdd.add(
              element); // Menambahkan data kehadiran lainnya ke dalam daftar
        }
      }
      history.addAll(
          elementsToAdd); // Menambahkan semua elemen yang sudah disiapkan ke daftar riwayat
    } else {
      Get.snackbar("Error",
          res.message); // Menampilkan snackbar jika gagal mendapatkan data
    }
  }

  String formatDate(DateTime date) {
    final formatter = DateFormat(
        'EEEE, dd MMMM yyyy'); // Formatter untuk tanggal dalam format yang diinginkan
    return formatter.format(date); // Mengembalikan tanggal yang diformat
  }

  String getHHmm(String? time) {
    if (time == null) {
      return "-- : --";
    } // Mengembalikan string default jika waktu null
    final split = time.split(":"); // Memecah waktu berdasarkan separator ":"
    return "${split[0]}:${split[1]}"; // Mengembalikan waktu dalam format jam:menit
  }
}
