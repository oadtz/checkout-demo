FROM nginx:latest
RUN apt-get update \
    && apt-get install -y openssl
RUN mkdir /etc/nginx/ssl; \
    cd /etc/nginx/ssl && openssl req -subj '/CN=localhost' -x509 -newkey rsa:4096 -nodes -keyout key-www.pem -out cert-www.pem -days 365
RUN mkdir /etc/nginx/ssl; \
    cd /etc/nginx/ssl && openssl req -subj '/CN=locahost' -x509 -newkey rsa:4096 -nodes -keyout key-api.pem -out cert-api.pem -days 365