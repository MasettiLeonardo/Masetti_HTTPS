# Progetto Login con Docker, PHP e MariaDB

Questo progetto è una semplice applicazione di login scritta in PHP, con backend MariaDB, containerizzati usando Docker e Docker Compose.

---

## Prerequisiti

- Docker
- Docker Compose

---

## Struttura del progetto

- `docker-compose.yml` - definizione dei servizi Docker (db, web, nginx)
- `Dockerfile` - immagine PHP con Apache e mysqli
- `nginx/` - configurazione nginx e certificati SSL
- `.env` - variabili ambiente per la connessione al database

---