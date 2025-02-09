# E-commerce API

## About

This project is an E-commerce API built using the Laravel framework. It provides a robust and scalable architecture for managing products, brands, categories, locations, and orders. The API supports CRUD operations and user authentication using JWT.

## Architecture

The project follows the MVC (Model-View-Controller) architectural pattern, which separates the application logic into three main components:

- **Models**: Represent the data and business logic of the application. They are located in the `app/Models` directory.
- **Controllers**: Handle the user input and interact with models to render the appropriate responses. They are located in the `app/Http/Controllers` directory.
- **Routes**: Define the endpoints for the API and map them to the appropriate controller actions. They are located in the `routes/api.php` file.

## Technologies

The project uses the following technologies:

- **Laravel**: A PHP framework for building web applications.
- **PHP**: The programming language used for server-side scripting.
- **MySQL**: The database management system used for storing application data.
- **JWT (JSON Web Tokens)**: Used for authentication and authorization.
- **Composer**: A dependency manager for PHP.
- **NPM**: A package manager for JavaScript.

## Features

- **User Authentication**: Users can register, log in, and log out using JWT for secure authentication.
- **Product Management**: CRUD operations for products, including image upload and pagination.
- **Brand Management**: CRUD operations for brands.
- **Category Management**: CRUD operations for categories, including image upload.
- **Location Management**: CRUD operations for user locations.
- **Order Management**: CRUD operations for orders, including order status updates and product quantity management.
- **Validation**: Input validation is performed using Laravel's built-in validation features.
- **Error Handling**: Custom error messages for better user experience.
- **Pagination**: Pagination support for listing products and orders.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/your-repo.git
    ```

2. Navigate to the project directory:
    ```sh
    cd your-repo
    ```

3. Install the dependencies:
    ```sh
    composer install
    npm install
    ```

4. Copy the [.env.example](http://_vscodecontentref_/0) file to `.env` and update the environment variables:
    ```sh
    cp .env.example .env
    ```

5. Generate the application key:
    ```sh
    php artisan key:generate
    ```

6. Run the database migrations:
    ```sh
    php artisan migrate
    ```

7. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

### Authentication

- **Register**: Send a POST request to `/api/register` with `name`, `email`, and `password` fields.
- **Login**: Send a POST request to `/api/login` with `email` and `password` fields.
- **Get User Info**: Send a GET request to `/api/user` with the JWT token in the Authorization header.
- **Logout**: Send a POST request to `/api/logout` with the JWT token in the Authorization header.

### Products

- **List Products**: Send a GET request to `/api/products`.
- **Get Product**: Send a GET request to `/api/products/{id}`.
- **Create Product**: Send a POST request to `/api/products` with product details.
- **Update Product**: Send a PUT request to `/api/products/{id}` with updated product details.
- **Delete Product**: Send a DELETE request to `/api/products/{id}`.

### Brands

- **List Brands**: Send a GET request to `/api/brands`.
- **Get Brand**: Send a GET request to `/api/brands/{id}`.
- **Create Brand**: Send a POST request to `/api/brands` with brand details.
- **Update Brand**: Send a PUT request to `/api/brands/{id}` with updated brand details.
- **Delete Brand**: Send a DELETE request to `/api/brands/{id}`.

### Categories

- **List Categories**: Send a GET request to `/api/categories`.
- **Get Category**: Send a GET request to `/api/categories/{id}`.
- **Create Category**: Send a POST request to `/api/categories` with category details.
- **Update Category**: Send a PUT request to `/api/categories/{id}` with updated category details.
- **Delete Category**: Send a DELETE request to `/api/categories/{id}`.

### Locations

- **List Locations**: Send a GET request to `/api/locations`.
- **Create Location**: Send a POST request to `/api/locations` with location details.
- **Update Location**: Send a PUT request to `/api/locations/{id}` with updated location details.
- **Delete Location**: Send a DELETE request to `/api/locations/{id}`.

### Orders

- **List Orders**: Send a GET request to `/api/orders`.
- **Get Order**: Send a GET request to `/api/orders/{id}`.
- **Create Order**: Send a POST request to `/api/orders` with order details.
- **Update Order Status**: Send a PUT request to `/api/orders/{id}/status` with updated status.
- **Get User Orders**: Send a GET request to `/api/users/{id}/orders`.

## Contributing

Thank you for considering contributing to the project! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).