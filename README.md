# <img src="/assets/liberpdf-logo.png" width="70px" />

## Upcoming
1. Migration to MySQL to SQlite3
2. Portability and plug and play

## Prerequisites
1. php 8^
2. sqlite3


## Library management SCHEMA 
1. **table**:users
```plaintext
User {
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    email TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
}
```
2. **table**:categories
```plaintext
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
```



