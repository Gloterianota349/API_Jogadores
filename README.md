# ⚽ API de Jogadores

Esta é uma API desenvolvida em PHP que permite o gerenciamento de informações sobre jogadores de futebol. Através de endpoints RESTful, é possível realizar operações de CRUD (Criar, Ler, Atualizar e Deletar) para gerenciar os dados dos jogadores.

## 🛠️ Tecnologias Utilizadas

* **PHP**: Linguagem de programação utilizada para o desenvolvimento da API.
* **MySQL**: Banco de dados para armazenamento das informações dos jogadores.
* **Apache**: Servidor web utilizado para hospedar a aplicação.

## 📁 Estrutura do Repositório

O repositório contém os seguintes diretórios e arquivos:

* `Config/`: Configurações de banco de dados e outras configurações globais.
* `Controller/`: Controladores responsáveis pela lógica de negócios e interação com o banco de dados.
* `Model/`: Modelos que representam as entidades do sistema, como Jogador.
* `vendor/`: Dependências do Composer.
* `.htaccess`: Configurações do servidor Apache.
* `composer.json`: Arquivo de configuração do Composer.
* `index.php`: Ponto de entrada da aplicação.

## 🚀 Como Executar

1. Clone este repositório:

   ```bash
   git clone https://github.com/Gloterianota349/API_Jogadores.git
   ```
2. Acesse o diretório do projeto:

   ```bash
   cd API_Jogadores
   ```
3. Instale as dependências do Composer:

   ```bash
   composer install
   ```
4. Configure o banco de dados no arquivo `Config/database.php`.
5. Inicie o servidor Apache:

   ```bash
   php -S localhost:8000
   ```
6. Acesse a API através do navegador ou ferramentas como Postman em:

   ```
   http://localhost:8000
   ```

## 📚 Endpoints Disponíveis

A API oferece os seguintes endpoints:

* `GET /jogadores`: Retorna todos os jogadores.
* `GET /jogadores/{id}`: Retorna um jogador específico pelo ID.
* `POST /jogadores`: Cria um novo jogador.
* `PUT /jogadores/{id}`: Atualiza as informações de um jogador existente.
* `DELETE /jogadores/{id}`: Deleta um jogador pelo ID.
