FROM node:20-alpine

# Set working directory
WORKDIR /app

# Install dependencies
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

# Copy app files
COPY . ./

# Expose port (from .env or default 3000)
EXPOSE 3000

# Start app in development mode
CMD ["yarn", "dev", "--host"]
