import 'package:flutter/material.dart';

import 'package:get/get.dart';

import '../controllers/home_controller.dart';

class HomeView extends GetView<HomeController> {
  const HomeView({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFFB9CFFC),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.fromLTRB(200, 50, 0, 0),
            child: Text(
              "Monday, 12/02/2024",
              style: TextStyle(
                fontSize: 16.0,
                fontWeight: FontWeight.normal,
                color: Color(0xFF000000),
              ),
            ),
          ),
          Container(
            child: Row(
              children: [
                Icon(Icons.person_2_rounded),
                const Column(
                  children: [
                    Padding(
                      padding: EdgeInsets.fromLTRB(50, 30, 0, 0),
                      child: Text(
                        "Violia Ruana",
                        style: TextStyle(
                          fontSize: 18.0,
                          fontWeight: FontWeight.bold,
                          color: Color(0xFF000000),
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.fromLTRB(50, 10, 0, 0),
                      child: Text(
                        "IT Intern",
                        style: TextStyle(
                          fontSize: 16.0,
                          fontWeight: FontWeight.normal,
                          color: Color(0xFF000000),
                        ),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
          Stack(children: [
            Container(
              width: double.infinity,
              height: 400,
              color: Colors.white,
            ),
            Row(
              children: [],
            ),
          ])
        ],
      ),
    );
  }
}
