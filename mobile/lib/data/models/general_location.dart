class GeneralLocationModel {
  double latitude; // Koordinat lintang umum
  double longitude; // Koordinat bujur umum

  GeneralLocationModel({
    required this.latitude,
    required this.longitude,
  });

  /// Factory method untuk membuat instance GeneralLocationModel dari JSON
  factory GeneralLocationModel.fromJson(Map<String, dynamic> json) =>
      GeneralLocationModel(
        latitude: json['latitude'] is String
            ? double.parse(json[
                'latitude']) // Jika latitude dalam format String, parse ke double
            : json['latitude'], // Jika sudah double, gunakan langsung
        longitude: json['longitude'] is String
            ? double.parse(json[
                'longitude']) // Jika longitude dalam format String, parse ke double
            : json['longitude'], // Jika sudah double, gunakan langsung
      );

  /// Mengkonversi objek GeneralLocationModel menjadi map JSON
  Map<String, dynamic> toJson() =>
      {'latitude': latitude, 'longitude': longitude};
}
