import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';

import '../controllers/attendance_controller.dart';

class AttendanceView extends GetView<AttendanceController> {
  const AttendanceView({Key? key});

  @override
  Widget build(BuildContext context) {
    Get.put(AttendanceController());
    return Scaffold(
      backgroundColor: Colors.white,
      body: FutureBuilder<LatLng?>(
        future: controller.getCurrentLocation(),
        builder: (BuildContext context, AsyncSnapshot<LatLng?> snapshot) {
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

          final LatLng currentLocation = snapshot.data!;

          Set<Circle> circles = Set.from([
            const Circle(
              circleId: CircleId('currentCircle'),
              center: LatLng(-7.3585689, 112.7413656),
              radius: 10,
            )
          ]);
          return Column(
            children: [
              Expanded(
                child: Stack(
                  children: [
                    SizedBox(
                      height: 377,
                      child: GoogleMap(
                        mapType: MapType.normal,
                        myLocationEnabled: true,
                        myLocationButtonEnabled: true,
                        initialCameraPosition: CameraPosition(
                          target: currentLocation,
                          zoom: 25,
                        ),
                        onCameraMove: null,
                        circles: circles,
                        markers: {
                          Marker(
                            markerId: const MarkerId('currentLocation'),
                            position: currentLocation,
                            icon: BitmapDescriptor.defaultMarkerWithHue(
                              BitmapDescriptor.hueRed,
                            ),
                          ),
                        },
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.only(top: 500),
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
                              child: const Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
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
                              child: const Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
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
                      bottom: 240,
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
                          child: const Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              // Removed the Icon widget here
                              SizedBox(width: 16),
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Padding(
                                    padding: EdgeInsets.only(top: 10),
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
                      bottom: 60,
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
                              onPressed: () async {
                                double distance = controller.calculateDistance(
                                  currentLocation.latitude,
                                  currentLocation.longitude,
                                  -7.3585689,
                                  112.7413656,
                                );
                                if (distance <= 10) {
                                  controller.saveAttendance(
                                    context,
                                    currentLocation.latitude,
                                    currentLocation.longitude,
                                  );
                                } else {
                                  showDialog(
                                    context: context,
                                    builder: (BuildContext context) {
                                      return AlertDialog(
                                        title: const Text('Error'),
                                        content: const Text(
                                            'You are more than 10 meters away from the office.'),
                                        actions: [
                                          TextButton(
                                            onPressed: () {
                                              Navigator.of(context).pop();
                                            },
                                            child: const Text('OK'),
                                          ),
                                        ],
                                      );
                                    },
                                  );
                                }
                              },
                              style: ButtonStyle(
                                backgroundColor:
                                    MaterialStateProperty.all<Color>(
                                  const Color(0xFF3559A0),
                                ),
                              ),
                              child: const Text(
                                "Clock In",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          );
        },
      ),
    );
  }
}
