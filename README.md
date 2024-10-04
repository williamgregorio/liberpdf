# <img src="/assets/liberpdf-logo.png" width="70px" />

## Prerequisites
1. php 8^
2. sqlite3
3. php-pdo

## Installation and setup
1. **Clone the repository**:
```bash
git clone https://github.com/williamgregorio/liberpdf
```
2. **Visit the liberpdf directory**:
```bash
cd liberpdf
```
3. **Set permissions**:
```bash
sudo chmod +x liberpdf.sh
```
4. **Make alias liberpdf.sh**:
`nvim ~/.bashrc`
```bash 
alias liberpdf=`/path/to/liberpdf/liberpdf.sh`
```
`source ~/.bashrc`

5. **Create database**:
```bash
liberpdf create db
```
6. **Run on localhost**:
```bash
liberpdf run
```
