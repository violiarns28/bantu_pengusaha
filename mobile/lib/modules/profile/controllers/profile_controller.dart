import 'dart:convert';
import 'dart:io';
import 'dart:typed_data';

import 'package:bantu_pengusaha/core/sources/sources.dart';
import 'package:bantu_pengusaha/modules/login/views/login_view.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../data/models/home_response.dart';

class ProfileController extends GetxController {
  Uint8List? _image;
  File? selectedImage;
  SharedPreferences? _prefs;
  final name = "".obs;
  final _token = "".obs;
  Rx<HistoryData?> today = Rx<HistoryData?>(null);
  List<HistoryData> history = [];
  final network = Network();

  @override
  void onInit() {
    initializeSP();
    super.onInit();
  }

  void initializeSP() async {
    _prefs ??= await SharedPreferences.getInstance();
    final tRes = _prefs!.getString("token") ?? "";
    _token.value = tRes;
    final nRes = _prefs!.getString("name") ?? "";
    name.value = nRes;
  }

  Future<void> getData() async {
    history.clear();
    history = await network.getAttendances();
    final now = DateTime.now();
    for (var element in history) {
      if (element.date.day == now.day) {
        today.value = element;
      } else {
        history.add(element);
      }
    }
  }

  void logout() async {
    var res = await Network().getData('/logout');
    var body = json.decode(res.body);
    debugPrint(res.body);
    if (body['success']) {
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
