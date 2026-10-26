# Steadfast Care

A lightweight, database-free Laravel web application featuring a clean Tailwind CSS frontend and secure payment submissions protected by Google reCAPTCHA.

---

## Features

* **Laravel Framework:** Built with clean routing and blade templates.
* **Tailwind CSS Frontend:** Modern, responsive design.
* **reCAPTCHA-Secured Payments:** Google reCAPTCHA integration to verify payment submissions and prevent automated spam.
* **Stateless Architecture:** Operates without a database for fast, seamless deployment.

---

## Tech Stack

* **Backend:** PHP (Laravel)
* **Frontend:** Tailwind CSS, Blade Templates
* **Security:** Google reCAPTCHA API

---

## Getting Started

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & npm (for Tailwind compilation, if applicable)

### Installation

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/Samngaburi/steadfast-care.git](https://github.com/Samngaburi/steadfast-care.git)
   cd steadfast-care


2:   Install PHP dependencies:

    composer install

3:  Update your .env file with your credentials:

    RECAPTCHA_SITE_KEY=your_site_key
    RECAPTCHA_SECRET_KEY=your_secret_key

4: Generate application key

   php artisan key:generate


5: Run the application

   php artisan serve