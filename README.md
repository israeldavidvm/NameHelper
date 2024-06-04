
# NameHelper 
## Manage file names, responsive images, URLs and more with ease!

The NameHelper repository offers you a complete library to simplify working with names in your application.

The NameHelper class provides a collection of utility functions for working with image names, particularly in the context of generating responsive image URLs. It also includes auxiliary functions for manipulating file names and some special functions that allow the generation of urls specially designed for Laravel.

I usually use this package with other packages created by me such as ImageCompressor and SmartImage.

## License

This Code is licensed under the general public license of GNU version 3.0 or posterior (LGPLV3+). You can find a complete copy of the license at https://www.gnu.org/licenses/lgPl-3.0-standalone.htmlalone.html0-standalone.html

## CHARACTERISTICS What does Namehelper offer?

- Transforms names into URLs compatible formats:

    - Convert tiny names (UTF-8).
    - Replaces low spaces and scripts with scripts.
    - Replace special characters with alphanumeric equivalents (for example, "a" becomes "a").
    - Eliminate punctuation marks and symbols not suitable for URLs.    
 - It generates variations of responsive names for images:

 - Create names of images with most recommended sizes that should have a responsive image (for example, "360-Imagen.jpg").

 - Generates URLs for local and external, responsive and non -responsive images.

 - Create URLS optimized for the Laravel framework.

 - Facilitates work with the name of files, extensions or directories

 ## Documentation 

NameHelper provides a collection of useful functions for manipulating file names, URLs, and generating URLs for images.

### Handling file names, path in linux file system or url

The library also provides a number of ways to work with file names present in what we call a $fileLocatorName which is nothing more than a string that refers to a file name, path in the file system in Linux or url.

So we can

#### Return the extension of a file from a <fileLocatorName>. Note, the file should not be a directory since directories do not have extensions, an assertion will be issued if a directory is passed instead of a file.

```
NameHelper::getExtOfFile($fileLocatorName);
```

#### Return the name of a file or directory without the extension from a <fileLocatorName>

```
NameHelper::getFileOrDirNameWithoutExt($fileLocatorName);
```

#### Returns the name of a file or directory from a <fileLocatorName>


```
NameHelper::getFileOrDirName($fileLocatorName);
```

### Name to url name converter

One of the things this library offers is a simple way to convert names to url names.

Suppose you want to use the name of a blog post as an identifier through the url.

So to access the post titled "hello world" you access the path
www.miblog.com/blog/hello-world

Here we can use the function

```NameHelper::transformNameToUrlName($name)```

Which when passed as a parameter
$name="hello world" will return hello-world

### Name generation for responsive images

If we want to generate a list of names for responsive images, we execute the method

```NameHelper::generateResponsiveImageNames($imageName);```

which for a parameter $imageName=image.jpg
will return an associative array
```
[
 0 => "image.jpg",
 360 => "360-image.jpg",
 720 => "720-image.jpg",
 1080 => "1080-image.jpg",
 1440 => "1440-image.jpg",
 1800 => "1800-image.jpg",
 2160 => "2160-image.jpg",
 2880 => "2880-image.jpg",
 3600 => "3600-image.jpg",
 4320 => "4320-image.jpg",
];
```

### Generation of URLs for Images
This library seeks to support normal, responsive images, with local or external storage

#### Grammar for urls

So the library will use the following generation of URLs by convention.

##### Local non-responsive image for laravel
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Responsive local image for laravel

```
<ResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>
```
For example
```/storage/images/image/```

Where:
Methods that contain the word LaravelConvectional usually give the value to
```
<localBaseUrl> from "/storage/images"
```

Where:
Methods that contain the word Conventional usually give the value to
```
<dirImage> from the result of NameHelper::transformNameToUrlName($imageName)
```
##### Conventional local non-responsive image
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Conventional Responsive Local Image

```
<ResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>
```
For example
```/storage/images/image/```


Where:
Methods that contain the word Conventional usually give the value to
```
<dirImage> from the result of NameHelper::transformNameToUrlName($imageName)
```

##### Local non-responsive image
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Responsive local image

```
<ResponsiveLocalUrl>::= <localBaseUrl>
```
For example
```/storage/images/image/```

##### External image not responsive
```
<nonResponsiveExternalUrl>::= <externalBaseUrl>/<dirImage>/<imageName>
```

##### Responsive external image
```
<ResponsiveExternalUrl>::= <externalBaseUrl>/<dirImage>
```

## Usage examples

#### Store the url of the images in the database:

To store a responsive image in the database of a Laravel application, it is recommended to use

