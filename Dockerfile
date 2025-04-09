# Imagem oficial do PHP com servidor embutido
FROM php:8.1-cli

# Copia os arquivos da aplicação para o container
COPY . /app

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Comando para iniciar o servidor PHP embutido
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
