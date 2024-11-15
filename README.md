# GraphQL API based on Nette, MySQL, Doctrine example
This project is a GraphQL API built with the following technologies:

## Backend
- **Framework**: [Nette Framework](https://nette.org/) – PHP framework for robust and clean web development.
- **GraphQL**: [Webonyx GraphQL PHP](https://webonyx.github.io/graphql-php/) – GraphQL schema and query execution.
- **Database**: [MySQL](https://www.mysql.com/) – Relational database for data persistence.
- **ORM**: [Doctrine](https://www.doctrine-project.org/) – Object-relational mapper for managing entities and relationships.
- **Migrations**: [Doctrine Migrations](https://www.doctrine-project.org/projects/migrations.html) – Schema management for version-controlled database changes.

## Deployment
- **Containerization**: [Docker](https://www.docker.com/) + Docker Compose for consistent development and deployment environments.
- **Web Server**: [NGINX](https://nginx.org/) for serving the application.

---

## Project Structure

```
project/
├── .docker/                    # Docker and NGINX configuration
├── .github/                    # GitHub Actions CI/CD workflows
├── app/                        # Application logic and Nette configuration
    ├── Core/RouterFactory.php  # Router configuration
    ├── GraphQL                 # GraphQL schema, resolvers
    ├── Model                   # Doctrine entities and repositories
    ├── Presenters              # Nette presenters for handling requests
    ├── Bootstrap.php           # Application bootstrap
├── bin/                        # Console commands
├── config/                     # Configuration files
├── db/migrations/              # Database migration files
├── www/                        # Web-accessible directory for the app
├── docker-compose.yml          # Docker Compose setup
├── Makefile                    # Makefile for common tasks
├── phpcs.xml                   # PHP CodeSniffer configuration
├── phpstan.neon                # PHPStan configuration
└── README.md                   # Project documentation
```

---

## Getting Started

### Prerequisites
- Docker and Docker Compose installed.
- MySQL running in a Docker container.

### Development Setup

1. Clone the repository:
```bash
git clone https://github.com/MartinKokesCz/graphql-nette-example
cd graphql-nette-example
```

2. Start Docker services:
```bash
docker-compose up --build
```

3. Access the application with your favourite client (for example [Altair GraphQL Client](https://altairgraphql.dev/) ):
- **GraphQL Endpoint**: `http://localhost/api`
---

## Database Setup
- The migrations are started together with docker compose command, but if it is not working you can manually run migrations to set up the database schema:
```bash
docker exec -it graphql-nette-example-php-1 php bin/console migrations:migrate
```
---

## GraphQL Queries and Mutations
- TODO: make separate documentation generated from schema

### Query for all books
```graphql
{
  allBooks {
    id
    title
    author
    publicationYear
    genre
    description
  }
}
```

### Query for a single book
```graphql
{
  book(id:1) {
    id
    title
    author
    publicationYear
    genre
    description
  }
}
```
### Query for creating a new book
```graphql
mutation {
  addBook(
    title: "To Kill a Mockingbird",
    author: "Harper Lee",
    publicationYear: 1960,
    genre: "Fiction",
    description: "A novel about the injustices of race and class in the Deep South."
  ) {
    id
    title
    author
    publicationYear
    genre
    description
  }
}
```

### Query for updating a book
```graphql
mutation {
  updateBook(
    id: 1,  # The ID of the book you want to update
    title: "New Title",
    author: "Updated Author",
    publicationYear: 2021,
    genre: "Updated Genre",
    description: "Updated description of the book."
  ) {
    id
    title
    author
    publicationYear
    genre
    description
  }
}
```

### Query for deleting a book based on ID
```graphql
mutation {
  deleteBook(id: 1)
}
```
---

## Tools for development
- **`make cs`**: Runs code style checks using CodeSniffer to ensure the code adheres to defined coding standards.
- **`make cbf`**: Executes the code style fixer to automatically format and fix code style issues based on the defined coding standards.
- **`make stan`**: Runs static analysis using a tool like PHPStan to identify potential bugs, type mismatches, and other issues in the codebase.