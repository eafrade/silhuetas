#!/bin/bash
export LANG=pt_BR.UTF-8
set -e

echo "🛠️ Entrypoint iniciado..."

APP_DIR=${APP_DIR:-/home/dev/app}
cd "$APP_DIR"

if ! command -v composer &>/dev/null; then
    echo "❌ Composer não está instalado!" >&2
    exit 1
fi

if [ ! -d "vendor" ]; then
    echo "📦 Instalando dependências com Composer..."
    composer install --no-interaction --prefer-dist --no-progress --no-suggest
else
    echo "✅ Dependências já instaladas."
fi

exec "$@"
