#!/bin/bash

docker compose down -v 
docker compose up -d --build
docker compose exec php composer install

# Animação de carregando, aguardando conteiner do mariadb iniciar corretamente
echo -n "Criando banco de dados "
for i in {1..20}; do
    for c in / - \\ \|; do
        echo -ne "\b$c"
        sleep 0.2
    done
done

# 
docker compose exec php php core/bin/doctrine orm:schema-tool:create

echo 
echo "Projeto disponivel em http://localhost:8080"
echo