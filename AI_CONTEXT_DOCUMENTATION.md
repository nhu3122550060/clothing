# BE-Clothing Project - AI Context Documentation

## Project Overview

**BE-Clothing** is a PHP web application built with the **Tempest Framework** - a modern PHP framework that focuses on simplicity and developer experience. The project is containerized using Docker and includes a MySQL database setup.

### Key Technologies

- **PHP 8.4** - Modern PHP version with strict typing
- **Tempest Framework v1.0** - Main application framework
- **Docker & Docker Compose** - Container orchestration
- **MySQL 8.0** - Database
- **Tailwind CSS** - Styling framework
- **Vite** - Build tool for assets
- **PHPUnit** - Testing framework
- **Mago** - PHP code formatting and linting tool

## Project Structure

```
clothing/
├── app/                    # Application source code
│   ├── HelloCommand.php    # Console command example
│   ├── HomeController.php  # Main controller
│   ├── home.view.php       # Home page view
│   ├── x-base.view.php     # Base layout template
│   ├── main.entrypoint.css # CSS entry point
│   └── main.entrypoint.ts  # TypeScript entry point
├── tests/                  # Test files
│   ├── HomeControllerTest.php
│   └── IntegrationTestCase.php
├── public/                 # Public web assets
│   ├── index.php          # Application entry point
│   └── favicon/           # Favicon files
├── docker/                # Docker configuration
├── vendor/                # Composer dependencies
├── composer.json          # PHP dependencies
├── docker-compose.yml     # Docker services
├── Dockerfile            # Container definition
├── mago.toml             # Code formatting/linting config
├── phpunit.xml           # Testing configuration
└── vite.config.ts        # Asset build configuration
```

## Source Code Summary

### Core Application Files

#### 1. Entry Point (`public/index.php`)
- Bootstrap file that initializes the Tempest HTTP application
- Uses strict typing declaration
- Loads autoloader and boots the application

#### 2. Home Controller (`app/HomeController.php`)
- **Class**: `HomeController` (final readonly)
- **Namespace**: `App`
- **Route**: `GET /` mapped to `__invoke()` method
- **Returns**: View object rendering `home.view.php`
- Uses Tempest's attribute-based routing system

#### 3. Console Command (`app/HelloCommand.php`)
- **Class**: `HelloCommand` (final)
- **Namespace**: `App`
- **Command**: Console command with `world` method
- **Feature**: Accepts optional `$name` parameter with default "stranger"
- Uses Tempest's console command attributes

#### 4. View Templates
- **Base Layout** (`x-base.view.php`): HTML5 structure with Tailwind CSS
- **Home View** (`home.view.php`): Landing page with gradient background and Tempest branding
- Uses Tempest's templating system with `<x-slot>` components

### Testing Structure

#### 1. Test Base Class (`tests/IntegrationTestCase.php`)
- **Abstract class** extending `Tempest\Framework\Testing\IntegrationTest`
- **Root directory**: Points to project root for test configuration
- **Namespace**: `Tests`

#### 2. Home Controller Test (`tests/HomeControllerTest.php`)
- **Class**: `HomeControllerTest` (final, internal)
- **Test Method**: `test_index()` - Tests GET / route
- **Assertions**: Checks HTTP 200 response and "Tempest" text presence

### Configuration Files

