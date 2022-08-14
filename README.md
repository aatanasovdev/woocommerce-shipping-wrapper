# woocommerce-shipping-wrapper

A basic WooCommerce wrapper for creating shipping methods. 

**This is a beta version.**

## Installation

```
composer TBD
```

## How it works

Steps:
 1. Install the package to your WordPress project;
 2. Register your shipping method inside an appropriate WordPress hook (all plugins must be loaded). For example: `woocommerce_shipping_init`:
 3. Add the shipping method to a shipping zone through the WordPress dashboard;
 4. Set the title, the description, and the fee of your shipping method using the Shipping Settings. These settings are empty by default, and they must be configured. It is because WooCommerce creates a new instance for each method added to a shipping zone behind the scenes.


## Setup

```php
include_once( 'vendor/autoload.php' );

use WC_Shipping_Wrapper\Shipping;

add_action('woocommerce_shipping_init', function() {
	$basic_shipping = new Shipping(
		'test-shipping-method',
		'Test Shipping Method'
	);
});
```

## Shipping Class

```php
$shipping = new Shipping(
	'shipping-method-id',
	'Shipping Method Title'
);
```

### Arguments

| Option            | Type     | Required | Description                                |
| ----------------- | -------- | -------- | ------------------------------------------ |
| `name`            | `string` | yes      | The unique ID of your shipping method      |
| `method_title`    | `string` | yes      | The default title of your shipping method  |

## Admin options

When you add your shipping method to a shipping zone, the following options will be available on the edit shipping page:

| Option               | Type     | Required | Description                                   |
| -------------------- | -------- | -------- | --------------------------------------------- |
| `method_title`       | `string` | yes      | The title of the added shipping method        |
| `cost`               | `number` | yes      | The shipping fee                              |
| `method_description` | `string` | yes      | The description of the added shipping method  |