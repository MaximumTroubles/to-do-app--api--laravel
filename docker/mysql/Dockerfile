FROM mysql:8.0.19

COPY ./mysql.cnf /etc/mysql/conf.d/mysql.cnf

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["mysqld"]

RUN usermod -u 1000 www-data
