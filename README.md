# Laravel E-Commerce Website

Welcome to our Laravel E-Commerce project! This is a full-fledged e-commerce website built using the Laravel framework, with integrated Stripe for payment processing and MySQL as the backend database.

## Getting Started

These instructions will help you set up the project on your local machine for development and testing purposes.

### Prerequisites

- PHP (>=7.3)
- Composer
- Node.js
- MySQL

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Thegr8test/ecommerce_store.git
   ```

2. Navigate to the project directory:

   ```bash
   cd ecommerce_store
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Install JavaScript dependencies:

   ```bash
   npm install
   ```

5. Copy the `.env.example` file to `.env` and configure your database and Stripe API credentials:

   ```bash
   cp .env.example .env
   ```

6. Generate the application key:

   ```bash
   php artisan key:generate
   ```

7. Migrate the database:

   ```bash
   php artisan migrate
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

   Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser to see the application.

## Features

- User authentication and authorization
- Product catalog and browsing
- Shopping cart functionality
- Checkout process with Stripe payment integration
- Order management

## Technologies Used

- Laravel
- MySQL
- Stripe

## Contributing

Feel free to contribute to the project! Check out the [contributing guidelines](CONTRIBUTING.md) for more information.

## License

This project is licensed under the [MIT License](LICENSE.md).

## Acknowledgments

- Thanks to the Laravel and Stripe communities for their awesome tools and documentation.
