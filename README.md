<h1 align="center">Nova Access Secret</h1>

<p align="center">
    <a href="https://packagist.org/packages/dasundev/nova-access-secret"><img src="https://img.shields.io/packagist/dt/dasundev/nova-access-secret" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/dasundev/nova-access-secret"><img src="https://img.shields.io/packagist/v/dasundev/nova-access-secret" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/dasundev/nova-access-secret"><img src="https://img.shields.io/packagist/l/dasundev/nova-access-secret" alt="License"></a>
</p>

## ✨ Introduction
This package provides a middleware for securing access to Nova by requiring a secret key to be provided in the URL.

## 🔍 How it Works
Once you've set up and configured this package, it works by preventing access to `http://my-website.com/nova`. 

If you try to visit that link, you'll see a **"404"** message. 

But if you add the secret key at the end of the URL like this: `http://my-website.com/nova/secret`, you'll be able to access the Nova login page.

> This functionality is facilitated through a specific type of cookie working behind the scenes. This cookie validates whether you possess the authorization to access the Nova login page.

## 📦 Installation

You can install the package via Composer:

 ```bash
 composer require dasundev/nova-access-secret
 ```

Optionally, you can publish the config file using:

```bash
php artisan vendor:publish --tag="nova-access-secret-config"
```
## 👩‍💻 Usage

After installing the package, open the .env file and add the following key with your secret key:

```dotenv
NOVA_ACCESS_SECRET_KEY=secret
```

To access Nova, append the secret key to the Nova URL like this:

```
https://my-website.com/nova/secret
```

Now, your Nova access is secured with the provided secret key.

> If you want to disable the secret access, simply keep the NOVA_ACCESS_SECRET_KEY value empty or delete the key from the .env file.

## 🔐 Enhance Security
To enhance security, you have the option to include your own cookie class through the configuration file.

```php
<?php

return [
 
    /*
    |--------------------------------------------------------------------------
    | Access Secret Cookie
    |--------------------------------------------------------------------------
    |
    | To use your own access secret cookie, set it here.
    |
    */

    'cookie' => MyAccessSecretCookie::class
];

```

## 🔄 Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
