# PlanVital APP

App para el registro de asistencia para ejecutivos.

# Requirements

- Docker

# Install project dependencies

```bash
composer install
```

# Install development environment dependencies and run

```bash
./vendor/bin/sail up -d  
```

# Execute migrations and seed

```bash
./vendor/bin/sail artisan migrate --seed 
```

# Install dependencies ui environment

```bash
./vendor/bin/sail npm install --legacy-peer-deps
```

# Run ui environment

```bash
./vendor/bin/sail npm run dev 
```

# Visualize site

<http://localhost:9000>