#### 1. Composer Configuration (`composer.json`)
- **Framework**: Tempest Framework ^1.0
- **PHP Version**: Requires PHP 8.4+
- **Dev Dependencies**: PHPUnit, Symfony VarDumper, Mago
- **Autoloading**: PSR-4 with `App\` namespace mapping to `app/`
- **Scripts**: Quality assurance commands (format, lint, test)

#### 2. Docker Configuration
- **Multi-container setup**: App (PHP), Database (MySQL), PHPMyAdmin
- **Ports**: 9090 (app), 3311 (database), 9091 (PHPMyAdmin)
- **PHP Version**: 8.4 with Apache
- **Database**: MySQL 8.0 with predefined schema

#### 3. Code Quality Tools
- **Mago**: PHP formatting and linting with custom rules
- **PHPUnit**: Test configuration with coverage reporting
- **Vite**: Asset building with Tailwind CSS integration

## Coding Conventions

### 1. PHP Standards

#### File Structure
- **Strict Types**: All PHP files must start with `declare(strict_types=1);`
- **Namespace**: Use PSR-4 autoloading with `App\` namespace
- **Class Modifiers**: Prefer `final` classes where inheritance isn't needed
- **Readonly Classes**: Use `readonly` for immutable data classes
- **Opening Tags**: Use `<?php` without closing tags in PHP-only files
- **File Encoding**: UTF-8 without BOM

#### Code Style
- **Formatting**: 4 spaces indentation, no tabs
- **Line Length**: Max 180 characters (configured in mago.toml)
- **Braces**: Opening braces on same line for classes, methods, and control structures
- **Type Hints**: Always use strict type hints for parameters and return types
- **Null Handling**: Use `?` for nullable types (e.g., `?string`, `?int`)
- **Array Syntax**: Use short array syntax `[]` instead of `array()`
- **String Quotes**: Use single quotes for simple strings, double quotes for interpolation

#### Naming Conventions
- **Classes**: PascalCase (e.g., `HomeController`, `HelloCommand`)
- **Methods**: camelCase (e.g., `__invoke()`, `world()`)
- **Variables**: camelCase with descriptive names
- **Constants**: UPPER_SNAKE_CASE
- **Files**: Match class names exactly
- **Interfaces**: Suffix with `Interface` (e.g., `UserRepositoryInterface`)
- **Traits**: Suffix with `Trait` (e.g., `TimestampableTrait`)
- **Enums**: PascalCase with descriptive names (e.g., `OrderStatus`)

#### Method and Function Guidelines
```php
// Good: Descriptive method names with proper type hints
public function calculateTotalPrice(array $items): float
{
    return array_sum(array_map(fn($item) => $item->price, $items));
}

// Good: Use of readonly properties
final readonly class Product
{
    public function __construct(
        public string $name,
        public float $price,
        public int $stock,
    ) {}
}

// Good: Proper null handling
public function findUserById(?int $id): ?User
{
    return $id ? $this->repository->find($id) : null;
}
```

#### Exception Handling
- **Custom Exceptions**: Create domain-specific exceptions extending base PHP exceptions
- **Exception Messages**: Use descriptive messages with context
- **Error Codes**: Use meaningful error codes for API responses
- **Logging**: Log exceptions with appropriate levels

```php
// Good: Custom exception with context
final class ProductNotFoundException extends Exception
{
    public function __construct(int $productId)
    {
        parent::__construct("Product with ID {$productId} not found");
    }
}
```

### 2. Tempest Framework Conventions

#### Controllers
- Use `final readonly` classes for controllers
- Single responsibility - one controller per route group
- Use `__invoke()` method for single-action controllers
- Leverage attribute-based routing with `#[Get]`, `#[Post]`, etc.
- Keep controllers thin - delegate business logic to services
- Use dependency injection for services and repositories

```php
// Good: Single-action controller with proper attributes
#[Get('/products/{id}')]
final readonly class ShowProductController
{
    public function __construct(
        private ProductService $productService,
    ) {}

    public function __invoke(int $id): View
    {
        $product = $this->productService->findById($id);
        return view('products.show', ['product' => $product]);
    }
}
```

#### Views
- Use `.view.php` suffix for template files
- Leverage Tempest's component system (`<x-base>`, `<x-slot>`)
- Keep logic minimal in templates
- Use PHP's alternative syntax in templates where appropriate
- Escape output using `{{ }}` for safe rendering
- Use descriptive variable names passed from controllers

```php
// Good: Clean view with proper escaping
<x-base>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
        <p class="text-gray-600">{{ $product->description }}</p>
        <div class="mt-4">
            <span class="text-lg font-semibold">${{ number_format($product->price, 2) }}</span>
        </div>
    </div>
</x-base>
```

#### Commands
- Use `final` classes for console commands
- Implement `HasConsole` trait for console functionality
- Use `#[ConsoleCommand]` attribute for command registration
- Provide sensible defaults for command parameters
- Use descriptive command names and help text
- Validate input parameters

