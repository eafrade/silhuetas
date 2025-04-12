#!/bin/sh
envsubst </app/sonar-project.template.properties >/app/sonar-project.properties
exec sonar-scanner "$@"
