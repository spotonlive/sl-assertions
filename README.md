# Assertions for Laravel 5.1

**THIS PACKAGE IS UNDER DEVELOPMENT**

## Configuration

### Installation
Run `$ composer require spotonlive/sl-assertions`

`config/app.php`
*Insert the provider and helper alias into your application configuration*
````php
    'providers' => [
        (..)
        'SpotOnLive\Assertions\Providers\Services\AssertionsServiceProvider'
        (..)
    ]

    'aliases' => [
        (..)
        'AssertionHelper' => 'SpotOnLive\Assertions\Facades\AssertionHelperFacade'
        (..)
    ]
```

### Configuration
run `$ php artisan vendor:publish` to create the configuration file.
À configuration file is now available in `config/assertion.php`.

## Assertions
To create new examples create a new assertion file implementing the assertion interface.
For example:

`EditAssertion.php`
```php
<?php

namespace App\Assertions\Users;

use SpotOnLive\Assertions\AssertionInterface;
use App\Entities\User;

class EditAssertion implements AssertionInterface
{
    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function assert($user, array $data = [])
    {
        /** @var User $userToEdit */
        $userToEdit = $data['user'];

        if ($user == $userToEdit || $user->hasRole(['superadmin', 'admin'])) {
            return true;
        }

        return false;
    }
}
```

And then register the assertion in your configuration file:

`config/assertion.php`
````php
<?php

return [
    'users.edit' => 'App\Assertions\Users\EditAssertion'
];
```

## Usage

### Service
Use the assertion service by injecting `SpotOnLive\Assertions\Services\AssertionService`.

*Example:*
```php
<?php

namespace App\Controllers;

use \SpotOnLive\Assertions\Services\AssertionServiceInterface;

class Controller
{
    /** @var AssertionServiceInterface **/
    protected $assertionService;

    public function __construct(AssertionServiceInterface $assertionService)
    {
        $this->assertionService = $assertionService;
    }

    public function admin()
    {
        if (!$this->assertionService->isGranted('admin.page', Auth::user())) {
            return redirect()->route('not-granted');
        }

        return view('admin.page');
    }
}
``

## Organization & authors
* [**spotonlive**](https://github.com/spotonlive)
* [**nikolajpetersen**](https://github.com/Nikolajpetersen)