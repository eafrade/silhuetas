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

É necessário ter **uma extensão de cobertura de código** instalada no PHP. Você pode usar:

- [Xdebug](https://xdebug.org/)
- ou [PCOV](https://github.com/krakjoe/pcov)

> ⚠️ Apenas uma das duas deve estar ativa no momento da execução.

#### ▶️ Rodando os testes

Para rodar os testes unitários:

```bash
composer test
```

Para rodar os testes com relatório de cobertura:

```bash
composer coverage
```

Isso executará todos os testes do projeto e gerará um relatório em **HTML** na pasta:

```
tests/reports/coverage/
```

Você pode abrir o arquivo `index.html` com seu navegador para visualizar o relatório.

### 6. Estrutura de pastas

O projeto segue a seguinte estrutura:

```plaintext
silhuetas/
├── files/
│   └── example.txt
├── src/
│   └── App/
│       ├── FileValidator.php
│       ├── Process.php
│       └── Silhouettes.php
├── tests/
│   ├── files/
│   │   ├── array_no_int.teste
│   │   ├── array_separator.teste
│   │   ├── case_count.teste
│   │   ├── file.teste
│   │   ├── file-pdf.teste
│   │   ├── item_count.teste
│   │   ├── no_int_case.teste
│   │   ├── range_0.teste
│   │   └── range_100.teste
│   ├── reports/
│   │   └── report.html
│   ├── FileValidatorTest.php
│   ├── ProcessTest.php
│   └── SilhouettesTest.php
├── .env
├── .pre-commit-config.yaml
├── composer.json
├── composer.lock
├── env_example
├── phpunit.xml.dist
├── process.php
└── README.md
```
