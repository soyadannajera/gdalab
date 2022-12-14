# Prueba entrevista FullStack PHP

***



## Tabla de contenidos
1. [Información General](#informacion-general)
2. [Tecnologias](#tecnologias)
3. [Requisitos](#requisitos)
3. [Instalacion](#instalacion)
4. [Uso de Apis](#uso-de-apis)
5. [Archivo Log](#archivo-log)

## General Info
***
Prueba Desarrollada en Laravel 9 con los requerimientos solicitados

## Tecnologias
***
*Framework ~ Laravel 9
*Autenticación ~ Sactum

## Requisitos
***
PHP Version 8.0.2
***

## Instalacion
***
```
$ git clone https://github.com/soyadannajera/gdalab.git
$ cd ../path/to/the/file
$ composer install
$ php artisan migrate
$ php artisan serv
```
***

## Uso de Apis
*** Publicas
***POST            api/login.............................................. CustomerController@authenticate
****query params email string

*** Privadas

***GET|HEAD        api/customer................................. customer.index › CustomerController@index
***POST            api/customer................................. customer.store › CustomerController@store
***GET|HEAD        api/customer/{customer}........................ customer.show › CustomerController@show
***PUT|PATCH       api/customer/{customer}.................... customer.update › CustomerController@update
***DELETE          api/customer/{customer}.................. customer.destroy › CustomerController@destroy
***GET|HEAD        api/commune .................................... commune.index › CommuneController@index
***POST            api/commune.................................... commune.store › CommuneController@store
***GET|HEAD        api/commune/{commune}............................ commune.show › CommuneController@show
***PUT|PATCH       api/commune/{commune}........................ commune.update › CommuneController@update
***DELETE          api/commune/{commune}...................... commune.destroy › CommuneController@destroy
***GET|HEAD        api/region....................................... region.index › RegionController@index
***POST            api/region....................................... region.store › RegionController@store
***GET|HEAD        api/region/{region}................................ region.show › RegionController@show
***PUT|PATCH       api/region/{region}............................ region.update › RegionController@update
***DELETE          api/region/{region}.......................... region.destroy › RegionController@destroy

## Archivo Log
/raiz_proyecto/storage/logs/mydblog.log