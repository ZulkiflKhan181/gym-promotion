FROM nginx:alpine

# Set working directory
WORKDIR /usr/share/nginx/html

# Copy HTML
COPY index.html index.html

# Copy custom Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
