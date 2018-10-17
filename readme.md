<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Flight Booking System

Written in Laravel 5.5, the current version is for airline clerks rather than tourists.

**Features**
1. Manage tourists
    * add new tourist
    * delete tourist
    * add booking (choose from the flights that have seats available)
    * cancel booking

2. Manage flights
    - add new flight
    - delete flight
    - add booking (choose from the list of tourists only if there are seats available)
    - cancel booking

**Data structure**
1. Tourist
    * name
    * surname
    * sex
    * date of birth
    * country
    * notes
    * bookings

2. Flight
    * departure
    * arrival
    * seats
    * price
    * bookings