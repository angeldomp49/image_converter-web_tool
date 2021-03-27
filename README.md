ya tenemos la funcion que nos devuelve un array de los nombres de archivos de directorios y subdirectorios, esto con sus rutas absolutas,
también modificamos la clase Parser de nanokit, falta recorrer el arreglo y crear una copia en webp de cada archivo en la carpeta de salida, tambi+en falta renombrar la clase nameparser y organizar el código además de integrar los cambios hecho en nanokit


vamos a cambiar las capas de ejecución, el convertidor va a llamar al contenedor de archivo de imágenes y va a pedir la carpeta de entrada y la de salida, de manera que cree el contenedor y exporte las imágenes en su código.


start
    php -S localhost:8000 -t public