![{FAE33641-F2CE-4381-9B48-783420BAAB95}](https://github.com/user-attachments/assets/ef9d3109-a824-4b18-a143-ec8dc8b01516)# Reporte

## Base de datos
Para la creacion de la API se utilo Laravel en donde se creo la siguiente base de datos 

### Tabla Usuarios
Esta tabla contiene a los usuarios de la aplicacion.
![{20C1BAE0-A2ED-4D64-9248-D4B7F4B1A4EC}](https://github.com/user-attachments/assets/5b8c7d17-3cca-4b49-bcd8-d12d640401fb)

### Tabla Pokemon
Esta tablña gurada la informacion de los pokemones.
![{2F96C320-85BE-43B9-87A7-EA97574BE934}](https://github.com/user-attachments/assets/0e437d71-ca23-4b81-b7e4-b84391687ec7)

### Tabla Habilidad
Esta tabla guarda toda la informacion de las habilidades de los pokemones.
![{84438BBB-6813-440A-9BC8-4B5F878D5289}](https://github.com/user-attachments/assets/1c76c5d4-28f0-4fa8-98ee-e41b44ed4c53)

### Tabla habilida_pokemon
Esta tabla surgue de la relacion de muchos a muchos que hay entre las habilidades y los pokemon.
![{FF87D9F8-7B5B-4DFF-B571-A8CECE6CD2ED}](https://github.com/user-attachments/assets/481ed304-fd85-443b-a18e-e0cfcce653c6)

Para que esta relacion funciones correctamente en los modelos de Pokemon y Habilidad debe de especificarse la realcion de muchos a muchos de la siguiente manera en donde se especifica la tabla que los relaciona y las llavez foraneas de cada uno:

Tabla habilidad:
![{2B60CE56-150F-4718-9A4F-34C414F08942}](https://github.com/user-attachments/assets/72435116-f367-4675-bc9f-18dfe43b2e36)

Tabla Pokemon:
![{D9218D7A-BCD3-49A8-87DB-CA31B829EEBF}](https://github.com/user-attachments/assets/e0798466-7287-4234-89e9-ca27c493a710)

## Controladores 
Para interactuar con la API y lograr realizar peticiones GET, POST, PUT, DELETE se deben especificar los metodos en los constroladores los cuales que haran las consultas a la base de datos y regresaran los datos e informacion requerida cuando se realicen estas peticiones. A continuacion se detallas los metodos que se crearon para cada peticion.

### Pokemon Controller

#### Index 
Este metodo regresa la lista de todos los pokemones que hay en la base de datos con sus habilidades.
Lo que hace este metodo es primero obtener todos los pokemones de la tabla Pokemon con Pokemon::al(), despues se crear un JSON el cual contiene la lista de pokemon y el estatus de la peticion el cual sera 200 si todo fue correcto asi mismo con load('habilidades') se cargan las habilidades de cada pokemon.
![{FAE33641-F2CE-4381-9B48-783420BAAB95}](https://github.com/user-attachments/assets/9ceb9439-57d4-4225-84db-7073c2153456)































<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
