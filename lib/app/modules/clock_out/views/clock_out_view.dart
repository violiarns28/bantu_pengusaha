import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/clock_out_controller.dart';

class ClockOutView extends GetView<ClockOutController> {
  const ClockOutView({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFB9CFFC),
      body: Column(
        children: [
          SizedBox(height: 30),
          Expanded(
            child: Stack(
              children: [
                Column(
                  children: [
                    SizedBox(
                      height: 160,
                    ),
                    Expanded(
                      child: Container(
                        padding: EdgeInsets.symmetric(horizontal: 24),
                        width: double.infinity,
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(50),
                            topRight: Radius.circular(50),
                          ),
                        ),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceAround,
                          children: [
                            Material(
                              elevation: 5,
                              borderRadius: BorderRadius.circular(20),
                              color: Color(0xFFEDF0F6),
                              child: Container(
                                padding: EdgeInsets.all(8),
                                width: 103,
                                height: 82,
                                child: Column(
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
                                        color: Color(0xFF2DBF4D),
                                      ),
                                    )
                                  ],
                                ),
                              ),
                            ),
                            Material(
                              elevation: 5,
                              borderRadius: BorderRadius.circular(20),
                              color: Color(0xFFEDF0F6),
                              child: Container(
                                padding: EdgeInsets.all(8),
                                width: 103,
                                height: 82,
                                child: Column(
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
                    ),
                  ],
                ),
                Positioned(
                  bottom: 380,
                  left: 0,
                  right: 0,
                  child: Center(
                    child: Container(
                      width: 297,
                      height: MediaQuery.of(context).size.height / 11.4,
                      decoration: BoxDecoration(
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
                  bottom: 160, // Adjusted the top position
                  left: 0,
                  right: 0,
                  child: Center(
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
                              fontWeight: FontWeight.bold),
                        ),
                        style: ButtonStyle(
                          backgroundColor: MaterialStateProperty.all<Color>(
                              const Color(0xFF3559A0)),
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
