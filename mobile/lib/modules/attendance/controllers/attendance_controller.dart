import 'dart:math' show cos, sqrt, asin;

import 'package:bantu_pengusaha/core/services/location.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:flutter/material.dart';
import 'package:geocoding/geocoding.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:location/location.dart';
import 'package:oktoast/oktoast.dart';

import '../../home/controllers/home_controller.dart';

class AttendanceController extends GetxController {
  final AttendanceRepo _attendanceRepo;
  final LocationService _locationService;
  final GeneralRepo _generalRepo;
  AttendanceController(
    this._attendanceRepo,
    this._locationService,
    this._generalRepo,
  );

  final Rx<AttendanceModel?> today = Rx<AttendanceModel?>(null);

  final Rx<LocationData?> loc = Rx<LocationData?>(null);
  final Rx<List<Placemark>?> pMark = Rx<List<Placemark>?>(null);
  final Rx<GeneralLocationModel> remoteLocation = Rx<GeneralLocationModel>(
    GeneralLocationModel(
      latitude: 0.0,
      longitude: 0.0,
    ),
  );

  @override
  void onInit() {
    getData();
    getRemoteLocation();
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

  Future<GeneralLocationModel?> getRemoteLocation() async {
    final locRes = await _generalRepo.getLocation();
    if (locRes.success) {
      if (locRes.data!.isNotEmpty) {
        final loc = GeneralLocationModel.fromJson(locRes.data!.first.value);
        remoteLocation.value = loc;
        return loc;
      } else {
        showToast('Remote location not found');
        return null;
      }
    } else {
      showToast(locRes.message);
      return null;
    }
  }

  Future<LocationData?> getCurrentLocation() async {
    loc.value = await _locationService.getLocation();
    return Future.value(loc.value);
  }

  Future<Placemark?> toPlacemark({
    double? ltt,
    double? lnt,
  }) async {
    pMark.value =
        await _locationService.locationFromCoor(ltt ?? 0.0, lnt ?? 0.0);
    return pMark.value?.last;
  }

  Future<void> saveAttendance(
    BuildContext context,
    double latitude,
    double longitude,
  ) async {
    var res = await _attendanceRepo.save(latitude, longitude);
    log.d("AttendanceController.saveAttendance ${res.message}");
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
        showToast(res.message);
      } else {
        showToast(res.message);
      }
    }
  }

  Future<double> calculateDistance(double lat1, double lon1) async {
    // double calculateDistance(double lat1, double lon1, double lat2, double lon2) {
    final loc = await getRemoteLocation();
    if (loc == null) {
      showToast('Remote location not found');
      return 999;
    }

    double lat2 = loc.latitude;
    double lon2 = loc.longitude;
    const p = 0.017453292519943295;
    var a = 0.5 -
        cos((lat2 - lat1) * p) / 2 +
        cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    final res = 12742 * asin(sqrt(a)); // 2 * R; R = 6371 km
    log.e('====== YOUR DISTANCE ========\n $res');
    return res;
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
