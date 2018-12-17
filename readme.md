# Laravel-Multivers

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![StyleCI][ico-styleci]][link-styleci]

Easily communicate with the Unit4 Multivers Web API.

## Installation

Via Composer

``` bash
$ composer require laveto/laravel-multivers
```

Publish config file

``` bash
$ php artisan vendor:publish --tag=laravel-multivers
```

Update the config file, it is possible to define multiple connections. See below for an example of a defined connection.

```
'api_url' => 'http://192.168.0.15/API_1_9_3',
'refresh_token' => 'dGVK!IAAAAApkHjXCUJTwYzs1sgqyoCW5D7sI3DROdJbXG9zzE6q14KAAAAFS34NmSN4rH0gUjgXsc-WrdCqKAkEkRe-7rc-fBKSwoiKnQnxreNGzzj7an18DBH3hmoOQlIfrl7ShUY8ZB4_YzsMLCf0qrggum3OAvkvBQnSuzOkcUR1xzTIGOmt1VmJs_NqbYqSLw6HAwKb4hGptxAaStfGhW2J6TJoa6350RMwIe3p6ISE7AGcPzeJMDaBBpkf6TK4BWfvzuVoVjA5Mfcr_5hxQTx8tqOMjzhsWkwnx2DfJY9IQg-7cpHy6wn6yuM5OrprIuW5IHxBrhD6acYKLUY7eigc1e3MKOX2hqw',
'client_id' => '0C16C134-2491-431E-B1D5-E470D0FE834E',
'client_secret' => 'cRenESWEbrewrEjatHe7atHaf4uwuzEphemespUFreBR8cuXaZ',
'grant_type' => 'refresh_token',
'database' => 'MVL00001'
```

The `refresh_token` is obtained via the "RefreshTokenGenerator" which you can download [here](https://laveto.nl/RefreshTokenGenerator.zip).

## Usage

If you didn't add the library as an allias in your config/app.php then you need to add the following line at the top of your php file.

``` php
use Laveto\LaravelMultivers\Facades\Multivers;
```

To make a get call use:
```
$result = Multivers::get('CustomerInfoList');
```

Optionally you can pass extra data that will be added in the request query string. Of course you can also use the OData parameters here. See below example.

```
$result = Multivers::get('CustomerInfoList', ['$top' => 3]);
```

To make post request you need to use `Multivers::post()`.

```
$result = Multivers::post('Customer', [
    "accountManagerId": "sample string 1",
    "addresses": null,
    "messages": [],
    "applyOrderSurcharge": true,
    "businessNumber": "sample string 3",
    "canChange": true,
    "cannotChangeReason": "sample string 5",
    "chargeVatTypeId": 0,
    "city": "sample string 6",
    "cocCity": "sample string 7",
    "cocDate": "sample string 8",
    "cocRegistration": "sample string 9",
    "collectiveInvoiceSystemId": "sample string 10",
    "combineInvoicesForElectronicBanking": true,
    "countryId": "sample string 12",
    "creditLimit": 13.0,
    "creditSqueezeId": "sample string 14",
    "currencyId": "sample string 15",
    "customerGroupId": 16,
    "customerId": "sample string 17",
    "customerStateId": "sample string 18",
    "database": "sample string 19",
    "dateChanged": "sample string 20",
    "dateCreated": "sample string 21",
    "deliveryConditionId": "sample string 22",
    "discountPercentage": 23.0,
    "email": "sample string 24",
    "fax": "sample string 25",
    "fullAddress": "sample string 26",
    "fullDeliveryAddress": "sample string 27",
    "googleMapsDirectionsUrl": "sample string 28",
    "googleMapsUrl": "sample string 29",
    "governmentDigitalId": "sample string 30",
    "hasOutstandingBalance": true,
    "homepage": "sample string 32",
    "includeVatOnOrderByDefault": true,
    "intrastatGoodsCodeId": 1,
    "intrastatGoodsDistributionId": 1,
    "intrastatStatSystemId": 1,
    "intrastatTrafficRegionId": 1,
    "intrastatTransactionTypeId": "sample string 34",
    "intrastatTransportTypeId": 1,
    "invoiceOnBehalfOfMembers": true,
    "isDunForPayment": true,
    "isInFactoring": true,
    "isPaymentRefRequired": true,
    "isPurchaseOrganization": true,
    "languageId": "sample string 40",
    "mobilePhone": "sample string 41",
    "name": "sample string 42",
    "organizationId": 43,
    "paymentConditionId": "sample string 44",
    "person": "sample string 45",
    "pricelistId": "sample string 46",
    "printPurchaseDetails": true,
    "purchaseOrganizationId": "sample string 48",
    "purchaseOrganizationMemberId": "sample string 49",
    "revenueAccountId": "sample string 50",
    "shortName": "sample string 51",
    "street1": "sample string 52",
    "street2": "sample string 53",
    "supplierId": "sample string 54",
    "telephone": "sample string 55",
    "usesUBLInvoice": true,
    "vatNumber": "sample string 57",
    "vatScenarioId": 1,
    "vatVerificationDate": "sample string 58",
    "zipCode": "sample string 59"
]);
```

Besides `GET` and `POST` you can also use `PUT` and `DELETE`.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

Tests are not included yet.


## Security

If you discover any security related issues, please  email author instead of using the issue tracker.

## Credits

- [Bart Jansen][link-author]
- [All Contributors][link-contributors]

## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/laveto/laravel-multivers.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/laveto/laravel-multivers.svg?style=flat-square
[ico-styleci]: https://github.styleci.io/repos/155196029/shield

[link-packagist]: https://packagist.org/packages/laveto/laravel-multivers
[link-downloads]: https://packagist.org/packages/laveto/laravel-multivers
[link-styleci]: https://github.styleci.io/repos/155196029
[link-author]: https://github.com/bartjansen1989
[link-contributors]: ../../contributors
