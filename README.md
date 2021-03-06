# Assertions for Laravel 5.1

[![Latest Stable Version](https://poser.pugx.org/spotonlive/sl-assertions/v/stable)](https://packagist.org/packages/spotonlive/sl-assertions) [![Total Downloads](https://poser.pugx.org/spotonlive/sl-assertions/downloads)](https://packagist.org/packages/spotonlive/sl-assertions) [![Latest Unstable Version](https://poser.pugx.org/spotonlive/sl-assertions/v/unstable)](https://packagist.org/packages/spotonlive/sl-assertions) [![License](https://poser.pugx.org/spotonlive/sl-assertions/license)](https://packagist.org/packages/spotonlive/sl-assertions) [![Code Climate](https://codeclimate.com/github/spotonlive/sl-assertions/badges/gpa.svg)](https://codeclimate.com/github/spotonlive/sl-assertions) [![Test Coverage](https://codeclimate.com/github/spotonlive/sl-assertions/badges/coverage.svg)](https://codeclimate.com/github/spotonlive/sl-assertions/coverage)

**THIS PACKAGE IS UNDER DEVELOPMENT**

## Configuration

### Installation
Run `$ composer require spotonlive/sl-assertions`

`config/app.php`
*Insert the provider and helper alias into your application configuration*

```php
    'providers' => [
        \SpotOnLive\Assertions\Providers\Services\AssertionServiceProvider::class,
        \SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider::class,
    ]

    'aliases' => [
        'AssertionHelper' => \SpotOnLive\Assertions\Facades\Helpers\AssertionHelperFacade::class,
    ]
```

### Configuration
run `$ php artisan vendor:publish` to create the configuration file.
A configuration file is now available in `config/assertions.php`.

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

        return $user == $userToEdit || $user->hasRole(['superadmin', 'admin']);
    }
}
```

And then register the assertion in your configuration file:

`config/assertions.php`
```php
<?php

return [
    'users.edit' => \App\Assertions\Users\EditAssertion::class,
];
```

## Usage

### Service
Use the assertion service by injecting `AssertionService`.

`app::make('AssertionService')`

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
```

### Helper

Use the `AssertionHelper` directly in your views.

*Example:*
**view.blade.php**
```php
@if(AssertionHelper::isGranted('user.edit', Auth::user(), ['user' => $user]))
    <a href="{{URL::route('user.edit')}}">{{_('Edit user')}}</a>
@endif
```

## Organization & authors
* [**spotonlive**](https://github.com/spotonlive)
* [**nikolajlovenhardt**](https://github.com/nikolajlovenhardt)
