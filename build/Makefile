down:
	docker compose down --remove-orphans
shell:
	docker compose exec -u ${UID}:${UID} app sh
up:
	DOCKER_BUILDKIT=0 docker compose up --build --remove-orphans -d
up-f:
	DOCKER_BUILDKIT=0 docker compose up --build --remove-orphans
build:
	DOCKER_BUILDKIT=0 docker compose build