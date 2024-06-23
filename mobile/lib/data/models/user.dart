class UserModel {
  int? id; // ID pengguna (opsional)
  String? name; // Nama pengguna (opsional)
  String? email; // Alamat email pengguna (opsional)
  String? token; // Token pengguna (opsional)
  DateTime? createdAt; // Tanggal dan waktu pembuatan pengguna (opsional)
  DateTime?
      updatedAt; // Tanggal dan waktu pembaruan terakhir pengguna (opsional)

  UserModel({
    this.id,
    this.name,
    this.email,
    this.token,
    this.createdAt,
    this.updatedAt,
  });

  /// Factory method untuk membuat instance UserModel dari JSON
  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      token: json['token'],
      createdAt: json['created_at'] != null
          ? DateTime.parse(json['created_at'])
          : null,
      updatedAt: json['updated_at'] != null
          ? DateTime.parse(json['updated_at'])
          : null,
    );
  }

  /// Mengkonversi objek UserModel menjadi map JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'email': email,
      'token': token,
      'created_at': createdAt
          ?.toIso8601String(), // Mengonversi ke format ISO 8601 jika tidak null
      'updated_at': updatedAt
          ?.toIso8601String(), // Mengonversi ke format ISO 8601 jika tidak null
    };
  }
}
