FROM node:18-alpine

ARG DEFAULT_PORT=3002
ENV PORT=${DEFAULT_PORT}
ENV NODE_ENV=production

WORKDIR /usr/src/app
COPY package*.json ./
RUN npm install --omit=dev
COPY . .
RUN addgroup -S appgroup && adduser -S appuser -G appgroup \
    && chown -R appuser:appgroup /usr/src/app
USER appuser
EXPOSE ${PORT}
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD wget --spider -q http://127.0.0.1:${PORT}/health || exit 1
CMD ["node", "index.js"]
