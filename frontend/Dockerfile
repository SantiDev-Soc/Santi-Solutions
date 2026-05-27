FROM node:20-alpine

WORKDIR /app

# Copiamos los archivos de dependencias
COPY package*.json ./

# Instalamos las dependencias dentro de Linux
RUN npm install

# Copiamos el resto del código
COPY . .

EXPOSE 3000

# Arrancamos en modo desarrollo con el host habilitado
CMD ["npm", "run", "dev", "--", "--host"]