```
NameHelper::generateLaravelConvectionResponsiveImageDirUrl($imageName)
```

Which will generate an image url like
```/storage/images/image/```

```
NameHelper::generateLaravelConvectionNonResponsiveImageUrl($imageName)
```

Which will generate an image url like
```/storage/images/imagen/imagen.jpg```

#### Recover images in the database:

Note that responsive images are stored in a directory

So the names for each of the responsive images must be obtained through

```
NameHelper::generateResponsiveImageUrls($imageName, $baseUrl);
```

Or through simpler commands like
```
NameHelper::generateLaravelConvectionResponsiveImageUrls($imageName)
```

either

```
NameHelper::generateConvectionResponsiveImageUrls($imageName)
```

## ¡Maneja nombres de archivos, imagenes responsive, URLs y más con facilidad!

El repositorio NameHelper te ofrece una librería completa para simplificar el trabajo con nombres en tu aplicación.

La clase NameHelper proporciona una colección de funciones de utilidad para trabajar con nombres de imágenes, particularmente en el contexto de generar URL de imágenes responsivas. También incluye funciones auxiliares para la manipulación de nombres de archivos y algunas funciones especiales que permiten la generacion de urls especialmente diseñadas para laravel

Este paquete lo suelo usar con otro paquetes creados por mi como ImageCompressor y SmartImage. 

## Licencia

Este código tiene licencia bajo la licencia pública general de GNU versión 3.0 o posterior (LGPLV3+). Puede encontrar una copia completa de la licencia en https://www.gnu.org/licenses/lgpl-3.0-standalone.htmlalone.html0-standalone.html


## Caracteristicas ¿Qué te ofrece NameHelper?

- Transforma nombres en formatos compatibles con URLs:

    - Convierte nombres a minúsculas (UTF-8).
    - Reemplaza espacios y guiones bajos por guiones.
    - Sustituye caracteres especiales por equivalentes alfanuméricos (por ejemplo, "á" se convierte en "a").
    - Elimina signos de puntuación y símbolos no aptos para URLs.

- Genera variaciones de nombres responsivos para imágenes:

- Crea nombres de imágenes con la mayoria de los tamaños recomendados que deberia de tener una imagen responsive (por ejemplo, "360-imagen.jpg").

- Genera URLs para imágenes locales y externas, responsivas y no responsivas.

- Crea URLs optimizadas para el framework Laravel.

- Facilita el trabajo con el nombre de archivos, extensiones o directorios

## Documentacion

NameHelper proporciona una colección de funciones útiles para manipular nombres de archivos, URLs y generar URLs para imágenes.

### Manejo de nombres de archivo, ruta en el sistema de archivos linux o url

La libreria tambien proporciona una serie de formas de trabajar con los nombres de archivos presentes en lo que nosotros llamamos un $fileLocatorName que no es mas que una cadena que hace referencia a un nombre de archivo, ruta en el sistema de archivos en linux o url

De manera que podemos

#### Retornar la extension de un archivo a partir de un <fileLocatorName>. Nota el archivo no deberia ser un directorio pues los directorios no tienen extension se emitira un assertion en caso de pasar un directorio en lugar de un archivo 

```
NameHelper::getExtOfFile($fileLocatorName);
```

#### Retornar el nombre de un archivo o directorio sin la extension a partir de un <fileLocatorName> 

```
NameHelper::getFileOrDirNameWithoutExt($fileLocatorName);
```

#### Retorna el nombre de un archivo o directorio a partir de un <fileLocatorName> 


```
NameHelper::getFileOrDirName($fileLocatorName);
```

### Conversor de nombres a nombres de url

Una de las cosas que ofrece esta libreria es una manera sencilla de pasar nombres a nombres de url.

Supongase que se quiere usar el nombre de los post de un blog como UN identificador por medio de la url.

De forma que para acceder al post titulado "hello world" se acceda a la ruta 
www.miblog.com/blog/hello-world

Aqui podemos usar la funcion 

```NameHelper::transformNameToUrlName($name)```

La cual al pasar como parametro
$name="hello world" retornara hello-world

### Generacion de nombres para Images responsivas

Si queremos generar una lista de nombres para imagenes responsivas ejecutamos el metodo

```NameHelper::generateResponsiveImageNames($imageName);```

el cual para un parametro $imageName=image.jpg
retornara un array asociativo
```
[
    0 => "image.jpg",  
    360 => "360-image.jpg",
    720 => "720-image.jpg",
    1080 => "1080-image.jpg",
    1440 => "1440-image.jpg",
    1800 => "1800-image.jpg",
    2160 => "2160-image.jpg",
    2880 => "2880-image.jpg",
    3600 => "3600-image.jpg",
    4320 => "4320-image.jpg",
];
```

