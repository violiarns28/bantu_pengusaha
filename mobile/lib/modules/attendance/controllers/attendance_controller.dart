import 'dart:math';

import 'package:bantu_pengusaha/core/services/location.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:location/location.dart';
import 'package:oktoast/oktoast.dart';

import '../../home/controllers/home_controller.dart';

class AttendanceController extends GetxController {
  final AttendanceRepo _attendanceRepo;
  final LocationService _locationService;
  AttendanceController(this._attendanceRepo, this._locationService);

  final Rx<AttendanceModel?> today = Rx<AttendanceModel?>(null);

  @override
  void onInit() {
    getData();
    super.onInit();
  }

  void getData() async {
    final res = await _attendanceRepo.getAll();
    if (res.success) {
      final now = DateTime.now();
      for (final i in res.data ?? []) {
        if (now.day == i.date.day) {
          today.value = i;
        }
      }
    } else {
      showToast(res.message);
    }
  }

  Future<LocationData?> getCurrentLocation() async {
    return await _locationService.getLocation();
  }

  Future<void> saveAttendance(
    BuildContext context,
    double latitude,
    double longitude,
  ) async {
    var res = await _attendanceRepo.save(latitude, longitude);

    if (res.success) {
      if (today.value?.clockIn == null) {
        showToast('Clock in successful');
      } else {
        showToast('Clock out successful');
      }
      today.value = res.data;
      final hC = Get.find<HomeController>();
      hC.today.value = res.data;
    } else {
      if (today.value?.clockIn == null) {
        showToast('Clock in unsuccessful');
      } else {
        showToast('Clock out unsuccessful');
      }
    }
  }

  double calculateDistance(double lat1, double lon1, double lat2, double lon2) {
    const p = 0.017453292519943295;
    var a = 0.5 -
        cos((lat2 - lat1) * p) / 2 +
        cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    return 12742 * asin(sqrt(a)); // 2 * R; R = 6371 km

    // return 0.0;
  }

  String formatDate(DateTime date) {
    final formatter = DateFormat('dd MMMM yyyy');
    return formatter.format(date);
  }

  String getHHmm(String? time) {
    if (time == null) return "-- : --";
    final split = time.split(":");
    return "${split[0]}:${split[1]}";
  }
}
