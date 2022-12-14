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
***POST            api/login.............................................. CustomerController@authenticate<br />
****query params email string<br />

*** Privadas<br />

***GET|HEAD        api/customer................................. customer.index › CustomerController@index<br />
***POST            api/customer................................. customer.store › CustomerController@store<br />
***GET|HEAD        api/customer/{customer}........................ customer.show › CustomerController@show<br />
***PUT|PATCH       api/customer/{customer}.................... customer.update › CustomerController@update<br />
***DELETE          api/customer/{customer}.................. customer.destroy › CustomerController@destroy<br />
***GET|HEAD        api/commune .................................... commune.index › CommuneController@index<br />
***POST            api/commune.................................... commune.store › CommuneController@store<br />
***GET|HEAD        api/commune/{commune}............................ commune.show › CommuneController@show<br />
***PUT|PATCH       api/commune/{commune}........................ commune.update › CommuneController@update<br />
***DELETE          api/commune/{commune}...................... commune.destroy › CommuneController@destroy<br />
***GET|HEAD        api/region....................................... region.index › RegionController@index<br />
***POST            api/region....................................... region.store › RegionController@store<br />
***GET|HEAD        api/region/{region}................................ region.show › RegionController@show<br />
***PUT|PATCH       api/region/{region}............................ region.update › RegionController@update<br />
***DELETE          api/region/{region}.......................... region.destroy › RegionController@destroy<br />

## Archivo Log
/raiz_proyecto/storage/logs/mydblog.log