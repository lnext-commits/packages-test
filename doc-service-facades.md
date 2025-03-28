# Service Facade

## _A set of classes of services for laravel_

Creating services with a key  _--all_ in order to create all classes

```sh
php artisan make:services --all 
```

We will respond:

```
enter the name of the service:  NameService
```

The following classes were created
> app/Http/ServiceFacades/ServiceFacadeNameService

> app/Http/ServiceFacades/ActClasses/ActNameService

> app/Http/ServiceFacades/GetClasses/GetNameService

> app/Http/ServiceFacades/SalvatoryClasses/SalvatoryNameService

In the Act class, we place the code that leads you to execute on the entity, for example, create, update.

In the Get class, we place the code that leads to receiving data from the entity.

In the Salvatore class, we place arrays of data for the entity and associated with it.

To call a method from these classes, you need to access them through the facade `ServiceFacadeNameService`.
For the Act class, you need to pass the first arguments `Illuminate\Http\Request` the second argument of the method name in the Act class.
It turns out that we can only call it from the controller, but if there is a need to call Act from another place,
we need to use the act Object facade method and pass it an associative array with the first argument, and the second method names.

Sample code:

``` php
ServiceFacadeNameService::act($request, 'nameMethod');
ServiceFacadeNameService::actObject(['field1' => 'value1', 'field2' => 'value2'], 'nameMethod');
```

For the Get class, you need to pass the entity as the first argument, and the method names in the Get class as the second.

Sample code:

``` php
ServiceFacadeNameService::get($item, 'nameMethod');
```

For the Salvatore class, you need to pass the first argument of the method name in the Salvatore class,
the second optional __option__ and the third optional, the names of the __key__ array.

_There is a separate documentation on salvatore in more detail._

Sample code:

``` php
ServiceFacadeNameService::salvatory('nameMethod', 'key', 'name');
```

## The structure of the Facade class

``` php
namespace App\Http\ServiceFacades;


use App\Http\ServiceFacades\ActClasses\ActNameService;
use App\Http\ServiceFacades\GetClasses\GetNameService;
use App\Http\ServiceFacades\SalvatoryClasses\SalvatoryNameService;
use App\Http\ServiceFacades\ServiceInterfaces\FacadeInterface;
use App\Http\ServiceFacades\ParentClasses\BaseServiceFacade;
use Illuminate\Http\Request;

class ServiceFacadeNameService extends BaseServiceFacade implements FacadeInterface
{

    public static function act(Request $request, string $method)
    {
       (new ActNameService())->$method($request);
    }

    public static function get($item, string $method)
    {
       return (new GetNameService($item))->$method();
    }

    public static function salvatory(string $method, string $option = 'default', string $key = null): array|string
    {
        return (new SalvatoryNameService())->$method($option, $key);
    }

    public static function actObject(array $inputArguments, $method): void
    {
        self::act(self::setCorrectValues($inputArguments), $method);
    }
}
```

### The Structure of auxiliary Classes

- Act

``` php
namespace App\Http\ServiceFacades\ActClasses;


class ActNameService
{

    public function __construct()
    {


    }
}
```

- Get

``` php
namespace App\Http\ServiceFacades\GetClasses;


class GetNameService
{

    public function __construct($item)
    {


    }
}
```

- Salvatory

``` php
namespace App\Http\ServiceFacades\SalvatoryClasses;


use App\Http\ServiceFacades\Traits\ResponseForArray;

class SalvatoryNameService
{
    use ResponseForArray;

    public function NAME ($option, $key): array|string
    {
        $arr = [

        ];

        return $this->returnArray($arr, $option, $key, __FUNCTION__);
    }
}
```
