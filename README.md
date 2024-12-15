# Reporte

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

![{0F1E7782-35C8-4EFE-B712-BE8DEFFD7ADA}](https://github.com/user-attachments/assets/aaeb607c-b4e9-4413-817a-dca1875e0353)


#### buscar
Este metodo busca a los pokemones en la base de datos que coincida con el nombre que se le haya pasado al metodo, para esto realiza una consulta a la base de datos filtrando con where el campo nombre que coincida con los nombres, poestriormente regresa un JSON con la lista de pokemon que coincidan y el estatus 200 asi mismo se cargan las habilidades de cada pokemon.

![{D382EBD5-A913-4E6B-86B4-35B5763555E1}](https://github.com/user-attachments/assets/a2cb847d-8bba-47fc-89da-a8ff4921de53)

![{78CC80F1-F492-4DA1-BF6B-573B0CEAAB2E}](https://github.com/user-attachments/assets/13bc64bd-fc61-4609-844c-add0a7991659)


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

![{A0E8BFE1-7A89-4498-B9B0-7F694C7C89F3}](https://github.com/user-attachments/assets/906eac89-cff8-4cf7-a8c4-f8440d3a1b2d)


#### Show
Este metodo sirve para buscar un pokemon por id para esto se debe pasar el id al metodo y se usa Pokemon::find($id) para buscar el pokemon con ese id en la base de datos.
Si no se encontro se retorna un mensaje de error y un status de 404, si se encontro se retorna el pokemon con su habilidad y un status de 200.

![{C2EAFE37-A507-45EC-89CF-22531C9D0CB8}](https://github.com/user-attachments/assets/66717af1-2cf0-4ac8-9886-7932096c92ab)

![{29705234-6848-480A-BD73-22AA0F7EBA58}](https://github.com/user-attachments/assets/6fe7ad52-4276-4e59-a117-5547f1f7f55c)


#### update
Este metodo se usa para actualizar un pokemon para el cual recibe el id del pokemon y los datos del pokemon.
Primero se busca el pokemon, si no existe se retorna el mensaje de error con un status de 404.
Despues se validan los datos a actualizar con validator. Si la validacion falla se retorna el mensaje de error mas el fallo del validator y un status de 400.

![{28D0557B-BAA5-4F4C-B754-4D078D4D53CA}](https://github.com/user-attachments/assets/dc7d7570-5256-4942-8245-45b9434f73a1)


Despues usando un try catch se actualiza el pokemon usando $pokemon->update y se especifican los campos a actualizar, despues por cada habilidad se busca la habilidad y se actualiza de la misma forma que el pokemon para despues actualizar las realciones con $pokemon->habilidades()->sync($habilidadesIds), finalmente se retorna un mensaje de exito y el pokemon actualizado ademas del status 200.

![imagen](https://github.com/user-attachments/assets/47598db5-0297-4a67-9d28-82ddb199209a)

Finalmente si ocurre un error en el catch se retorna el mensaje de error mas el error de la excepcion y un status de 500.

![{AB0C158C-6B0F-4F92-960F-8B095898ED26}](https://github.com/user-attachments/assets/76bbf3ad-bc48-4f5a-a310-69bb07cc247e)

![{AE813ED4-DD96-4E7E-9E87-6D81C08FE4CA}](https://github.com/user-attachments/assets/f9a641e7-a8cf-4d96-a003-5f444ba78c45)



#### destroy
Este metodo lo que hace es borrar un pokemon junto con sus habilidaes, para esto primero se busca el pokemon, si no existe se retorna el mensaje de error y el estatus 404.
Si se encuentra primero se borran las habilidades usando $pokemon->habilidades()->detach(), despues se borra el pokemon usando $pokemon->delete().
Si todo es correcto se retorna el mensaje de eliminado y un status de 200, si hay un error en el catch se retorna un mensaje de error mas el errorde la excepcion y el estatu 500.

![{81BAF5F3-C51B-4A11-9585-A8F9BD4FB7CF}](https://github.com/user-attachments/assets/5474574d-09dd-47f7-8be2-af39cb9c1423)

![{35D0FCA2-7409-4B31-81F5-496039A9089F}](https://github.com/user-attachments/assets/7f0a50ce-77c4-4028-890b-293e9d0a6e1c)







































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

# Creacion del Api de Pokemones
Primero crearemos las migraciones de usuarios, pokemones, habilidades de pokemones y tabla intermedia entre habilidades y pokemones dado que tiene una relacion de muchos a muchos por que un pokemon puede terne de una a muchas habilidades y una habilidad puede pertenecer a uno o muchos pokemones.

## Migraciones
La migracion se crea dado que esta es la parte de la base de datos y es donde se alacenara todos los datos, esto se hara con los comandos de.
- ```bash
`php artisan make:migration create_usuario_table`
```
- ```bash
`php artisan make:migration create_pokemon_table`
```
- ```bash
`php artisan make:migration create_habilidads_table`
```
- ```bash
`php artisan make:migration create_habilidad_pokemon_table`
```

### Creación de la tabla usuarios

```php
<?php

// Importamos las herramientas necesarias para trabajar con migraciones
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Creamos una clase anónima que extiende la clase Migration
return new class extends Migration
{
    // Este método "up" se ejecuta cuando aplicamos la migración
    public function up(): void
    {
        // Creamos una tabla llamada 'usuario' con Schema y definimos sus columnas con Blueprint
        Schema::create('usuario', function (Blueprint $table) {
            $table->id(); // Columna de clave primaria auto-incremental, usada como identificador único
            $table->string('name'); // Columna para almacenar el nombre del usuario (máximo 255 caracteres)
            $table->string('avatar'); // Columna para guardar la URL o el nombre del archivo del avatar del usuario
            $table->string('apellidoP'); // Columna para el apellido paterno del usuario
            $table->string('apellidoM'); // Columna para el apellido materno del usuario
            $table->string('email'); // Columna para el correo electrónico del usuario (debería ser único en muchos casos)
            $table->string('password'); // Columna para almacenar la contraseña
            $table->string('phone'); // Columna para guardar el número de teléfono del usuario
            $table->timestamps(); // Agrega las columnas que nos dice cuando se creo y la ultima modificaión
        });
    }

    // Este método "down" se ejecuta para revertir la migración
    public function down(): void
    {
        // Elimina la tabla 'usuario' si existe en la base de datos
        Schema::dropIfExists('usuario');
    }
};

```
### Creación de la tabla pokemon
```php
<?php

// Importamos las herramientas necesarias para trabajar con migraciones
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Creamos una clase anónima que extiende la clase Migration
return new class extends Migration
{
    // Este método "up" se ejecuta cuando aplicamos la migración
    public function up(): void
    {
        // Utilizamos Schema para crear una tabla llamada 'pokemon'
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id(); // Columna de clave primaria con auto-incremento, esencial para identificar registros únicos
            $table->string('nombre'); // Columna para almacenar el nombre del Pokémon
            $table->string('avatar'); // Columna para guardar la URL o el nombre del archivo de la imagen del Pokémon
            $table->string('descripcion'); // Columna para almacenar una breve descripción del Pokémon
            $table->integer('peso'); // Columna para almacenar el peso del Pokémon
            $table->integer('altura'); // Columna para guardar la altura del Pokémon
            $table->integer('hp'); // Columna para los puntos de salud (HP) del Pokémon
            $table->integer('ataque'); // Columna para la estadística de ataque
            $table->integer('defensa'); // Columna para la estadística de defensa
            $table->integer('ataque_especial'); // Columna para la estadística de ataque especial
            $table->integer('defensa_especial'); // Columna para la estadística de defensa especial
            $table->integer('velocidad'); // Columna para la estadística de velocidad
            $table->timestamps(); // Agrega las columnas 'created_at' y 'updated_at' automáticamente para registrar cuándo se creó o modificó un registro
        });
    }

    // Este método "down" se ejecuta para revertir la migración
    public function down(): void
    {
        // Elimina la tabla 'pokemon' si existe en la base de datos
        Schema::dropIfExists('pokemon');
    }
};
```
### Creación de la tabla habilidad

```php
<?php

// Importamos las herramientas necesarias para trabajar con migraciones
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Creamos una clase anónima que extiende la clase Migration
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        // Crea una tabla llamada 'habilidads' en la base de datos
        Schema::create('habilidads', function (Blueprint $table) {
            $table->id(); // Clave primaria auto-incremental, usada para identificar registros únicos
            $table->string('nombre'); // Columna para almacenar el nombre de la habilidad (máximo 255 caracteres)
            $table->string('descripcion'); // Columna para almacenar una descripción de la habilidad
            $table->timestamps(); // Agrega las columnas que nos dice cuando se creo y la ultima modificaión
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        // Elimina la tabla 'habilidads' si existe
        Schema::dropIfExists('habilidads');
    }
};
```

### Creación de la tabla de muchos a muchos entre habilidades y pokemones

```php
<?php

// Importamos las herramientas necesarias para trabajar con migraciones
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Creamos una clase anónima que extiende la clase Migration
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        // Crea una tabla intermedia llamada 'habilidad_pokemon' para gestionar la relación
        Schema::create('habilidad_pokemon', function (Blueprint $table) {
            $table->id(); // Clave primaria auto-incremental para identificar cada registro
            $table->unsignedBigInteger('pokemon_id'); // Columna para relacionar con la tabla 'pokemon'
            $table->unsignedBigInteger('habilidad_id'); // Columna para relacionar con la tabla 'habilidads'
            
            // Definimos la clave foránea 'pokemon_id' que referencia al campo 'id' en la tabla 'pokemon'
            $table->foreign('pokemon_id')
                ->references('id')->on('pokemon') // Apunta a la columna 'id' de la tabla 'pokemon'
                ->onDelete('restrict'); // Si intentamos borrar un registro relacionado, se restringe la operación

            // Definimos la clave foránea 'habilidad_id' que referencia al campo 'id' en la tabla 'habilidads'
            $table->foreign('habilidad_id')
                ->references('id')->on('habilidads') // Apunta a la columna 'id' de la tabla 'habilidads'
                ->onDelete('restrict'); // Restringe la eliminación si hay una relación activa

            $table->timestamps(); // Agrega las columnas que nos dice cuando se creo y la ultima modificaión
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        // Elimina la tabla 'habilidad_pokemon' si existe
        Schema::dropIfExists('habilidad_pokemon');
    }
};
```
## Creacion de los modelos
En esta parte haremos un modelo para cada tabla dado que estos nos permiten hacer consultas a la base de datos.

### Creación de los modelos

Crearemos los modelos con los comandos:
- ```bash
php artisan make:model Usuario
```
- ```bash
php artisan make:model Pokemon
```
- ```bash
php artisan make:model Habilidad
```
- ```bash
php artisan make:model habilidad_pokemon
```

### Creación del modelo usuarios

```php
<?php

namespace App\Models; // Espacio de nombres que indica dónde se encuentra este modelo en el proyecto

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model de Eloquent
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory para usar factories en este modelo

class Usuario extends Model
{
    // Uso del trait HasFactory, que permite generar datos de prueba con factories
    use HasFactory;

    // Especifica el nombre de la tabla asociada a este modelo
    protected $table = 'usuario'; 
    // Por defecto, Eloquent asume que la tabla tiene el nombre pluralizado del modelo ("usuarios" para este caso),
    // pero aquí especificamos que el modelo corresponde a la tabla "usuario".

    // Define los campos que se pueden asignar masivamente al modelo
    protected $fillable = [
        'name',        // Nombre del usuario
        'avatar',      // URL o ruta del avatar del usuario
        'apellidoP',   // Apellido paterno del usuario
        'apellidoM',   // Apellido materno del usuario
        'email',       // Correo electrónico del usuario
        'password',    // Contraseña (debe ser protegida, normalmente con hash)
        'phone'        // Teléfono del usuario
    ];
    // El arreglo `$fillable` sirve para proteger el modelo contra la asignación masiva no deseada.
    // Solo estos campos pueden ser asignados con métodos como `create()` o `update()`.

    // Otros atributos o métodos personalizados pueden definirse aquí para añadir lógica al modelo.
}
```

### Creación del modelo pokemones

```php
<?php

namespace App\Models; // Define el espacio de nombres donde se encuentra este modelo

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model de Eloquent

class Pokemon extends Model
{
    // Método que define una relación "muchos a muchos" con el modelo Habilidad
    public function habilidades()
    {
        return $this->belongsToMany(
            Habilidad::class,        // Modelo relacionado: Habilidad
            'habilidad_pokemon',     // Tabla intermedia: habilidad_pokemon
            'pokemon_id',            // Columna de este modelo en la tabla intermedia
            'habilidad_id'           // Columna del modelo relacionado en la tabla intermedia
        );
    }

    // Especifica el nombre de la tabla asociada a este modelo
    protected $table = 'pokemon';
    // Laravel asume que el nombre de la tabla será el plural del modelo ("pokemons"), 
    // pero aquí especificamos que usaremos "pokemon" como nombre exacto.

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',            // Nombre del Pokémon
        'avatar',            // URL o ruta de la imagen del Pokémon
        'descripcion',       // Breve descripción del Pokémon
        'peso',              // Peso del Pokémon
        'altura',            // Altura del Pokémon
        'hp',                // Puntos de vida (HP) del Pokémon
        'ataque',            // Estadística de ataque
        'defensa',           // Estadística de defensa
        'ataque_especial',   // Estadística de ataque especial
        'defensa_especial',  // Estadística de defensa especial
        'velocidad'          // Velocidad del Pokémon
    ];
    // Estos campos pueden ser asignados en operaciones como `create()` o `update()`.
}

```

### Creación del modelo habilidades

```php
<?php

namespace App\Models; // Define el espacio de nombres donde se encuentra este modelo

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model de Eloquent

class Habilidad extends Model
{
    // Método que define una relación "muchos a muchos" con el modelo Pokemon
    public function pokemon()
    {
        return $this->belongsToMany(
            Pokemon::class,        // Modelo relacionado: Pokemon
            'habilidad_pokemon',   // Tabla intermedia: habilidad_pokemon
            'habilidad_id',        // Columna de este modelo en la tabla intermedia
            'pokemon_id'           // Columna del modelo relacionado en la tabla intermedia
        );
    }

    // Especifica el nombre de la tabla asociada a este modelo
    protected $table = 'habilidads';
    // Laravel asume que el nombre de la tabla será el plural del modelo ("habilidads"), 
    // pero aquí especificamos que usaremos "habilidads" como nombre exacto.

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',       // Nombre de la habilidad
        'descripcion'   // Descripción de la habilidad
    ];
    // Estos campos pueden ser asignados en operaciones como `create()` o `update()`.
}

```

### Creación del modelo habilidades de pokemon

```php
<?php

namespace App\Models; // Define el espacio de nombres donde se encuentra este modelo

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model de Eloquent

class habilidad_pokemon extends Model
{
    // Este modelo está asociado con la tabla intermedia 'habilidad_pokemon', 
    // que establece una relación "muchos a muchos" entre Pokémon y Habilidades.
    // No es necesario especificar ninguna relación aquí, ya que ya está definida en los modelos `Pokemon` y `Habilidad`.

    // En este caso, el modelo `habilidad_pokemon` no necesita métodos ni propiedades adicionales.
    // Laravel manejará la tabla intermedia automáticamente a través de las relaciones definidas en los modelos relacionados.
}
```

## Creación de los Controladores
La Api necesita controladores dado que estos son las consultas que se le hacen a la base dedatos y son los que nos permiten recuperar los datos, ingresar datos, modificar datos entre mas cosas. Para crear un controlador ejecutaremos los comandos:

- ```bash
php artisan make:controller UsuarioController
```
- ```bash
php artisan make:controller PokemonController
```
- ```bash
php artisan make:controller UsuarioController
```
- ```bash
php artisan make:controller HabilidadPokemonController
```

### Creación de Crontrolador de Usuarios

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Para manejar las solicitudes HTTP
use App\Models\Usuario; // El modelo Usuario para interactuar con la tabla 'usuarios'
use Illuminate\Support\Facades\Validator; // Para validar los datos recibidos en las solicitudes

class UsuarioController extends Controller
{
    // Método que devuelve todos los usuarios
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        $usuarios = Usuario::all();

        // Preparar la respuesta en formato JSON con los usuarios obtenidos
        $data = [
            'usuarios' => $usuarios, // Datos de los usuarios
            'status' => 200 // Código de estado HTTP 200 para éxito
        ];
        
        // Retorna la respuesta JSON con los datos y el código de estado 200
        return response()->json($data, 200);
    }

    // Método para crear un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud (request)
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55', // El nombre es obligatorio y no puede exceder 55 caracteres
            'avatar' => 'required', // El avatar es obligatorio
            'apellidoP' => 'required|max:35', // El apellido paterno es obligatorio y no puede exceder 35 caracteres
            'apellidoM'=> 'required|max:35', // El apellido materno es obligatorio y no puede exceder 35 caracteres
            'email' => 'required|email|unique:usuario', // El email es obligatorio, debe ser único y tener formato de correo electrónico
            'password' => 'required|max:100', // La contraseña es obligatoria y no puede exceder 100 caracteres
            'phone' => 'required|digits:10' // El teléfono es obligatorio y debe ser un número de 10 dígitos
        ]);

        // Si la validación falla, retorna un mensaje de error
        if($validator->fails()){
            // Preparar el mensaje de error con los detalles de la validación fallida
            $data = [
                'menssage' => 'Error en la Validacion de datos',
                'errors' => $validator->errors(), // Errores de validación
                'status' => 400 // Código de estado 400 para Bad Request
            ];
            return response()->json($data, 400); // Retorna la respuesta con el error de validación
        }

        // Si la validación es exitosa, crea el usuario con los datos proporcionados
        $usuario = Usuario::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'apellidoP' => $request->apellidoP,
            'apellidoM'=> $request->apellidoM,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        ]);

        // Si la creación del usuario falla, retorna un mensaje de error
        if(!$usuario){
            // Retorna un mensaje indicando que hubo un error al crear el usuario
            $data = [
                'menssage' => 'Error al crear el Usuario',
                'status' => 500 // Código de estado 500 para Error Interno del Servidor
            ];
            return response()->json($data, 500); // Retorna la respuesta con el mensaje de error
        }

        // Si el usuario fue creado exitosamente, retorna la información del usuario con un código de estado 201 (Creado)
        $data = [
            'usuario' => $usuario, // El usuario recién creado
            'status' => 201 // Código de estado 201 para creación exitosa
        ];
        return response()->json($data, 201); // Retorna la respuesta con el usuario creado
    }

    // Método para mostrar los detalles de un usuario por su ID
    public function show($id)
    {
        // Buscar un usuario por su ID
        $usuario = Usuario::find($id);

        // Si el usuario no existe, retorna un mensaje de error
        if(!$usuario){
            // Retorna un mensaje de error con código 404 (No Encontrado)
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404 // Código de estado 404 para Not Found
            ];
            return response()->json($data, 404); // Retorna la respuesta con el mensaje de error
        }
        
        // Si el usuario existe, prepara la respuesta con los datos del usuario
        $data = [
            'usuario' => $usuario, // Datos del usuario encontrado
            'status' => 200 // Código de estado 200 para éxito
        ];
        return response()->json($data, 200); // Retorna la respuesta con el usuario
    }

    // Método para eliminar un usuario por su ID
    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $usuario = Usuario::find($id);

        // Si el usuario no existe, retorna un mensaje de error
        if(!$usuario){
            // Retorna un mensaje de error con código 404 (No Encontrado)
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404 // Código de estado 404 para Not Found
            ];
            return response()->json($data, 404); // Retorna la respuesta con el mensaje de error
        }
        
        // Elimina el usuario de la base de datos
        $usuario->delete();

        // Retorna un mensaje confirmando que el usuario fue eliminado con código de estado 200 (OK)
        $data = [
            'message' => 'Usuario Eliminado',
            'status' => 200 // Código de estado 200 para éxito
        ];
        return response()->json($data, 200); // Retorna la respuesta con la confirmación de eliminación
    }

    // Método para actualizar un usuario por su ID
    public function update($id, Request $request)
    {
        // Buscar el usuario por su ID
        $usuario = Usuario::find($id);

        // Si el usuario no existe, retorna un mensaje de error
        if (!$usuario) {
            // Retorna un mensaje indicando que el usuario no fue encontrado
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404 // Código de estado 404 para No Encontrado
            ], 404); // Retorna la respuesta con el código de error 404
        }

        // Valida los datos recibidos en la solicitud de actualización
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'avatar' => 'required|url', // Avatar debe ser una URL válida
            'apellidoP' => 'required|max:35',
            'apellidoM' => 'required|max:35',
            'password' => 'required|max:100',
            'phone' => 'required|digits:10'
        ]);

        // Si la validación falla, retorna un error con los detalles de la falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(), // Errores de validación
                'status' => 400 // Código de estado 400 para Bad Request
            ], 400); // Retorna la respuesta con los detalles del error
        }

        // Si la validación es exitosa, actualiza los datos del usuario
        $usuario->name = $request->name;
        $usuario->avatar = $request->avatar;
        $usuario->apellidoP = $request->apellidoP;
        $usuario->apellidoM = $request->apellidoM;
        $usuario->password = $request->password;
        $usuario->phone = $request->phone;

        // Guarda los cambios en la base de datos
        $usuario->save();

        // Retorna un mensaje confirmando que el usuario ha sido actualizado correctamente
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario, // Los datos del usuario actualizado
            'status' => 200 // Código de estado 200 para éxito
        ], 200); // Retorna la respuesta con el usuario actualizado
    }
    
    // Método para actualizar parcialmente los datos de un usuario
    public function updateParcial($id, Request $request)
    {
        // Busca al usuario por su ID
        $usuario = Usuario::find($id);

        // Si el usuario no existe, retorna un mensaje de error
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404 // Código de estado 404 para No Encontrado
            ];
            return response()->json($data, 404); // Retorna la respuesta con el error
        }

        // Valida solo los campos que se están actualizando
        $validator = Validator::make($request->all(), [
            'name' => 'max:55', // El nombre es opcional pero no puede exceder 55 caracteres
            'avatar' => 'required', // Avatar es obligatorio
            'apellidoP' => 'max:35', // El apellido paterno es opcional pero no puede exceder 35 caracteres
            'apellidoM'=> 'max:35', // El apellido materno es opcional pero no puede exceder 35 caracteres
            'password' => 'max:100', // La contraseña es opcional pero no puede exceder 100 caracteres
            'phone' => 'digits:10' // El teléfono es opcional pero debe tener 10 dígitos
        ]);

        // Si la validación falla, retorna un mensaje de error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(), // Errores de validación
                'status' => 400 // Código de estado 400 para Bad Request
            ], 400); // Retorna la respuesta con los detalles del error
        }

        // Actualiza solo los campos que fueron proporcionados en la solicitud
        if ($request->has('name')) {
            $usuario->name = $request->name;
        }
        if ($request->has('avatar')) {
            $usuario->avatar = $request->avatar;
        }
        if ($request->has('apellidoP')) {
            $usuario->apellidoP = $request->apellidoP;
        }
        if ($request->has('apellidoM')) {
            $usuario->apellidoM = $request->apellidoM;
        }
        if ($request->has('password')) {
            $usuario->password = $request->password;
        }
        if ($request->has('phone')) {
            $usuario->phone = $request->phone;
        }

        // Guarda los cambios en la base de datos
        $usuario->save();

        // Retorna un mensaje confirmando que el usuario fue actualizado correctamente
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario, // Datos del usuario actualizado
            'status' => 200 // Código de estado 200 para éxito
        ], 200); // Retorna la respuesta con el usuario actualizado
    }
}

