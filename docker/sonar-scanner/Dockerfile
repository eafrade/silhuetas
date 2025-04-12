FROM debian:bullseye-slim

ENV SONAR_SCANNER_VERSION=5.0.1.3006
ENV SONAR_SCANNER_OPTS="-Djava.net.preferIPv4Stack=true"
ENV PATH="/opt/sonar-scanner-${SONAR_SCANNER_VERSION}-linux/bin:$PATH"

RUN apt-get update \
    && apt-get install -y --no-install-recommends gettext curl unzip ca-certificates \
    && curl -sL "https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-${SONAR_SCANNER_VERSION}-linux.zip" -o sonar-scanner.zip \
    && unzip sonar-scanner.zip -d /opt \
    && rm sonar-scanner.zip \
    && ln -s "/opt/sonar-scanner-${SONAR_SCANNER_VERSION}-linux/bin/sonar-scanner" /usr/local/bin/sonar-scanner \
    && apt-get remove -y curl unzip \
    && apt-get autoremove -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY docker/sonar-scanner/entrypoint.sh /entrypoint.sh
WORKDIR /app

ENTRYPOINT ["sonar-scanner"]
CMD ["--help"]
