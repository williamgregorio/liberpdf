#!/bin/bash

COMMAND= "$1"

DEFAULT_DATA_PATH="../data/db.sqlite3"
DATA_DIR= "../data"


check_data_directory() {
  if [! -d "$DATA_DIR"]; then
    echo "Data directory does not exist.\n...Creating new directory"
    mkdir -p "$DATA_DIR"
    echo "Directory 'data' has been created."
  fi
}

check_db_status() {
  if [[ -f "$DEFAULT_DATA_PATH" ]]; then
    echo "Database 'db.sqlite3' file already exists."
    
  fi
}

