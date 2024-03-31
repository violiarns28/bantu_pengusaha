import 'dart:convert';

import 'package:bantu_pengusaha/data/models/home_response.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Network {
  final String _url = 'https://c24e-114-10-31-57.ngrok-free.app/api';

  Future<String?> _getToken() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    return localStorage.getString('token');
  }

  getData(apiURL) async {
    var fullUrl = _url + apiURL;
    return await http.get(
      Uri.parse(fullUrl),
      headers: await _setHeaders(),
    );
  }

  postData(apiURL, Map<String, dynamic> data) async {
    var fullUrl = _url + apiURL;
    debugPrint(fullUrl);
    return await http.post(
      Uri.parse(fullUrl),
      body: jsonEncode(data),
      headers: await _setHeaders(),
    );
  }

  Future<Map<String, String>> _setHeaders() async {
    final t = await _getToken();
    return {
      'Content-type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer $t',
    };
  }

  Future<bool> getMe() async {
    final res = await getData('/me');
    final body = json.decode(res.body);
    return body['success'];
  }

  Future<List<HistoryData>> getAttendance() async {
    final response = await getData('/get-attendances');
    // log.f("d: ${response.body}");

    final homeResponseModel =
        HomeResponseModel.fromJson(json.decode(response.body));

    return homeResponseModel.data;
  }
}
