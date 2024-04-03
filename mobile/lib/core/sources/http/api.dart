import 'dart:convert';

import 'package:bantu_pengusaha/data/models/home_response.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Network {
  final String _url = 'http://8.215.13.194/api';

  Future<String?> _getToken() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    return localStorage.getString('token');
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
    return body['success'] ?? false;
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
    return await http.post(
      Uri.parse(fullUrl),
      body: jsonEncode(data),
      headers: await _setHeaders(),
    );
  }

  Future<List<HistoryData>> getAttendances() async {
    final response = await getData('/get-attendances');
    final homeResponseModel =
        HomeResponseModel.fromJson(json.decode(response.body));
    for (var data in homeResponseModel.data) {
      log.e('Get Attendance: ${data.toJson()}');
    }
    return homeResponseModel.data;
  }
}
