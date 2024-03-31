import 'dart:convert';

import 'package:get/get.dart';
import 'package:http/http.dart' as myHttp;
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../data/models/home_response.dart';

class HomeController extends GetxController {
  final Future<SharedPreferences> _prefs = SharedPreferences.getInstance();
  late Future<String> name, _token;
  HomeResponseModel? homeResponseModel;
  HistoryData? today;
  List<HistoryData> history = [];

  @override
  void onInit() {
    super.onInit();
    _token = _prefs.then((SharedPreferences prefs) {
      return prefs.getString("token") ?? "";
    });

    name = _prefs.then((SharedPreferences prefs) {
      return prefs.getString("name") ?? "";
    });
  }

  Future<void> getData() async {
    var token = await _token;

    Map<String, String> headres = {'Authorization': 'Bearer $token'};

    var response = await myHttp.get(
        Uri.parse('https://192.168.1.7:3000/api/get-attendances'),
        headers: headres);

    homeResponseModel = HomeResponseModel.fromJson(json.decode(response.body));
    history.clear();
    homeResponseModel!.data.forEach((element) {
      if (element.isToday) {
        today = element;
      } else {
        history.add(element);
      }
    });
  }
}
