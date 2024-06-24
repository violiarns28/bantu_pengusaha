import 'dart:convert';

import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:device_info_plus/device_info_plus.dart';
import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';

class LocalService extends GetxService {
  late SharedPreferences
      local; // Instance shared preferences untuk penyimpanan lokal
  late DeviceInfoPlugin
      deviceInfo; // Instance plugin untuk mendapatkan informasi perangkat

  /// Inisialisasi layanan lokal async
  Future<LocalService> init() async {
    local = await SharedPreferences
        .getInstance(); // Mendapatkan instance shared preferences
    deviceInfo = DeviceInfoPlugin(); // Inisialisasi plugin device info
    return this; // Mengembalikan instance LocalService setelah diinisialisasi
  }

  @override
  void onInit() {
    log.e(
        "Initializing LocalService"); // Log ketika inisialisasi LocalService dimulai
    super.onInit();
  }

  @override
  void onClose() {
    log.e("Closing LocalService"); // Log ketika LocalService ditutup
    super.onClose();
  }

  /// Menyimpan token ke penyimpanan lokal
  Future<void> setToken(String token) async {
    await local.setString('token', token);
  }

  /// Mendapatkan token dari penyimpanan lokal
  String? getToken() {
    return local.getString('token');
  }

  /// Menghapus token dari penyimpanan lokal
  Future<void> removeToken() async {
    await local.remove('token');
  }

  /// Menyimpan data pengguna ke penyimpanan lokal
  Future<void> setUser(UserModel user) async {
    await local.setString('user', jsonEncode(user.toJson()));
  }

  /// Mendapatkan data pengguna dari penyimpanan lokal
  UserModel? getUser() {
    final user = local.getString('user');
    if (user != null && user.isNotEmpty && user != 'null') {
      return UserModel.fromJson(jsonDecode(user));
    }
    return null;
  }

  /// Menghapus data pengguna dari penyimpanan lokal
  Future<void> removeUser() async {
    await local.remove('user');
  }

  /// Mengatur header HTTP dengan menambahkan token otentikasi
  Map<String, String> setHeaders() {
    final token = getToken();
    return {
      'Content-type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
    };
  }

  /// Mendapatkan ID perangkat
  Future<String?> getDeviceId() async {
    final info = await deviceInfo.deviceInfo;
    if (info is AndroidDeviceInfo) {
      return info.id;
    }
    return null;
  }
}
