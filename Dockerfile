# Use the official MySQL 8.0 image as the base
FROM mysql:8.0

# Environment variables for MySQL configuration
ENV MYSQL_DATABASE=mydatabase
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword
ENV MYSQL_ROOT_PASSWORD=myrootpassword

# Copy custom MySQL configuration file (optional)
COPY my.cnf /etc/mysql/conf.d/

# Expose the default MySQL port
EXPOSE 3306

# Start MySQL server on container startup
CMD ["mysqld"]