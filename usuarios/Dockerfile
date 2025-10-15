FROM node:18-alpine

ARG DEFAULT_PORT=3001
ENV PORT=${DEFAULT_PORT}
ENV NODE_ENV=production

WORKDIR /usr/src/app

# copiar package.json primero para cachear
COPY package*.json ./

# instalar dependencias (omit dev)
RUN npm install --omit=dev

# copiar el resto del código
COPY . .

# crear usuario sin privilegios
RUN addgroup -S appgroup && adduser -S appuser -G appgroup \
    && chown -R appuser:appgroup /usr/src/app

USER appuser

EXPOSE ${PORT}

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD wget --spider -q http://127.0.0.1:${PORT}/health || exit 1

CMD ["node", "index.js"]