```php
// Good: Well-structured console command
final class ImportProductsCommand
{
    use HasConsole;

    #[ConsoleCommand('import:products')]
    public function import(string $filePath, bool $dryRun = false): void
    {
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        $this->info("Starting product import...");
        // Implementation here
    }
}
```

#### Services and Repositories
- Use dependency injection for all services
- Create interfaces for repositories
- Keep services focused on single responsibility
- Use DTOs for data transfer between layers

```php
// Good: Service with interface and dependency injection
interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function save(Product $product): Product;
}

final readonly class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function createProduct(CreateProductDto $dto): Product
    {
        $product = new Product($dto->name, $dto->price, $dto->stock);
        return $this->productRepository->save($product);
    }
}
```

### 3. Testing Standards

#### Test Organization
- **Namespace**: `Tests\` for all test classes
- **File Naming**: `*Test.php` suffix
- **Class Naming**: Match tested class with `Test` suffix
- **Method Naming**: Descriptive test names with `test_` prefix
- **Test Categories**: Unit tests, Integration tests, Feature tests

#### Test Structure
- **Base Class**: Extend `IntegrationTestCase` for integration tests
- **Annotations**: Use `@internal` for test classes
- **Assertions**: Use fluent assertion methods
- **Test Data**: Keep test data minimal and focused
- **Setup/Teardown**: Use `setUp()` and `tearDown()` methods appropriately

#### Test Naming and Documentation
```php
// Good: Descriptive test names and clear assertions
/**
 * @internal
 */
final class ProductServiceTest extends IntegrationTestCase
{
    public function test_create_product_with_valid_data_returns_product(): void
    {
        $dto = new CreateProductDto('Test Product', 99.99, 10);
        
        $product = $this->productService->createProduct($dto);
        
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(99.99, $product->price);
    }

    public function test_create_product_with_invalid_price_throws_exception(): void
    {
        $dto = new CreateProductDto('Test Product', -10.00, 10);
        
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Price must be positive');
        
        $this->productService->createProduct($dto);
    }
}
```

#### Test Data Management
- **Factories**: Use factory patterns for test data creation
- **Fixtures**: Create reusable test fixtures
- **Database**: Use transactions for test isolation
- **Mocking**: Mock external dependencies appropriately

```php
// Good: Test data factory
final class ProductFactory
{
    public static function create(array $overrides = []): Product
    {
        return new Product(
            $overrides['name'] ?? 'Test Product',
            $overrides['price'] ?? 99.99,
            $overrides['stock'] ?? 10,
        );
    }
}
```

### 4. Database Conventions

#### Configuration
- **Environment Variables**: Use Docker environment variables
- **Connection**: PDO with MySQL driver
- **Character Set**: UTF-8 encoding
- **Timezone**: UTC for all timestamps

#### Database Design
- **Table Names**: Snake_case, plural nouns (e.g., `products`, `order_items`)
- **Column Names**: Snake_case (e.g., `created_at`, `user_id`)
- **Primary Keys**: Use `id` as primary key with auto-increment
- **Foreign Keys**: Use `{table}_id` format (e.g., `user_id`, `product_id`)
- **Timestamps**: Include `created_at` and `updated_at` in all tables
- **Soft Deletes**: Use `deleted_at` for soft delete functionality

#### Migration Guidelines
```php
// Good: Migration with proper column types and constraints
final class CreateProductsTable extends Migration
{
    public function up(): void
    {
        $this->schema->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->unsigned();
            $table->integer('stock')->unsigned()->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
}
```

#### Repository Pattern
- **Interface**: Create repository interfaces for testability
- **Implementation**: Implement concrete repositories with database logic
- **Query Builder**: Use Tempest's query builder for complex queries
- **Transactions**: Use database transactions for data consistency

```php
// Good: Repository implementation with proper error handling
final readonly class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private Database $database,
    ) {}

    public function findById(int $id): ?Product
    {
        $result = $this->database
            ->query('SELECT * FROM products WHERE id = ? AND deleted_at IS NULL')
            ->bind($id)
            ->first();

        return $result ? Product::fromArray($result) : null;
    }

    public function save(Product $product): Product
    {
        return $this->database->transaction(function () use ($product) {
            if ($product->id) {
                return $this->update($product);
            }
            return $this->create($product);
        });
    }
}
```

### 5. Asset Management

#### Frontend Assets
- **CSS**: Use Tailwind CSS utility classes
- **JavaScript**: TypeScript for type safety
- **Build Tool**: Vite for asset compilation
- **Entry Points**: Separate CSS and TS entry files

#### Styling Guidelines
- **Utility-First**: Prefer Tailwind utilities over custom CSS
- **Component Structure**: Use semantic HTML structure
- **Responsive Design**: Mobile-first approach
- **Accessibility**: Include ARIA labels and semantic markup
- **Color Scheme**: Use consistent color palette from Tailwind
- **Typography**: Use Tailwind's typography utilities

#### CSS Organization
```css
/* Good: Organized CSS with Tailwind utilities */
@import "tailwindcss";

