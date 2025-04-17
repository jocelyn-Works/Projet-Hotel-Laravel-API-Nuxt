
FROM node:18-alpine AS builder

WORKDIR /app

COPY package*.json ./

COPY . .

RUN npm install

FROM node:18-alpine

WORKDIR /app

COPY --from=builder /app ./

RUN npm install --omit=dev

EXPOSE 3000

CMD ["npm", "run", "dev"]