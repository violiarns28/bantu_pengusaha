import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart';
import 'package:bantu_pengusaha/modules/attendance/attendance.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:geocoding/geocoding.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';

class HomeController extends GetxController {
  final AttendanceRepo _attendanceRepo;
  final LocalService _local;
  final LocationService _locationService;

  HomeController(this._attendanceRepo, this._local, this._locationService);

  final name = "".obs;
  Rx<AttendanceModel?> today = Rx<AttendanceModel?>(null);
  List<AttendanceModel> history = [];

  @override
  void onInit() {
    super.onInit();
    _locationService.requestPermission();
    name.value = _local.getUser()?.name ?? "Folks";
    getData();
  }

  Future<List<Placemark>?> getCurrentLocation() async {
    final aC = Get.find<AttendanceController>();

    final coor = await Future.delayed(const Duration(seconds: 1), () {
      return aC.loc.value;
    });

    // final coor = await _locationService.getLocation();
    if (coor == null) {
      Get.snackbar("Error", "Failed to get location");
      return null;
    } else {
      final pMarks = await _locationService.locationFromCoor(
          coor.latitude ?? 0, coor.longitude ?? 0);
      for (var i in pMarks) {
        log.e('PLACEMARKS: $i');
      }
      return pMarks;
    }
  }

  Future<void> getData() async {
    history.clear();
    final res = await _attendanceRepo.getAll();

    if (res.success && res.data != null) {
      history = res.data ?? [];
      final now = DateTime.now();
      List<AttendanceModel> elementsToAdd = [];

      for (var element in history) {
        if (element.date.day == now.day) {
          today.value = element;
        } else {
          elementsToAdd.add(element);
        }
      }
      history.addAll(elementsToAdd);
    } else {
      Get.snackbar("Error", res.message);
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
 