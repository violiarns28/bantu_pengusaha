import 'dart:convert';

import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:device_info_plus/device_info_plus.dart';
import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';

class LocalService extends GetxService {
  late SharedPreferences local;
  late DeviceInfoPlugin deviceInfo;

  Future<LocalService> init() async {
    local = await SharedPreferences.getInstance();
    deviceInfo = DeviceInfoPlugin();
    return this;
  }

  @override
  void onInit() {
    log.e("Initializing LocalService");
    super.onInit();
  }

  @override
  void onClose() {
    log.e("Closing LocalService");
    super.onClose();
  }

  Future<void> setToken(String token) async {
    await local.setString('token', token);
  }

  String? getToken() {
    return local.getString('token');
  }

  Future<void> removeToken() async {
    await local.remove('token');
  }

  Future<void> setUser(UserModel user) async {
    await local.setString('user', jsonEncode(user.toJson()));
  }

  UserModel? getUser() {
    final user = local.getString('user');
    if (user != null && user.isNotEmpty && user != 'null') {
      return UserModel.fromJson(jsonDecode(user));
    }
    return null;
  }

  Future<void> removeUser() async {
    await local.remove('user');
  }

  Map<String, String> setHeaders() {
    final token = getToken();
    return {
      'Content-type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
    };
  }

  Future<String?> getDeviceId() async {
    final info = await deviceInfo.deviceInfo;
    if (info is AndroidDeviceInfo) {
      return info.id;
    }
    return null;
  }
}
