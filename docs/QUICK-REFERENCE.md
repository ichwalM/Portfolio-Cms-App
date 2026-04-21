# 🚀 Quick Reference Guide

Panduan cepat untuk menggunakan semua API endpoints di Ichwal CMS.

## 📌 Base URL & Auth

```
Base URL: http://localhost:8000/api/v1
API Key: YOUR_API_KEY (dari environment atau dashboard)
```

### Method 1: Query Parameter
```
http://localhost:8000/api/v1/profile?api_key=YOUR_API_KEY
```

### Method 2: Header
```
X-API-Key: YOUR_API_KEY
```

---

## 🗂️ API Endpoints Quick Reference

### Portfolio APIs (GET)

| Endpoint | Deskripsi | Pagination |
|----------|-----------|-----------|
| `GET /profile` | Profil portfolio | ❌ |
| `GET /projects` | Daftar projects | ✅ |
| `GET /projects/{slug}` | Detail project | ❌ |
| `GET /skills` | Skills by category | ❌ |
| `GET /experiences` | Work experiences | ❌ |
| `GET /posts` | Blog posts | ✅ |
| `GET /posts/{slug}` | Blog detail | ❌ |
| `GET /about` | About info | ❌ |
| `GET /certificates` | Certificates | ❌ |

### Form APIs (POST)

| Endpoint | Deskripsi | Required Fields |
|----------|-----------|-----------------|
| `POST /contact` | Kirim pesan | name, email, message |
| `POST /visits` | Record kunjungan | (auto) |

---

## 💬 Contact API

### Request
```bash
curl -X POST "http://localhost:8000/api/v1/contact" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Your Name",
    "email": "you@example.com",
    "subject": "Optional subject",
    "message": "Your message here"
  }'
```

### Response Success
```json
{
  "success": true,
  "message": "Your message has been sent successfully."
}
```

### Response Error (Validation)
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "email": ["The email must be a valid email address."]
  }
}
```

---

## 📊 Visit API

### Request
```bash
curl -X POST "http://localhost:8000/api/v1/visits"
```

### Response
```json
{
  "message": "Visit recorded"
}
```

---

## 🎯 Portfolio APIs

### GET /profile
```bash
curl "http://localhost:8000/api/v1/profile?api_key=YOUR_API_KEY"
```

### GET /projects
```bash
# Page 1 (default)
curl "http://localhost:8000/api/v1/projects?api_key=YOUR_API_KEY"

# Specific page
curl "http://localhost:8000/api/v1/projects?page=2&api_key=YOUR_API_KEY"
```

### GET /projects/{slug}
```bash
curl "http://localhost:8000/api/v1/projects/e-commerce-platform?api_key=YOUR_API_KEY"
```

### GET /skills
```bash
curl "http://localhost:8000/api/v1/skills?api_key=YOUR_API_KEY"
```

Response: Skills grouped by category
```json
{
  "Backend": [
    { "id": 1, "name": "Laravel", "proficiency": "Expert", "icon": "..." }
  ],
  "Frontend": [
    { "id": 2, "name": "Vue.js", "proficiency": "Advanced", "icon": "..." }
  ]
}
```

### GET /experiences
```bash
curl "http://localhost:8000/api/v1/experiences?api_key=YOUR_API_KEY"
```

### GET /posts
```bash
# Page 1
curl "http://localhost:8000/api/v1/posts?api_key=YOUR_API_KEY"

# Specific page
curl "http://localhost:8000/api/v1/posts?page=2&api_key=YOUR_API_KEY"
```

### GET /posts/{slug}
```bash
curl "http://localhost:8000/api/v1/posts/getting-started-with-laravel?api_key=YOUR_API_KEY"
```

### GET /about
```bash
curl "http://localhost:8000/api/v1/about?api_key=YOUR_API_KEY"
```

Response:
```json
{
  "about_photo": "http://...",
  "about_deskripsi": "Bio...",
  "about_univ": "University name",
  "GPA": "3.75"
}
```

### GET /certificates
```bash
curl "http://localhost:8000/api/v1/certificates?api_key=YOUR_API_KEY"
```

---

## 📱 JavaScript Examples

### Fetch API
```javascript
const apiKey = 'YOUR_API_KEY';
const baseURL = 'http://localhost:8000/api/v1';

// GET request
fetch(`${baseURL}/profile?api_key=${apiKey}`)
  .then(res => res.json())
  .then(data => console.log(data));

// POST request
fetch(`${baseURL}/contact?api_key=${apiKey}`, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    name: 'John',
    email: 'john@example.com',
    message: 'Hello'
  })
})
  .then(res => res.json())
  .then(data => console.log(data));
```

### Axios
```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': 'YOUR_API_KEY'
  }
});

// GET
api.get('/profile').then(res => console.log(res.data));

// POST
api.post('/contact', {
  name: 'John',
  email: 'john@example.com',
  message: 'Hello'
}).then(res => console.log(res.data));
```

---

## ✅ Validasi & Error Codes

### Valid Request Fields

**Contact Form:**
- `name` - String, max 255, required
- `email` - Valid email, max 255, required
- `subject` - String, max 255, optional
- `message` - String, max 5000, required

### HTTP Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Success |
| 201 | Created - Resource created |
| 400 | Bad Request |
| 401 | Unauthorized - Invalid API key |
| 404 | Not Found |
| 422 | Validation failed |
| 500 | Server error |

---

## 🔐 Security Tips

1. ✅ Use environment variables for API key
2. ✅ Never commit API key to version control
3. ✅ Use HTTPS in production
4. ✅ Validate input on client side
5. ✅ Handle errors gracefully
6. ✅ Implement rate limiting
7. ❌ Don't expose API key in frontend code
8. ❌ Don't log sensitive data

---

## 📞 Environment Setup

### .env File
```env
VITE_API_URL=http://localhost:8000
VITE_API_KEY=your_api_key_here
```

### .env.example
```env
VITE_API_URL=http://localhost:8000
VITE_API_KEY=change_me
```

### Usage
```javascript
const apiUrl = import.meta.env.VITE_API_URL;
const apiKey = import.meta.env.VITE_API_KEY;
```

---

## 🔗 Full Documentation

- 📄 [Setup & Authentication](./01-SETUP-AUTHENTICATION.md)
- 📁 [Portfolio API](./02-PORTFOLIO-API.md)
- 📬 [Contact API](./03-CONTACT-API.md)
- 📊 [Visit API](./04-VISIT-API.md)

---

## 🐛 Troubleshooting

### Issue: 401 Unauthorized
**Solusi:**
- Check if API key is correct
- Make sure API key is sent in query parameter or header
- Verify API key exists in database

### Issue: 422 Validation Error
**Solusi:**
- Check required fields are filled
- Verify email format is valid
- Check field length limits
- Review error messages in response

### Issue: 404 Not Found
**Solusi:**
- Check endpoint spelling
- Verify resource exists (e.g., project slug)
- Make sure data is published

### Issue: 500 Server Error
**Solusi:**
- Check server logs: `storage/logs/laravel.log`
- Verify database connection
- Check file permissions for storage directory
- Run migrations: `php artisan migrate`

---

## 📈 Tips

1. **Cache Results** - Cache API responses untuk performa lebih baik
2. **Use Pagination** - Gunakan pagination untuk endpoints yang mengembalikan banyak data
3. **Error Handling** - Selalu handle API errors dengan baik
4. **Loading States** - Tampilkan loading indicator saat fetch
5. **Timeout** - Set timeout untuk mencegah request hang

---

Last Updated: April 2026
