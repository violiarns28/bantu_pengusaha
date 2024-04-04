import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:geocoding/geocoding.dart' hide Location;
import 'package:get/get.dart';
import 'package:location/location.dart';

class LocationService extends GetxService {
  late Location location;

  Future<LocationService> init() async {
    location = Location();
    return this;
  }

  @override
  void onInit() {
    log.e('Initializing LocationService 🚀');
    super.onInit();
  }

  @override
  void onClose() {
    log.e('Closing LocationService 🚀');
    super.onClose();
  }

  Future<LocationData?> getLocation() async {
    bool isOk = await requestPermission();
    if (isOk) {
      return await location.getLocation();
    } else {
      return Future.value(null);
    }
  }

  Future<List<Placemark>> locationFromCoor(
      double latitude, double longitude) async {
    return await placemarkFromCoordinates(latitude, longitude);
  }

  Future<bool> requestPermission() async {
    bool serviceEnabled = await location.serviceEnabled();
    if (!serviceEnabled) {
      serviceEnabled = await location.requestService();
    }

    PermissionStatus permissionGranted = await location.hasPermission();

    if (permissionGranted == PermissionStatus.granted) {
      return true;
    } else if (permissionGranted == PermissionStatus.grantedLimited) {
      return true;
    } else {
      permissionGranted = await location.requestPermission();
      return false;
    }
  }
}
