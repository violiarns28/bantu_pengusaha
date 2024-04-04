import 'dart:io';
import 'dart:typed_data';

import 'package:bantu_pengusaha/core/services/local.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth.dart';
import 'package:bantu_pengusaha/modules/login/views/login_view.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ProfileController extends GetxController {
  final AuthRepo _authRepo;
  final LocalService _localService;

  ProfileController(
    this._authRepo,
    this._localService,
  );

  Uint8List? _image;
  File? selectedImage;
  final name = "".obs;
  Rx<AttendanceModel?> today = Rx<AttendanceModel?>(null);
  List<AttendanceModel> history = [];

  @override
  void onInit() {
    name.value = _localService.getUser()?.name ?? "Folks";
    super.onInit();
  }

  void logout() async {
    var res = await _authRepo.logout();
    if (res.success) {
      SharedPreferences localStorage = await SharedPreferences.getInstance();
      localStorage.remove('user');
      localStorage.remove('token');
      Get.offAll(() => const LoginView());
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
    selectedImage = File(pickedImage.path);
    _image = File(pickedImage.path).readAsBytesSync();
    update(); // Trigger UI update
    Navigator.of(Get.context!).pop(); // Close the modal sheet
  }
}
