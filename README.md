Features

Promo code verification using a CSV file

One-time use check with PostgreSQL database

Returns unique voucher code

Frontend served using Nginx

Containerized with Docker for portability and scalability
Technologies Used
PHP (Backend)

PostgreSQL (Database)

HTML/CSS (Frontend UI)

Nginx (Web server)

Docker (Containerization)

CSV (Promo code mapping)
How It Works
User enters email and promo code on the frontend.

PHP processes the request (process.php).

Promo code is validated against a CSV file.

System checks if it's already used (via DB).

If valid, inserts into the database and displays the voucher code.

Dockerized Deployment
The app is containerized with Docker for easier deployment. You can spin it up using Docker Compose or individual Dockerfiles.
