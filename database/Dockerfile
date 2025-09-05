# Verwende das offizielle Debian-Image als Basis
FROM debian:bullseye-slim

# Installiere SQLite
RUN apt-get update && apt-get install -y sqlite3

# Erstelle das Verzeichnis für die Datenbankdatei
RUN mkdir -p /app

# Erstelle eine SQLite-Datenbank-Datei und eine Beispiel-Tabelle
RUN sqlite3 /app/database.db "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT);"

# Setze das Arbeitsverzeichnis
WORKDIR /app

# Halte den Container im Hintergrund am Leben (wird ohne weitere Aktion fortlaufen)
CMD ["tail", "-f", "/dev/null"]