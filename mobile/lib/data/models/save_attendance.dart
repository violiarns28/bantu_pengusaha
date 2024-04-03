// import 'dart:convert';

// import 'package:bantu_pengusaha/data/models/home_response.dart';

// SaveAttendanceResponseModel saveAttendanceResponseModelFromJson(String str) =>
//     SaveAttendanceResponseModel.fromJson(json.decode(str));

// String saveAttendanceResponseModelToJson(SaveAttendanceResponseModel data) =>
//     json.encode(data.toJson());

// class SaveAttendanceResponseModel {
//   bool success;
//   String message;
//   HistoryData? data; // Make data nullable

//   SaveAttendanceResponseModel({
//     required this.success,
//     required this.message,
//     required this.data,
//   });

//   factory SaveAttendanceResponseModel.fromJson(Map<String, dynamic> json) {
//     return SaveAttendanceResponseModel(
//       success: json["success"] ?? false,
//       message: json["message"] ?? "",
//       data: json["data"] != null
//           ? HistoryData.fromJson(json["data"])
//           : null, // Check for null data
//     );
//   }

//   Map<String, dynamic> toJson() => {
//         "success": success,
//         "message": message,
//         "data": data?.toJson(), // Serialize data if not null
//       };
// }

// // class Data {
// //   int id;
// //   int userId;
// //   String latitude;
// //   String longitude;
// //   DateTime date;
// //   String? clockIn;
// //   String? clockOut;
// //   DateTime updatedAt;
// //   DateTime createdAt;

// //   Data({
// //     required this.id,
// //     required this.userId,
// //     required this.latitude,
// //     required this.longitude,
// //     required this.date,
// //     required this.clockIn,
// //     required this.clockOut,
// //     required this.updatedAt,
// //     required this.createdAt,
// //   });

// //   factory Data.fromJson(Map<String, dynamic> json) => Data(
// //         userId: json["user_id"],
// //         latitude: json["latitude"],
// //         longitude: json["longitude"],
// //         date: DateTime.parse(json["date"]),
// //         clockIn: json["clock_in"],
// //         clockOut: json["clock_out"],
// //         updatedAt: DateTime.parse(json["updated_at"]),
// //         createdAt: DateTime.parse(json["created_at"]),
// //         id: json["id"],
// //       );

// //   Map<String, dynamic> toJson() => {
// //         "user_id": userId,
// //         "latitude": latitude,
// //         "longitude": longitude,
// //         "date":
// //             "${date.year.toString().padLeft(4, '0')}-${date.month.toString().padLeft(2, '0')}-${date.day.toString().padLeft(2, '0')}",
// //         "clock_in": clockIn,
// //         "clock_out": clockOut,
// //         "updated_at": updatedAt.toIso8601String(),
// //         "created_at": createdAt.toIso8601String(),
// //         "id": id,
// //       };
// // }