```

### Creación de Crontrolador de Pokemon

```php
<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Habilidad;

class PokemonController extends Controller
{
    /**
     * Mostrar una lista de todos los recursos (pokemones).
     */
    public function index()
    {
        // Obtiene todos los pokemones, incluyendo sus habilidades relacionadas
        $pokemon = Pokemon::all();
        $data = [
            'pokemons' => $pokemon->load('habilidades'), // Carga las habilidades relacionadas
            'status' => 200 // Código de estado 200 para éxito
        ];
        return response()->json($data, 200); // Retorna la lista de pokemones con sus habilidades
    }

    /**
     * Buscar pokemones por nombre.
     */
    public function buscar($nombre)
    {
        // Filtra los pokemones cuyo nombre contenga la cadena proporcionada
        $pokemon = Pokemon::where("nombre", "LIKE", "%{$nombre}%")->get(); 

        $data = [
            'pokemons' => $pokemon->load('habilidades'), // Carga las habilidades relacionadas
            'status' => 200 // Código de estado 200 para éxito
        ];
        return response()->json($data, 200); // Retorna la lista de pokemones encontrados
    }

    /**
     * Crear un nuevo recurso (Pokémon).
     */
    public function store(Request $request)
    {
        // Define las reglas de validación para los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'avatar' => 'required|string',
            'descripcion' => 'required|string',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'hp' => 'required|numeric',
            'ataque' => 'required|numeric',
            'defensa' => 'required|numeric',
            'ataque_especial' => 'required|numeric',
            'defensa_especial' => 'required|numeric',
            'velocidad' => 'required|numeric',
            'habilidades' => 'nullable|array' // Habilidades opcionales
        ]);

        // Si la validación falla, retorna un mensaje de error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400, // Código de estado 400 para Bad Request
            ], 400);
        }

        try {
            // Crea un nuevo Pokémon con los datos proporcionados
            $pokemon = Pokemon::create($request->only([
                'nombre', 'avatar', 'descripcion', 'peso', 'altura', 'hp', 
                'ataque', 'defensa', 'ataque_especial', 'defensa_especial', 'velocidad'
            ]));

            // Si se proporcionan habilidades, las crea y asocia al Pokémon
            if ($request->has('habilidades')) {
                $habilidadesIds = collect(); // Colección para almacenar los IDs de habilidades
                
                foreach ($request->habilidades as $habilidadData) {
                    // Crea una habilidad y guarda su ID
                    $habilidad = Habilidad::create([
                        'nombre' => $habilidadData['nombre'],
                        'descripcion' => $habilidadData['descripcion'],
                    ]);
    
                    $habilidadesIds->push($habilidad->id);
                }
    
                // Asocia las habilidades al Pokémon
                $pokemon->habilidades()->sync($habilidadesIds);
            }

            // Retorna la respuesta con el Pokémon creado y sus habilidades
            return response()->json([
                'pokemon' => $pokemon->load('habilidades'),
                'message' => 'Pokémon creado exitosamente',
                'status' => 201, // Código de estado 201 para creación exitosa
            ], 201);
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra durante la creación
            return response()->json([
                'message' => 'Error en la creación del Pokémon',
                'error' => $e->getMessage(),
                'status' => 500, // Código de estado 500 para error interno del servidor
            ], 500);
        }
    }

    /**
     * Mostrar un Pokémon específico por su ID.
     */
    public function show($id)
    {
        // Busca el Pokémon por ID
        $pokemon = Pokemon::find($id);

        // Si no se encuentra el Pokémon, retorna un mensaje de error
        if (!$pokemon) {
            return response()->json([
                'mensaje' => 'Pokemon no encontrado',
                'status' => 404, // Código de estado 404 para no encontrado
            ], 404);
        }

        $data = [
            'pokemon' => $pokemon->load('habilidades'),
            'status' => 200 // Código de estado 200 para éxito
        ];

        return response()->json($data, 200); // Retorna el Pokémon encontrado con sus habilidades
    }

    /**
     * Actualizar un Pokémon existente.
     */
    public function update(Request $request, $id)
    {
        // Busca el Pokémon por ID
        $pokemon = Pokemon::find($id);

        // Si no se encuentra el Pokémon, retorna un mensaje de error
        if (!$pokemon) {
            return response()->json([
                'mensaje' => 'Pokemon no encontrado',
                'status' => 404, // Código de estado 404 para no encontrado
            ], 404);
        }

        // Define las reglas de validación para los datos de entrada
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string',
            'avatar' => 'required|string',
            'descripcion' => 'required|string',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'hp' => 'required|numeric',
            'ataque' => 'required|numeric',
            'defensa' => 'required|numeric',
            'ataque_especial' => 'required|numeric',
            'defensa_especial' => 'required|numeric',
            'velocidad' => 'required|numeric',
            'habilidades' => 'nullable|array' // Habilidades opcionales
        ]);

        // Si la validación falla, retorna un mensaje de error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400, // Código de estado 400 para Bad Request
            ], 400);
        }

        try {
            // Actualiza los campos del Pokémon con los nuevos datos
            $pokemon->update($request->only([
                'nombre', 'avatar', 'descripcion', 'peso', 'altura', 'hp', 
                'ataque', 'defensa', 'ataque_especial', 'defensa_especial', 'velocidad'
            ]));

            // Si se proporcionan habilidades, las actualiza y asocia al Pokémon
            if ($request->has('habilidades')) {
                foreach ($request->habilidades as $habilidadData) {
                    // Encuentra la habilidad por ID y la actualiza
                    $habilidad = Habilidad::find($habilidadData['id']);
                    if ($habilidad) {
                        $habilidad->update([
                            'nombre' => $habilidadData['nombre'] ?? $habilidad->nombre,
                            'descripcion' => $habilidadData['descripcion'] ?? $habilidad->descripcion,
                        ]);
                    }
                }

                // Sincroniza las habilidades actualizadas con el Pokémon
                $habilidadesIds = collect($request->habilidades)->pluck('id');
                $pokemon->habilidades()->sync($habilidadesIds);
            }

            return response()->json([
                'mensaje' => 'Pokémon actualizado exitosamente',
                'pokemon' => $pokemon->load('habilidades'),
                'status' => 200, // Código de estado 200 para éxito
            ], 200);
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra durante la actualización
            return response()->json([
                'message' => 'Error al actualizar el Pokémon',
                'error' => $e->getMessage(),
                'status' => 500, // Código de estado 500 para error interno del servidor
            ], 500);
        }
    }

    /**
     * Eliminar un Pokémon.
     */
    public function destroy($id)
    {
        try {
            // Busca el Pokémon por ID
            $pokemon = Pokemon::find($id);

            // Si no se encuentra el Pokémon, retorna un mensaje de error
            if (!$pokemon) {
                return response()->json([
                    'mensaje' => 'Pokémon no encontrado',
                    'status' => 404, // Código de estado 404 para no encontrado
                ], 404);
            }

            // Desasocia las habilidades del Pokémon
            $pokemon->habilidades()->detach();

            // Elimina el Pokémon de la base de datos
            $pokemon->delete();

            return response()->json([
                'message' => 'Pokémon eliminado',
                'status' => 200, // Código de estado 200 para éxito
            ], 200);
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra durante la eliminación
            return response()->json([
                'message' => 'Error al eliminar el Pokémon',
                'error' => $e->getMessage(),
                'status' => 500, // Código de estado 500 para error interno del servidor
            ], 500);
        }
    }
}

