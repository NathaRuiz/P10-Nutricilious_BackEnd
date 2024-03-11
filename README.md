# Nutrilicious API 🥗🛒

A Laravel-based API for a healthy food marketplace, Nutrilicious. The API allows users to browse and purchase products from various companies, manage their cart, and enables company administrators to manage their products.

## Features 🌟

- **User Authentication**: Authentication is implemented using Laravel Breeze for session-based authentication and Sanctum for API token authentication, providing secure access to the API endpoints.

- **Product Management**: Users can view, search, and purchase products from various companies. Company administrators can add, update, and delete their products.

- **Cart Management**: Users can add products to their cart, view the contents of their cart, update quantities, remove products, and clear their cart.

- **Twilio Integration**: Upon successful purchase, users receive a WhatsApp message confirming their order, implemented using the Twilio API.

## Project Structure 📁

The project structure is organized as follows:

- **Controllers**: Contains controllers for handling user, company, and admin operations.
- **Models**: Contains model classes representing database entities like users, products, orders, etc.
- **Database Migrations and Seeds**: Database migrations and seeds for setting up the database schema and initial data.
- **Routes**: Contains API routes for various endpoints.
- **Middleware**: Custom middleware for authorization and other operations.
- **Tests**: Contains PHPUnit tests for testing API endpoints.

## Installation 🚀

1. Clone the repository:

    ```bash
    git clone https://github.com/NathaRuiz/P10-Nutricilious_BackEnd.git
    ```

2. Navigate to the project directory:

    ```bash
    cd project-directory
    ```

3. Install dependencies using Composer:

    ```bash
    composer install
    ```

4. Install frontend dependencies using npm:

    ```bash
    npm install
    ```

5. Set up the environment variables:

    - Copy the `.env.example` file to `.env` and configure the database connection, Twilio credentials, and other environment variables as needed.

6. Run the migrations to set up the database:

    ```bash
    php artisan migrate
    ```

7. Seed the database with sample data (optional):

    ```bash
    php artisan db:seed
    ```

8. Start the development server:

    ```bash
    php artisan serve
    ```

## Usage 🚀

1. Register an account or log in using the provided authentication routes.
2. Browse products, add them to your cart, and proceed to purchase.
3. Company administrators can manage their products by adding, updating, or deleting them.
4. Upon successful purchase, users will receive a WhatsApp message confirming their order.

## Dependencies 📦

- **Laravel Breeze**: Provides simple and minimalistic authentication views and routes.
- **Laravel Sanctum**: Provides a lightweight authentication system for APIs.
- **Twilio SDK**: Allows sending WhatsApp messages for order confirmation.
- **Other Laravel dependencies**: Axios, Illuminate/Support, Illuminate/Http, Illuminate/Database, etc.

## Contributing 🤝

Contributions are welcome! Please fork the repository, make your changes, and submit a pull request.

## License 📄

This project is licensed under the [MIT License](LICENSE).
