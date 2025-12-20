# Geoglify

This project is a robust boilerplate for modern web applications, specifically tailored for geospatial needs but flexible enough for any use case. It leverages a cutting-edge technology stack to provide a scalable, high-performance foundation.

## Tech Stack & Versions

Geoglify is built with the latest and greatest versions of its core technologies:

| Category | Technology | Version |
|----------|------------|---------|
| **Backend** | [Laravel](https://laravel.com/) (PHP) | ^12.0 |
| **Language** | [PHP](https://www.php.net/) | ^8.4 |
| **Frontend** | [Vue.js](https://vuejs.org/) | ^3.5.25 |
| **Build Tool** | [Vite](https://vitejs.dev/) | ^7.2.4 |
| **UI Framework** | [Vuetify](https://vuetifyjs.com/) | ^3.7.0 |
| **CSS** | [Tailwind CSS](https://tailwindcss.com/) | ^4.1.17 |
| **SPA Glue** | [Inertia.js](https://inertiajs.com/) | ^1.0.0 |
| **Mapping** | [MapLibre GL](https://maplibre.org/) | ^4.6.0 |
| **Map Server** | [Martin](https://maplibre.org/martin/) | Latest |
| **Database** | [PostgreSQL](https://www.postgresql.org/) | 16 |
| **Spatial DB** | [PostGIS](https://postgis.net/) | 3.4 |
| **Infra** | [Docker](https://www.docker.com/) | - |

## Architecture Goals

- **Geospatial Ready**: Built-in support for vector tiles (PMTiles), spatial database functions, and interactive maps.
- **Modern & Fast**: Uses Vite, HTTP/3 ready stack, and efficient vector tiles.
- **Developer Experience**: Fully containerized with Docker for easy setup and consistency.
- **Scalable**: Separation of concerns with a dedicated map tile server (`Martin`) and a robust Laravel backend.

## Project Structure

```bash
geoglify/
├── database/           # Database Docker configuration & init scripts
├── martin/             # Martin Tile Server configuration
├── pmtiles/            # Data directory for hosted .pmtiles (Ignored by Git)
├── webapp/             # Main Laravel + Vue.js Application
├── docker-compose.yml  # Container orchestration
```

## Getting Started

### 1. Prerequisites

- Docker
- Docker Compose

### 2. Installation

Clone the repository and start the environment.

```bash
git clone <repository-url>
cd geoglify
```

### 3. Running the Services

Start the application stack with Docker Compose. This will spin up the database, webapp, map server, and utility services.

```bash
docker compose up -d
```

**Services:**

*   **webapp**: The main application running on ports `8080` (HTTP) and `5173` (Vite request).
    *   _Healthcheck_: `http://localhost:8080/`
*   **database**: PostgreSQL with PostGIS on port `5432`.
*   **martin**: Vector tile server running on port `8081`.
    *   _Tiles URL_: `http://localhost:8081/porto/{z}/{x}/{y}` (Example source)
*   **mailpit**: Email testing tool on port `8025`.
*   **redis**: Cache and queue driver.

### 4. Setup Map Data (PMTiles)

The project includes a `downloader` service to automatically fetch OSM data and convert/extract it to PMTiles format using `go-pmtiles`.

To download specific map data (defined in `docker-compose.yml`):

```bash
# The service runs automatically on 'docker compose up', but you can check logs or restart it
docker compose restart downloader
```

The resulting `.pmtiles` files are stored in the `./pmtiles` directory and served by **Martin**.

## Configuration

### Webapp
Configuration is handled via standard Laravel `.env` files. The entrypoint script handles generation of `.env` from examples if not present.

### Map Server (Martin)
Configured in `martin/config.yaml`.
- By default, it looks for `.pmtiles` in the `/pmtiles` directory.
- CORS is enabled for all origins (`*`) to allow direct browser access.

## Contributing

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/amazing-feature`).
3. Commit your changes (`git commit -m 'Add some amazing feature'`).
4. Push to the branch (`git push origin feature/amazing-feature`).
5. Open a Pull Request.

---

**Made with love for technology and open source.**
