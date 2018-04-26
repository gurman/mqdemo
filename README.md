# MQDemo

Demo of simple microservices structure with MQ broker

# Requirements

- Docker 1.13.1+
- Docker Compose

# Install

```docker-compose up -d --scale consumer2=3```

# How to use

1. Go to `http://localhost/` - _publisher_ service will send message to broker. Then services _consumer1_ and _consumer2_ will receive and log that message.
2. Check `docker-compose logs consumer1 consumer2` from the host.

Also you can check queues: `docker exec -it mqdemo_mq_1 rabbitmqctl list_queues`

