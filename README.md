<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Desafio Fullstack - Gerenciamento de Usuário com notificação push e notificação por email

O sistema permite que administradores realizem operações como cadastro, edição, exclusão e visualização de usuários. Ao cadastrar um novo usuário, é enviado automaticamente um e-mail notificando sobre o cadastro bem-sucedido. Quando um administrador edita um usuário, este último recebe uma notificação imediata, caso esteja logado no sistema.

## Instruções para Execução

**1.** Clone o projeto em sua máquina

**2.** run `composer install` e `composer update`

Necessário `extension=sodium` habilitada no php.ini.

**3.** run `npm install`

**4.** Crie um Arquivo `.env`: Na raiz do seu projeto, crie um arquivo chamado `.env`.

**5.** Copie do `.env.example`: Localize o arquivo `.env.example` no seu projeto e copie todo o conteúdo.

**6.** Cole no `.env`: Cole o conteúdo copiado no arquivo recém-criado `.env`.

**7.** Configuração de Envio de E-mails:

   Para habilitar o envio de e-mails, utilizei o serviço Mailtrap. Siga os passos abaixo para configurar:

   Crie uma conta no [Mailtrap](https://mailtrap.io/) se ainda não tiver uma.
   Após o login, crie um novo projeto para obter as credenciais necessárias.
   No projeto Mailtrap, vá até as configurações e copie as informações do servidor SMTP fornecidas.

**8.** Configuração do .env para Mailtrap:

Adicione as seguintes informações do Mailtrap ao seu arquivo .env:

```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"

```

Certifique-se de substituir pelos valores fornecidos pelo Mailtrap.

**9.** run `php artisan migrate`

**10.** run `php artisan db:seed`

Após executar `php artisan db:seed`, será criado um usuário administrador para acesso ao sistema com as seguintes credenciais:

-   Email: teste@example.com
-   Senha: 12345678

**11.** run `php artisan key:generate`

**12.** run `npm run dev` para atualizar o laravel-mix.

**13.** run `php artisan serve` para iniciar o servidor.

**14.** Acesse http://localhost:8000

Para conduzir testes nas funcionalidades de notificação, acesso o sistema simultaneamente com dois usuários distintos em navegadores diferentes. Utilizo as credenciais de um usuário administrador para efetuar as edições necessárias. Uma característica notável desse processo é a exibição em tempo real da notificação para o usuário que teve seus dados alterados.
