# symfony-hotel
## Project Initialization
//Depreca
To clone the project along with its submodules, use the following command:

```sh
git clone --recurse-submodules https://github.com/mystogan187/symfony-hotel.git
```
### You can also download directly the repo from:
```sh
gh repo clone mystogan187/sfHotel

git clone https://github.com/mystogan187/sfHotel.git
```

## Requirements

- **Symfony CLI**: To install Symfony CLI, use:

```sh
curl -sS https://get.symfony.com/cli/installer | bash
```


- **MySQL**
macOS:
```sh
brew install mysql
```
Lunux
```sh
sudo apt install mysql-server
```

The database specifications is as shown on the env:

User: root
Password: 123
Port: 3306
Database: hotel

DATABASE_URL="mysql://root:123@127.0.0.1:3306/hotel?charset=utf8"

```sh
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```



## Start WebServer

To start the Symfony web server, use the following command:

```sh
symfony server:start
```
