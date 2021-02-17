FROM mcr.microsoft.com/mssql/server:2019-latest
#FROM mcr.microsoft.com/mssql/rhel/server:2019-CU1-rhel-8

# Create work directory
RUN mkdir -p /usr/work
WORKDIR /usr/work

# Copy all scripts into working directory
COPY . /usr/work/


# For environment variables list, see https://docs.microsoft.com/en-us/sql/linux/sql-server-linux-configure-environment-variables
# If you want to specify LCID, you may not set here. You should specify with running a docker. ``docker run -e "MSSQL_LCID=1041" <image>``
ARG SA_PASSWORD='Password1!'
ARG TCP_PORT=1433
ARG PID=Express
ENV ACCEPT_EULA=Y MSSQL_PID=$PID MSSQL_SA_PASSWORD=$SA_PASSWORD MSSQL_TCP_PORT=$TCP_PORT

# Grant permissions for the import-data script to be executable
RUN chmod +x /usr/work/import-data.sh

### Containers should not run as root as a good practice
USER 10001

# Default SQL Server TCP/Port
EXPOSE $TCP_PORT

CMD /bin/bash ./entrypoint.sh