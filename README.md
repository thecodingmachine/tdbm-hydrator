[![Latest Stable Version](https://poser.pugx.org/mouf/tdbm-hydrator/v/stable)](https://packagist.org/packages/mouf/tdbm-hydrator)
[![Total Downloads](https://poser.pugx.org/mouf/tdbm-hydrator/downloads)](https://packagist.org/packages/mouf/tdbm-hydrator)
[![Latest Unstable Version](https://poser.pugx.org/mouf/tdbm-hydrator/v/unstable)](https://packagist.org/packages/mouf/tdbm-hydrator)
[![License](https://poser.pugx.org/mouf/tdbm-hydrator/license)](https://packagist.org/packages/mouf/tdbm-hydrator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thecodingmachine/tdbm-hydrator/badges/quality-score.png?b=1.0)](https://scrutinizer-ci.com/g/thecodingmachine/tdbm-hydrator/?branch=1.0)
[![Build Status](https://travis-ci.org/thecodingmachine/tdbm-hydrator.svg?branch=1.0)](https://travis-ci.org/thecodingmachine/tdbm-hydrator)
[![Coverage Status](https://coveralls.io/repos/thecodingmachine/tdbm-hydrator/badge.svg?branch=1.0&service=github)](https://coveralls.io/github/thecodingmachine/tdbm-hydrator?branch=1.0)


About the TDBM hydrator
=======================

This package contains an **hydrator**.
An **hydrator** is a class that takes an array in parameter and maps it to an object (calling the appropriate getters and setters).

Unlike most existing hydrators that need an object instance to be filled, the *tdbm-hydrator* package can (optionally) create a new object instance. This is very useful when you have big constructors with lots of parameters to fill from the array, which happen often if you use [TDBM](http://mouf-php.com/packages/mouf/database.tdbm).

Note that this package is completely standalone and does not need TDBM or Mouf to run. Still, this hydrator is known to work very well with TDBM generated beans (hence the name).

Installation
============

```
composer require mouf/tdbm-hydrator
```

Usage
=====

Let's assume you have a simple `Product` class:

```php
class Product
{
    private $name;
    private $price;
    private $inStock;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setInStock(bool $inStock)
    {
        $this->inStock = $inStock;
    }

    // Let's assume we have getters too...
}
```

Now, I have this PHP array I want to turn into an object:

```php
$productAsArray = [
    'name' => 'My product',
    'price' => '99',
    'in_stock' => true
]
```

Creating a new hydrated object
------------------------------

I can create an object ex-nihilo, using the following code:

```php
$hydrator = new TdbmHydrator();

$product = $hydrator->hydrateNewObject([
    'name' => 'My product',
    'price' => '99',
    'in_stock' => true
], Product::class);
```

Notice that:

- the `TdbmHydrator` will map each item of the array to the constructor arguments or the setters
- the `TdbmHydrator` can sort out differences between camel-case and underscored names (for instance, it can map `in_stock` to `setInStock()`)

Hydrating an existing object
----------------------------

I can also fill an existing object with values from an array. In this case, only setters are called:

```php
$product = new Project('My product', 99);

$hydrator->hydrateObject([
    'in_stock' => true
], $product);
```
