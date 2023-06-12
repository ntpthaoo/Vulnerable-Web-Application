# Use the official MySQL 8.0 image as the base
FROM mysql:8.0

# Environment variables for MySQL configuration
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=
ENV MYSQL_ROOT_PASSWORD=

# Copy custom MySQL configuration file (optional)
#COPY my.cnf /etc/mysql/conf.d/

# Expose the default MySQL port
EXPOSE 3307

# Start MySQL server on container startup
CMD ["mysqld"]