```

### Creación de Crontrolador de Habilidad

```php
<?php

namespace App\Http\Controllers;

use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HabilidadController extends Controller
{
    /**
     * Mostrar una lista de todas las habilidades.
     */
    public function index()
    {
        // Obtiene todas las habilidades desde la base de datos
        $habilidad = Habilidad::all();
        $data = [
            'habilidad' => $habilidad, // Habilidades encontradas
            'status' => 200 // Código de estado 200 para éxito
        ];
        return response()->json($data, 200); // Retorna las habilidades encontradas
    }

    /**
     * Mostrar el formulario para crear una nueva habilidad.
     * Este método está vacío porque no se requiere una vista en esta API.
     */
    public function create()
    {
        //
    }

    /**
     * Almacenar una nueva habilidad en la base de datos.
     */
    public function store(Request $request)
    {
        // Define las reglas de validación para los datos de entrada
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string', // Nombre es obligatorio y debe ser una cadena de texto
            'descripcion' => 'required|string', // Descripción es obligatoria y debe ser una cadena de texto
        ]);

        // Si la validación falla, retorna un mensaje de error con los detalles
        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors(), // Muestra los errores de validación
                'status' => 400 // Código de estado 400 para Bad Request
            ];
            return response()->json($data, 400);
        }

        try {
            // Crea la nueva habilidad con los datos proporcionados
            $habilidad = Habilidad::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);

            // Retorna la respuesta con la habilidad creada y un mensaje de éxito
            return response()->json([
                'habilidades' => $habilidad, // La habilidad creada
                'mensaje' => 'Habilidad creada exitosamente',
                'status' => 201, // Código de estado 201 para creación exitosa
            ], 201);
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra durante la creación
            return response()->json([
                'mensaje' => 'Error en la creación de la habilidad',
                'error' => $e->getMessage(),
                'status' => 500, // Código de estado 500 para error interno del servidor
            ], 500);
        }
    }

    /**
     * Mostrar una habilidad específica por su ID.
     */
    public function show($id)
    {
        // Busca la habilidad por ID
        $habilidad = Habilidad::find($id);

        // Si no se encuentra la habilidad, retorna un mensaje de error
        if (!$habilidad) {
            return response()->json([
                'mensaje' => 'Habilidad no encontrada',
                'status' => 404 // Código de estado 404 para no encontrado
            ], 404);
        }

        // Retorna la habilidad encontrada
        $data = [
            'habilidad' => $habilidad, // La habilidad encontrada
            'status' => 200 // Código de estado 200 para éxito
        ];

        return response()->json($data, 200); // Retorna la habilidad con estado 200
    }

    /**
     * Mostrar el formulario para editar una habilidad existente.
     * Este método está vacío porque no se requiere una vista en esta API.
     */
    public function edit(Habilidad $habilidad)
    {
        //
    }

    /**
     * Actualizar una habilidad existente.
     */
    public function update(Request $request, $id)
    {
        // Busca la habilidad por ID
        $habilidad = Habilidad::find($id);

        // Si no se encuentra la habilidad, retorna un mensaje de error
        if (!$habilidad) {
            $data = [
                'mensaje' => 'Habilidad no encontrada',
                'status' => 404 // Código de estado 404 para no encontrado
            ];
            return response()->json($data, 404);
        }

        // Define las reglas de validación para los datos de entrada
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string', // Nombre es obligatorio y debe ser una cadena de texto
            'descripcion' => 'required|string' // Descripción es obligatoria y debe ser una cadena de texto
        ]);

        // Si la validación falla, retorna un mensaje de error con los detalles
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(), // Muestra los errores de validación
                'status' => 400 // Código de estado 400 para Bad Request
            ];
            return response()->json($data, 400);
        }

        // Actualiza los campos de la habilidad con los nuevos datos
        $habilidad->nombre = $request->nombre;
        $habilidad->descripcion = $request->descripcion;

        // Guarda los cambios en la base de datos
        $habilidad->save();

        $data = [
            'mensaje' => 'Habilidad actualizada exitosamente',
            'habilidad' => $habilidad, // La habilidad actualizada
            'status' => 200 // Código de estado 200 para éxito
        ];

        return response()->json($data, 200); // Retorna la habilidad actualizada
    }

    /**
     * Eliminar una habilidad específica.
     */
    public function destroy($id)
    {
        // Busca la habilidad por ID
        $habilidad = Habilidad::find($id);

        // Si no se encuentra la habilidad, retorna un mensaje de error
        if (!$habilidad) {
            $data = [
                'mensaje' => 'Habilidad no encontrada',
                'status' => 404 // Código de estado 404 para no encontrado
            ];
            return response()->json($data, 404);
        }

        // Elimina la habilidad de la base de datos
        $habilidad->delete();

        // Retorna un mensaje indicando que la habilidad fue eliminada
        $data = [
            'message' => 'Habilidad eliminada',
            'habilidad' => $habilidad, // La habilidad eliminada
            'status' => 200 // Código de estado 200 para éxito
        ];

        return response()->json($data, 200); // Retorna el mensaje de eliminación exitosa
    }
}

