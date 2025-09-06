
# Variablen
DOCKER_COMPOSE = docker compose
COMPOSE_FILE = docker-compose.yml

all: set_up_volume  up

set_up_volume:
	@echo "Kompiliere TypeScript zu JavaScript..."
# 	@curl -fsSL https://download.docker.com/linux/debian/gpg | sudo tee /etc/apt/trusted.gpg.d/docker.asc

	# Überprüfe, ob Node.js und npm installiert sind
# 	@sudo apt install -y nodejs npm
# 	@curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
# 	@sudo apt install -y nodejs
	# Überprüfe, ob TypeScript global installiert ist, andernfalls installiere es
	@npm list -g typescript >/dev/null 2>&1 || { \
		echo "TypeScript ist nicht installiert. Installiere es..."; \
		sudo npm install -g typescript; \
	}

	# Kompiliere TypeScript zu JavaScript
	@echo "Kompiliere login_form.ts zu JavaScript..."
# 	@tsc web/login_form.ts || { \
# 		echo "Fehler beim Kompilieren von TypeScript."; \
# 		exit 1; \
# 	}

	@echo "Kompilierung abgeschlossen."	# Standardbefehl: Container starten
up:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) up --build -d



# Container stoppen
down:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) down

# Logs anzeigen
logs:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) logs -f

# Container bauen (z. B. nach Änderungen am Dockerfile)
build:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) build

# Alle Container, Netzwerke und Volumes entfernen (vorsichtig verwenden!)
clean:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) down -v


