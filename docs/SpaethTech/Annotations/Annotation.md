# Annotation

Class Annotation

The base class for all built-in and user-defined Annotations.

* Full name: `\SpaethTech\Annotations\Annotation`



## Constants

| Constant | Type | Value |
|:---------|:-----|:------|
|`\SpaethTech\Annotations\Annotation::TARGET_NONE`||0|
|`\SpaethTech\Annotations\Annotation::TARGET_CLASS`||1|
|`\SpaethTech\Annotations\Annotation::TARGET_METHOD`||2|
|`\SpaethTech\Annotations\Annotation::TARGET_PROPERTY`||4|
|`\SpaethTech\Annotations\Annotation::TARGET_ANY`||7|

## Methods

### __construct

Annotation Constructor

```php
public Annotation::__construct(int $target, string $class, string $name, string $keyword, string $value): mixed
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `target` | **int** | The target of the current annotation, for example: class, method or property. |
| `class` | **string** | The name of the class containing the current annotation. |
| `name` | **string** | The name of the current annotation&#039;s method or property.  Use &quot;$class&quot; for class name. |
| `keyword` | **string** | A valid annotation keyword that immediately follows the &quot;@&quot; symbol. |
| `value` | **string** | Any characters following the annotation keyword, recognized as the annotation value. |


**Return Value:**





---
### getStandardAnnotations



```php
public static Annotation::getStandardAnnotations(): array
```



* This method is **static**.





**Return Value:**

Returns an array of keyword => class associations from the included "Standard" Annotations.



---
### parse



```php
public Annotation::parse(array $existing): array
```




* This method is **abstract**.



**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `existing` | **array** | Any existing annotations that were previously parsed from the same declaration. |


**Return Value:**

Returns an array of keyword => value(s) parsed by the implementing Annotation class.



---


---
> Automatically generated from source code comments on 2023-03-02 using
> [phpDocumentor](http://www.phpdoc.org/) for [spaethtech/php-monorepo](https://github.com/spaethtech/php-monorepo)

<style>
/* Remove padding and background in <code> used in the structs title */
h2 code,
h3 code,
h4 code,
h5 code {
    background: none !important;
    padding: 0 !important;
}

table {
    width: 100%;
    display: table;
}

thead > tr > th {
    text-align: left;
}

thead > tr > th:first-child {
    width: 20%;
}

/* Remove padding and background in <code> used in the tables */
td code,
th code {
    background: none;
    padding: 0;
}
</style>
