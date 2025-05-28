
<div align="center">
  <img src="https://braavo.com.br/wp-content/uploads/2025/05/logo-bvo-mgz-scaled.png" alt="Magazord" width="300"/>
</div>
<br>
<br>

# Teste Técnico Braavo - Magazord

#### Fico muito feliz que vc estejá aqui, fiz o teste com muito carrinho e dei o meu melhor, espero que goste!



- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Como rodar o projeto](#como-rodar-o-projeto)
  - [Usando Script Automatizado](#usando-script-automatizado)
  - [Usando Docker](#usando-docker)
- [Requisitos Atendidos](#requisitos-atendidos)
- [Extras Implementados](#extras-implementados)


---

## Sobre o Projeto

Este sistema é um gerenciador de contatos, desenvolvido do zero, com foco em boas práticas, padrão MVC e uso da ORM Doctrine.

---
## Tecnologias Utilizadas

####  Back-end
- PHP 8.4
- Doctrine ORM 3.3.3
- Composer 2.8.9
- MySQL (MariaDB)

####  Front-end
- [Latte](https://latte.nette.org/en/) pra Templete HTML, 
- [Bootstrap](https://getbootstrap.com/) 5.3.6
- JS e CSS 
- PostgreSQL ou MySQL

####  Infraestrutura
- Docker Composer
- Git/GitHub
---

## Como rodar o projeto

### Usando Script Automatizado:

```bash
chmod +x script.sh && ./script.sh
```
🚧 Necessário ter o [Docker](https://www.docker.com/) instalado. O script se encontram na raiz do projeto. Será necssario liberar o acesso a porta 3306

O script é bem simple, subir os conteines, instalar as dependências e criar o banco usando o schema do doctrine

### Usando Docker:

```bash
docker-compose up -d --build
```
```bash
docker compose exec php composer install
```
```bash
docker compose exec php php core/bin/doctrine orm:schema-tool:create
```
> Projeto disponivel: http://localhost:8080/

### Requisitos Atendidos
#### Requisitos Funcionais

**RF01**[✅] Tela de consulta para pessoas </br>
**RF02**[✅] Campo de pesquisa por nome de pessoa</br>
**RF03**[✅] Tela de consulta para contatos </br>
**RF04**[✅] CRUD completo para pessoas (Cadastrar, Visualizar, Alterar, Excluir) </br>
**RF05**[✅] CRUD completo para contatos (Cadastrar, Visualizar, Alterar, Excluir) </br>

#### Requisitos Não Funcionais

**RNF01**[✅] Backend em PHP com sistemas de rotas </br>
**RNF02**[✅] Uso da ORM Doctrine </br>
**RNF03**[✅] Uso de JS, HTML, CSS no frontend </br>
**RNF04**[✅] Organização do projeto seguindo o padrão MVC </br>
**RNF05**[✅] Gerenciamento de dependências com Composer </br>
**RNF06**[✅] Banco de dados SQL MySQL </br>
**RNF07**[✅] Controle de versão no GitHub </br>

#### Extras Implementados

**Validação de CPF**[✅] CPFs não pode se repetir e devem possuir 11 caracteres numericos </br>
</br>
![image](https://github.com/user-attachments/assets/0de6830d-42a9-4491-85fe-04116777c13f)

</br>
**Tela de 404 NOT FOUND**[✅] </br>
![image](https://github.com/user-attachments/assets/583fa841-1298-4990-af93-7092957966f8)


---

