# K O T O B A

## ¿ Qué es Kotoba ?

Kotoba es una app que te permite var listas de vocabulario de distintos idiomas, crear tus propias listas de vocabularios y tus flashcards. Puedes repasar tus flashcards de vocabulario o jugar a varios juegos para ayudarte a memorizar el vocabulario.

## Instalación

Kotoba es un app que utiliza Laravel 11 y Inertia von Vue.js.

Para poner en marcha la app, una vez clonado el repositorio y hacer cd en la carpeta principal del proyecto, se deben seguir los siguientes pasos:

-   1. composer install
-   2. npm install
-   3. npm run dev
-   4. cp .env.example .env y ajustar los datos de la base de datos, además de crear una base de datos vacía (por ejemplo, en MySQL) con el nombre que elijas en el .env
-   5. generar una key con php artisan key:generate
-   6. migrar la base de datos con php artisan migrate --seed
-   7. php artisan serve en una segunda terminal
-   8. el proyecto estará disponible en http://localhost:8000/
