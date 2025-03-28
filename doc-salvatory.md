# Salvatory output array

## _The capabilities of our storage_

First you need to create a facade service

```sh
php artisan make:services 
```

We will respond:

```
enter the name of the service:  NameService

create Act class? (yes/no): no

create Get class? (yes/no): no

create Salvatory class? (yes/no): yes

```

To create only the Salvatore class
> app/Http/ServiceFacades/SalvatoryClasses/SalvatoryTempEntity

Let's create a method with an array

``` php
public function getData ($option, $key): array|string
    {
         $arr = [
            'upper1' => [
                'attachments1' => [
                    'internal1' => [
                        'value1',
                        'value2',
                        'value3',
                    ]
                ],
                'attachments2' => [
                    'internal2' => [
                        'value4',
                        'value5',
                        'value6',
                    ]
                ],
            ],
            'upper2' => [
                'attachments3' => 'value1',
                'attachments4' => 'value2',
                'attachments5' => 'value1',
                'attachments6' => 'value2',
            ],
            'upper3' => [
                'attachments7' => 'value10',
                'attachments8' => 'value11',
                'attachments9' => 'value12',
                'attachments10' => 'value13',
            ],
        ];

        return $this->returnArray($arr, $option, $key, __FUNCTION__);
    }

```

Access to the array from anywhere in the application

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData'); 
```

Result

```
array:3 [
  "upper1" => array:2 [
    "attachments1" => array:1 [
      "internal1" => array:3 [
        0 => "value1"
        1 => "value2"
        2 => "value3"
      ]
    ]
    "attachments2" => array:1 [
      "internal2" => array:3 [
        0 => "value4"
        1 => "value5"
        2 => "value6"
      ]
    ]
  ]
  "upper2" => array:4 [
    "attachments3" => "value1"
    "attachments4" => "value2"
    "attachments5" => "value1"
    "attachments6" => "value2"
  ]
  "upper3" => array:4 [
    "attachments7" => "value10"
    "attachments8" => "value11"
    "attachments9" => "value12"
    "attachments10" => "value13"
  ]
]
```

---
Transmitted  __options__

- key

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'key');
```

Result

```
array:3 [
  0 => "upper1"
  1 => "upper2"
  2 => "upper3"
]
```

- value

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'value');
```

Result

```
array:3 [
  0 => array:2 [
    "attachments1" => array:1 [
      "internal1" => array:3 [
        0 => "value1"
        1 => "value2"
        2 => "value3"
      ]
    ]
    "attachments2" => array:1 [
      "internal2" => array:3 [
        0 => "value4"
        1 => "value5"
        2 => "value6"
      ]
    ]
  ]
  1 => array:4 [
    "attachments3" => "value1"
    "attachments4" => "value2"
    "attachments5" => "value1"
    "attachments6" => "value2"
  ]
  2 => array:4 [
    "attachments7" => "value10"
    "attachments8" => "value11"
    "attachments9" => "value12"
    "attachments10" => "value13"
  ]
]
```

- dot

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'dot');
```

Result

```
array:14 [
  "upper1.attachments1.internal1.0" => "value1"
  "upper1.attachments1.internal1.1" => "value2"
  "upper1.attachments1.internal1.2" => "value3"
  "upper1.attachments2.internal2.0" => "value4"
  "upper1.attachments2.internal2.1" => "value5"
  "upper1.attachments2.internal2.2" => "value6"
  "upper2.attachments3" => "value1"
  "upper2.attachments4" => "value2"
  "upper2.attachments5" => "value1"
  "upper2.attachments6" => "value2"
  "upper3.attachments7" => "value10"
  "upper3.attachments8" => "value11"
  "upper3.attachments9" => "value12"
  "upper3.attachments10" => "value13"
]
```

---
Transmitted  __key__

Code:

``` php
ServiceFacadeTempEntity::salvatory('getData', key: 'upper1');
```

Result

```
array:2 [
  "attachments1" => array:1 [
    "internal1" => array:3 [
      0 => "value1"
      1 => "value2"
      2 => "value3"
    ]
  ]
  "attachments2" => array:1 [
    "internal2" => array:3 [
      0 => "value4"
      1 => "value5"
      2 => "value6"
    ]
  ]
]
```

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', key: 'upper1.attachments1.internal1');
```

Result

```
array:3 [
  0 => "value1"
  1 => "value2"
  2 => "value3"
]
```

---

Combining

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'key', 'upper1.attachments1');
```

Result

```
array:1 [
  0 => "internal1"
]
```

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'value', 'upper1.attachments1');
```

Result

```
array:1 [
  0 => array:3 [
    0 => "value1"
    1 => "value2"
    2 => "value3"
  ]
]
```

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'dot', 'upper1.attachments1');
```

Result

```
array:3 [
  "internal1.0" => "value1"
  "internal1.1" => "value2"
  "internal1.2" => "value3"
]
```

---

Expansion __option__

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'key.value1', 'upper2');
```

Result

```
array:2 [
  0 => "attachments3"
  1 => "attachments5"
]
```

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', 'value.value12', 'upper3');
```

Result

```
"attachments9"
```

---

Error if there is no requested key

Code:

``` php 
ServiceFacadeTempEntity::salvatory('getData', key: 'upper1.qwr'); 
```

Result

```
"the required key (upper1.qwr) is not in the array (getData) signature:%^$*!@$!"
```
