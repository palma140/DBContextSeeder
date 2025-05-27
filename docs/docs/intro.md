---
sidebar_position: 1
---

# Installation

**DBContextSeeder** is a Laravel package that helps you seed your database using a class-based and reusable structure. It allows you to break down your seeding logic into multiple seeders and run them in a controlled way.

---

## 🚀 Installation

### 📦 Install via Composer (Recommended)

```bash
composer require ipleiria/dbcontextseeder
```

This will install the package from [Packagist](https://packagist.org/packages/ipleiria/dbcontextseeder) and make it ready to use in your Laravel project.

---

### 🛠 Install Manually (Local Development)


#### 1. Clone the Repository

```bash
git clone https://github.com/palma140/DBContextSeeder.git packages/dbcontextseeder
```

> We recommend cloning it into a `packages/` folder in the root of your Laravel project.

#### 2. Update `composer.json`

In your Laravel project's `composer.json`, add the following under the `repositories` section:

```json
"repositories": [
  {
    "type": "path",
    "url": "packages/dbcontextseeder"
  }
],
"require": {
  "ipleiria/dbcontextseeder": "*"
}
```

#### 3. Install the Package

Run:

```bash
composer update ipleiria/dbcontextseeder
```

---

## ✅ You're Done

The package is now installed and ready to use!
