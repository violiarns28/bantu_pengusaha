import 'dart:convert';
import 'dart:math' show cos, sqrt, asin;

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
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

  Future<LatLng?> getCurrentLocation() async {
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

    LocationData locationData = await location.getLocation();
    return LatLng(locationData.latitude!, locationData.longitude!);
  }

  Future<void> saveAttendance(
    BuildContext context,
    double latitude,
    double longitude,
  ) async {
    SaveAttendanceResponseModel saveAttendanceResponseModel;
    Map<String, String> body = {
      "latitude": latitude.toString(),
      "longitude": longitude.toString(),
    };

    var token = await _token;

    Map<String, String> headers = {'Authorization': 'Bearer $token'};

    var response = await myHttp.post(
      Uri.parse("http://192.168.1.7:3000/api/save-attendance"),
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

  double calculateDistance(double lat1, double lon1, double lat2, double lon2) {
    const p = 0.017453292519943295;
    var a = 0.5 -
        cos((lat2 - lat1) * p) / 2 +
        cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    return 12742 * asin(sqrt(a)); // 2 * R; R = 6371 km
  }
}

getLocation() {}
