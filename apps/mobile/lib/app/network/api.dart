import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Network {
  final String _url = 'http://192.168.1.56:3000/api';
  var token;

  _getToken() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    String? tokenString = localStorage.getString('token');
  }

  getData(apiURL) async {
    var fullUrl = _url + apiURL;
    return await http.get(Uri.parse(fullUrl), headers: _setHeaders());
  }

  postData(apiURL, Map<String, dynamic> data) async {
    var fullUrl = _url + apiURL;
    debugPrint(fullUrl);
    return await http.post(Uri.parse(fullUrl),
        body: jsonEncode(data), headers: _setHeaders());
  }

  Map<String, String> _setHeaders() {
    return {
      'Content-type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
    };
  }
}
