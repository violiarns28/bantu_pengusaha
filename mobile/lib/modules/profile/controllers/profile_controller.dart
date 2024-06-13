import 'dart:io';
import 'dart:typed_data';

import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:bantu_pengusaha/modules/modules.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';

class ProfileController extends GetxController {
  final AuthRepo _authRepo;
  final LocalService _localService;

  ProfileController(
    this._authRepo,
    this._localService,
  );

  Uint8List? _image;
  Rx<File?> selectedImage = Rx<File?>(null);
  final name = "".obs;
  final deviceId = "".obs;
  Rx<AttendanceModel?> today = Rx<AttendanceModel?>(null);
  List<AttendanceModel> history = [];

  @override
  void onInit() async {
    name.value = _localService.getUser()?.name ?? "Folks";
    final id = await _localService.getDeviceId();
    log.e("Mac Address: $id");
    deviceId.value = id ?? "Unknown";
    super.onInit();
  }

  void logout() async {
    var res = await _authRepo.logout();
    if (res.success) {
      Get.lazyPut<LoginController>(
        () => LoginController(
          Get.find<AuthRepoImpl>(),
          Get.find<LocationService>(),
        ),
      );
      Get.offAllNamed(Routes.LOGIN);
    }
  }

  void showImagePickerOption(BuildContext context) {
    showModalBottomSheet(
      backgroundColor: Colors.white,
      context: context,
      builder: (builder) {
        return Padding(
          padding: const EdgeInsets.all(18.0),
          child: SizedBox(
            width: 350,
            height: 70,
            child: Row(
              children: [
                Expanded(
                  child: InkWell(
                    onTap: () {
                      _pickImage(ImageSource.gallery);
                    },
                    child: const SizedBox(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Icon(
                            Icons.image,
                            size: 40,
                          ),
                          Text("Gallery"),
                        ],
                      ),
                    ),
                  ),
                ),
                Expanded(
                  child: InkWell(
                    onTap: () {
                      _pickImage(ImageSource.camera);
                    },
                    child: const SizedBox(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Icon(
                            Icons.camera_alt,
                            size: 40,
                          ),
                          Text("Camera"),
                        ],
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  Future<void> _pickImage(ImageSource source) async {
    final pickedImage = await ImagePicker().pickImage(source: source);
    if (pickedImage == null) return;
    selectedImage.value = File(pickedImage.path);
    _image = File(pickedImage.path).readAsBytesSync();
    Navigator.of(Get.context!).pop(); // Close the modal sheet
  }
}
