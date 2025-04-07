
# Silhuetas - Preenchimento de Colunas

O projeto **Silhuetas** é uma aplicação em PHP que realiza o cálculo de preenchimento de colunas com base em arquivos de entrada.

---
### Clonando o repositório

Primeiro, clone o repositório para o seu ambiente local:

```bash
git clone https://github.com/eafrade/silhuetas.git
cd silhuetas
```

## 🐳 Executando com Docker

> Este projeto usa **Docker** e `Makefile` para facilitar a execução de testes, validação de código e execução da aplicação.

### ▶️ Comandos principais

| Comando              | Descrição                                         |
|----------------------|---------------------------------------------------|
| `make build`         | Constrói a imagem Docker                         |
| `make up`            | Sobe o container                                 |
| `make down`          | Encerra o container                              |
| `make run`           | Executa a aplicação (`php process.php`)          |
| `make test`          | Roda os testes unitários                         |
| `make coverage`      | Gera o relatório de cobertura de testes          |
| `make lint`          | Verifica padrão PSR12 com PHP_CodeSniffer        |
| `make fix`           | Corrige o código com PHP CS Fixer                |
| `make stan`          | Executa análise estática com PHPStan             |
| `make status`        | Exibe o status do container                      |
| `make shell`         | Abre o shell do container                        |

---

## ⚙️ Configuração

Antes de rodar, configure o arquivo `.env`:

```bash
cp env_example .env
```

Edite o conteúdo conforme necessário:

```env
FILE_DIRECTORY='files'
FILE_EXTENSION='txt'
```

Coloque os arquivos de entrada no diretório `files/`.

---

## 🧪 Testes

Para rodar os testes:

```bash
make test
```

Para gerar o relatório de cobertura em HTML:

```bash
make coverage
```

Abra o arquivo `tests/reports/coverage/index.html` no navegador para visualizar.

---

## 📂 Estrutura de diretórios

```plaintext
silhuetas/
├── docker/                      # Arquivos Docker
│   ├── Dockerfile
│   └── entrypoint.sh
├── files/                       # Arquivos de entrada (.txt)
├── src/App/                     # Código fonte
├── tests/                       # Testes e arquivos de teste
├── .env                         # Configuração do ambiente
├── composer.json               # Dependências
├── Makefile                    # Comandos úteis
└── process.php                 # Ponto de entrada da aplicação
```

---

## ⚙️ Execução local (opcional)

Se quiser rodar fora do Docker, será necessário:

- PHP 8.2+
- Composer
- Xdebug ou PCOV (para cobertura de código)

Instale as dependências com:

```bash
composer install
```

Execute:

```bash
php process.php
```

---

## 🧹 Padrões de Código

Este projeto utiliza:

- **PHPStan** (`make stan`)
- **PHP_CodeSniffer** com PSR-12 (`make lint`)
- **PHP CS Fixer** (`make fix`, `make check`)

---
