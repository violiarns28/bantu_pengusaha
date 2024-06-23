import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:geocoding/geocoding.dart' hide Location;
import 'package:get/get.dart';
import 'package:location/location.dart';

/// Kelas untuk mengelola layanan lokasi dalam aplikasi menggunakan GetX
class LocationService extends GetxService {
  late Location location; // Objek location dari package location.dart

  /// Metode inisialisasi untuk menginisialisasi layanan lokasi
  Future<LocationService> init() async {
    location =
        Location(); // Inisialisasi objek Location dari package location.dart
    return this; // Mengembalikan instance dari LocationService
  }

  @override
  void onInit() {
    log.e(
        'Initializing LocationService 🚀'); // Log saat inisialisasi LocationService dimulai
    super.onInit();
  }

  @override
  void onClose() {
    log.e('Closing LocationService 🚀'); // Log saat LocationService ditutup
    super.onClose();
  }

  /// Metode untuk mendapatkan lokasi saat ini
  Future<LocationData?> getLocation() async {
    bool isOk = await requestPermission(); // Meminta izin akses lokasi
    if (isOk) {
      return await location
          .getLocation(); // Mengembalikan lokasi saat ini jika izin diberikan
    } else {
      return Future.value(
          null); // Mengembalikan nilai null jika izin tidak diberikan
    }
  }

  /// Metode untuk mendapatkan informasi placemark berdasarkan koordinat
  Future<List<Placemark>> locationFromCoor(
      double latitude, double longitude) async {
    return await placemarkFromCoordinates(latitude,
        longitude); // Mendapatkan informasi placemark dari koordinat tertentu
  }

  /// Metode untuk meminta izin akses lokasi dari pengguna
  Future<bool> requestPermission() async {
    bool serviceEnabled = await location
        .serviceEnabled(); // Memeriksa apakah layanan lokasi aktif
    if (!serviceEnabled) {
      serviceEnabled = await location
          .requestService(); // Meminta untuk mengaktifkan layanan lokasi jika belum aktif
    }

    PermissionStatus permissionGranted =
        await location.hasPermission(); // Memeriksa status izin akses lokasi

    if (permissionGranted == PermissionStatus.granted) {
      return true; // Mengembalikan true jika izin sudah diberikan
    } else if (permissionGranted == PermissionStatus.grantedLimited) {
      return true; // Mengembalikan true jika izin terbatas sudah diberikan
    } else {
      permissionGranted = await location
          .requestPermission(); // Meminta izin akses lokasi dari pengguna
      return false; // Mengembalikan false jika izin tidak diberikan
    }
  }
}
