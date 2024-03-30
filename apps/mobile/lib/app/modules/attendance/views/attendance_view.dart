import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:location/location.dart';
import 'package:syncfusion_flutter_maps/maps.dart';

import '../controllers/attendance_controller.dart';

class AttendanceView extends GetView<AttendanceController> {
  const AttendanceView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Get.put(AttendanceController());
    return Scaffold(
      backgroundColor: Colors.white,
      body: FutureBuilder<LocationData?>(
          future: controller.getCurrentLocation(),
          builder:
              (BuildContext context, AsyncSnapshot<LocationData?> snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return const Center(
                child: CircularProgressIndicator(),
              );
            } else if (snapshot.hasError) {
              return const Center(
                child: Text('Error fetching location data'),
              );
            } else if (!snapshot.hasData || snapshot.data == null) {
              return const Center(
                child: Text('Location data unavailable'),
              );
            }

            final LocationData currentLocation = snapshot.data!;
            return Column(
              children: [
                Expanded(
                  child: Stack(children: [
                    Container(
                      height: 377,
                      child: SfMaps(
                        layers: [
                          MapTileLayer(
                            initialFocalLatLng: MapLatLng(
                              currentLocation.latitude!,
                              currentLocation.longitude!,
                            ),
                            initialZoomLevel: 15,
                            initialMarkersCount: 1,
                            urlTemplate:
                                "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
                            markerBuilder: (BuildContext context, int index) {
                              return MapMarker(
                                latitude: currentLocation.latitude!,
                                longitude: currentLocation.longitude!,
                                child: const Icon(
                                  Icons.location_on,
                                  color: Colors.red,
                                ),
                              );
                            },
                          )
                        ],
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.only(top: 440),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          Material(
                            elevation: 5,
                            borderRadius: BorderRadius.circular(20),
                            color: const Color(0xFFEDF0F6),
                            child: Container(
                              padding: const EdgeInsets.all(8),
                              width: 103,
                              height: 82,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: const [
                                  SizedBox(
                                    height: 8,
                                  ),
                                  Text(
                                    "Clock In",
                                    style: TextStyle(
                                      fontSize: 16.0,
                                      fontWeight: FontWeight.w500,
                                      color: Color(0xFF000000),
                                    ),
                                  ),
                                  SizedBox(
                                    height: 8,
                                  ),
                                  Text(
                                    "07 : 49",
                                    style: TextStyle(
                                      fontSize: 18.0,
                                      fontWeight: FontWeight.w600,
                                      color: Colors.green,
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Material(
                            elevation: 5,
                            borderRadius: BorderRadius.circular(20),
                            color: const Color(0xFFEDF0F6),
                            child: Container(
                              padding: const EdgeInsets.all(8),
                              width: 103,
                              height: 82,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: const [
                                  SizedBox(
                                    height: 8,
                                  ),
                                  Text(
                                    "Clock Out",
                                    style: TextStyle(
                                      fontSize: 16.0,
                                      fontWeight: FontWeight.w500,
                                      color: Color(0xFF000000),
                                    ),
                                  ),
                                  SizedBox(
                                    height: 8,
                                  ),
                                  Text(
                                    "-- : --",
                                    style: TextStyle(
                                      fontSize: 18.0,
                                      fontWeight: FontWeight.w600,
                                      color: Colors.red,
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    Positioned(
                      bottom: 330,
                      left: 0,
                      right: 0,
                      child: Center(
                        child: Container(
                          width: 297,
                          height: MediaQuery.of(context).size.height / 11.4,
                          decoration: const BoxDecoration(
                            borderRadius: BorderRadius.all(
                              Radius.circular(15),
                            ),
                            image: DecorationImage(
                              image: AssetImage(
                                  'assets/images/locationContainer.png'),
                              fit: BoxFit.cover,
                            ),
                          ),
                          child: Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              // Removed the Icon widget here
                              const SizedBox(width: 16),
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Padding(
                                    padding: const EdgeInsets.only(top: 10),
                                    child: Text(
                                      "Location",
                                      style: TextStyle(
                                        fontSize: 16.0,
                                        fontWeight: FontWeight.bold,
                                        color: Color(0xFFFFFFFF),
                                      ),
                                    ),
                                  ),
                                  Text(
                                    "Delta Pelangi 3 No 29, Deltasari, Waru",
                                    style: TextStyle(
                                      fontSize: 14.0,
                                      fontWeight: FontWeight.w500,
                                      color: Color(0xFFFFFFFF),
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    Positioned(
                      bottom: 140,
                      left: 0,
                      right: 0,
                      child: Center(
                        child: Material(
                          elevation: 8,
                          borderRadius: BorderRadius.circular(24),
                          color: const Color(0xFF3559A0),
                          child: SizedBox(
                            width: 200,
                            height: 52,
                            child: ElevatedButton(
                              onPressed: () {
                                controller.saveAttendance(
                                  context,
                                  currentLocation.latitude!,
                                  currentLocation.longitude!,
                                );
                              },
                              child: const Text(
                                "Clock In",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                              style: ButtonStyle(
                                backgroundColor:
                                    MaterialStateProperty.all<Color>(
                                  const Color(0xFF3559A0),
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ]),
                ),
              ],
            );
          }),
    );
  }
}
