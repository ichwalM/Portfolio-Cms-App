# 📁 Portfolio API Documentation

Dokumentasi lengkap untuk semua endpoint Portfolio API yang digunakan untuk mengambil data portfolio, project, skills, dan pengalaman.

## 📋 Daftar Isi
- [Overview](#overview)
- [Profile Endpoint](#profile-endpoint)
- [Projects Endpoint](#projects-endpoint)
- [Skills Endpoint](#skills-endpoint)
- [Experiences Endpoint](#experiences-endpoint)
- [Posts/Blog Endpoint](#postsblog-endpoint)
- [About Endpoint](#about-endpoint)
- [Certificates Endpoint](#certificates-endpoint)

---

## 📌 Overview

| Endpoint | Method | Auth | Deskripsi |
|----------|--------|------|-----------|
| `/profile` | GET | API Key | Get profile info |
| `/projects` | GET | API Key | Get all projects (paginated) |
| `/projects/{slug}` | GET | API Key | Get single project detail |
| `/skills` | GET | API Key | Get skills grouped by category |
| `/experiences` | GET | API Key | Get work experiences |
| `/posts` | GET | API Key | Get blog posts (paginated) |
| `/posts/{slug}` | GET | API Key | Get single blog post |
| `/about` | GET | API Key | Get about information |
| `/certificates` | GET | API Key | Get certificates list |

---

## 👤 Profile Endpoint

### GET `/profile`

Mengambil informasi profil portfolio.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/profile?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "id": 1,
  "name": "Ichwal",
  "title": "Full Stack Developer",
  "bio": "Passionate developer focused on building excellent products...",
  "email": "ichwal@example.com",
  "phone": "+62-xxx-xxx-xxxx",
  "location": "Jakarta, Indonesia",
  "hero_image": "http://localhost:8000/storage/profiles/hero.jpg",
  "social_links": {
    "github": "https://github.com/ichwal",
    "linkedin": "https://linkedin.com/in/ichwal",
    "twitter": "https://twitter.com/ichwal"
  },
  "open_work": true,
  "created_at": "2026-01-22T10:30:00.000000Z",
  "updated_at": "2026-01-22T10:30:00.000000Z"
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Profile ID |
| `name` | string | Nama lengkap |
| `title` | string | Judul/Profesi |
| `bio` | string | Biografi singkat |
| `email` | string | Email |
| `phone` | string | Nomor telepon |
| `location` | string | Lokasi |
| `hero_image` | string | URL gambar hero |
| `social_links` | object | Link media sosial |
| `open_work` | boolean | Status ketersediaan kerja |

---

## 🎯 Projects Endpoint

### GET `/projects`

Mengambil daftar semua project yang dipublikasikan dengan pagination.

#### Request

```bash
# Halaman pertama (default)
curl -X GET "http://localhost:8000/api/v1/projects?api_key=YOUR_API_KEY"

# Halaman spesifik
curl -X GET "http://localhost:8000/api/v1/projects?page=2&api_key=YOUR_API_KEY"
```

#### Query Parameters

| Parameter | Type | Default | Deskripsi |
|-----------|------|---------|-----------|
| `page` | integer | 1 | Nomor halaman |
| `per_page` | integer | 10 | Jumlah item per halaman |

#### Response (200 OK)

```json
{
  "data": [
    {
      "id": 1,
      "title": "E-Commerce Platform",
      "slug": "e-commerce-platform",
      "description": "Full-featured e-commerce platform built with Laravel and Vue.js",
      "content": "Detailed project content...",
      "thumbnail": "http://localhost:8000/storage/projects/ecommerce.jpg",
      "tech_stack": ["Laravel", "Vue.js", "MySQL", "Redis"],
      "github_url": "https://github.com/ichwal/ecommerce",
      "live_url": "https://ecommerce-demo.com",
      "published_at": "2026-01-20T10:30:00.000000Z",
      "created_at": "2026-01-20T10:30:00.000000Z",
      "updated_at": "2026-01-20T10:30:00.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/v1/projects?page=1",
    "last": "http://localhost:8000/api/v1/projects?page=5",
    "prev": null,
    "next": "http://localhost:8000/api/v1/projects?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 5,
    "path": "http://localhost:8000/api/v1/projects",
    "per_page": 10,
    "to": 10,
    "total": 50
  }
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Project ID |
| `title` | string | Judul project |
| `slug` | string | URL slug |
| `description` | string | Deskripsi singkat |
| `content` | string | Konten detail |
| `thumbnail` | string | URL gambar thumbnail |
| `tech_stack` | array | Array teknologi yang digunakan |
| `github_url` | string | URL repository GitHub |
| `live_url` | string | URL project live |
| `published_at` | datetime | Tanggal publikasi |

---

### GET `/projects/{slug}`

Mengambil detail project spesifik berdasarkan slug.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/projects/e-commerce-platform?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "id": 1,
  "title": "E-Commerce Platform",
  "slug": "e-commerce-platform",
  "description": "Full-featured e-commerce platform built with Laravel and Vue.js",
  "content": "Detailed project content with markdown...",
  "thumbnail": "http://localhost:8000/storage/projects/ecommerce.jpg",
  "tech_stack": ["Laravel", "Vue.js", "MySQL", "Redis"],
  "github_url": "https://github.com/ichwal/ecommerce",
  "live_url": "https://ecommerce-demo.com",
  "published_at": "2026-01-20T10:30:00.000000Z",
  "created_at": "2026-01-20T10:30:00.000000Z",
  "updated_at": "2026-01-20T10:30:00.000000Z"
}
```

#### Error Response (404 Not Found)

```json
{
  "success": false,
  "message": "Project not found"
}
```

---

## 🛠️ Skills Endpoint

### GET `/skills`

Mengambil daftar skills yang dikelompokkan berdasarkan kategori.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/skills?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "Backend": [
    {
      "id": 1,
      "name": "Laravel",
      "category": "Backend",
      "proficiency": "Expert",
      "icon": "http://localhost:8000/storage/skills/laravel.svg",
      "created_at": "2026-01-22T10:30:00.000000Z"
    },
    {
      "id": 2,
      "name": "PHP",
      "category": "Backend",
      "proficiency": "Expert",
      "icon": "http://localhost:8000/storage/skills/php.svg",
      "created_at": "2026-01-22T10:30:00.000000Z"
    }
  ],
  "Frontend": [
    {
      "id": 3,
      "name": "Vue.js",
      "category": "Frontend",
      "proficiency": "Advanced",
      "icon": "http://localhost:8000/storage/skills/vuejs.svg",
      "created_at": "2026-01-22T10:30:00.000000Z"
    },
    {
      "id": 4,
      "name": "React",
      "category": "Frontend",
      "proficiency": "Advanced",
      "icon": "http://localhost:8000/storage/skills/react.svg",
      "created_at": "2026-01-22T10:30:00.000000Z"
    }
  ],
  "Database": [
    {
      "id": 5,
      "name": "MySQL",
      "category": "Database",
      "proficiency": "Expert",
      "icon": "http://localhost:8000/storage/skills/mysql.svg",
      "created_at": "2026-01-22T10:30:00.000000Z"
    }
  ]
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Skill ID |
| `name` | string | Nama skill |
| `category` | string | Kategori skill |
| `proficiency` | string | Level keahlian (Beginner, Intermediate, Advanced, Expert) |
| `icon` | string | URL icon skill |

---

## 💼 Experiences Endpoint

### GET `/experiences`

Mengambil daftar pengalaman kerja, diurutkan dari yang paling baru.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/experiences?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
[
  {
    "id": 1,
    "title": "Senior Full Stack Developer",
    "company": "Tech Company Inc",
    "position": "Senior Developer",
    "start_date": "2024-01-15",
    "end_date": null,
    "currently_working": true,
    "description": "Leading development of microservices architecture and mentoring junior developers...",
    "tech_used": ["Laravel", "Vue.js", "Docker", "Kubernetes"],
    "created_at": "2026-01-22T10:30:00.000000Z",
    "updated_at": "2026-01-22T10:30:00.000000Z"
  },
  {
    "id": 2,
    "title": "Full Stack Developer",
    "company": "Startup XYZ",
    "position": "Developer",
    "start_date": "2022-06-01",
    "end_date": "2024-01-14",
    "currently_working": false,
    "description": "Developed and maintained multiple client projects using Laravel and React...",
    "tech_used": ["Laravel", "React", "PostgreSQL"],
    "created_at": "2026-01-22T10:30:00.000000Z",
    "updated_at": "2026-01-22T10:30:00.000000Z"
  }
]
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Experience ID |
| `title` | string | Judul pekerjaan |
| `company` | string | Nama perusahaan |
| `position` | string | Posisi/Jabatan |
| `start_date` | date | Tanggal mulai (YYYY-MM-DD) |
| `end_date` | date | Tanggal berakhir (nullable jika masih kerja) |
| `currently_working` | boolean | Status saat ini |
| `description` | string | Deskripsi pekerjaan |
| `tech_used` | array | Teknologi yang digunakan |

---

## 📝 Posts/Blog Endpoint

### GET `/posts`

Mengambil daftar semua blog posts yang dipublikasikan dengan pagination.

#### Request

```bash
# Halaman pertama
curl -X GET "http://localhost:8000/api/v1/posts?api_key=YOUR_API_KEY"

# Halaman spesifik
curl -X GET "http://localhost:8000/api/v1/posts?page=2&api_key=YOUR_API_KEY"
```

#### Query Parameters

| Parameter | Type | Default | Deskripsi |
|-----------|------|---------|-----------|
| `page` | integer | 1 | Nomor halaman |
| `per_page` | integer | 10 | Jumlah item per halaman |

#### Response (200 OK)

```json
{
  "data": [
    {
      "id": 1,
      "title": "Getting Started with Laravel 11",
      "slug": "getting-started-with-laravel-11",
      "excerpt": "A comprehensive guide to get started with Laravel 11...",
      "content": "Full blog post content with markdown...",
      "thumbnail": "http://localhost:8000/storage/blogs/laravel11.jpg",
      "additional_photos": [
        "http://localhost:8000/storage/blogs/photo1.jpg",
        "http://localhost:8000/storage/blogs/photo2.jpg"
      ],
      "category": "Tutorial",
      "tags": ["laravel", "php", "web-development"],
      "published_at": "2026-01-20T10:30:00.000000Z",
      "created_at": "2026-01-20T10:30:00.000000Z",
      "updated_at": "2026-01-20T10:30:00.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/v1/posts?page=1",
    "last": "http://localhost:8000/api/v1/posts?page=3",
    "prev": null,
    "next": "http://localhost:8000/api/v1/posts?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "path": "http://localhost:8000/api/v1/posts",
    "per_page": 10,
    "to": 10,
    "total": 25
  }
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Post ID |
| `title` | string | Judul post |
| `slug` | string | URL slug |
| `excerpt` | string | Ringkasan singkat |
| `content` | string | Konten lengkap (markdown) |
| `thumbnail` | string | URL gambar thumbnail |
| `additional_photos` | array | URL foto tambahan |
| `category` | string | Kategori post |
| `tags` | array | Array tags |
| `published_at` | datetime | Tanggal publikasi |

---

### GET `/posts/{slug}`

Mengambil detail blog post spesifik berdasarkan slug.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/posts/getting-started-with-laravel-11?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "id": 1,
  "title": "Getting Started with Laravel 11",
  "slug": "getting-started-with-laravel-11",
  "excerpt": "A comprehensive guide to get started with Laravel 11...",
  "content": "Full blog post content with markdown...",
  "thumbnail": "http://localhost:8000/storage/blogs/laravel11.jpg",
  "additional_photos": [
    "http://localhost:8000/storage/blogs/photo1.jpg",
    "http://localhost:8000/storage/blogs/photo2.jpg"
  ],
  "category": "Tutorial",
  "tags": ["laravel", "php", "web-development"],
  "published_at": "2026-01-20T10:30:00.000000Z",
  "created_at": "2026-01-20T10:30:00.000000Z",
  "updated_at": "2026-01-20T10:30:00.000000Z"
}
```

#### Error Response (404 Not Found)

```json
{
  "success": false,
  "message": "Post not found"
}
```

---

## ℹ️ About Endpoint

### GET `/about`

Mengambil informasi about (biografi panjang) dan data akademik.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/about?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "about_photo": "http://localhost:8000/storage/about/profile.jpg",
  "about_deskripsi": "I'm a passionate full-stack developer with 5+ years of experience in building web applications...",
  "about_univ": "Universitas Telkom",
  "GPA": "3.75"
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `about_photo` | string | URL foto profil |
| `about_deskripsi` | string | Biografi panjang |
| `about_univ` | string | Nama universitas |
| `GPA` | string | GPA akademik |

---

## 🏆 Certificates Endpoint

### GET `/certificates`

Mengambil daftar semua sertifikat, diurutkan dari yang paling baru.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/certificates?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
[
  {
    "id": 1,
    "title": "AWS Certified Solutions Architect",
    "issuer": "Amazon Web Services",
    "issue_date": "2025-12-15",
    "credential_id": "AWS-12345-67890",
    "credential_url": "https://aws.amazon.com/verification/...",
    "image": "http://localhost:8000/storage/certificates/aws.jpg"
  },
  {
    "id": 2,
    "title": "Laravel Certification",
    "issuer": "Laravel",
    "issue_date": "2025-10-20",
    "credential_id": "LARAVEL-ABC123",
    "credential_url": "https://laravelcertification.com/...",
    "image": "http://localhost:8000/storage/certificates/laravel.jpg"
  }
]
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Certificate ID |
| `title` | string | Judul sertifikat |
| `issuer` | string | Penerbit sertifikat |
| `issue_date` | date | Tanggal penerbitan |
| `credential_id` | string | ID kredensial |
| `credential_url` | string | URL untuk verifikasi |
| `image` | string | URL gambar sertifikat |

---

## 📊 Example Usage - JavaScript/Vue.js

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

// Get profile
const getProfile = async () => {
  const { data } = await api.get('/profile');
  return data;
};

// Get projects with pagination
const getProjects = async (page = 1) => {
  const { data } = await api.get('/projects', {
    params: { page }
  });
  return data;
};

// Get single project
const getProject = async (slug) => {
  const { data } = await api.get(`/projects/${slug}`);
  return data;
};

// Get all skills
const getSkills = async () => {
  const { data } = await api.get('/skills');
  return data;
};

// Get experiences
const getExperiences = async () => {
  const { data } = await api.get('/experiences');
  return data;
};

// Get blog posts
const getPosts = async (page = 1) => {
  const { data } = await api.get('/posts', {
    params: { page }
  });
  return data;
};

// Get single post
const getPost = async (slug) => {
  const { data } = await api.get(`/posts/${slug}`);
  return data;
};

// Get about info
const getAbout = async () => {
  const { data } = await api.get('/about');
  return data;
};

// Get certificates
const getCertificates = async () => {
  const { data } = await api.get('/certificates');
  return data;
};

export {
  getProfile,
  getProjects,
  getProject,
  getSkills,
  getExperiences,
  getPosts,
  getPost,
  getAbout,
  getCertificates
};
```

---

## 🔗 Next Steps

Baca dokumentasi endpoint lainnya:
- [Contact API](./03-CONTACT-API.md)
- [Visit API](./04-VISIT-API.md)
