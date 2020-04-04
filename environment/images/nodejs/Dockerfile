FROM debian:8.7
ENV TERM=xterm
EXPOSE 4200
COPY bootstrap.sh /build/bootstrap.sh
RUN /build/bootstrap.sh
CMD ["/build/start.sh"]
