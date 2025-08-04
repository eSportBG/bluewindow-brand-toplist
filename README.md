# Bluewindow Brand Toplist

This repository contains a **Yii2 REST API** backend and a simple **frontend** for the Bluewindow Brand CRUD task. It is designed to run inside a Docker container for easy setup and consistent environments.

## Features

- **REST API** for managing brands (`create`, `read`, `update`, `delete`)
- **Frontend** to list, create, and delete brands
- **Dockerized** environment for PHP (Apache), MySQL, and Composer dependencies
- Responsive design with Bootstrap grid and custom CSS

## Tech Stack

- PHP 8.1, Yii2 Framework (Advanced Template)
- MySQL 5.7
- Apache HTTP Server
- Docker & Docker Compose
- Vanilla JavaScript + Bootstrap 5 for frontend

## Getting Started

1. **Clone the repository**

   ```bash
   git clone https://github.com/your-org/bluewindow-brand-toplist.git
   cd bluewindow-brand-toplist
   ```

2. **Build and start containers**

   ```bash
   docker-compose up -d --build
   ```

   This will start two services:

   - `app`: PHP 8.1 + Apache, serving both frontend and backend
   - `mysql`: MySQL 5.7 database

3. **Run migrations (if any)**

   If you have migrations set up, apply them:

   ```bash
   docker exec -it bluewindow_brand_toplist_app_1 bash
   ./yii migrate --interactive=0
   exit
   ```

4. **Access the application**

   - Frontend UI: [http://localhost:8080/](http://localhost:8080/)
   - API endpoint: [http://localhost:8080/api/brand](http://localhost:8080/api/brand)

## API Endpoints

| Method | Endpoint          | Description         |
| ------ | ----------------- | ------------------- |
| GET    | `/api/brand`      | List all brands     |
| GET    | `/api/brand/{id}` | View a single brand |
| POST   | `/api/brand`      | Create a new brand  |
| PATCH  | `/api/brand/{id}` | Update an existing  |
| DELETE | `/api/brand/{id}` | Delete a brand      |

### Example: Create a Brand

```bash
curl -X POST http://localhost:8080/api/brand \
  -H "Content-Type: application/json" \
  -d '{"brand_name":"Example","brand_image":"https://...","brand_rating":4,"country_code":"US"}'
```

## Frontend

- A **form** to add new brands
- A **list** of existing brands with their rating and country
- **Delete** buttons for each brand

Just navigate to [http://localhost:8080/](http://localhost:8080/) and interact with the form.

## Changelog

### [1.0.2] - 2025-08-04
- Docker container

### [1.0.1] - 2025-08-04
- Brand - api + frontend

### [1.0.0] - 2025-08-04
- Initializing repo