/* Custom components when necessary */
@layer components {
    .btn-primary {
        @apply bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded;
    }
    
    .card {
        @apply bg-white shadow-md rounded-lg p-6;
    }
}

/* Utilities for specific needs */
@layer utilities {
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
}
```

#### JavaScript/TypeScript Guidelines
- **Type Safety**: Use TypeScript interfaces and types
- **Module System**: Use ES6 modules for organization
- **Error Handling**: Implement proper error handling
- **DOM Manipulation**: Use modern DOM APIs
- **Event Handling**: Use event delegation where appropriate

```typescript
// Good: TypeScript with proper types and error handling
interface Product {
    id: number;
    name: string;
    price: number;
    stock: number;
}

class ProductManager {
    private products: Product[] = [];

    async fetchProducts(): Promise<Product[]> {
        try {
            const response = await fetch('/api/products');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            this.products = await response.json();
            return this.products;
        } catch (error) {
            console.error('Error fetching products:', error);
            throw error;
        }
    }

    renderProducts(container: HTMLElement): void {
        container.innerHTML = this.products
            .map(product => this.renderProduct(product))
            .join('');
    }

    private renderProduct(product: Product): string {
        return `
            <div class="card">
                <h3 class="text-lg font-semibold">${product.name}</h3>
                <p class="text-gray-600">$${product.price.toFixed(2)}</p>
                <p class="text-sm text-gray-500">Stock: ${product.stock}</p>
            </div>
        `;
    }
}
```

### 6. Development Workflow

#### Quality Assurance
- **Formatting**: Run `composer mago:fmt` before commits
- **Linting**: Run `composer mago:lint` for code quality
- **Testing**: Run `composer phpunit` for test validation
- **Combined**: Use `composer qa` for full quality check

#### Version Control
- **Branching**: Use feature branches for development
- **Commits**: Write descriptive commit messages
- **Pull Requests**: Require code review before merging
- **Conventional Commits**: Use conventional commit format

```bash
# Good: Descriptive commit messages
git commit -m "feat(products): add product search functionality"
git commit -m "fix(auth): resolve session timeout issue"
git commit -m "docs(api): update product endpoint documentation"
```

#### Code Review Guidelines
- **Review Checklist**: Check for coding standards compliance
- **Testing**: Ensure tests are written and passing
- **Documentation**: Verify documentation is updated
- **Performance**: Review for potential performance issues
- **Security**: Check for security vulnerabilities

#### Docker Development
- **Container Management**: Use docker-compose for local development
- **Port Mapping**: Consistent port assignments (9090, 9091, 3311)
- **Volume Mounting**: Live reload with volume mapping
- **Environment**: Separate development and production configurations
- **Health Checks**: Implement health checks for services

```dockerfile
# Good: Dockerfile with proper practices
FROM php:8.4-apache

