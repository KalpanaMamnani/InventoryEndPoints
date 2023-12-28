# Grocery Inventory Management System

This Laravel application provides endpoints for managing a grocery inventory. It includes features for adding grocery items to the inventory and retrieving all items.

## Getting Started

### Prerequisites

- PHP (>= 7.4)
- Composer
- MySQL or any other supported database

### Installation

1. **Clone the repository:**
   ```bash
   gh repo clone KalpanaMamnani/InventoryEndPoints
   ```

2. **Change to project directory:**
   ```bash
   cd InventoryEndPoints
   ```

3. **Copy the `.env.example` file to `.env` and configure your database:**
   ```bash
   cp .env.example .env
   ```

4. **Update the following fields in the `.env` file with your database details:**
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=your_database_name`
   - `DB_USERNAME=your_database_username`
   - `DB_PASSWORD=your_database_password`

Make sure to replace `your_database_name`, `your_database_username`, and `your_database_password` with your actual database details.

These steps provide a basic setup for your Laravel project. Continue with the rest of the instructions for running and testing your endpoints.
![image](https://github.com/KalpanaMamnani/InventoryEndPoints/assets/37242267/ae842b59-046a-4455-a1e9-e8ba77eeb9c8)
### 5. Run the Following Commands

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

### 6. Access the Grocery Items Endpoint

Navigate to the following URL in your web browser by adding /grocery-items to the URL:

[http://127.0.0.1:8000/grocery-items](http://127.0.0.1:8000/grocery-items)

This will take you to the "grocery-items" endpoint where you can interact with the grocery inventory features. Adjust the base URL and endpoints based on your specific configuration.
![image](https://github.com/KalpanaMamnani/InventoryEndPoints/assets/37242267/ae4e5013-33c6-4398-9ce3-4ef12f510fd4)

### Important Note:

After running the command `php artisan serve`, your program may throw an error stating 'No API key generated'. Follow these steps to resolve:

1. **Generate API Key:**
   - If prompted for an API key, click on the option to generate one.
   - Follow the instructions or prompts to generate the API key.

2. **Refresh the Page:**
   - After generating the API key, refresh the page in your web browser.

This step is necessary to ensure that your application has the required API key for authentication. If you encounter any issues during this process or have additional questions, feel free to ask for assistance.


# Grocery CRUD Application with Discount Feature

I have added a discount feature to my laravel application. Users can apply discounts to specific categories, and the discounted prices are displayed accordingly.

## Table of Contents

- [Database Setup](#database-setup)
- [Model Creation](#model-creation)
- [Controller Changes](#controller-changes)
- [Blade Files](#blade-files)
- [View Changes](#view-changes)

## Database Setup

- Added a new table named `discount` to store discount information.
- Created a migration for the `discount` table.

## Model Creation

- Created a `Discount` model to interact with the `discount` table.

## Controller Changes

- Modified the `GroceryController` to include the `Discount` model.

- Modified the `applyDiscount` method to create a new discount entry in the `discount` table based on the form input.

```php
public function applyDiscount(Request $request)
{
     // Validate the form data
        $request->validate([
            'categoryname' => 'required',
            'discount' => 'required|numeric|min:0',
        ]);

        // Retrieve form data
        $categoryName = $request->input('categoryname');
        $discountValue = $request->input('discount');

        // Create a new Discount record
        Discount::create([
            'category' => $categoryName,
            'discount' => $discountValue,
        ]);

        // Redirect to the discount form with a success message
        return redirect()->route('discount-form')->with('success', 'Discount applied successfully.');
}
```

## Blade Files

- Created a new Blade file for the discount form (`discount-form.blade.php`).


## View Changes

- Modified the view file (`index.blade.php`) to display either the discounted price or the original price based on the presence of a discount.

```blade
<td>
    @if($item->discounted_price != $item->price)
        Discounted Price: ${{ $item->discounted_price }}
    @else
        Original Price: ${{ $item->price }}
    @endif
</td>
```
