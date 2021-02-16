#FROM microsoft/mssql-server-linux:latest
FROM mcr.microsoft.com/mssql/rhel/server:2019-CU1-rhel-8

# Create work directory
RUN mkdir -p /usr/work
WORKDIR /usr/work

# Copy all scripts into working directory
COPY . /usr/work/

ENV ACCEPT_EULA=Y
ENV SA_PASSWORD=Password1!
ENV MSSQL_PID=Express


# Grant permissions for the import-data script to be executable
RUN chmod +x /usr/work/import-data.sh

EXPOSE 1433

CMD /bin/bash ./entrypoint.sh