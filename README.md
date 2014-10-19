Zae\Larattic
========

Easy Assetic management for Laravel 4 projects.

Install
-------
Installation via composer is very easy, simply add the package to your composer.json:  

```json
"require": {  
    "zae/larattic": "~0.1"  
}
```

Or download the code and add the namespace to your autoloader or simply require() the files.  

Usage
-----

Laravel 4 Facade:

```php
<?php
Larattic::asset('css')
```

About
=====

License
-------
This project has an MIT license. See the `LICENSE` file for details.

Assetic
--------
The project uses assetic to manage your assets.
 
Oyejorge/less.php
--------
The project has pre-build filters for oyejorge/less.php less compiler.

cjsDelivery
--------
The project has a pre-build filter for mattcg/cjsdelivery.

Laravel
-------
The project has easy L4 integration using it's ServiceProvider and Facade.  

add the ServiceProvider to your list of providers in the config/app file:  

```php
'providers' => array(  
	'Zae\Larattic\LaratticServiceProvider'    
)
```

and the Facade to the list of aliases in the config/app file:

```php
'aliases' => array(  
    'Larattic'v=> 'Zae\Larattic\Facades\Larattic'  
)
```

Author
------
Ezra Pool <ezra@tsdme.nl>

TODO
----
- Provide tests.
- SOLIDify the project further.