# Install dependencies in single layer
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libzip-dev \
    && docker-php-ext-install pdo_mysql gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy application code
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8000
CMD ["php", "tempest", "serve", "--host=0.0.0.0"]
```

### 7. Error Handling and Logging

#### Exception Management
- **Strict Types**: Enable strict typing for better error detection
- **Type Safety**: Use proper type hints to prevent runtime errors
- **Validation**: Validate input parameters at entry points
- **Logging**: Use structured logging for debugging
- **Custom Exceptions**: Create domain-specific exceptions
- **Error Boundaries**: Implement proper error boundaries in controllers

#### Exception Hierarchy
```php
// Good: Custom exception hierarchy
abstract class AppException extends Exception
{
    abstract public function getErrorCode(): string;
    abstract public function getHttpStatus(): int;
}

final class ValidationException extends AppException
{
    public function getErrorCode(): string
    {
        return 'VALIDATION_ERROR';
    }

    public function getHttpStatus(): int
    {
        return 422;
    }
}

final class ResourceNotFoundException extends AppException
{
    public function getErrorCode(): string
    {
        return 'RESOURCE_NOT_FOUND';
    }

    public function getHttpStatus(): int
    {
        return 404;
    }
}
```

#### Logging Standards
- **Log Levels**: Use appropriate log levels (debug, info, warning, error, critical)
- **Structured Logging**: Use structured format for better parsing
- **Context**: Include relevant context in log messages
- **Sensitive Data**: Never log sensitive information

```php
// Good: Structured logging with context
final readonly class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $repository,
        private LoggerInterface $logger,
    ) {}

    public function createProduct(CreateProductDto $dto): Product
    {
        $this->logger->info('Creating new product', [
            'product_name' => $dto->name,
            'price' => $dto->price,
        ]);

        try {
            $product = $this->repository->save(new Product($dto->name, $dto->price, $dto->stock));
            
            $this->logger->info('Product created successfully', [
                'product_id' => $product->id,
                'product_name' => $product->name,
            ]);
            
            return $product;
        } catch (Exception $e) {
            $this->logger->error('Failed to create product', [
                'error' => $e->getMessage(),
                'product_name' => $dto->name,
                'trace' => $e->getTraceAsString(),
            ]);
            
            throw new ProductCreationException('Failed to create product', 0, $e);
        }
    }
}
```

### 8. Documentation Standards

#### Code Documentation
- **DocBlocks**: Use PHPDoc format for class and method documentation
- **Inline Comments**: Explain complex business logic
- **README**: Maintain up-to-date setup instructions
- **API Documentation**: Document public methods and their purposes
- **Type Documentation**: Document complex types and interfaces

#### DocBlock Standards
```php
/**
 * Service for managing product operations.
 * 
 * Handles product creation, updates, and retrieval with proper
 * validation and error handling.
 */
final readonly class ProductService
{
    /**
     * Creates a new product with validation.
     * 
     * @param CreateProductDto $dto The product data to create
     * @return Product The created product instance
     * @throws ValidationException When product data is invalid
     * @throws ProductCreationException When product creation fails
     */
    public function createProduct(CreateProductDto $dto): Product
    {
        // Implementation
    }

    /**
     * Retrieves products with optional filtering.
     * 
     * @param array<string, mixed> $filters Optional filters to apply
     * @return Product[] Array of matching products
     */
    public function getProducts(array $filters = []): array
    {
        // Implementation
    }
}
```

#### Comments Best Practices
- **Purpose Over Implementation**: Explain why, not what
- **TODO Comments**: Track technical debt and future improvements
- **FIXME Comments**: Mark known issues that need attention
- **Business Logic**: Document complex business rules
- **Algorithms**: Explain non-obvious algorithms or calculations

```php
// Good: Explaining business logic
public function calculateDiscount(Product $product, User $user): float
{
    // Premium users get 10% discount on all products
    if ($user->isPremium()) {
        return $product->price * 0.10;
    }
    
    // Regular users get 5% discount on products over $100
    if ($product->price >= 100.00) {
        return $product->price * 0.05;
    }
    
    return 0.00;
}

