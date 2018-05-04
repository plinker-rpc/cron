# Cron

A cron component which allows you to read and control cron tasks on remote systems.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/cron
```

## Client

Creating a client instance is done as follows:


    <?php
    require 'vendor/autoload.php';

    /**
     * Initialize plinker client.
     *
     * @param string $server - URL to server listener.
     * @param string $config - server secret, and/or a additional component data
     */
    $client = new \Plinker\Core\Client(
        'http://example.com/server.php',
        [
            'secret' => 'a secret password'
        ]
    );
    
    // or using global function
    $client = plinker_client('http://example.com/server.php', 'a secret password');
   
 
## Methods

Once setup, you call the class though its namespace to its method.


### Crontab

Get crontab as-is.

**Call**


``` php
$result = $client->cron->crontab();
```

**Response**
``` text

```


### Create

Create a crontask.

**Call**


``` php
$result = $client->cron->create('My Cron Task', '* * * * * cd ~');
```

**Response**
``` text
encode this string
```


### Get

Get a crontask.

**Call**


``` php
$result = $client->cron->get('My Cron Task');
```

**Response**
``` text

```

### Update

Update cron task.

**Call**


``` php
$result = $client->cron->update('My Cron Task', '0 * * * * cd ~');
```

**Response**
``` text

```


### Read

Read a cron task.

**Call**


``` php
$result = $client->cron->read('My Cron Task');
```

**Response**
``` text

```


### Delete

Delete a cron task.

**Call**


``` php
$result = $client->cron->delete('My Cron Task');
```

**Response**
``` text

```


### Drop

Drop cron task journal.

**Call**


``` php
$result =  $client->cron->drop();
```

**Response**
``` text

```


### Dump

Return current crontab as plain text.

**Call**


``` php
$result = $client->cron->dump();
```

**Response**
``` text

```


### Apply

Apply crontab.

**Call**


``` php
$result = $client->cron->apply();
```

**Response**
``` text

```


## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/cron/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/cron/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/cron/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
