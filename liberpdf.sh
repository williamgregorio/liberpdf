#!/bin/bash
COMMAND="$1"
DEFAULT_DATA_PATH="./data/db.sqlite3"
DATA_DIR="./data"

check_data_directory() {
  if [ ! -d "$DATA_DIR" ]; then
    echo "Data directory does not exist."
    echo "Creating new directory..."
    mkdir -p "$DATA_DIR"
    echo "Directory 'data' has been created."
  fi
}

check_db_status() {
  if [ -f "$DEFAULT_DATA_PATH" ]; then
    echo "Database 'db.sqlite3' file already exists."

    TABLE_COUNT=$(sqlite3 "$DEFAULT_DATA_PATH" "SELECT COUNT(name) FROM sqlite_master WHERE type='table';" )
    if [ $TABLE_COUNT -gt 2 ]; then
      echo "Database already has more than 2 tables, either delete it, or aborting now."
      exit 1
    else 
      echo "Database exist but not enough tables to run, web app."
    fi
  else
    echo "Database file does not exist."
  fi
}

create_db() {
  check_data_directory
  check_db_status

  php build/setup.php
  echo "Database setup is complete, and ready for usage."
}

run_local_php_server() {
  PORT=${1:-7001}
  echo "Starting PHP local server on port $PORT"
  php -S localhost:$PORT
}

case "$COMMAND" in
  "create")
    shift
    case "$1" in
      "db")
        create_db
        ;;
      *)
        echo "Usage: ./liberpdf.sh create db"
        exit 1
        ;;
    esac
    ;;
  "run")
    shift
    run_local_php_server "$1"
    ;;
  *)
    echo "Usage: ./liberpdf.sh create db OR ./liberpdf.sh run {port} defaults to 7001"
    exit 1
    ;;
esac
