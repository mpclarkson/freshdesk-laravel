# Freshdesk Service Provider for Laravel 5

[![Build Status](https://travis-ci.org/mpclarkson/freshdesk-laravel.svg?branch=master)](https://travis-ci.org/mpclarkson/freshdesk-laravel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mpclarkson/freshdesk-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mpclarkson/freshdesk-laravel/?branch=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9bc7be97-3ed1-4895-944e-05658edd7a4f.svg)](https://insight.sensiolabs.com/projects/9bc7be97-3ed1-4895-944e-05658edd7a4f)
[![Packagist](https://img.shields.io/packagist/v/mpclarkson/freshdesk-php-sdk.svg)](https://packagist.org/packages/mpclarkson/freshdesk-php-sdk)

This is a service provider for interacting with the Freshdesk API v2 via the 
[freshdesk-php-sdk](https://github.com/mpclarkson/freshdesk-php-sdk) in Laravel and Lumen applications.

## Installation

To add this bundle to your app, use [Composer](https://getcomposer.org).

Add `mpclarkson/freshdesk-laravel` to your **composer.json** file:

```json
{
    "require": {
        "mpclarkson/freshdesk-laravel": "dev-master"
    }
}
```

Then run:
 
 ```sh
 composer update
 ```

You must then register the provider in your application.

Register the provider in the `providers` key in your `config/app.php`:

```php
    'providers' => array(
        // ...
        Mpclarkson\Laravel\Freshdesk\FreshdeskServiceProvider::class,
    )
```

Then add the Freshdesk facade alias in the `aliases` key in your `config/app.php`:

```php
    'aliases' => array(
        // ...
        'Freshdesk' => Mpclarkson\Laravel\Freshdesk\FreshdeskFacade::class,
    )
```

## Configuration

To customize the configuration file, publish the package configuration using Artisan.

```sh
php artisan vendor:publish --provider="Mpclarkson\Laravel\Freshdesk\FreshdeskServiceProvider"
```

Set your configuration using **environment variables**, either in your `.env` file or on your server's control panel:

- `FRESHDESK_KEY`

Read this article to find your API key: `https://support.freshdesk.com/support/solutions/articles/215517-how-to-find-your-api-key`

- `FRESHDESK_DOMAIN`

The subdomain part of your Freshdesk organisation URL.

e.g. http://mpclarkson.freshdesk.com use **mpclarkson**

## Accessing the Freshdesk API

In a controller you can access Freshdesk resource
as follows: 

```php

//Contacts
$contacts = Freshdesk::contacts()->update($contactId, $data);

//Agents
$me = Freshdesk::agents()->current();

//Companies
$company = Freshdesk::companies()->create($data);

//Groups
$deleted = Freshdesk::groups()->delete($groupId);

//Tickets
$ticket = Freshdesk::tickets()->view($filters);

//Time Entries
$time = Freshdesk::timeEntries()->all($ticket['id']);

//Conversations
$ticket = Freshdesk::conversations()->note($ticketId, $data);

//Categories
$newCategory = Freshdesk::categories()->create($data);

//Forums
$forum = Freshdesk::forums()->create($categoryId, $data);

//Topics
$topics =Freshdesk::topics()->monitor($topicId, $userId);

//Comments
$comment = Freshdesk::comments()->create($forumId);

//Email Configs
$configs = Freshdesk::emailConfigs()->all();

//Products
$product = Freshdesk::products()->view($productId);

//Business Hours
$hours = Freshdesk::businessHours()->all();

//SLA Policy
$policies = Freshdesk::slaPolicies()->all();
```

### Filtering

All `GET` requests accept an optional `array $query` parameter to filter
results. For example:

```php
//Page 2 with 50 results per page
$page2 = Freshdesk::forums()->all(['page' => 2, 'per_page' => 50]);

//Tickets for a specific customer
$tickets = Freshdesk::tickets()->view(['company_id' => $companyId]);
```

Please read the Freshdesk documentation for further information on
filtering `GET` requests.

## Contributing

This is a work in progress and PRs are welcome. Please read the 
[contributing guide](.github/CONTRIBUTING.md).

## Author

The library was written and maintained by [Matthew Clarkson](http://mpclarkson.github.io/) 
from [Hilenium](https://hilenium.com).

## References

* [Freshdesk PHP SDK](https://github.com/mpclarkson/freshdesk-php-sdk)
* [Freshdesk API Documentation](https://developer.freshdesk.com/api/)
* [Freshdesk PHP Samples](https://github.com/freshdesk/fresh-samples/tree/master/PHP)
