import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/acc_clock_in_controller.dart';

class AccClockInView extends GetView<AccClockInController> {
  const AccClockInView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFB9CFFC),
      body: Column(
        children: [
          Expanded(
            child: Stack(
              children: [
                Padding(
                  padding: const EdgeInsets.only(top: 350),
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 24),
                    width: double.infinity,
                    height: double.infinity,
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: const BorderRadius.only(
                        topLeft: Radius.circular(50),
                        topRight: Radius.circular(50),
                      ),
                    ),
                    child: Padding(
                      padding: const EdgeInsets.only(bottom: 140),
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
                  ),
                ),
                Positioned(
                  bottom: 370,
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
                          image:
                              AssetImage('assets/images/locationContainer.png'),
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
                  bottom: 160,
                  left: 0,
                  right: 0,
                  child: Center(
                    child: Material(
                      elevation: 8,
                      borderRadius: BorderRadius.circular(24),
                      color: const Color(0xFFEDF0F6),
                      child: SizedBox(
                        width: 263,
                        height: 52,
                        child: ElevatedButton(
                          onPressed: () {},
                          child: const Text(
                            "Clock Out",
                            style: TextStyle(
                              color: Colors.white,
                              fontSize: 24.0,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          style: ButtonStyle(
                            backgroundColor: MaterialStateProperty.all<Color>(
                              const Color(0xFF3559A0),
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
      ),
    );
  }
}
