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

