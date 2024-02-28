import 'package:flutter/material.dart';

class HomeView extends StatefulWidget {
  const HomeView({Key? key}) : super(key: key);
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    final height = size.height;
    final width = size.width;
    return Scaffold(
      body: Builder(
        builder: (BuildContext context) => Scaffold(
          backgroundColor: const Color(0xFFB9CFFC),
          body: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Padding(
                padding: const EdgeInsets.fromLTRB(200, 50, 0, 0),
                child: Text(
                  "Monday, 12/02/2024",
                  style: TextStyle(
                    fontSize: 16.0,
                    fontWeight: FontWeight.normal,
                    color: Color(0xFF000000).withOpacity(0.7),
                  ),
                ),
              ),
              Padding(
                padding: const EdgeInsets.fromLTRB(26, 10, 0, 0),
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
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Violia Ruana",
                            style: TextStyle(
                              fontSize: 18.0,
                              fontWeight: FontWeight.w600,
                              color: Color(0xFF000000),
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(top: 4),
                            child: Text(
                              "IT Intern",
                              style: TextStyle(
                                fontSize: 16.0,
                                fontWeight: FontWeight.normal,
                                color: Color(0xFF000000).withOpacity(0.7),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
              Expanded(child: SizedBox(height: 30)),
              Stack(
                children: [
                  Column(
                    children: [
                      SizedBox(
                        height: 71 / 2,
                      ),
                      Container(
                        padding: EdgeInsets.symmetric(horizontal: 24),
                        width: double.infinity,
                        height: 530,
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(50),
                            topRight: Radius.circular(50),
                          ),
                        ),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            SizedBox(height: 50),
                            Text(
                              "Today Attendance",
                              style: TextStyle(
                                fontSize: 18.0,
                                fontWeight: FontWeight.w600,
                                color: Color(0xFF000000),
                              ),
                            ),
                            SizedBox(height: 20),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Material(
                                  elevation: 8,
                                  borderRadius: BorderRadius.circular(20),
                                  color: Color(0xFFEDF0F6),
                                  child: Container(
                                    padding: EdgeInsets.all(16),
                                    width: 162,
                                    height: 130,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Row(
                                          children: [
                                            Container(
                                              padding: EdgeInsets.all(2),
                                              decoration: BoxDecoration(
                                                color: Color(0xFFC7D2E7),
                                                borderRadius:
                                                    BorderRadius.circular(8),
                                              ),
                                              child: Icon(Icons.login_rounded),
                                            ),
                                            SizedBox(
                                              width: 8,
                                            ),
                                            Text(
                                              "Clock In",
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.w500,
                                                color: Color(0xFF000000)
                                                    .withOpacity(0.65),
                                              ),
                                            )
                                          ],
                                        ),
                                        SizedBox(
                                          height: 16,
                                        ),
                                        Text(
                                          "07:49",
                                          style: TextStyle(
                                            fontSize: 18.0,
                                            fontWeight: FontWeight.w600,
                                            color: Color(0xFF000000),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 8,
                                        ),
                                        Text(
                                          "On Time",
                                          style: TextStyle(
                                            fontSize: 14.0,
                                            fontWeight: FontWeight.w500,
                                            color: Color(0xFF000000)
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
                                  color: Color(0xFFEDF0F6),
                                  child: Container(
                                    padding: EdgeInsets.all(16),
                                    width: 162,
                                    height: 130,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Row(
                                          children: [
                                            Container(
                                              padding: EdgeInsets.all(2),
                                              decoration: BoxDecoration(
                                                color: Color(0xFFC7D2E7),
                                                borderRadius:
                                                    BorderRadius.circular(8),
                                              ),
                                              child: Icon(Icons.logout_rounded),
                                            ),
                                            SizedBox(
                                              width: 8,
                                            ),
                                            Text(
                                              "Clock Out",
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.w500,
                                                color: Color(0xFF000000)
                                                    .withOpacity(0.65),
                                              ),
                                            )
                                          ],
                                        ),
                                        SizedBox(
                                          height: 16,
                                        ),
                                        Text(
                                          "18:00",
                                          style: TextStyle(
                                            fontSize: 18.0,
                                            fontWeight: FontWeight.w600,
                                            color: Color(0xFF000000),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 8,
                                        ),
                                        Text(
                                          "On Time",
                                          style: TextStyle(
                                            fontSize: 14.0,
                                            fontWeight: FontWeight.w500,
                                            color: Color(0xFF000000)
                                                .withOpacity(0.5),
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ),
                              ],
                            ),
                            SizedBox(height: 24),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Material(
                                  elevation: 8,
                                  borderRadius: BorderRadius.circular(20),
                                  color: Color(0xFFEDF0F6),
                                  child: Container(
                                    padding: EdgeInsets.all(16),
                                    width: 162,
                                    height: 130,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Row(
                                          children: [
                                            Container(
                                              padding: EdgeInsets.all(2),
                                              decoration: BoxDecoration(
                                                color: Color(0xFFC7D2E7),
                                                borderRadius:
                                                    BorderRadius.circular(8),
                                              ),
                                              child:
                                                  Icon(Icons.timelapse_rounded),
                                            ),
                                            SizedBox(
                                              width: 8,
                                            ),
                                            Text(
                                              "Total Leaves",
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.w500,
                                                color: Color(0xFF000000)
                                                    .withOpacity(0.65),
                                              ),
                                            )
                                          ],
                                        ),
                                        SizedBox(
                                          height: 16,
                                        ),
                                        Text(
                                          "2",
                                          style: TextStyle(
                                            fontSize: 18.0,
                                            fontWeight: FontWeight.w600,
                                            color: Color(0xFF000000),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 8,
                                        ),
                                        Text(
                                          "Times",
                                          style: TextStyle(
                                            fontSize: 14.0,
                                            fontWeight: FontWeight.w500,
                                            color: Color(0xFF000000)
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
                                  color: Color(0xFFEDF0F6),
                                  child: Container(
                                    padding: EdgeInsets.all(16),
                                    width: 162,
                                    height: 130,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Row(
                                          children: [
                                            Container(
                                              padding: EdgeInsets.all(2),
                                              decoration: BoxDecoration(
                                                color: Color(0xFFC7D2E7),
                                                borderRadius:
                                                    BorderRadius.circular(8),
                                              ),
                                              child: Icon(
                                                  Icons.calendar_month_rounded),
                                            ),
                                            SizedBox(
                                              width: 8,
                                            ),
                                            Text(
                                              "Total Days",
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.w500,
                                                color: Color(0xFF000000)
                                                    .withOpacity(0.65),
                                              ),
                                            )
                                          ],
                                        ),
                                        SizedBox(
                                          height: 16,
                                        ),
                                        Text(
                                          "12",
                                          style: TextStyle(
                                            fontSize: 18.0,
                                            fontWeight: FontWeight.w600,
                                            color: Color(0xFF000000),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 8,
                                        ),
                                        Text(
                                          "Working Days",
                                          style: TextStyle(
                                            fontSize: 14.0,
                                            fontWeight: FontWeight.w500,
                                            color: Color(0xFF000000)
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
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(
                          Radius.circular(15),
                        ), // fixed radius syntax
                        image: DecorationImage(
                          image: AssetImage(
                              'assets/images/locationContainer.png'), // Image asset
                          fit: BoxFit.cover, // Image fit property
                        ),
                      ),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Padding(
                            padding: const EdgeInsets.fromLTRB(
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
                                padding: const EdgeInsets.only(
                                    top: 10), // Padding for the "Location" text
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
        ),
      ),
    );
  }

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    throw UnimplementedError();
  }
}
