import 'package:bantu_pengusaha/core/sources/sources.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../data/models/home_response.dart';

class HomeController extends GetxController {
  SharedPreferences? _prefs;
  final name = "".obs;
  final _token = "".obs;
  Rx<HistoryData?> today = Rx<HistoryData?>(null);
  List<HistoryData> history = [];
  final network = Network();

  @override
  void onInit() {
    initializeSP();
    super.onInit();
  }

  void initializeSP() async {
    _prefs ??= await SharedPreferences.getInstance();
    final tRes = _prefs!.getString("token") ?? "";
    _token.value = tRes;
    final nRes = _prefs!.getString("name") ?? "";
    name.value = nRes;
  }

  Future<void> getData() async {
    history.clear();
    history = await network.getAttendances();
    final now = DateTime.now();
    for (var element in history) {
      if (element.date.day == now.day) {
        today.value = element;
      } else {
        history.add(element);
      }
    }
  }

  String formatDate(DateTime date) {
    final formatter = DateFormat('EEEE, dd MMMM yyyy');
    return formatter.format(date);
  }

  String getHHmm(String? time) {
    if (time == null) return "-- : --";
    final split = time.split(":");
    return "${split[0]}:${split[1]}";
  }
}
