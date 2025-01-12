# Child select field for Laravel Nova

This field allows you to dynamically fill options of the select based on value in parent select field.

Field is based on [nova-ajax-select](https://github.com/dillingham/nova-ajax-select).
But instead of providing api endpoint, you can fill options by a closure function.

![](https://user-images.githubusercontent.com/29180903/52602810-15c53900-2e32-11e9-9ade-492bfe80b234.gif)

### Install
```
composer require vlinde/nova-child-select
```

### Usage
Class have 2 special methods on top of default Select from Laravel Nova.
`parent` should be a select field or another child select this one depends on.
`options` should be a callable. it will receive parent select field's value as first argument and should return an array to be shown on the child select field.


### Example

```
use Vlinde\ChildSelect\ChildSelect;

public function fields(Request $request)
    {
        return [

            ID::make()->sortable(),

            Select::make('Country')
                ->options(Country::all()->pluck('id','name')
                ->rules('required'),

            ChildSelect::make('City')
                ->parent('country')
                ->options(function ($value) { 
                    City::whereCountry($value)->get()->pluck('id','name')
                })
                ->model(City::class)
                ->rules('required'),
        ];
    }

```
