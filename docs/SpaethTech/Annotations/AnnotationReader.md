# AnnotationReader

Class AnnotationReader



* Full name: `\SpaethTech\Annotations\AnnotationReader`
* This class is marked as **final** and can't be subclassed



## Constants

| Constant | Type | Value |
|:---------|:-----|:------|
|`\SpaethTech\Annotations\AnnotationReader::CACHE_JSON_OPTIONS`||JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT|
|`\SpaethTech\Annotations\AnnotationReader::PARSE_TYPE_CLASS`||1|
|`\SpaethTech\Annotations\AnnotationReader::PARSE_TYPE_METHOD`||2|
|`\SpaethTech\Annotations\AnnotationReader::PARSE_TYPE_PROPERTY`||4|
|`\SpaethTech\Annotations\AnnotationReader::ANNOTATION_PATTERN`||&#039;/\\*(?:[\\t ]*)?@([\\w_\\-\\\\]+)(?:[\\t ]*)?(.*)$/m&#039;|
|`\SpaethTech\Annotations\AnnotationReader::CACHE_FOLDER`||&quot;.annotations&quot;|

## Methods

### __construct



```php
public AnnotationReader::__construct(string $class): mixed
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `class` | **string** | The name of the class for which to perform all reflections and annotation parsing. |


**Return Value:**





---
### cacheDir



```php
public static AnnotationReader::cacheDir(string|null $path = null): string|null
```



* This method is **static**.




**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `path` | **string|null** | If provided, sets the cache directory for annotations from this point forward. |


**Return Value:**

Returns the directory path, or NULL if caching is disabled.



---
### cacheDirForClass



```php
public static AnnotationReader::cacheDirForClass(string $class): ?string
```



* This method is **static**.




**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `class` | **string** |  |


**Return Value:**





---
### cacheClear



```php
public static AnnotationReader::cacheClear(array|null $classes = null): void
```



* This method is **static**.




**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `classes` | **array|null** | An optional array of class names for which to remove, ignoring the rest. |


**Return Value:**





---
### hasMethodAnnotationsCached



```php
public static AnnotationReader::hasMethodAnnotationsCached(string $class, string $method): bool
```



* This method is **static**.




**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `class` | **string** |  |
| `method` | **string** |  |


**Return Value:**





---
### getMethodAnnotationsCached



```php
public static AnnotationReader::getMethodAnnotationsCached(string $class, string $method): ?array
```



* This method is **static**.




**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `class` | **string** |  |
| `method` | **string** |  |


**Return Value:**





---
### parse



```php
private AnnotationReader::parse(int $target, string $docBlock, string $name = &quot;&quot;): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `target` | **int** |  |
| `docBlock` | **string** |  |
| `name` | **string** |  |


**Return Value:**





---
### getUseStatements



```php
public AnnotationReader::getUseStatements(): array
```









**Return Value:**

Returns an array containing the pairing between class/alias and fully qualified class name.



---
### getNamespace



```php
public AnnotationReader::getNamespace(): string
```









**Return Value:**

Returns the namespace part of the current class.



---
### findAnnotationClass

Returns the fully qualified class name, even if a non-qualified or aliased class name is provided.

```php
public AnnotationReader::findAnnotationClass(string $class): string|null
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `class` | **string** | The class name to be used for the lookup. |


**Return Value:**

Returns the fully qualified class name or NULL if a valid Annotation class is not found.



---
### getReflectedClass



```php
public AnnotationReader::getReflectedClass(): \ReflectionClass
```









**Return Value:**

Returns the current class, using the Reflection engine.



---
### getReflectedMethods

Gets all methods of the current class, optionally filtering by bitwise disjunction of the following:
- ReflectionMethod::IS_STATIC
- ReflectionMethod::IS_PUBLIC
- ReflectionMethod::IS_PROTECTED
- ReflectionMethod::IS_PRIVATE
- ReflectionMethod::IS_ABSTRACT
- ReflectionMethod::IS_FINAL

```php
public AnnotationReader::getReflectedMethods(int|null $filter = null): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `filter` | **int|null** | Any optional filters, defaults to ALL methods. |


**Return Value:**

Returns an array of the filtered class methods, using the Reflection engine.



---
### getReflectedMethod

Gets the specified method of the current class.