### Generacion de urls para Images
Esta libreria busca dar soporte a imagenes normales, responsive, con almacenamiento local o externo

#### Gramatica para las url

De manera que la libreria utilizara por convencion la siguiente generacion de URLs

##### Imagen no responsiva local para laravel
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local responsiva para laravel

```
<ResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>
```
Como por ejemplo 
```/storage/images/imagen/```

Donde: 
Los metodos que contienen la palabra LaravelConvetional suelen darle el valor a
```
<localBaseUrl>  de "/storage/images" 
```

Donde:
Los metodos que contienen la palabra Convetional suelen darle el valor a
```
<dirImage> de el resultado de NameHelper::transformNameToUrlName($imageName)
```
##### Imagen no responsiva local convencional
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local responsiva convencional

```
<ResponsiveLocalUrl>::= <localBaseUrl>/<dirImage>
```
Como por ejemplo 
```/storage/images/imagen/```


Donde:
Los metodos que contienen la palabra Convetional suelen darle el valor a
```
<dirImage> de el resultado de NameHelper::transformNameToUrlName($imageName)
```

##### Imagen no responsiva local
```
<nonResponsiveLocalUrl>::= <localBaseUrl>/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local responsiva

```
<ResponsiveLocalUrl>::= <localBaseUrl>
```
Como por ejemplo 
```/storage/images/imagen/```

##### Imagen externa no responsiva
```
<nonResponsiveExternalUrl>::= <externalBaseUrl>/<dirImage>/<imageName>
```

##### Imagen externa responsiva
```
<ResponsiveExternalUrl>::= <externalBaseUrl>/<dirImage>
```

## Ejemplos de uso

#### Almacenar la url de las imagenes en la bd:

Para almacenar una imagen responsive en la base de datos de una aplicacion laravel  se recomienda usar 

```
NameHelper::generateLaravelConvetionalResponsiveImageDirUrl($imageName)
```

Lo que generara una url de imagen como 
```/storage/images/imagen/```

```
NameHelper::generateLaravelConvetionalNonResponsiveImageUrl($imageName)
```

Lo que generara una url de imagen como 
```/storage/images/imagen/imagen.jpg```

#### Recuperar imagenes en la bd:

Notese que las imagenes responsives estan almacenadas en un directorio

De manera que los nombres para cada una de las imagenes responsive deben obtenerse por medio de

```
NameHelper::generateResponsiveImageUrls($imageName, $baseUrl);
```

O por medio de comandos mas sencillos como 
```
NameHelper::generateLaravelConvetionalResponsiveImageUrls($imageName)
```

o 

```
NameHelper::generateConvetionalResponsiveImageUrls($imageName)
```

### Find me on:
[![GITHUB](https://img.shields.io/badge/Github-israeldavidvm-gray?style=for-the-badge&logo=github&logoColor=white&labelColor=101010)](https://github.com/israeldavidvm)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-israeldavidvm-0077B5?style=for-the-badge&logo=linkedin&logoColor=white&labelColor=101010)](https://www.linkedin.com/in/israeldavidvm/)
[![Twitter](https://img.shields.io/badge/Twitter-@israeldavidvm-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white&labelColor=101010)](https://twitter.com/israeldavidvm)
[![Facebook](https://img.shields.io/badge/Facebook-israeldavidvm-1877F2?style=for-the-badge&logo=facebook&logoColor=white&labelColor=101010)](https://www.facebook.com/israeldavidvm)
[![Instagram](https://img.shields.io/badge/Instagram-@israeldavidvmv-gray?style=for-the-badge&logo=instagram&logoColor=white&labelColor=101010)](https://www.instagram.com/israeldavidvm/)
[![TikTok](https://img.shields.io/badge/TikTok-@israeldavidvm-E4405F?style=for-the-badge&logo=tiktok&logoColor=white&labelColor=101010)](https://www.tiktok.com/@israeldavidvm)
[![YouTube](https://img.shields.io/badge/YouTube-@israeldavidvm-FF0000?style=for-the-badge&logo=youtube&logoColor=white&labelColor=101010)](https://www.youtube.com/channel/UCmZLFpEPNdwpJOhal0wry7A)

## Technologies used / Tecnologias usadas

[![PHP](https://img.shields.io/badge/php-blue?logo=php&style=for-the-badge&logoColor=blue&labelColor=gray)]() 