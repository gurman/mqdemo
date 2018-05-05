# MQDemo (Kafka version)

Demo of simple microservices structure with Apache Kafka as MQ broker

# Requirements

- Docker 1.13.1+
- Docker Compose

# Install

```docker-compose up -d --scale consumer2=3```

# How to use

1. Go to `http://localhost/` - _publisher_ service will send message to broker. Then services _consumer1_ and _consumer2_ will receive and log that message.
2. Check `docker-compose logs consumer1 consumer2` from the host.

Also you can check queues:
```docker exec -it mqdemo_kafka_1 /opt/kafka/bin/kafka-topics.sh --list --zookeeper zookeeper
docker exec -it mqdemo_kafka_1 /opt/kafka/bin/kafka-topics.sh --describe --topic logs --zookeeper zookeeper
docker exec -it mqdemo_kafka_1 /opt/kafka/bin/kafka-consumer-groups.sh --list --bootstrap-server kafka:9092
docker exec -it mqdemo_kafka_1 /opt/kafka/bin/kafka-consumer-groups.sh --describe --group Consumer1 --bootstrap-server kafka:9092
docker exec -it mqdemo_kafka_1 /opt/kafka/bin/kafka-consumer-groups.sh --describe --group Consumer2 --bootstrap-server kafka:9092```

