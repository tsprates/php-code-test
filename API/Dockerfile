FROM node:16-alpine

WORKDIR /home/node/
COPY package.json .
RUN npm i
COPY src .

CMD npm start