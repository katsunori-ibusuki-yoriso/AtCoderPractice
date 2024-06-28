# typescript/Dockerfile
FROM node:18-alpine

WORKDIR /usr/src/app

COPY package.json ./
COPY package-lock.json ./
RUN npm install

CMD ["sh", "-c", "npm test"]
