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

#### buscar
Este metodo busca a los pokemones en la base de datos que coincida con el nombre que se le haya pasado al metodo, para esto realiza una consulta a la base de datos filtrando con where el campo nombre que coincida con los nombres, poestriormente regresa un JSON con la lista de pokemon que coincidan y el estatus 200 asi mismo se cargan las habilidades de cada pokemon.
![{D382EBD5-A913-4E6B-86B4-35B5763555E1}](https://github.com/user-attachments/assets/a2cb847d-8bba-47fc-89da-a8ff4921de53)

#### Store
Este metodo sirve para crear un nuevo pokemon en la base de datos primero recibe una JSON con los datos a guardar en request para lo cual primero se validan cada uno de los datos del pokemon usando un validator, y guardando el resultado en una variable llamada validator. 
Despues se verifa si la validacion fallo, si es asi se retorna un mensaje de error, con un status de error y la respuesta de la validacion que contiene los motivos por el cual no se validaron los datos.

![{DB19F8DE-984E-496C-BB3F-6B58643974DC}](https://github.com/user-attachments/assets/9a3877af-9e2c-485d-a9a7-e7042dbd20e4)

Si los datos estan bien se crea el pomemon con Pokemon::create y se especifican los campos. Esto se pone dentro de un try catch. 
Si se crea el pokemon correctamente despues se valida que existan habilidades en request si es asi se recorren las habilidades y por cada una se crea la habilidad con Habilidad::create y se guarda la id de la habilidad, despues se enlazan los nuevos pokemones con sus habilidades usando $pokemon->habilidades()->sync($habilidadesIds)
Si todo salio bien se retorna el pokemon que se creo con sus habilidades, un mensaje se exito y un status de 200. 

![{8E5A0AF2-149F-4B49-A320-A88C72098F98}](https://github.com/user-attachments/assets/6f733fda-a825-4ebb-9750-f283bf105f26)

Si sugue un error en la creacion del pokemon entra al catch en donde se retorna un mensaje de error, el error de la excepcion y un status 500.
![{CF5CC40E-4E8D-495D-B516-C4CC445FB562}](https://github.com/user-attachments/assets/000461b2-df78-4f23-abe5-d64e679aaf75)

#### Show
Este metodo sirve para buscar un pokemon por id para esto se debe pasar el id al metodo y se usa Pokemon::find($id) para buscar el pokemon con ese id en la base de datos.
Si no se encontro se retorna un mensaje de error y un status de 404, si se encontro se retorna el pokemon con su habilidad y un status de 200.
![{C2EAFE37-A507-45EC-89CF-22531C9D0CB8}](https://github.com/user-attachments/assets/66717af1-2cf0-4ac8-9886-7932096c92ab)

#### update
Este metodo se usa para actualizar un pokemon para el cual recibe el id del pokemon y los datos del pokemon.
Primero se busca el pokemon, si no existe se retorna el mensaje de error con un status de 404.
Despues se validan los datos a actualizar con validator. Si la validacion falla se retorna el mensaje de error mas el fallo del validator y un status de 400.
![{28D0557B-BAA5-4F4C-B754-4D078D4D53CA}](https://github.com/user-attachments/assets/dc7d7570-5256-4942-8245-45b9434f73a1)

Despues usando un try catch se actualiza el pokemon usando $pokemon->update y se especifican los campos a actualizar, despues por cada habilidad se busca la habilidad y se actualiza de la misma forma que el pokemon para despues actualizar las realciones con $pokemon->habilidades()->sync($habilidadesIds), finalmente se retorna un mensaje de exito y el pokemon actualizado ademas del status 200.

![imagen](https://github.com/user-attachments/assets/47598db5-0297-4a67-9d28-82ddb199209a)

Finalmente si ocurre un error en el catch se retorna el mensaje de error mas el error de la excepcion y un status de 500.
![{AB0C158C-6B0F-4F92-960F-8B095898ED26}](https://github.com/user-attachments/assets/76bbf3ad-bc48-4f5a-a310-69bb07cc247e)


#### destroy
Este metodo lo que hace es borrar un pokemon junto con sus habilidaes, para esto primero se busca el pokemon, si no existe se retorna el mensaje de error y el estatus 404.
Si se encuentra primero se borran las habilidades usando $pokemon->habilidades()->detach(), despues se borra el pokemon usando $pokemon->delete().
Si todo es correcto se retorna el mensaje de eliminado y un status de 200, si hay un error en el catch se retorna un mensaje de error mas el errorde la excepcion y el estatu 500.
![{81BAF5F3-C51B-4A11-9585-A8F9BD4FB7CF}](https://github.com/user-attachments/assets/5474574d-09dd-47f7-8be2-af39cb9c1423)






































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
