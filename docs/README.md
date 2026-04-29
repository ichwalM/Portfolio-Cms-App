# 📚 API Documentation - Ichwal CMS

Dokumentasi lengkap untuk semua endpoint API di Ichwal CMS Portfolio.

## 📋 Daftar Isi

- **[Setup & Autentikasi](./01-SETUP-AUTHENTICATION.md)** - Panduan autentikasi dan setup API
- **[Portfolio API](./02-PORTFOLIO-API.md)** - Endpoint untuk mengambil data portfolio
- **[Contact API](./03-CONTACT-API.md)** - Endpoint untuk form kontak
- **[Visit API](./04-VISIT-API.md)** - Endpoint untuk tracking kunjungan
- **[Wall App API](./05-WALL-APP-API.md)** - Endpoint untuk data aplikasi wall app

## 🚀 Quick Start

### Base URL
```
http://localhost:8000/api/v1
```

### API Key
Tambahkan header atau query parameter untuk autentikasi:
```
?api_key=YOUR_API_KEY
```
atau
```
X-API-Key: YOUR_API_KEY
```

## 📌 API Overview

| Method | Endpoint | Deskripsi | Auth |
|--------|----------|-----------|------|
| **GET** | `/profile` | Get profile info | API Key |
| **GET** | `/projects` | Get all projects | API Key |
| **GET** | `/projects/{slug}` | Get single project | API Key |
| **GET** | `/skills` | Get skills by category | API Key |
| **GET** | `/experiences` | Get work experiences | API Key |
| **GET** | `/posts` | Get blog posts | API Key |
| **GET** | `/posts/{slug}` | Get single post | API Key |
| **GET** | `/about` | Get about info | API Key |
| **GET** | `/certificates` | Get certificates | API Key |
| **GET** | `/wall-apps` | Get wall apps info | API Key |
| **POST** | `/contact` | Submit contact form | API Key |
| **POST** | `/visits` | Record visit | API Key |

## ✅ Status Codes

- **200 OK** - Request berhasil
- **201 Created** - Resource berhasil dibuat
- **400 Bad Request** - Request tidak valid
- **404 Not Found** - Resource tidak ditemukan
- **422 Unprocessable Entity** - Validasi gagal
- **500 Internal Server Error** - Error server

## 🔐 Response Format

### Success Response
```json
{
  "data": { ... },
  "success": true
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": { ... }
}
```

## 📞 Support

Jika ada pertanyaan, silakan hubungi backend developer.
