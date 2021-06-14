
# trabfin_bd_20202
Trabalho Final - Banco de Dados I - 2020/2

Nomes
- Jonatas Luis Ramos Simoes 115089638
- Roberto Leonie Ferreira Moreira 116062192
- João Henrique Schmidt de Carvalho 119050097
- Leonardo Emerson André Alves 117062624
- Ana Clara Monteiro de Oliveira 115199661
- Andreza Cardoso Santos  115209709

## Instalação no linux (debian)
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
### Parte 2: mysql
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
Procure pelo arquivo sqls_script_renomeacao.sh na pasta sqls/ e aplique os scripts renomeados:
```sh
./sqls/sqls_script_renomeacao.sh Script_VODAN_BR_BD(ReadsSQLData).sql
./sqls/sqls_script_renomeacao.sh SQLs_Integradas.sql
sudo mysql -u root -p < ./sqls/renomeado_Script_VODAN_BR_BD(ReadsSQLData).sql
sudo mysql -u root -p < ./sqls/renomeado_SQLs_Integradas.sql
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
![Exemplo de login e senha no app_local.php](https://user-images.githubusercontent.com/51456769/121438851-25e67800-c95b-11eb-9ab6-560686b531b7.png)

Precisamos agora instalar o [composer](http://localhost/index.php), ele é apenas necessário para construir a estrutura de arquivos.
O site do composer literalmente me manda não compartilhar o comando de instalação devido à constante mudança do script, então é necessário entrar no site e pegar o código atualizado lá. Quando o composer estiver instalado, execute o comando:
```sh
composer create-project --prefer-dist cakephp/app:^3.9 diretorio/bem/legal
```
Agora a parte mais importante, depois de clonar o repositório, substitua os arquivos do 'diretorio/bem/legal' pelos arquivos do repositório:
```sh
cp -r ./site_vodan/ diretorio/bem/legal # o src/ do site_vodan deve ser o mesmo do src/ do diretorio legal
```
Isso fara com que os arquivos essenciais do cake rodem os arquivos essenciais do site.
Depois disso, basta executar o arquivo cake. Dentro da pasta do repositório:
```sh
./bin/cake server
```
O site será então iniciado, e poderá ser acessado com o endereço https://localhost:8765
