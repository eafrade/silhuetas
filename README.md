# Silhuetas - Preenchimento de Colunas

O projeto **Silhuetas** é uma aplicação em PHP que realiza o cálculo de preenchimento de colunas com base em um arquivo de entrada.
Ele valida o formato dos arquivos e processa as informações de forma eficiente.

## Requisitos

Antes de rodar o projeto, certifique-se de que você tenha os seguintes requisitos instalados:

- PHP 8.2 ou superior
- Composer (gerenciador de dependências para PHP)
- PHPUnit (para execução dos testes)

## Instalação e Configuração

Siga as etapas abaixo para configurar e rodar o projeto:

### 1. Clonando o repositório

Primeiro, clone o repositório para o seu ambiente local:

```bash
git clone https://github.com/eafrade/silhuetas.git
cd silhuetas
```

### 2. Instalando dependências

Instale as dependências do projeto usando o Composer. Se você não tiver o Composer instalado, pode obter mais informações [aqui](https://getcomposer.org/).

```bash
composer install
```

Isso irá instalar tanto as dependências de produção quanto as dependências de desenvolvimento (como o PHPUnit).

### 3. Configurando o arquivo `.env`

Crie o arquivo `.env` na raiz do projeto com as variáveis de configuração para o diretório de arquivos e a extensão dos arquivos a serem processados:

```bash
touch .env
```

No arquivo `.env`, adicione as seguintes variáveis:

```env
# Parametros de carga dos arquivos
FILE_DIRECTORY='files'
FILE_EXTENSION='txt'
```

Certifique-se de que o diretório `files/` contenha os arquivos `.txt` que você deseja processar.

### 4. Rodando o projeto

Para rodar a aplicação, você pode executar o script process.php, que chama automaticamente a função de cálculo de preenchimento de silhuetas. O script irá processar os arquivos de entrada, validando sua estrutura e calculando os resultados.

Execute o seguinte comando no terminal para rodar o script:

```bash
php process.php
```

### 5. Rodando os testes

O projeto inclui testes básicos para garantir que a validação do arquivo esteja funcionando corretamente. Para rodar os testes, execute o seguinte comando:

```bash
composer test
```

Isso rodará todos os testes do projeto e gerará um relatório em HTML na pasta `tests/reports/`.

### 6. Estrutura de pastas

O projeto segue a seguinte estrutura:

```plaintext
silhuetas/
├── files/
│   └── example.txt
├── src/
│   └── App/
│       └── FileValidator.php
│       └── Silhouettes.php
├── tests/
│   ├── FileValidatorTest.php
│   ├── files/
│   │    ├── case_count.teste
│   │    ├── file.teste
│   │    ├── item_count.teste
│   │    ├── range_0.teste
│   │    └── range_100.teste
│   └── reports/
├── .env
├── composer.json
├── composer.lock
├── process.php
└── README.md
```
