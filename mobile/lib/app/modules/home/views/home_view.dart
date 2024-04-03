import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/home_controller.dart';

class HomeView extends StatelessWidget {
  const HomeView({super.key});
  @override
  Widget build(BuildContext context) {
    final HomeController controller = Get.put(HomeController());

    final size = MediaQuery.of(context).size;
    final height = size.height;
    final width = size.width;
    return Scaffold(
      body: FutureBuilder(
          future: controller.getData(),
          builder: (context, snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return const Center(child: CircularProgressIndicator());
            } else {
              return Scaffold(
                backgroundColor: const Color(0xFFB9CFFC),
                body: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Padding(
                      padding: const EdgeInsets.fromLTRB(170, 50, 0, 0),
                      child: Text(
                        controller.formatDate(DateTime.now()),
                        style: TextStyle(
                          fontSize: 16.0,
                          fontWeight: FontWeight.w500,
                          color: const Color(0xFF000000).withOpacity(0.7),
                        ),
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.fromLTRB(26, 20, 0, 0),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(100),
                              border: Border.all(
                                width: 2,
                                color: Colors.black,
                              ),
                            ),
                            child: ClipRRect(
                              borderRadius: BorderRadius.circular(100),
                              child: const Image(
                                image: AssetImage('assets/images/profile.jpg'),
                                fit: BoxFit.cover,
                                width: 60,
                                height: 60,
                              ),
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(left: 20),
                            child: Obx(() {
                              return Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    controller.name.value,
                                    style: TextStyle(
                                      fontSize: 16.0,
                                      fontWeight: FontWeight.w500,
                                      color: const Color(0xFF000000)
                                          .withOpacity(0.7),
                                    ),
                                  ),
                                  Padding(
                                    padding: const EdgeInsets.only(top: 4),
                                    child: Text(
                                      "IT Intern",
                                      style: TextStyle(
                                        fontSize: 16.0,
                                        fontWeight: FontWeight.normal,
                                        color: const Color(0xFF000000)
                                            .withOpacity(0.7),
                                      ),
                                    ),
                                  ),
                                ],
                              );
                            }),
                          ),
                        ],
                      ),
                    ),
                    const Expanded(child: SizedBox(height: 30)),
                    Stack(
                      children: [
                        Column(
                          children: [
                            const SizedBox(
                              height: 71 / 2,
                            ),
                            Container(
                              padding:
                                  const EdgeInsets.symmetric(horizontal: 24),
                              width: double.infinity,
                              height: 520,
                              decoration: const BoxDecoration(
                                color: Colors.white,
                                borderRadius: BorderRadius.only(
                                  topLeft: Radius.circular(50),
                                  topRight: Radius.circular(50),
                                ),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const SizedBox(height: 50),
                                  const Text(
                                    "Today Attendance",
                                    style: TextStyle(
                                      fontSize: 18.0,
                                      fontWeight: FontWeight.w600,
                                      color: Color(0xFF000000),
                                    ),
                                  ),
                                  const SizedBox(height: 20),
                                  Row(
                                    mainAxisAlignment:
                                        MainAxisAlignment.spaceBetween,
                                    children: [
                                      Material(
                                        elevation: 8,
                                        borderRadius: BorderRadius.circular(20),
                                        color: const Color(0xFFEDF0F6),
                                        child: Container(
                                          padding: const EdgeInsets.all(16),
                                          width: 162,
                                          height: 130,
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                children: [
                                                  Container(
                                                    padding:
                                                        const EdgeInsets.all(2),
                                                    decoration: BoxDecoration(
                                                      color: const Color(
                                                          0xFFC7D2E7),
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              8),
                                                    ),
                                                    child: const Icon(
                                                        Icons.login_rounded),
                                                  ),
                                                  const SizedBox(
                                                    width: 8,
                                                  ),
                                                  Text(
                                                    "Clock In",
                                                    style: TextStyle(
                                                      fontSize: 16.0,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      color: const Color(
                                                              0xFF000000)
                                                          .withOpacity(0.65),
                                                    ),
                                                  )
                                                ],
                                              ),
                                              const SizedBox(
                                                height: 16,
                                              ),
                                              Obx(
                                                () => Text(
                                                  controller.getHHmm(controller
                                                      .today.value?.clockIn),
                                                  style: const TextStyle(
                                                    fontSize: 18.0,
                                                    fontWeight: FontWeight.w600,
                                                    color: Color(0xFF000000),
                                                  ),
                                                ),
                                              ),
                                              const SizedBox(
                                                height: 8,
                                              ),
                                              Text(
                                                "On Time",
                                                style: TextStyle(
                                                  fontSize: 14.0,
                                                  fontWeight: FontWeight.w500,
                                                  color: const Color(0xFF000000)
                                                      .withOpacity(0.5),
                                                ),
                                              )
                                            ],
                                          ),
                                        ),
                                      ),
                                      Material(
                                        elevation: 8,
                                        borderRadius: BorderRadius.circular(20),
                                        color: const Color(0xFFEDF0F6),
                                        child: Container(
                                          padding: const EdgeInsets.all(16),
                                          width: 162,
                                          height: 130,
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                children: [
                                                  Container(
                                                    padding:
                                                        const EdgeInsets.all(2),
                                                    decoration: BoxDecoration(
                                                      color: const Color(
                                                          0xFFC7D2E7),
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              8),
                                                    ),
                                                    child: const Icon(
                                                        Icons.logout_rounded),
                                                  ),
                                                  const SizedBox(
                                                    width: 8,
                                                  ),
                                                  Text(
                                                    "Clock Out",
                                                    style: TextStyle(
                                                      fontSize: 16.0,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      color: const Color(
                                                              0xFF000000)
                                                          .withOpacity(0.65),
                                                    ),
                                                  )
                                                ],
                                              ),
                                              const SizedBox(
                                                height: 16,
                                              ),
                                              Obx(
                                                () => Text(
                                                  controller.getHHmm(controller
                                                      .today.value?.clockOut),
                                                  style: const TextStyle(
                                                    fontSize: 18.0,
                                                    fontWeight: FontWeight.w600,
                                                    color: Color(0xFF000000),
                                                  ),
                                                ),
                                              ),
                                              const SizedBox(
                                                height: 8,
                                              ),
                                              Text(
                                                "On Time",
                                                style: TextStyle(
                                                  fontSize: 14.0,
                                                  fontWeight: FontWeight.w500,
                                                  color: const Color(0xFF000000)
                                                      .withOpacity(0.5),
                                                ),
                                              )
                                            ],
                                          ),
                                        ),
                                      ),
                                    ],
                                  ),
                                  const SizedBox(height: 24),
                                  Row(
                                    mainAxisAlignment:
                                        MainAxisAlignment.spaceBetween,
                                    children: [
                                      Material(
                                        elevation: 8,
                                        borderRadius: BorderRadius.circular(20),
                                        color: const Color(0xFFEDF0F6),
                                        child: Container(
                                          padding: const EdgeInsets.all(16),
                                          width: 162,
                                          height: 130,
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                children: [
                                                  Container(
                                                    padding:
                                                        const EdgeInsets.all(2),
                                                    decoration: BoxDecoration(
                                                      color: const Color(
                                                          0xFFC7D2E7),
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              8),
                                                    ),
                                                    child: const Icon(Icons
                                                        .timelapse_rounded),
                                                  ),
                                                  const SizedBox(
                                                    width: 8,
                                                  ),
                                                  Text(
                                                    "Total Leaves",
                                                    style: TextStyle(
                                                      fontSize: 16.0,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      color: const Color(
                                                              0xFF000000)
                                                          .withOpacity(0.65),
                                                    ),
                                                  )
                                                ],
                                              ),
                                              const SizedBox(
                                                height: 16,
                                              ),
                                              const Text(
                                                "2",
                                                style: TextStyle(
                                                  fontSize: 18.0,
                                                  fontWeight: FontWeight.w600,
                                                  color: Color(0xFF000000),
                                                ),
                                              ),
                                              const SizedBox(
                                                height: 8,
                                              ),
                                              Text(
                                                "Times",
                                                style: TextStyle(
                                                  fontSize: 14.0,
                                                  fontWeight: FontWeight.w500,
                                                  color: const Color(0xFF000000)
                                                      .withOpacity(0.5),
                                                ),
                                              )
                                            ],
                                          ),
                                        ),
                                      ),
                                      Material(
                                        elevation: 8,
                                        borderRadius: BorderRadius.circular(20),
                                        color: const Color(0xFFEDF0F6),
                                        child: Container(
                                          padding: const EdgeInsets.all(16),
                                          width: 162,
                                          height: 130,
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                children: [
                                                  Container(
                                                    padding:
                                                        const EdgeInsets.all(2),
                                                    decoration: BoxDecoration(
                                                      color: const Color(
                                                          0xFFC7D2E7),
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              8),
                                                    ),
                                                    child: const Icon(Icons
                                                        .calendar_month_rounded),
                                                  ),
                                                  const SizedBox(
                                                    width: 8,
                                                  ),
                                                  Text(
                                                    "Total Days",
                                                    style: TextStyle(
                                                      fontSize: 16.0,
                                                      fontWeight:
                                                          FontWeight.w500,
                                                      color: const Color(
                                                              0xFF000000)
                                                          .withOpacity(0.65),
                                                    ),
                                                  )
                                                ],
                                              ),
                                              const SizedBox(
                                                height: 16,
                                              ),
                                              const Text(
                                                "12",
                                                style: TextStyle(
                                                  fontSize: 18.0,
                                                  fontWeight: FontWeight.w600,
                                                  color: Color(0xFF000000),
                                                ),
                                              ),
                                              const SizedBox(
                                                height: 8,
                                              ),
                                              Text(
                                                "Working Days",
                                                style: TextStyle(
                                                  fontSize: 14.0,
                                                  fontWeight: FontWeight.w500,
                                                  color: const Color(0xFF000000)
                                                      .withOpacity(0.5),
                                                ),
                                              )
                                            ],
                                          ),
                                        ),
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                        Center(
                          child: Container(
                            width: 297,
                            height: height / 11.4,
                            decoration: const BoxDecoration(
                              borderRadius: BorderRadius.all(
                                Radius.circular(15),
                              ), // fixed radius syntax
                              image: DecorationImage(
                                image: AssetImage(
                                    'assets/images/locationContainer.png'), // Image asset
                                fit: BoxFit.cover, // Image fit property
                              ),
                            ),
                            child: const Row(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Padding(
                                  padding: EdgeInsets.fromLTRB(
                                      15, 16, 5, 0), // Padding for the icon
                                  child: Icon(
                                    Icons.location_on,
                                    color: Colors.white,
                                    size: 35,
                                  ),
                                ),
                                SizedBox(width: 10),
                                Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Padding(
                                      padding: EdgeInsets.only(
                                          top:
                                              10), // Padding for the "Location" text
                                      child: Text(
                                        "Location",
                                        style: TextStyle(
                                          fontSize: 16.0,
                                          fontWeight: FontWeight.normal,
                                          color: Color(0xFFFFFFFF),
                                        ),
                                      ),
                                    ), // Padding for the "Waru, Sidoarjo" text
                                    Text(
                                      "Waru, Sidoarjo",
                                      style: TextStyle(
                                        fontSize: 18.0,
                                        fontWeight: FontWeight.w600,
                                        color: Colors.white,
                                      ),
                                    ),
                                  ],
                                ),
                              ],
                            ),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              );
            }
          }),
    );
  }
}
