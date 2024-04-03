import 'dart:convert';

import 'package:bantu_pengusaha/core/sources/sources.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as myHttp;
import 'package:intl/intl.dart';
import 'package:location/location.dart';
import 'package:oktoast/oktoast.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../data/models/home_response.dart';
import '../../../../data/models/save_attendance.dart';
import '../../home/controllers/home_controller.dart';

class AttendanceController extends GetxController {
  final Future<SharedPreferences> _prefs = SharedPreferences.getInstance();
  late Future<String> _token;
  final Rx<HistoryData?> today = Rx<HistoryData?>(null);
  final net = Network();

  @override
  void onInit() {
    getData();
    super.onInit();
    _token = _prefs.then((SharedPreferences prefs) {
      return prefs.getString("token") ?? "";
    });
  }

  void getData() async {
    final h = await net.getAttendances();
    final now = DateTime.now();
    for (final i in h) {
      if (now.day == i.date.day) {
        today.value = i;
      }
    }
  }

  Future<LocationData?> getCurrentLocation() async {
    Location location = Location();

    bool serviceEnabled = await location.serviceEnabled();
    if (!serviceEnabled) {
      serviceEnabled = await location.requestService();
      if (!serviceEnabled) {
        return null;
      }
    }

    PermissionStatus permissionGranted = await location.hasPermission();
    if (permissionGranted == PermissionStatus.denied) {
      permissionGranted = await location.requestPermission();
      if (permissionGranted != PermissionStatus.granted) {
        return null;
      }
    }
    return await location.getLocation();
  }

  Future<void> saveAttendance(
    BuildContext context,
    double latitude,
    double longitude,
  ) async {
    SaveAttendanceResponseModel saveAttendanceResponseModel;
    Map<String, String> body = {
      "latitude": latitude.toString(),
      "longitude": longitude.toString()
    };

    var token = await _token;

    Map<String, String> headers = {'Authorization': 'Bearer $token'};

    var response = await myHttp.post(
      Uri.parse("http://8.215.13.194/api/save-attendance"),
      body: body,
      headers: headers,
    );

    var res = SaveAttendanceResponseModel.fromJson(json.decode(response.body));

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
    // const p = 0.017453292519943295;
    // var a = 0.5 -
    //     cos((lat2 - lat1) * p) / 2 +
    //     cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    // return 12742 * asin(sqrt(a)); // 2 * R; R = 6371 km

    return 0.0;
  }

  getLocation() {}
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
