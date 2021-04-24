FROM nginx:alpine
COPY index.html /usr/share/nginx/html
COPY nginx.conf /etc/nginx/
EXPOSE 5000
CMD ["nginx", "-g", "daemon off;"]