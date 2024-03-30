import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as myHttp;
import 'package:location/location.dart';
import 'package:oktoast/oktoast.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../data/models/save_attendance.dart';

class AttendanceController extends GetxController {
  final Future<SharedPreferences> _prefs = SharedPreferences.getInstance();
  late Future<String> _token;

  @override
  void onInit() {
    super.onInit();
    _token = _prefs.then((SharedPreferences prefs) {
      return prefs.getString("token") ?? "";
    });
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
      BuildContext context, double latitude, double longitude) async {
    var saveAttendanceResponseModel;
    Map<String, String> body = {
      "latitude": latitude.toString(),
      "longitude": longitude.toString()
    };

    var token = await _token;

    Map<String, String> headers = {'Authorization': 'Bearer $token'};

    var response = await myHttp.post(
      Uri.parse("http://192.168.1.56:3000/api/save-attendance"),
      body: body,
      headers: headers,
    );

    saveAttendanceResponseModel =
        SaveAttendanceResponseModel.fromJson(json.decode(response.body));

    if (saveAttendanceResponseModel.success) {
      showToast('Clock in successful');
    } else {
      showToast('Clock in unsuccessful');
    }
  }

  getLocation() {}
}
