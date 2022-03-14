FROM node:17.6.0-alpine

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY package.json package-lock.json ./
RUN npm ci

COPY . ./

CMD ["npm", "start"]
