
# Variablen
DOCKER_COMPOSE = docker compose
COMPOSE_FILE = docker-compose.yml

all: set_up_volume  up

set_up_volume:
	@echo "Kompiliere Typescript zu Javascript"
	@sudo apt update
	@sudo apt install nodejs npm
	@npm install -g typescript
	@tsc login_form.ts

	# Standardbefehl: Container starten
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


