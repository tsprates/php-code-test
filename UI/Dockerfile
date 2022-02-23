FROM node:16-alpine

RUN npm install -g http-server

WORKDIR /app

COPY src/package*.json ./

RUN npm i

COPY src/ ./

RUN npm run build

EXPOSE 3001
CMD [ "http-server", "-p", "3001", "dist" ]