```php
public AnnotationReader::getReflectedMethod(string $method): \ReflectionMethod
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `method` | **string** | The name of a specific method to retrieve. |


**Return Value:**

Returns a method of the current class, given a name, using the Reflection engine.



---
### getReflectedProperties



```php
public AnnotationReader::getReflectedProperties(int|null $filter = null): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `filter` | **int|null** | An optional filter to be used to get only certain types of properties. |


**Return Value:**

Returns the properties of the current class, given an optional filter, using the Reflection engine.



---
### getReflectedProperty



```php
public AnnotationReader::getReflectedProperty(string $property): \ReflectionProperty
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `property` | **string** | The name of a specific property to retrieve. |


**Return Value:**

Returns a property of the current class, given a name, using the Reflection engine.



---
### getAnnotations



```php
public AnnotationReader::getAnnotations(): array
```









**Return Value:**

Returns an associative array of all class, method and property annotations for the current class.



---
### getClassAnnotations



```php
public AnnotationReader::getClassAnnotations(): array
```









**Return Value:**

Returns an associative array of all annotations for the current class.



---
### getClassAnnotation



```php
public AnnotationReader::getClassAnnotation(string $keyword): mixed
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `keyword` | **string** | The keyword of an annotation for this class. |


**Return Value:**

Returns the value of the specified annotation for the current class.



---
### getClassAnnotationsLike



```php
public AnnotationReader::getClassAnnotationsLike(string $pattern): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `pattern` | **string** | A pattern for which to search the keywords of annotations for this class. |


**Return Value:**

Returns an associative array of any matching annotations for the current class.



---
### hasClassAnnotation



```php
public AnnotationReader::hasClassAnnotation(string $keyword): bool
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `keyword` | **string** | The keyword of an annotation for this class. |


**Return Value:**

Returns TRUE if the class annotation exists, otherwise FALSE.



---
### getMethodAnnotations



```php
public AnnotationReader::getMethodAnnotations(string|string[] $methods): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `methods` | **string|string[]** |  |


**Return Value:**

Returns an associative array of all annotations for the method(s) of the current class.



---
### getMethodAnnotation



```php
public AnnotationReader::getMethodAnnotation(string $method, string $keyword): mixed
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `method` | **string** | The method of the current class for which to examine. |
| `keyword` | **string** | The keyword of an annotation for this method. |


**Return Value:**

Returns the value of the annotation for the given method of the current class.



---
### getMethodAnnotationsLike



```php
public AnnotationReader::getMethodAnnotationsLike(string $method, string $pattern): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `method` | **string** | The method of the current class for which to examine. |
| `pattern` | **string** | A pattern for which to search the keywords of annotations for this method. |


**Return Value:**

Returns an associative array of matching annotations for the given method of the current class.



---
### hasMethodAnnotation



```php
public AnnotationReader::hasMethodAnnotation(string $method, string $keyword): bool
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `method` | **string** | The method of the current class for which to examine. |
| `keyword` | **string** | The keyword of an annotation for this method. |


**Return Value:**

Returns TRUE if the method annotation exists, otherwise FALSE.



---
### getPropertyAnnotations



```php
public AnnotationReader::getPropertyAnnotations(string[]|string $properties): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `properties` | **string[]|string** |  |


**Return Value:**

Returns an associative array of all annotations for the property/properties of the current class.



---
### getPropertyAnnotation



```php
public AnnotationReader::getPropertyAnnotation(string $property, string $keyword): mixed
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `property` | **string** | The property of the current class for which to examine. |
| `keyword` | **string** | The keyword of an annotation for this property. |


**Return Value:**

Returns the value of the annotation for the give property of the current class.



---
### getPropertyAnnotationsLike



```php
public AnnotationReader::getPropertyAnnotationsLike(string $property, string $pattern): array
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `property` | **string** | The property of the current class for which to examine. |
| `pattern` | **string** | A pattern for which to search the keywords of annotations for this property. |


**Return Value:**

Returns an associative array of matching annotations for the given property of the current class.



---
### hasPropertyAnnotation



```php
public AnnotationReader::hasPropertyAnnotation(string $property, string $keyword): bool
```








**Parameters:**

| Parameter  | Type  | Description  |
|:-----------|:------|:-------------|
| `property` | **string** | The property of the current class for which to examine. |
| `keyword` | **string** | The keyword of an annotation for this property. |


**Return Value:**

Returns TRUE if the property annotation exists, otherwise FALSE.



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
