<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="150" alt="Laravel Logo">
  <h1>Forgelenta - HRIS Application</h1>
</p>

<p align="center">
  <a href="LICENSE">
    <img src="https://img.shields.io/github/license/rendrazuriansyah/forgelenta" alt="License">
  </a>
  <a href="https://github.com/rendrazuriansyah/forgelenta/stargazers">
    <img src="https://img.shields.io/github/stars/rendrazuriansyah/forgelenta?style=social" alt="Stars">
  </a>
</p>

## About Forgelenta

Forgelenta is an HRIS (Human Resource Information System) application built using Laravel 12. This project aims to implement core features for managing human resources, drawing inspiration from the Talenta HRIS system by Mekari.

**Key Features:**

*   **Authentication:** Login, Register (using Laravel Breeze).
*   **Tasks Management:**
    *   Create, edit, delete tasks.
    *   Mark completion status.
    *   Flatpickr integration for date input.
*   **Employees Management:**
    *   CRUD (Create, Read, Update, Delete) employee data.
*   **Departments Management:**
    *   CRUD department data.
*   **Roles Management:**
    *   CRUD role data.
*   **Presences Management:**
    *   CRUD presence data.
*   **Payrolls:**
    *   CRUD payroll data.
    *   Generate salary slips.
*   **Leave Requests:**
    *   CRUD leave request data.
    *   Confirm/Reject requests.
*   **Auth & Authorization:** Implementing middleware for access control (CheckRole).
*   **Dashboard:** Using the Mazer Admin Dashboard template (Bootstrap 5) with a responsive and informative design.
*   **Additional Features (to be developed):**
    *   Insight views for total data.
    *   Latest tasks display.
    *   Presence chart.
    *   etc.

## Project Goals

*   Master the concepts and implementation of CRUD (Create, Read, Update, Delete) in Laravel.
*   Understand how to integrate a UI template (Mazer Admin Dashboard).
*   Learn to use additional plugins like Flatpickr.
*   Understand the concepts of authentication and authorization with Laravel.
*   Build a functional and ready-to-use HRIS application.

## Technologies Used

*   **Framework:** Laravel 12
*   **UI Template:** Mazer Admin Dashboard (Bootstrap 5)
*   **Database:** MariaDB
*   **Others:** Laravel Breeze, Flatpickr

## Installation and Usage

1.  **Clone the Repository:**

    ```bash
    git clone https://github.com/rendrazuriansyah/forgelenta.git
    cd Forgelenta
    ```
2.  **Install Dependencies:**

    ```bash
    composer install
    npm install
    ```
3.  **Database Configuration:**
    *   Create a new database in MySQL (or your preferred database).
    *   Edit the `.env` file and adjust your database configuration.
4.  **Run Migrations:**

    ```bash
    php artisan migrate
    ```
5.  **Seed Data (optional):**

    ```bash
    php artisan db:seed
    ```
6.  **Run the Server:**

    ```bash
    php artisan serve
    ```

    Open the application in your browser at `http://127.0.0.1:8000` (or the address displayed in the terminal).

## Contributing

Contributions are highly encouraged!  See our [CONTRIBUTING.md](CONTRIBUTING.md) file for details.

## License

This project is licensed under the [MIT license](LICENSE).
