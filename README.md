# <img src="/assets/liberpdf-logo.png" width="70px" />

## Prerequisites
1. php 8^
2. sqlite3
3. php-pdo

## Installation and setup
1. **Clone the repository**
```bash
git clone https://github.com/williamgregorio/liberpdf
```
2. **Visit the liberpdf directory**
```bash
cd liberpdf
```
3. **Set permissions**
```bash
sudo chmod +x liberpdf.sh
```
5. Make alias liberpdf.sh
1. go to ~/.bashrc
```bash 
alias liberpdf=`/path/to/liberpdf/liberpdf.sh`
```
2. source ~/.bashrc
4. **Create database**
```bash
liberpdf create db
```
5. **Run on localhost**
```bash
liberpdf run
```
