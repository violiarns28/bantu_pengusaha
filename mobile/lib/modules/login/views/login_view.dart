import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/login_controller.dart'; // Mengimpor controller yang digunakan

class LoginView extends GetView<LoginController> {
  // Menggunakan GetView dan mengaitkan dengan LoginController
  const LoginView({super.key});

  @override
  Widget build(BuildContext context) {
    return GetBuilder<LoginController>(builder: (controller) {
      // Menggunakan GetBuilder untuk mendapatkan state dari controller
      return Scaffold(
        backgroundColor:
            const Color(0xFFB9CFFC), // Warna latar belakang Scaffold
        body: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Image(
                    image:
                        AssetImage('assets/images/login.png'), // Gambar header
                  ),
                  const Padding(
                    padding: EdgeInsets.only(left: 30.0),
                    child: Text(
                      "Login", // Judul halaman login
                      style: TextStyle(
                        fontSize: 24.0,
                        fontWeight: FontWeight.bold,
                        color: Color(0xFF000000),
                      ),
                    ),
                  ),
                  const Padding(
                    padding: EdgeInsets.only(left: 30.0),
                    child: Text(
                      "Hello there, login to continue!", // Subjudul
                      style: TextStyle(
                        fontSize: 15.0,
                        fontWeight: FontWeight.normal,
                        color: Color(0xFF000000),
                      ),
                    ),
                  ),
                  Center(
                    child: Container(
                      padding: const EdgeInsets.all(24.0),
                      margin: const EdgeInsets.all(24.0),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(
                            0.48), // Warna latar belakang kontainer login
                        borderRadius: BorderRadius.circular(32.0),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(
                                  0.6), // Warna latar belakang field email
                              borderRadius: BorderRadius.circular(16.0),
                            ),
                            child: Padding(
                              padding: const EdgeInsets.all(0),
                              child: TextFormField(
                                controller: controller
                                    .email, // Menghubungkan dengan controller email dari LoginController
                                decoration: InputDecoration(
                                  prefixIcon: const Icon(Icons
                                      .alternate_email_rounded), // Icon email
                                  labelText: "Email",
                                  hintText: "Email",
                                  border: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(16.0),
                                  ),
                                  hintStyle: const TextStyle(
                                    fontSize: 16.0,
                                    fontWeight: FontWeight.normal,
                                  ),
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(height: 16.0),
                          Container(
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(
                                  0.6), // Warna latar belakang field password
                              borderRadius: BorderRadius.circular(16.0),
                            ),
                            child: Padding(
                              padding: const EdgeInsets.all(0),
                              child: Obx(() => TextFormField(
                                    controller: controller
                                        .password, // Menghubungkan dengan controller password dari LoginController
                                    obscureText: !controller.isPasswordVisible
                                        .value, // Menggunakan observable untuk menentukan visibilitas password
                                    decoration: InputDecoration(
                                      prefixIcon: const Icon(Icons
                                          .lock_outline_rounded), // Icon password
                                      labelText: "Password",
                                      hintText: "Password",
                                      border: OutlineInputBorder(
                                        borderRadius:
                                            BorderRadius.circular(16.0),
                                      ),
                                      suffixIcon: IconButton(
                                        onPressed: () {
                                          controller
                                              .togglePasswordVisibility(); // Tombol untuk mengubah visibilitas password
                                        },
                                        icon: Icon(
                                          controller.isPasswordVisible.value
                                              ? Icons
                                                  .visibility // Icon visibilitas password
                                              : Icons.visibility_off,
                                        ),
                                      ),
                                    ),
                                  )),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                  Center(
                    child: Material(
                      elevation: 8,
                      borderRadius: BorderRadius.circular(24),
                      color: const Color(0xFFEDF0F6), // Warna tombol login
                      child: SizedBox(
                        width: 210,
                        height: 52,
                        child: ElevatedButton(
                          onPressed: () {
                            controller.login(
                                controller.email
                                    .text, // Tombol untuk memanggil fungsi login dari LoginController
                                controller.password.text);
                          },
                          style: ButtonStyle(
                            backgroundColor: MaterialStateProperty.all<Color>(
                                const Color(0xFF3559A0)), // Warna tombol login
                          ),
                          child: const Text(
                            "Login", // Teks pada tombol login
                            style: TextStyle(
                                color: Colors.white,
                                fontSize: 20.0,
                                fontWeight: FontWeight.w500),
                          ),
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      );
    });
  }
}