// TODO: Implement bulk discount calculation for multiple products
// FIXME: Handle edge case where user premium status is null
```

#### API Documentation
- **OpenAPI/Swagger**: Use OpenAPI specification for REST APIs
- **Request/Response**: Document all request and response formats
- **Error Codes**: Document all possible error responses
- **Authentication**: Document authentication requirements
- **Rate Limits**: Document any rate limiting policies

```php
/**
 * @OpenApi\Get(
 *     path="/api/products/{id}",
 *     summary="Get product by ID",
 *     @OpenApi\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OpenApi\Schema(type="integer")
 *     ),
 *     @OpenApi\Response(
 *         response=200,
 *         description="Product details",
 *         @OpenApi\JsonContent(ref="#/components/schemas/Product")
 *     ),
 *     @OpenApi\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */
```

### 9. Security Conventions

#### Input Validation
- **Sanitization**: Sanitize all user inputs
- **Validation**: Validate data types and formats
- **SQL Injection**: Use parameterized queries
- **XSS Prevention**: Escape output appropriately
- **CSRF Protection**: Implement CSRF tokens for forms

```php
// Good: Input validation and sanitization
final readonly class CreateProductRequest
{
    public function __construct(
        public readonly string $name,
        public readonly float $price,
        public readonly int $stock,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty(trim($this->name))) {
            throw new ValidationException('Product name is required');
        }

        if (strlen($this->name) > 255) {
            throw new ValidationException('Product name too long');
        }

        if ($this->price <= 0) {
            throw new ValidationException('Price must be positive');
        }

        if ($this->stock < 0) {
            throw new ValidationException('Stock cannot be negative');
        }
    }
}
```

#### Authentication and Authorization
- **Password Hashing**: Use secure password hashing (bcrypt, argon2)
- **Session Management**: Implement secure session handling
- **Role-Based Access**: Implement role-based authorization
- **Token Security**: Use secure tokens for API authentication
- **Rate Limiting**: Implement rate limiting for sensitive endpoints

```php
// Good: Secure password handling
final readonly class AuthService
{
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3,
        ]);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
```

## Development Commands

### Local Development
```bash
# Start containers
docker-compose up -d

# Run tests
composer phpunit

# Format code
composer mago:fmt

# Lint code
composer mago:lint

# Full quality check
composer qa
```

### Framework Commands
```bash
# Start development server
php tempest serve

# Run console commands
php tempest [command]

# Generate framework components
php tempest discovery:generate
```

## Environment Configuration

### Database Connection
- **Host**: `db` (Docker service name)
- **Database**: `clothing_db`
- **Username**: `clothing_user`
- **Password**: `clothing_password`
- **Port**: 3311 (external), 3306 (internal)

### Application URLs
- **Web Application**: http://localhost:9090
- **PHPMyAdmin**: http://localhost:9091
- **Database**: localhost:3311

## Next Steps for AI Development

When working on this project, AI agents should:

1. **Follow Strict Typing**: Always use `declare(strict_types=1);` and proper type hints
2. **Maintain Code Quality**: Run formatting and linting tools before commits
3. **Write Tests**: Create corresponding tests for new features with proper coverage
4. **Use Framework Conventions**: Leverage Tempest's attribute-based system and dependency injection
5. **Respect Docker Setup**: Work within the containerized environment
6. **Follow PSR Standards**: Adhere to PSR-4 autoloading and PSR-12 coding standards
7. **Security First**: Implement proper input validation and output escaping
8. **Documentation**: Write comprehensive documentation for all public APIs
9. **Error Handling**: Implement proper exception handling and logging
10. **Performance**: Consider performance implications of code changes

### Code Review Checklist for AI Agents

Before submitting code, ensure:

- [ ] All files have `declare(strict_types=1);`
- [ ] Proper type hints for all parameters and return types
- [ ] PSR-4 autoloading conventions followed
- [ ] Tests written for new functionality
- [ ] Code formatted with `composer mago:fmt`
- [ ] No linting errors from `composer mago:lint`
- [ ] All tests pass with `composer phpunit`
- [ ] Proper error handling and logging implemented
- [ ] Input validation and output escaping in place
- [ ] Documentation updated for new features
- [ ] No security vulnerabilities introduced
- [ ] Performance considerations addressed

This documentation serves as the foundation for consistent development practices and helps maintain code quality across the project lifecycle.
