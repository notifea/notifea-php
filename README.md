# notifea-php
Pure PHP repository for using Notifea services.

[Notifea](https://notifea.com) provides clients very user-friendly way of sending transactional emails
and sms to their users.

**Please note that our services are in alpha phase and are not yet available to public.** 

## Install

To install the SDK you need to be using [Composer]([https://getcomposer.org/)
in your project. To install it please see the [docs](https://getcomposer.org/download/).

After you installed [Composer]([https://getcomposer.org/) install the SDK 

```shell script
composer require notifea/notifea-php
```

## Minimum requirements

This package will require you to use:
- PHP 7.0 or higher
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) 6.0 or higher 

## Usage

All email and sms endpoints are accessed via **NotifeaClient**. First start by 
configuring this client.

```php
$client = new NotifeaClient(
    'https://api.notifea.com',
    'Bearer {authorization}'
);
```

Your `authentication` token can be generated in [access-tokens](https://app.notifea.com/access-tokens) section.

### Usage - emails

To interact with email endpoints use `EmailService`. First start by instantiating.

```php
$client = new NotifeaClient(
    'https://api.notifea.com',
    'Bearer {authorization}'
);

$emailService = new EmailService($client);
```

#### Send email

Sending an email can be as simple as using this few lines of code:

```php
$email = new Email();
$email->setFrom('newadress@notifea.com')
    ->setRecipient('customer@business.com')
    ->setReplyTo('reply_to@notifea.com')
    ->setSubject('My first email')
    ->setHtmlBody('<p>This is my first email</p>')
    ->setCc('cc@notifea.com')
;

$sentEmail = $emailService->sendEmail($email);
```

`$sentEmail` will contain updated `Email` object with all interesting information.

#### Get emails

To get emails, use this piece of code:

```php
$emails = $emailService->getEmails();
```

`$emails` will be a new `Collection` containing all returned `Email` objects

#### Get single email

To get a single email entity, only email uuid is needed:

```php
$email = $emailService->getEmail('8fc2c850-81c0-4424-823a-aa4727441864');
```

`$email` will be an `Email` object

#### Delete email

To delete a single email entity from notifea database, this function is sufficient

```php
$result = $emailService->deleteEmail('8fc2c850-81c0-4424-823a-aa4727441864');
```

`$result` will be an either `true` on successful deletion or `NotifeaException` will be 
triggered on any failure (such as email not fount)

### Usage - sms

To interact with sms endpoints use `SmsService`. First start by instantiating.

```php
$client = new NotifeaClient(
    'https://api.notifea.com',
    'Bearer {authorization}'
);

$smsService = new SmsService($client);
```

#### Send sms

Sending an sms can be as simple as using this few lines of code:

```php
$sms = new Sms();
$sms
    ->setRecipient('+421902739429')
    ->setSmsSenderid('59634971-e57f-44af-b530-038e27e7064e')
    ->setContent('My awesome SMS message.')
;

$smsService->sendSms($sms);
```

`$sentEmail` will contain updated `Sms` object with all interesting information.

To find out what is your `sms_sender_id` go into your Management section of your sms senders.

#### Get sms

To get sms, use this piece of code:

```php
$emails = $smsService->getSmss();
```

`$emails` will be a new `Collection` containing all returned `Sms` objects

#### Get single sms

To get a single sms entity, only sms uuid is needed:

```php
$sms = $smsService->getSms('8fc2c850-81c0-4424-823a-aa4727441864');
```

`$sms` will be an `Sms` object

#### Delete sms

To delete a single sms entity from notifea database, this function is sufficient

```php
$result = $smsService->deleteSms('8fc2c850-81c0-4424-823a-aa4727441864');
```

`$result` will be an either `true` on successful deletion or `NotifeaException` will be 
triggered on any failure (such as email not fount)

## Community

- [Documentation](https://docs.notifea.com)
- [Report issues](https://github.com/notifea/notifea-php/issues)

## Contributing

Dependencies are managed through `composer`:

```
$ composer install
```

Tests can be run via phpunit:

```
$ vendor/bin/phpunit
```
