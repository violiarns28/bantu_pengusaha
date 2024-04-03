import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/profile_controller.dart';

class ProfileView extends GetView<ProfileController> {
  const ProfileView({super.key});

  @override
  Widget build(BuildContext context) {
    final ProfileController controller = Get.put(ProfileController());
    final size = MediaQuery.of(context).size;
    final width = size.width;
    return Scaffold(
        body: FutureBuilder(
            future: controller.getData(),
            builder: (context, AsyncSnapshot<dynamic> snapshot) {
              if (snapshot.connectionState == ConnectionState.waiting) {
                return const Center(child: CircularProgressIndicator());
              } else {
                return Scaffold(
                  backgroundColor: const Color(0xFFB9CFFC),
                  body: Stack(children: [
                    Positioned.fill(
                      top: 145,
                      left: 0,
                      right: 0,
                      child: Container(
                        padding: const EdgeInsets.symmetric(horizontal: 24),
                        width: double.infinity,
                        height: double.infinity,
                        decoration: const BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(50),
                            topRight: Radius.circular(50),
                          ),
                        ),
                        child: Obx(
                          () => Column(
                            children: [
                              const SizedBox(height: 56),
                              Text(
                                controller.name.value,
                                style: const TextStyle(
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.w600,
                                  color: Color(0xFF000000),
                                ),
                              ),
                              const SizedBox(height: 8),
                              Text(
                                "IT Intern",
                                style: TextStyle(
                                  fontSize: 16.0,
                                  fontWeight: FontWeight.normal,
                                  color:
                                      const Color(0xFF000000).withOpacity(0.7),
                                ),
                              ),
                              const SizedBox(height: 24),
                              InkWell(
                                onTap: () {
                                  Get.toNamed(Routes.LOGIN);
                                },
                                child: Container(
                                  width: double.infinity,
                                  height: 48,
                                  decoration: const BoxDecoration(
                                    image: DecorationImage(
                                      image: AssetImage(
                                        'assets/images/locationContainer.png',
                                      ),
                                      fit: BoxFit.contain,
                                    ),
                                  ),
                                  child: const Center(
                                    child: Text(
                                      'Logout',
                                      style: TextStyle(
                                        fontSize: 18.0,
                                        fontWeight: FontWeight.w500,
                                        color: Colors.white,
                                      ),
                                    ),
                                  ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    Positioned(
                      top: 90,
                      left: (width - 100) / 2,
                      child: GestureDetector(
                        onTap: () {
                          controller.showImagePickerOption(context);
                        },
                        // child: Container(
                        //   decoration: BoxDecoration(
                        //     borderRadius: BorderRadius.circular(100),
                        //     border: Border.all(
                        //       width: 1,
                        //       color: Colors.grey.shade800,
                        //     ),
                        //   ),
                        child: CircleAvatar(
                          radius: 50,
                          backgroundColor: Colors.grey.shade300,
                          backgroundImage: controller.selectedImage != null
                              ? FileImage(controller.selectedImage!)
                              : const NetworkImage(
                                  "https://www.pngall.com/wp-content/uploads/12/Avatar-Profile-PNG-Images.png",
                                ) as ImageProvider<Object>,
                        ),
                      ),
                    ),
                    // ),
                  ]),
                );
              }
            }));
  }
}
