import pika, os, time, json
url = os.environ.get('CLOUDAMQP_URL', 'amqp://guest:guest@172.16.238.210:5672/my_vhost')

params = pika.URLParameters(url)
connection = pika.BlockingConnection(params)
channel = connection.channel() # start a channel
#The processors


def testing():
    print('testing')


# create a function which is called on incoming messages
def consumerProcessor(ch, method, properties, body):
    data  = (body.decode('utf-8'))
    print(data)
    testing()


    #Send the data back to the consumer which is written in Laravel
    channel.queue_declare(queue='producer')
    message = 'Hello from Python! testing 1 2 3'
    channel.basic_publish(exchange='', routing_key='consumer', body=message)





# set up subscription on the queue
channel.basic_consume('producer',
  consumerProcessor,
  auto_ack=True)

# start consuming (blocks)
channel.start_consuming()
connection.close()
