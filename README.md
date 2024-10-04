# <img src="/assets/liberpdf-logo.png" width="70px" />

## Upcoming
1. Migration to MySQL to SQlite3
2. Portability and plug and play

## Prerequisites
1. php 8^
2. sqlite3
3. php-pdo

## Installation and setup
1. Clone the repository
```bash
git clone https://github.com/williamgregorio/liberpdf
```
2. Visit the liberpdf directory
```bash
cd liberpdf
```
3. Set permissions
```bash
sudo chmod +x liberpdf.sh
```

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
3. **table**:books
```plaintext
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    category_id INTEGER,
    title TEXT NOT NULL,
    url TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (category_id) REFERENCES Category(id)
````

