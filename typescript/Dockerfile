# typescript/Dockerfile
FROM node:18-alpine

WORKDIR /usr/src/app

COPY package.json ./
COPY package-lock.json ./
RUN npm install

COPY src /usr/src/app/src
COPY common /usr/src/app/common

CMD ["sh", "-c", "npm test"]
