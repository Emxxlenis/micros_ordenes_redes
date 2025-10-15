FROM node:18-alpine

ARG DEFAULT_PORT=3002
ENV PORT=${DEFAULT_PORT}
ENV NODE_ENV=production

WORKDIR /usr/src/app
COPY package*.json ./

# Endure flaky networks: pin registry and increase retries/timeouts
ARG NPM_REGISTRY=https://registry.npmjs.org/
RUN npm config set registry "$NPM_REGISTRY" \
  && npm config set fetch-retries 5 \
  && npm config set fetch-retry-maxtimeout 600000 \
  && npm config set fetch-retry-mintimeout 20000

# Use lockfile when available
RUN if [ -f package-lock.json ]; then npm ci --omit=dev; else npm install --omit=dev; fi
COPY . .
RUN addgroup -S appgroup && adduser -S appuser -G appgroup \
    && chown -R appuser:appgroup /usr/src/app
USER appuser
EXPOSE ${PORT}
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD wget --spider -q http://127.0.0.1:${PORT}/health || exit 1
CMD ["node", "index.js"]
