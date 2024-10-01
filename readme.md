# Laravel Crypto Price Tracker

This project is a Laravel 5.6 application that tracks cryptocurrency prices using the CoinGecko API. It provides two main endpoints:

1. Get the latest price of a cryptocurrency
2. Get the estimated price of a cryptocurrency at a specific date/time (UTC)

## Features

- Supports multiple cryptocurrencies: BTC, BCH, LTC, ETH, DACXI, LINK, USDT, XLM, DOT, ADA, SOL, AVAX, LUNC, MATIC, USDC, BNB, XRP, UNI, MKR, BAT, SAND, and EOS
- Uses CoinGecko API to fetch cryptocurrency data
- Stores historical price data in a MySQL database
- Docker orchestration for easy setup and deployment
- Automated tests (Unit and Feature tests)

## Requirements

- Docker
- Docker Compose

## Setup

1. Clone the repository:
   ```
   git clone https://github.com/blpilla/laravel-crypto-price-tracker.git
   cd laravel-crypto-price-tracker
   ```

2. Copy the `.env.example` file to `.env`:
   ```
   cp .env.example .env
   ```

3. Build and run the Docker containers:
   ```
   docker-compose up -d --build
   ```

4. Install composer dependencies:
   ```
   docker-compose exec app composer install
   ```

5. Generate the application key:
   ```
   docker-compose exec app php artisan key:generate
   ```

6. Run database migrations:
   ```
   docker-compose exec app php artisan migrate
   ```

## Usage

The application exposes two main API endpoints:

1. Get the latest price of a cryptocurrency:
   ```
   GET /api/latest-price?crypto=<symbol>
   ```
   Example: `http://localhost:8000/api/latest-price?crypto=btc`

2. Get the estimated price of a cryptocurrency at a specific date/time:
   ```
   GET /api/price-at-timestamp?crypto=<symbol>&timestamp=<UTC_timestamp>
   ```
   Example: `http://localhost:8000/api/price-at-timestamp?crypto=eth&timestamp=2023-04-20T12:00:00Z`

## Testing

To run the automated tests, use the following command:

```
docker-compose exec app php artisan test
```

## Architecture Decisions

1. **Laravel 5.6**: Used as per the project requirements.
2. **Repository Pattern**: Implemented to separate data access logic from business logic.
3. **Service Layer**: Created a CoinGeckoService to handle API interactions with CoinGecko.
4. **Docker**: Used for containerization to ensure consistency across different environments.
5. **MySQL**: Chosen as the database for storing historical price data.

## External Libraries

- **Guzzle**: Used for making HTTP requests to the CoinGecko API.
- **Carbon**: Used for date/time manipulation and formatting.

## Deployment to Railway.app

1. Create a Railway account and install the Railway CLI.
2. Login to Railway:
   ```
   railway login
   ```
3. Initialize the project:
   ```
   railway init
   ```
4. Add a MySQL database to your project:
   ```
   railway add
   ```
5. Deploy the application:
   ```
   railway up
   ```
6. Set up environment variables in the Railway dashboard.
7. Run migrations:
   ```
   railway run php artisan migrate
   ```

For more detailed instructions on deploying to Railway.app, please refer to their official documentation.

## Contributing

Please read the CONTRIBUTING.md file for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the LICENSE.md file for details.