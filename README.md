# trabfin_bd_20202
Trabalho Final - Banco de Dados I - 2020/2

Nomes
- Jonatas Luis Ramos Simoes 115089638
- Roberto Leonie Ferreira Moreira 116062192
- João Henrique Schmidt de Carvalho 119050097
- Leonardo Emerson André Alves 117062624
- Ana Clara Monteiro de Oliveira 115199661
- Andreza Cardoso Santos  115209709
- - - -
##Instalação no linux (debian)
### Parte 1: apache
Primeiramente é necessária algum serviço para hostear o site
```sh
sudo apt update
sudo apt install apache2
```
Depois, é necessário ativar os:
```sh
sudo systemctl start apache2.service
```
## Parte 2: mysql
Para ver se o apache HTTP está instalado, basta pesquisar pelo [localhost](http://locahost) no navegador
Depois, é necessária a instalação do mysql
```sh
sudo apt install mysql-server
```
Depois disso, rode o comando abaixo e siga as instruções que serão fornecidas para segurar o mysql
```sh
sudo mysql_secure_installation
```
e reinicie o servidor:
```sh
sudo systemctl restart mysql
```
Agora, já é possível aplicar o sql contido no repositório.
Procure pelo arquivo script_vodan_renomeado.sql nas pastas ./site_vodan ou ./
Na pasta do repostório local, aplique:
```sh
sudo mysql -u root -p < ./site_vodan/script_vodan_renomeado.sql
```
### Parte 3: php
Aplique os repositórios
```sh
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
```
Todos esses módulos são necessários:
```sh
sudo apt install php7.2 libapache2-mod-php7.2 php7.2-common php7.2-gmp php7.2-curl php7.2-intl php7.2-mbstring php7.2-xmlrpc php7.2-mysql php7.2-gd php7.2-imap php7.2-ldap php-cas php7.2-bcmath php7.2-xml php7.2-cli php7.2-zip php7.2-sqlite3
```
Se estiver com uma versão anterior ou superior, basta substituir todos os "7.2"s pela versão preferível.
Dentro do arquivo php.ini (/etc/php/7.2/apache2/php.ini no ubuntu), modifique os seguintes valores:
```vim
file_uploads = On
allow_url_fopen = On
short_open_tag = On
memory_limit = 256M
upload_max_filesize = 100M
max_execution_time = 360
max_input_vars = 1500
date.timezone = America/Chicago
```
Para testar se tudo está funcionando, modifique (se houver) ou crie o arquivo index.php
```sh
sudo nano /var/www/html/index.php #localização dos repositório dos sites no linux
```
Digite o seguinte código:
```php
<?php phpinfo(); ?>
```
E veja se está funcionando no [localhost](http://localhost/index.php)

### Parte 3: cakephp
Se tudo já está em ordem, agora chegou a hora de lançar o servidor.
Mas antes, no arquivo site_vodan/config/app_local.php, coloquem o login e senha do usuário do banco de dados.
O root é aceito:
<img alt="Exemplo de usuário e senha" scr="https://drive.google.com/file/d/1CARe8mI6dv7yVfhbe9GLe1d932dYhBLq/view?usp=sharing" />

Depois disso, basta executar o arquivo cake. Dentro da pasta do repositório:
```sh
./bin/cake serve
```
O site será então iniciado, e poderá ser acessado com o endereço https://localhost:8765
- - - -
##Instalação Windows
Acredito que o wampserver e o xampp possuam dentro do seus diretórios, a maioria dos arquivos necessários.
<img alt="Por favor complete para os usuários do windows" scr="https://imgur.com/a/qCzSaMt" />
