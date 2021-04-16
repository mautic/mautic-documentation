---
title: Queue
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-----------


Improved scalability can be achieved by activating the queuing mechanism for email and page opens.  Use this if you
are getting too much traffic at once from people opening pages or opening emails.

> **_NOTE:_**  Mautic 3.x users who are implementing RabbitMQ or Beanstalkd need to configure the settings directly in their local configuration file. If you are using the legacy Mautic 2.x series the steps below remains the same. 


## Activating

You can activate and configure the queuing mechanism by going to configuration:

- Open the admin menu by clicking the cog icon in the top right corner.
- Select the *Configuration* menu item.
- Select the *Queue Settings* tab.
- Switch the *Queue Protocol* to either *RabbitMQ* or *Beanstalkd*.
- Save the configuration.

### RabbitMQ

[RabbitMQ][rabbitMQ] is one of the available queue protocols that Mautic supports.
In order to use it, you must have a RabbitMQ server running.  Instructions on how to install RabbitMQ can be obtained
on their [website][rabbitMQ-website].  For testing purposes, you can use
you can use [cloudamqp][cloudamqp] which offers a RabbitMQ as a service.

Once you have setup a RabbitMQ server, you can configure Mautic to use it by using the *Configuration* menu item again.

- Open the admin menu by clicking the cog icon in the top right corner.
- Select the *Configuration* menu item.
- Select the *Queue Settings* tab.
- Switch the *Queue Protocol* to *RabbitMQ*.
- Change the *Host* to the hostname of your RabbitMQ installation.
- Change the *Virtual Host* to the virtual host of your RabbitMQ installation.
- Change the *User* to the username of your RabbitMQ installation.
- Change the *Password* to the password of your RabbitMQ installation.
- Save the configuration.

### Beanstalkd

[Beanstalkd][beanstalkd] is another available queue protocol that Mautic supports.
In order to use it, you must have a Beanstalkd server running.  Instructions on how to install Beanstalkd can be
obtained on their [website][beanstalkd-website].

Once you have setup a Beanstalkd server, you can configure mautic to use it by using the *Configuration* menu item again.

- Open the admin menu by clicking the cog icon in the top right corner.
- Select the *Configuration* menu item.
- Select the *Queue Settings* tab.
- Switch the *Queue Protocol* to *Beanstalkd*.
- Change the *Host* to the hostname of your Beanstalkd installation.
- Save the configuration.

## Processing

Once the queuing mechanism is activated, any page hits and email opens will be queued up to be processed later.
To process them, you will need to run some console commands on a regular basis.

Processing page hits is done by using the following command:

```
php /path/to/mautic/bin/console mautic:queue:process --env=prod -i page_hit
```

Processing email hits is done by using the following command:

```
php /path/to/mautic/bin/console mautic:queue:process --env=prod -i email_hit
```

When these commands are run, they will continue to run until you stop the program by using the keyboard
combination `Control + C`.  If you want to run them to process only, say, 50 page hits or email hits, you can
run the command like this instead:

```
php /path/to/mautic/bin/console mautic:queue:process --env=prod -i page_hit -m 50
```

or

```
php /path/to/mautic/bin/console mautic:queue:process --env=prod -i email_hit -m 50
```

### Cron to push the jobs
You need to run the following cron to keep pushing the jobs.
```
php /path/to/mautic/bin/console mautic:email:send
```
See the documentation on [cron jobs][cron-jobs] for further information.

[cron-jobs]: </setup/cron-jobs>
[rabbitMQ]: <https://www.rabbitmq.com/features.html>
[rabbitMQ-website]: <http://www.rabbitmq.com/download.html>
[cloudamqp]: <https://www.cloudamqp.com/>
[beanstalkd]: <https://kr.github.io/beanstalkd/>
[beanstalkd-website]: <https://kr.github.io/beanstalkd/download.html>
