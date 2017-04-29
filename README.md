# classnames-php
PHP port of the JavaScript classNames utility. https://github.com/JedWatson/classnames

## Installation

```
composer require cjstroud/classnames-php
```

The classNames can be accessed anywhere.

```
classNames('foo', ['bar' => true]); // 'foo bar'
```

## Usage

The `classNames` function takes any number of arguments which can be a string or array. 
When using an array, if the value associated with a given key is falsy, that key won't be included in the output. 
If no value is given the true is assumed.

```
classNames('foo'); // 'foo'
classNames(['foo' => true]); // 'foo'
classNames('foo', ['bar' => false, 'baz' => true]); // 'foo baz'
classNames(['foo', 'bar' => true]) // 'foo bar'

// Falsy values get ignored
classNames('foo', null, 0, false, 1); // 'foo 1'
```

Objects and functions will be ignored, unless the object has __toString() function.
If it does that will be called and the string value used.

```
class ExampleObject {
    function __toString()
    {
        return 'bar';
    }
}

classNames('foo', function() {}, new stdClass(), new ExampleObject()); // 'foo bar'
```

## Laravel Blade

```
<div class="{{ classNames('foo', ['bar' => true]) }}"></div>

<div class="foo bar"></div>
```

## License

[MIT](LICENSE). Copyright (c) 2017 Chris Stroud.
