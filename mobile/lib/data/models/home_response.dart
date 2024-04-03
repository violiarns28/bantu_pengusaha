// import 'dart:convert';

// HomeResponseModel homeResponseModelFromJson(String str) =>
//     HomeResponseModel.fromJson(json.decode(str));

// String homeResponseModelToJson(HomeResponseModel data) =>
//     json.encode(data.toJson());

// class HomeResponseModel {
//   bool success;
//   String message;
//   List<HistoryData> data;

//   HomeResponseModel({
//     required this.success,
//     required this.message,
//     required this.data,
//   });

//   factory HomeResponseModel.fromJson(Map<String, dynamic> json) =>
//       HomeResponseModel(
//         success: json["success"],
//         message: json["message"],
//         data: List<HistoryData>.from(
//             json["data"].map((x) => HistoryData.fromJson(x))),
//       );

//   Map<String, dynamic> toJson() => {
//         "success": success,
//         "message": message,
//         "data": List<dynamic>.from(data.map((x) => x.toJson())),
//       };
// }

// class HistoryData {
//   int id;
//   int userId;
//   String latitude;
//   String longitude;
//   DateTime date;
//   String? clockIn;
//   String? clockOut;
//   DateTime createdAt;
//   DateTime updatedAt;
//   // bool isToday;

//   HistoryData({
//     required this.id,
//     required this.userId,
//     required this.latitude,
//     required this.longitude,
//     required this.date,
//     required this.clockIn,
//     required this.clockOut,
//     required this.createdAt,
//     required this.updatedAt,
//     // required this.isToday,
//   });

//   factory HistoryData.fromJson(Map<String, dynamic> json) => HistoryData(
//         id: json["id"],
//         userId: json["user_id"],
//         latitude: json["latitude"],
//         longitude: json["longitude"],
//         date: DateTime.parse(json["date"]),
//         clockIn: json["clock_in"],
//         clockOut: json["clock_out"],
//         createdAt: DateTime.parse(json["created_at"]),
//         updatedAt: DateTime.parse(json["updated_at"]),
//         // isToday: json["is_today"],
//       );

//   Map<String, dynamic> toJson() => {
//         "id": id,
//         "user_id": userId,
//         "latitude": latitude,
//         "longitude": longitude,
//         "date": date,
//         "clock_in": clockIn,
//         "clock_out": clockOut,
//         "created_at": createdAt.toIso8601String(),
//         "updated_at": updatedAt.toIso8601String(),
//         // "is_today": isToday,
//       };
// }
