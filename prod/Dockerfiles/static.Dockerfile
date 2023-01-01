FROM nginx:1.23.3-alpine
WORKDIR /usr/share/nginx/html/
COPY --from=build /var/www/html/public/ .
RUN pwd
RUN ls -lah