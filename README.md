
Установка
------------

### Install via Composer

~~~
docker-compose up -d 
~~~

После нужно будет накатить миграции через bash в контейнере php 

~~~
yii migrate 
~~~

Чтобы у нас писалась статистика - нужно запустить прослушивание сообщений RabbitMQ

~~~
yii queue/listen -v
~~~


### SQL на получение выборки по месяцам с топом
```sql
SELECT rank() OVER ( partition by date order by count )
AS 'rank', u.url, date
FROM visits
INNER JOIN url u on visits.url = u.id
```