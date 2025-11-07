# mon serveur web à moi
FROM ubuntu:24.04

LABEL maintainer="ubuntu + Apache"

# eviter les interractions
ENV DEBIAN_FRONTEND=noninteractive

# executer la mis à jour de la distrib
RUN apt-get update && apt-get upgrade -y

# installation des paquets apache
RUN apt-get install apache2 -y

#ouverture du port du container
EXPOSE 80

# lancement du service apache dans le container
CMD ["apachectl", "-D", "FOREGROUND"]