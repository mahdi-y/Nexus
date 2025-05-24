# Nexus

![Symfony](https://img.shields.io/badge/Symfony-6.x-blueviolet?logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.0+-777bb4?logo=php)
![Java NLP](https://img.shields.io/badge/Java-NLP-orange?logo=java)
![MySQL](https://img.shields.io/badge/MySQL-8.x-blue?logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-lightblue?logo=bootstrap)
![License: MIT](https://img.shields.io/badge/License-MIT-green)


> **Nexus** is a collaborative platform for developers and programmers to share knowledge, ask questions, and find solutions together.  
> Built with Symfony (PHP), it features a modern UI using Bootstrap/Argon Dashboard, and integrates Java-based NLP for advanced search capabilities.

---

## Features

- **User registration, authentication, and profile management**
- **Ask and answer questions, vote, and signal content**
- **Search powered by a Java NLP module**
- **Responsive, modern UI with Bootstrap and Argon Dashboard**
- **Admin and visitor views**
- **Notification system (browser notifications)**
- **QR code generation**

---

## Project Structure

```
.
├── bin/                    # Symfony binaries
├── config/                 # Symfony configuration
├── migrations/             # Doctrine migrations
├── NLP/                    # Java NLP module (test.jar)
├── public/                 # Public assets (entry point, JS, CSS, images)
│   └── assets/
│       ├── js/
│       └── scss/
├── src/                    # PHP source code (controllers, entities, forms, repositories)
├── templates/              # Twig templates for frontend
├── tests/                  # Automated tests
├── translations/           # Translation files
├── .env                    # Environment variables
├── composer.json           # PHP dependencies
├── docker-compose.yml      # Docker configuration
└── phpunit.xml.dist        # PHPUnit configuration
```

---

## Requirements

- PHP 8.0+
- Composer
- Symfony CLI (optional, for local development)
- Node.js & npm (for asset compilation, if needed)
- Java (for NLP module)
- MySQL or compatible database

---

## Setup

1. **Clone the repository**

   ```sh
   git clone https://github.com/yourusername/nexus.git
   cd nexus
   ```

2. **Install PHP dependencies**

   ```sh
   composer install
   ```

3. **Configure environment**

   - Copy `.env` to `.env.local` and adjust database credentials as needed.
  
4. **Run database migrations**

   ```sh
   php bin/console doctrine:migrations:migrate
   ```

5. **Install and build frontend assets** (if using Symfony Encore/Webpack)

   ```sh
   npm install
   npm run dev
   ```

6. **Run the Java NLP module**

   - Ensure Java is installed.
   - The NLP JAR is located at `NLP/test.jar`.

7. **Start the Symfony server**

   ```sh
   symfony serve
   # or
   php -S localhost:8000 -t public
   ```

8. **Access the application**

   Open [http://localhost:8000](http://localhost:8000) in your browser.

---

## Usage

- Register or log in to access all features.
- Use the search bar for NLP-powered question search.
- Ask questions, provide answers, and vote on content.
- Admins can manage users and content.

---

## Testing

Run PHPUnit tests:

```sh
php bin/phpunit
```

---

## License

This project is licensed under the **MIT License**. See the [LICENSE](./LICENSE.md) file for details.


---

**Note:** For more details, see the code in [src/Controller](src/Controller/) and templates in [templates/](templates/).