```

### Creación de Crontrolador de Habilidad y Pokemon

```php
<?php

namespace App\Http\Controllers;

use App\Models\habilidad_pokemon;  // Importa el modelo habilidad_pokemon
use Illuminate\Http\Request;  // Importa la clase Request

class HabilidadPokemonController extends Controller
{
    /**
     * Muestra una lista de los recursos (sin implementación en este caso).
     */
    public function index()
    {
        //
    }

    /**
     * Muestra el formulario para crear un nuevo recurso (sin implementación en este caso).
     */
    public function create()
    {
        //
    }

    /**
     * Almacena un nuevo recurso en el almacenamiento (sin implementación en este caso).
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra el recurso especificado (sin implementación en este caso).
     */
    public function show(habilidad_pokemon $habilidad_pokemon)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado (sin implementación en este caso).
     */
    public function edit(habilidad_pokemon $habilidad_pokemon)
    {
        //
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento (sin implementación en este caso).
     */
    public function update(Request $request, habilidad_pokemon $habilidad_pokemon)
    {
        //
    }

    /**
     * Elimina el recurso especificado del almacenamiento (sin implementación en este caso).
     */
    public function destroy(habilidad_pokemon $habilidad_pokemon)
    {
        //
    }
}

```

## Creación de la API

Dado que no estaremos interactuando directamente con la base de datos necesitamos mandar a lalmar cada metodo que se encientra en el controlador y esto lo haremos con el comendo de:
```bash
composer require laravel/sanctum
```
Este nos permitira instalar todas las herramientas necesarias para la api despues agregaremos. 

Despues de crear el archivo tendremos que crear las rutas con las que le aremos peticiones a la API .
 
```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\UsuarioController;

// Ruta para obtener el usuario autenticado. Utiliza el middleware 'auth:sanctum' para validar la autenticación.
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para el recurso "Pokemons"
// Muestra todos los pokemones
Route::get('/pokemons',[PokemonController::class, 'index']);
// Muestra un pokemon específico por su ID
Route::get('/pokemons/{id}',[PokemonController::class, 'show']);
// Crea un nuevo pokemon
Route::post('/pokemons',[PokemonController::class, 'store']);
// Actualiza un pokemon específico por su ID
Route::put('/pokemons/{id}',[PokemonController::class, 'update']);
// Elimina un pokemon específico por su ID
Route::delete('/pokemons/{id}',[PokemonController::class, 'destroy']);
// Busca un pokemon por nombre
Route::get('/pokemons/buscar/{nombre}',[PokemonController::class, 'buscar']);

// Rutas para el recurso "Habilidades"
// Muestra todas las habilidades
Route::get('/habilidades',[HabilidadController::class, 'index']);
// Muestra una habilidad específica por su ID
Route::get('/habilidades/{id}',[HabilidadController::class, 'show']);
// Crea una nueva habilidad
Route::post('/habilidades',[HabilidadController::class, 'store']);
// Actualiza una habilidad específica por su ID
Route::put('/habilidades/{id}',[HabilidadController::class, 'update']);
// Elimina una habilidad específica por su ID
Route::delete('/habilidades/{id}',[HabilidadController::class, 'destroy']);

// Rutas para el recurso "Usuarios"
// Muestra cuántos usuarios existen
Route::get('/usuarios/hay', [UsuarioController::class, 'cuantosHay']);
// Muestra todos los usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
// Muestra un usuario específico por su ID
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
// Crea un nuevo usuario
Route::post('/usuarios', [UsuarioController::class, 'store']);
// Actualiza un usuario específico por su ID
Route::put('/usuarios/{id}',  [UsuarioController::class, 'update']);
// Elimina un usuario específico por su ID
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
// Realiza una actualización parcial de un usuario específico por su ID
Route::patch('/usuarios/{id}', [UsuarioController::class, 'updateParcial']);
```

