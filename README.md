# Pure PHP & MySQL Project

This repository is a lightweight, framework-free PHP project that uses MySQL for database management. It is designed as a simple and efficient solution for quick implementation or as a learning tool for beginners to understand PHP fundamentals.

---

## 🚀 Features

- Basic CRUD (Create, Read, Update, Delete) functionality.
- Direct connection to MySQL using `mysqli` or `PDO`.
- Modular and structured code for easy maintenance.
- Minimalistic design, ready to be integrated into larger projects.
- Includes a sample database configuration.

---

## 📂 Project Structure

```plaintext
📁 src/
├── 📄 config.php       // Database configuration
├── 📄 database.php     // MySQL connection handling
├── 📄 index.php        // Main entry point
├── 📄 routes.php       // Route management
├── 📂 views/           // HTML templates and views
└── 📂 public/          // Public assets (CSS, JS, images)
```

---

## ⚙️ Requirements

1. PHP 7.4 or higher.
2. A web server (Apache, Nginx, or similar).
3. MySQL 5.7 or higher.
4. Composer (optional for future dependencies).

---

## 📥 Installation

1. Clone this repository:  
   ```bash
   git clone https://github.com/jramma/purePhp-MySql.git
   cd purePhp-MySql
   ```

2. Set up your database connection:  
   Edit `config.php` with your database details:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'your_database_name');
   ```

3. Import the database schema:  
   Open your MySQL client and run:
   ```sql
   SOURCE database/schema.sql;
   ```

4. Start the PHP development server:  
   ```bash
   php -S localhost:8000 -t public
   ```

5. Open your browser at `http://localhost:8000`.

---

## 🛠️ Usage

- **Homepage:** Access the main application in your browser to see the preconfigured examples.
- **Customization:** Add or modify routes in `routes.php` and templates in the `views/` folder.

---

## 🌟 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a branch for your feature or fix:  
   ```bash
   git checkout -b feature/new-feature
   ```
3. Commit your changes:  
   ```bash
   git commit -m "Added new feature"
   ```
4. Push your branch:  
   ```bash
   git push origin feature/new-feature
   ```
5. Open a Pull Request on GitHub.

---

## 📄 License

This project is licensed under the MIT License. See the `LICENSE` file for details.

Thank you for using this repository! 😊
