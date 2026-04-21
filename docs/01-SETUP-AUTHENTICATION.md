# 🔐 Setup & Autentikasi API

Panduan lengkap untuk setup dan menggunakan Ichwal CMS API dengan autentikasi API Key.

## 📋 Daftar Isi
- [Persyaratan Sistem](#persyaratan-sistem)
- [Setup API Key](#setup-api-key)
- [Cara Menggunakan API Key](#cara-menggunakan-api-key)
- [Testing API](#testing-api)

---

## ✅ Persyaratan Sistem

- Laravel 11+
- PHP 8.2+
- Database MySQL/PostgreSQL
- Composer

---

## 🔑 Setup API Key

### 1. Membuat User & API Key

Masuk ke database dan buat user baru, atau gunakan user yang sudah ada. Setiap user memiliki API key untuk autentikasi.

**Via Laravel Tinker:**

```bash
php artisan tinker
```

```php
$user = \App\Models\User::first();
$user->api_key = \Illuminate\Support\Str::random(32);
$user->save();
echo $user->api_key;
```

### 2. Middleware API Key

Middleware `api.key` mengecek header atau query parameter:

**File:** `app/Http/Middleware/ApiKeyMiddleware.php`

Middleware ini akan:
- Mengecek query parameter `?api_key=xxx`
- Mengecek header `X-API-Key: xxx`
- Mengembalikan error 401 jika API key tidak valid

---

## 🚀 Cara Menggunakan API Key

### Method 1: Query Parameter

```bash
curl -X GET "http://localhost:8000/api/v1/profile?api_key=YOUR_API_KEY"
```

### Method 2: Header

```bash
curl -X GET "http://localhost:8000/api/v1/profile" \
  -H "X-API-Key: YOUR_API_KEY"
```

### Method 3: JavaScript/Fetch

**Query Parameter:**
```javascript
const apiKey = 'YOUR_API_KEY';
const response = await fetch(`/api/v1/profile?api_key=${apiKey}`);
const data = await response.json();
```

**Header:**
```javascript
const apiKey = 'YOUR_API_KEY';
const response = await fetch('/api/v1/profile', {
  headers: {
    'X-API-Key': apiKey,
  }
});
const data = await response.json();
```

### Method 4: Axios

```javascript
const apiKey = 'YOUR_API_KEY';
const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': apiKey,
  }
});

const profile = await api.get('/profile');
```

---

## 🧪 Testing API

### Menggunakan cURL

```bash
# Test Profile
curl -X GET "http://localhost:8000/api/v1/profile?api_key=YOUR_API_KEY"

# Test Projects
curl -X GET "http://localhost:8000/api/v1/projects?api_key=YOUR_API_KEY"

# Test Contact Form
curl -X POST "http://localhost:8000/api/v1/contact?api_key=YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "Testing API",
    "message": "This is a test message"
  }'
```

### Menggunakan Postman

1. Buat request baru
2. Set method ke GET/POST
3. Masukkan URL: `http://localhost:8000/api/v1/endpoint`
4. Tambah parameter query: `api_key=YOUR_API_KEY`
5. Atau tambah header: `X-API-Key: YOUR_API_KEY`
6. Klik Send

### Menggunakan Insomnia

1. Create HTTP request
2. Set URL dengan query parameter atau header seperti Postman

---

## 🔒 Keamanan

1. **Jangan expose API key di public repository**
2. **Gunakan environment variable untuk API key**
3. **Rotate API key secara berkala**
4. **Jangan push `.env` file ke git**
5. **Validasi semua input dari client**

---

## 📝 Environment Variables

Tambahkan di `.env` file:

```env
API_KEY=your_secret_api_key_here
APP_URL=http://localhost:8000
```

Gunakan di aplikasi frontend:

```javascript
const apiKey = process.env.REACT_APP_API_KEY;
const apiUrl = process.env.REACT_APP_API_URL;
```

---

## ❌ Error Responses

### 401 Unauthorized (Invalid/Missing API Key)

```json
{
  "success": false,
  "message": "Unauthorized. Invalid API key."
}
```

### 403 Forbidden

```json
{
  "success": false,
  "message": "Forbidden. Access denied."
}
```

---

## 🎯 Next Steps

Setelah setup berhasil, baca dokumentasi untuk endpoint spesifik:
- [Portfolio API](./02-PORTFOLIO-API.md)
- [Contact API](./03-CONTACT-API.md)
- [Visit API](./04-VISIT-API.md)
