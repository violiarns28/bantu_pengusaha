import 'dart:math' show cos, sqrt, asin;

import 'package:bantu_pengusaha/core/services/location.dart'; // Mengimpor LocationService untuk layanan lokasi
import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor model-model yang diperlukan
import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor repositori yang diperlukan
import 'package:bantu_pengusaha/utils/logger.dart'; // Mengimpor logger untuk logging
import 'package:flutter/material.dart'; // Mengimpor flutter material untuk UI
import 'package:geocoding/geocoding.dart'; // Mengimpor geocoding untuk mendapatkan alamat berdasarkan koordinat
import 'package:get/get.dart'; // Mengimpor Get untuk manajemen status
import 'package:intl/intl.dart'; // Mengimpor intl untuk formatting tanggal
import 'package:location/location.dart'; // Mengimpor location untuk akses lokasi perangkat
import 'package:oktoast/oktoast.dart'; // Mengimpor oktoast untuk menampilkan toast message

import '../../home/controllers/home_controller.dart'; // Mengimpor HomeController untuk mengakses kontroler beranda

class AttendanceController extends GetxController {
  final AttendanceRepo _attendanceRepo;
  final LocationService _locationService;
  final GeneralRepo _generalRepo;

  AttendanceController(
    this._attendanceRepo,
    this._locationService,
    this._generalRepo,
  );

  final Rx<AttendanceModel?> today = Rx<AttendanceModel?>(
      null); // Rx untuk mengamati perubahan model hadir hari ini

  final Rx<LocationData?> loc = Rx<LocationData?>(
      null); // Rx untuk mengamati perubahan data lokasi saat ini
  final Rx<List<Placemark>?> pMark = Rx<List<Placemark>?>(
      null); // Rx untuk mengamati perubahan daftar placemark
  final Rx<GeneralLocationModel> remoteLocation = Rx<GeneralLocationModel>(
    // Rx untuk mengamati perubahan lokasi umum
    GeneralLocationModel(
      latitude: 0.0,
      longitude: 0.0,
    ),
  );

  @override
  void onInit() {
    getData(); // Memuat data pada inisialisasi kontroler
    getRemoteLocation(); // Memuat lokasi umum pada inisialisasi kontroler
    super.onInit();
  }

  void getData() async {
    final res = await _attendanceRepo
        .getAll(); // Mendapatkan semua data kehadiran dari repositori
    if (res.success) {
      final now = DateTime.now();
      for (final i in res.data ?? []) {
        if (now.day == i.date.day) {
          today.value = i; // Menetapkan nilai hadir hari ini jika ditemukan
        }
      }
    } else {
      showToast(
          res.message); // Menampilkan pesan toast jika gagal mendapatkan data
    }
  }

  Future<GeneralLocationModel?> getRemoteLocation() async {
    final locRes = await _generalRepo
        .getLocation(); // Mendapatkan lokasi umum dari repositori
    if (locRes.success) {
      if (locRes.data!.isNotEmpty) {
        final loc = GeneralLocationModel.fromJson(locRes.data!.first.value);
        remoteLocation.value =
            loc; // Menetapkan nilai lokasi umum jika ditemukan
        return loc;
      } else {
        showToast(
            'Remote location not found'); // Menampilkan pesan toast jika lokasi umum tidak ditemukan
        return null;
      }
    } else {
      showToast(locRes
          .message); // Menampilkan pesan toast jika gagal mendapatkan lokasi umum
      return null;
    }
  }

  Future<LocationData?> getCurrentLocation() async {
    loc.value = await _locationService
        .getLocation(); // Mendapatkan lokasi saat ini dari layanan lokasi
    return loc.value;
  }

  Future<Placemark?> toPlacemark({
    double? ltt,
    double? lnt,
  }) async {
    pMark.value = await _locationService.locationFromCoor(
        ltt ?? 0.0, lnt ?? 0.0); // Mendapatkan placemark dari koordinat
    return pMark.value?.last;
  }

  Future<void> saveAttendance(
    BuildContext context,
    double latitude,
    double longitude,
  ) async {
    var res = await _attendanceRepo.save(
        latitude, longitude); // Menyimpan data kehadiran ke repositori
    log.d(
        "AttendanceController.saveAttendance ${res.message}"); // Mencatat pesan log dari respons
    if (res.success) {
      if (today.value?.clockIn == null) {
        showToast(
            'Clock in successful'); // Menampilkan pesan toast jika berhasil clock in
      } else {
        showToast(
            'Clock out successful'); // Menampilkan pesan toast jika berhasil clock out
      }
      today.value = res.data; // Menetapkan nilai hadir hari ini dari respons
      final hC = Get.find<HomeController>();
      hC.today.value =
          res.data; // Menetapkan nilai hadir hari ini ke HomeController
    } else {
      if (today.value?.clockIn == null) {
        showToast(res.message); // Menampilkan pesan toast jika gagal clock in
      } else {
        showToast(res.message); // Menampilkan pesan toast jika gagal clock out
      }
    }
  }

  Future<double> calculateDistance(double lat1, double lon1) async {
    final loc =
        await getRemoteLocation(); // Mendapatkan lokasi umum untuk perhitungan jarak
    if (loc == null) {
      showToast(
          'Remote location not found'); // Menampilkan pesan toast jika lokasi umum tidak ditemukan
      return 999; // Mengembalikan nilai jarak yang besar jika lokasi umum tidak ditemukan
    }

    double lat2 = loc.latitude; // Mendapatkan latitude dari lokasi umum
    double lon2 = loc.longitude; // Mendapatkan longitude dari lokasi umum
    const p = 0.017453292519943295;
    var a = 0.5 -
        cos((lat2 - lat1) * p) / 2 +
        cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    final res =
        12742 * asin(sqrt(a)); // Menghitung jarak menggunakan formula haversine
    log.e('====== YOUR DISTANCE ========\n $res');
    return res; // Mengembalikan nilai jarak
  }

  String formatDate(DateTime date) {
    final formatter =
        DateFormat('dd MMMM yyyy'); // Formatter untuk format tanggal
    return formatter
        .format(date); // Mengembalikan tanggal dalam format yang ditentukan
  }

  String getHHmm(String? time) {
    if (time == null) {
      return "-- : --";
    } // Mengembalikan string default jika waktu null
    final split = time.split(":"); // Memisahkan waktu menjadi jam dan menit
    return "${split[0]}:${split[1]}"; // Mengembalikan waktu dalam format yang ditentukan
  }
}
