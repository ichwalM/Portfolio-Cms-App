# Ichwal Portfolio CMS (Backend)

Welcome to the backend repository for the **Ichwal Portfolio**. This CMS allows full management of portfolio content including projects, skills, experience, and blog posts. It exposes a JSON API for consumption by a frontend application (e.g., Next.js).

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/ichwal/ichwal-cms.git
    cd ichwal-cms
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Configure Environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Update your `.env` file with your database credentials.*

4.  **Run Migrations & Seeders:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    *This creates the database schema and populates it with dummy data.*

5.  **Build Assets:**
    ```bash
    npm run build
    ```

6.  **Start Server:**
    ```bash
    php artisan serve
    ```
    Access the application at `http://localhost:8000`.

---

## 🔑 Authentication

- **Dashboard URL**: `http://localhost:8000/dashboard`
- **Default Admin**:
    - Email: `admin@ichwal.com`
    - Password: `password`

---

## 📡 API Documentation

Base URL: `http://localhost:8000/api/v1`

**Authentication:**
All API endpoints in `v1` are protected. You must provide a valid API Key via:
- Header: `X-API-KEY: your-api-key`
- Query Parameter: `?api_key=your-api-key`

> You can generate your API Key in the [Dashboard](http://localhost:8000/dashboard).

### 1. Profile
**Endpoint**: `GET /profile`
Returns the owner's profile information, hero image URL, and social links.

**Response:**
```json
{
  "id": 1,
  "name": "Ichwal",
  "bio": "Passionate Full Stack Developer...",
  "hero_image": "http://localhost:8000/storage/profile/hero.jpg",
  "social_links": {
    "github": "https://github.com/ichwal",
    "linkedin": "..."
  }
}
```

### 2. Projects
**Endpoint**: `GET /projects`
Returns a paginated list of published projects.

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "E-Commerce Platform",
      "slug": "e-commerce-platform",
      "tech_stack": ["Laravel", "React"],
      "thumbnail": "..."
    }
  ],
  "links": { ... } // Pagination links
}
```

**Endpoint**: `GET /projects/{slug}`
Returns details of a specific project.

### 3. Skills
**Endpoint**: `GET /skills`
Returns all skills grouped by category (Frontend, Backend, etc.).

**Response:**
```json
{
  "Backend": [
    { "name": "Laravel", "proficiency": 95 },
    { "name": "Node.js", "proficiency": 85 }
  ],
  "Frontend": [ ... ]
}
```

### 4. Experience
**Endpoint**: `GET /experiences`
Returns a list of work experiences ordered by date.

**Response:**
```json
[
  {
    "company": "Tech Solutions Inc.",
    "role": "Senior Full Stack Developer",
    "start_date": "2023-01-01",
    "end_date": null,
    "description": "..."
  }
]
```

### 5. Blog
**Endpoint**: `GET /posts`
Returns a paginated list of published blog posts.

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Getting Started with Laravel",
      "slug": "getting-started-with-laravel",
      "thumbnail": "http://localhost:8000/storage/blogs/thumb.webp",
      "additional_photos": [
        "http://localhost:8000/storage/blogs/additional/doc1.webp",
        "http://localhost:8000/storage/blogs/additional/doc2.webp"
      ],
      "published_at": "2024-01-15"
    }
  ],
  "links": { ... }
}
```

**Endpoint**: `GET /posts/{slug}`
Returns a specific blog post with full content and optional additional photos (documentation, screenshots, etc.).

### 6. About
**Endpoint**: `GET /about`
Returns the comprehensive about section information including University and GPA.

**Response:**
```json
{
  "about_photo": "http://localhost:8000/storage/about/photo.webp",
  "about_deskripsi": "I am a dedicated student...",
  "about_univ": "Harvard University",
  "GPA": "3.90"
}
```

### 7. Visits
**Endpoint**: `POST /visits`
Records a new visit. Call this once when your frontend application loads.

**Response:**
```json
{
  "message": "Visit recorded"
}
```

---

## 🛠 Tech Stack

- **Framework**: Laravel 12
- **Auth**: Laravel Breeze
- **Styling**: Tailwind CSS
- **Database**: SQLite / MySQL
