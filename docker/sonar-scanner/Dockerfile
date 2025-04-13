FROM debian:bullseye-slim

ARG UID
ARG GID

ARG SONAR_SCANNER_VERSION
ENV SONAR_SCANNER_VERSION=${SONAR_SCANNER_VERSION}
ENV SONAR_USER_HOME=/tmp/.sonar
ENV XDG_CONFIG_HOME=/tmp/.config

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

RUN addgroup --gid ${GID} dev \
    && adduser --uid ${UID} --gid ${GID} --system --no-create-home dev

USER dev
WORKDIR /app

ENTRYPOINT ["sonar-scanner"]
CMD ["--help"]
