<!-- Repo-specific appendix to the shared AGENTS.md. Generic conventions live in AGENTS_ARCH.md (hardlinked). -->

# AGENTS.local.md — ksfraser/exceptions Library
## Core Purpose
This is a **shared library** providing centralized exception handling for all ksfraser projects. It contains:
- **Domain exceptions**: Generic business logic exceptions
- **Utility exceptions**: Cross-cutting concerns (validation, parsing, file operations)
- **Module exceptions**: Module-specific exceptions (CRM, Calendar, ProjectManagement, etc.)
## Namespace Structure
```
Ksfraser\Exceptions\
├── Domain\           # Generic domain exceptions
│   ├── EntityNotFoundException
│   ├── ConfigurationException
│   └── InvalidBankAccountException
├── Utility\          # Cross-cutting utility exceptions
│   ├── ValidationException
│   ├── FileNotFoundException
│   └── ParsingFailedException
├── FrontAccounting\  # FrontAccounting-specific (FA platform)
├── CRM\              # CRM module exceptions
├── Calendar\          # Calendar module exceptions
└── ProjectManagement\ # ProjectManagement module exceptions
```
## Exception Design Guidelines
### Required Properties
```php
class EntityNotFoundException extends \RuntimeException
{
    private string $entityType;
    private mixed $id;
    public static function withId(string $entityType, $id): self
    {
        return new self("{$entityType} not found with id: {$id}");
    }
}
```
### Factory Methods
- Provide factory methods for common instantiation patterns
- Include context information (entity type, IDs, field names)
- Use meaningful error messages with structured data
### Exception Chaining
```php
public function __construct(
    string $message,
    ?\Throwable $previous = null
) {
    parent::__construct($message, 0, $previous);
}
```
### Module-Specific Exceptions
For modules that previously used deep inheritance with type validation in magic methods:
**OLD Pattern (Legacy):**
```php
// In BaseCRM class with magic __set
public function __set($k, $v) {
    validate_type($k, $v);  // Type validation in magic setter
    $this->$k = $v;
    $this->notify("NOTIFY_SET_{$k}", $v);  // Event notification
}
```
**NEW Pattern:**
```php
// Module exception extends library base
use Ksfraser\Exceptions\CRM\CRMException as BaseCRMException;
class CRMException extends BaseCRMException
{
    protected string $debtorNo;
    protected array $context;
    public function __construct(
        string $message,
        string $debtorNo = '',
        array $context = [],
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->debtorNo = $debtorNo;
        $this->context = $context;
    }
    public function getDebtorNo(): string { return $this->debtorNo; }
    public function getContext(): array { return $this->context; }
}
```
## Adding New Exceptions
1. Determine correct namespace (Domain/Utility/Module)
2. Extend appropriate base class
3. Add factory methods for common patterns
4. Include context properties with getters
5. Write comprehensive tests
6. Update documentation
## Development Workflow
All development is done in the **devel tree** (`~/Documents/Exceptions`).
### Workflow Steps
1. **Develop** in this repo (feature branches preferred)
2. **Test**: run repo-appropriate tests
3. **Lint**: `php -l` on modified PHP files (no syntax errors)
4. **Commit** and **Push** branch to GitHub
5. **Merge** to `master` when ready
6. **Push** `master` to GitHub
*No UAT bind point in `~/ksf_Infrastructure/fa_modules/Exceptions` — this repo is consumed via Composer path repos or other means.*
