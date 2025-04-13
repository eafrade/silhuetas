#!/bin/sh
set -e

echo "📄 Generating sonar-project.properties from template with environment variables..."
envsubst <"$APP_DIR/sonar-project.template.properties" >"$APP_DIR/sonar-project.properties"

echo "🚀 Running SonarScanner..."
exec sonar-scanner "$@"
