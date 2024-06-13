import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/login_controller.dart';

class LoginView extends GetView<LoginController> {
  const LoginView({super.key});

  @override
  Widget build(BuildContext context) {
    return GetBuilder<LoginController>(builder: (controller) {
      return Scaffold(
        backgroundColor: const Color(0xFFB9CFFC),
        body: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Image(
                    image: AssetImage('assets/images/login.png'),
                  ),
                  const Padding(
                    padding: EdgeInsets.only(left: 30.0),
                    child: Text(
                      "Login",
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
                      "Hello there, login to continue!",
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
                        color: Colors.white.withOpacity(0.48),
                        borderRadius: BorderRadius.circular(32.0),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.6),
                              borderRadius: BorderRadius.circular(16.0),
                            ),
                            child: Padding(
                              padding: const EdgeInsets.all(0),
                              child: TextFormField(
                                controller: controller.email,
                                decoration: InputDecoration(
                                  prefixIcon:
                                      const Icon(Icons.alternate_email_rounded),
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
                              color: Colors.white.withOpacity(0.6),
                              borderRadius: BorderRadius.circular(16.0),
                            ),
                            child: Padding(
                              padding: const EdgeInsets.all(0),
                              child: Obx(() => TextFormField(
                                    controller: controller.password,
                                    obscureText: !controller.isPasswordVisible
                                        .value, // Use the observable
                                    decoration: InputDecoration(
                                      prefixIcon: const Icon(
                                          Icons.lock_outline_rounded),
                                      labelText: "Password",
                                      hintText: "Password",
                                      border: OutlineInputBorder(
                                        borderRadius:
                                            BorderRadius.circular(16.0),
                                      ),
                                      suffixIcon: IconButton(
                                        onPressed: () {
                                          controller
                                              .togglePasswordVisibility(); // Toggle password visibility
                                        },
                                        icon: Icon(
                                          controller.isPasswordVisible.value
                                              ? Icons.visibility
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
                      color: const Color(0xFFEDF0F6),
                      child: SizedBox(
                        width: 210,
                        height: 52,
                        child: ElevatedButton(
                          onPressed: () {
                            controller.login(controller.email.text,
                                controller.password.text);
                          },
                          style: ButtonStyle(
                            backgroundColor: MaterialStateProperty.all<Color>(
                                const Color(0xFF3559A0)),
                          ),
                          child: const Text(
                            "Login",
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
