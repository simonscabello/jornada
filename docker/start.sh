#!/bin/bash

# Configurar o Apache para usar a porta do Railway
sed -i "s/Listen 80/Listen ${PORT:-8080}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT:-8080}/" /etc/apache2/sites-available/000-default.conf

# Iniciar o Apache em primeiro plano
apache2-foreground
