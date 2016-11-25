## About
[![Build Status](https://travis-ci.org/chrisyoyo/akismet-spam.png?branch=master)](https://travis-ci.org/chrisyoyo/akismet-spam)


Laravel 5 package that allows you to deal with spams using [Akismet](https://akismet.com).


## Usage

In your project:
```composer require chrisyoyo/akismet-spam```

In ```config/app.php``` providers:

```php
Chrisyoyo\AkismetSpam\SpamServiceProvider::class,
```

Next, publish the package default config:

```
php artisan vendor:publish --provider="Chrisyoyo\AkismetSpam\SpamServiceProvider"
```

In the .env change your akismet secret and website.

Then add a boolean 'spam' column with default to false on models you want to use.
And add the spammable trait, and the getSpamColumns function to it like this :

```php

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisyoyo\AkismetSpam\Spammable;

class Post extends Model
{
    use Spammable;

    public function getSpamColumns()
    {
        return [
            'body' => 'body',
            'author' => 'user.name',
            'author_email' => 'user.email',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

...
```

It is very flexible, in your controller you have 3 choices of implementation, first the easiest for the store method:

```php

public function store(Request $request)
    {
        $post = new Post;
        $post->body = 'Hello, my name is ' . $request->user()->name;
        $post->user()->associate($request->user());

        if ($post->isSpam()) {
            $post->spam = true;
        }

        $post->save();
    }

...
```

It can be done because you have the Spammable trait on your model.

You can also add the interface on your controller and use it like this:

```php

use Chrisyoyo\AkismetSpam\Service\SpamServiceInterface;

...


protected $spam;

public function __construct(SpamServiceInterface $spam)
{
    $this->middleware(['auth']);

    $this->spam = $spam;
}

public function store(Request $request)
{
    $post = new Post;
    $post->body = 'Hello, my name is ' . $request->user()->name;
    $post->user()->associate($request->user());

    if ($this->spam->isSpam([
        'body' => $post->body,
        'author' => $post->user->name,
        'author_email' => $post->user->email,
    ])) {
        $this->spam->markAsSpam([
            'body' => $post->body,
            'author' => $post->user->name,
            'author_email' => $post->user->email,
        ]);

        $post->spam = true;
    }

    $post->save();
}

...
```

or simply use the Spam Facade:

```php

use Chrisyoyo\AkismetSpam\Spam;

...

public function store(Request $request)
{
    if (Spam::isSpam([
        'body' => $post->body,
        'author' => $post->user->name,
        'author_email' => $post->user->email,
    ])) {
        Spam::markAsSpam([
            'body' => $post->body,
            'author' => $post->user->name,
            'author_email' => $post->user->email,
        ])

        $post->spam = true;
    }
}

...
```

Then you have two examples function to mark as a spam, or say that is not a spam.


```php
public function spam(Post $post)
{
    $post->markAsSpam();

    $post->spam = true;
    $post->save();
}

public function ham(Post $post)
{
    $post->markAsHam();

    $post->spam = false;
    $post->save();
}

...
```
