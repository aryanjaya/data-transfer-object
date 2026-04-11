---
name: aryanjaya-dto-development
description: Build and work with Data Transfer Objects using aryanjaya/data-transfer-object, including automatic casting, validation, property mapping, and nested DTOs.
---

# Aryanjaya Data Transfer Object Development

## When to use this skill

Use this skill when:
- Converting arrays or JSON data into typed PHP objects
- Building API resources that need structured data representation
- Working with form request data that needs validation and type safety
- Creating immutable data structures for service layers
- Mapping external data (APIs, databases) to internal PHP objects
- Handling nested data structures with automatic casting

## Features

### Creating DTOs

Extend `DataTransferObject` and define typed public properties:

```php
use Aryanjaya\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;
    public ?string $email;
    public int $age;
}
```

Construct with named arguments or arrays:

```php
$dto = new UserDTO(name: 'John', email: 'john@example.com', age: 30);
// or
$dto = new UserDTO(['name' => 'John', 'email' => 'john@example.com', 'age' => 30]);
```

### Automatic Casting

Nested DTOs and DTO arrays are automatically cast:

```php
class OrderDTO extends DataTransferObject
{
    public UserDTO $user;           // Automatically cast from array
    public array $items;           // Array of data
}

$order = new OrderDTO([
    'user' => ['name' => 'John', 'email' => 'john@example.com', 'age' => 30],
    'items' => [],
]);
```

### Custom Casters

Implement `Caster` for complex transformations:

```php
use Aryanjaya\DataTransferObject\Caster;

class DateTimeCaster implements Caster
{
    public function cast(mixed $value): \DateTimeImmutable
    {
        return new \DateTimeImmutable($value);
    }
}
```

Apply to properties with `#[CastWith]`:

```php
use Aryanjaya\DataTransferObject\Attributes\CastWith;

class EventDTO extends DataTransferObject
{
    #[CastWith(DateTimeCaster::class)]
    public \DateTimeImmutable $startDate;
}
```

### Class-Level Casters

Define casters on the target class itself:

```php
#[CastWith(DateTimeCaster::class)]
class CustomDateTime extends \DateTimeImmutable
{
    // This class will use DateTimeCaster when encountered as a property type
}
```

### Default Casters

Register casters for types on a base DTO class:

```php
use Aryanjaya\DataTransferObject\Attributes\DefaultCast;

#[
    DefaultCast(\DateTimeImmutable::class, DateTimeCaster::class),
    DefaultCast(MyEnum::class, EnumCaster::class),
]
abstract class BaseDTO extends DataTransferObject
{
    // All child DTOs inherit these default casters
}
```

### Array Casting

Use `ArrayCaster` for typed arrays:

```php
use Aryanjaya\DataTransferObject\Casters\ArrayCaster;

class OrderDTO extends DataTransferObject
{
    /** @var OrderItemDTO[] */
    #[CastWith(ArrayCaster::class, itemType: OrderItemDTO::class)]
    public array $items;
}
```

### Property Mapping

Map from different source property names:

```php
use Aryanjaya\DataTransferObject\Attributes\MapFrom;
use Aryanjaya\DataTransferObject\Attributes\MapTo;

class ApiUserDTO extends DataTransferObject
{
    #[MapFrom('first_name')]
    #[MapTo('firstName')]
    public string $firstName;
    
    #[MapFrom('user.email')]
    public string $email;
}

$dto = new ApiUserDTO(['first_name' => 'John', 'user' => ['email' => 'john@example.com']]);
$dto->toArray(); // ['firstName' => 'John', 'email' => 'john@example.com']
```

### Validation

Create custom validation attributes implementing `Validator`:

```php
use Aryanjaya\DataTransferObject\Validator;
use Aryanjaya\DataTransferObject\Validation\ValidationResult;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class NumberBetween implements Validator
{
    public function __construct(private int $min, private int $max) {}

    public function validate(mixed $value): ValidationResult
    {
        if ($value < $this->min) {
            return ValidationResult::invalid("Value should be >= {$this->min}");
        }
        if ($value > $this->max) {
            return ValidationResult::invalid("Value should be <= {$this->max}");
        }
        return ValidationResult::valid();
    }
}
```

Apply to properties:

```php
class ValidatedDTO extends DataTransferObject
{
    #[NumberBetween(1, 100)]
    public int $percentage;
}
```

### Strict vs Flexible DTOs

DTOs are flexible by default (ignore unknown properties). Use `#[Strict]` to throw on unknown properties:

```php
use Aryanjaya\DataTransferObject\Attributes\Strict;

#[Strict]
class StrictDTO extends DataTransferObject
{
    public string $name;
}

// Throws UnknownProperties exception
new StrictDTO(name: 'John', unknown: 'value');
```

### Helper Methods

Convert and filter DTO data:

```php
$dto->all();                          // All properties as array
$dto->toArray();                      // Recursive array conversion
$dto->only('name', 'email')->toArray();   // Only specified properties
$dto->except('password')->toArray();      // Exclude specified properties

// Clone with modifications (immutable)
$clone = $dto->clone(name: 'Jane');
```

### Array of DTOs

Create multiple DTOs from array data:

```php
$users = UserDTO::arrayOf([
    ['name' => 'John', 'email' => 'john@example.com', 'age' => 30],
    ['name' => 'Jane', 'email' => 'jane@example.com', 'age' => 25],
]);
```

## Best Practices

- **Keep DTOs immutable**: Use `clone()` for modifications rather than setters
- **Type everything**: Always use explicit property types for automatic casting
- **Use class-level casters**: For reusable types, prefer `#[CastWith]` on the class over property-level attributes
- **Default casters on base classes**: Define common casters once in a base DTO class
- **Validation at the edge**: Validate incoming data at construction time using custom validators
- **Mapping for APIs**: Use `#[MapFrom]` and `#[MapTo]` to handle different naming conventions (snake_case vs camelCase)
- **Prefer flexible DTOs**: Only use `#[Strict]` when you need to catch unexpected data
- **Document array types**: Use `@var Type[]` PHPDoc when using `ArrayCaster`
