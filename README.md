[[_TOC_]]
# NameHelper 

[Readme version in English](./README-EN.md)

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

#### Retornar la extension de un archivo a partir de un \<fileLocatorName\>. Nota el archivo no deberia ser un directorio pues los directorios no tienen extension se emitira un assertion en caso de pasar un directorio en lugar de un archivo 

```
NameHelper::getExtOfFile($fileLocatorName);
```

#### Retornar el nombre de un archivo o directorio sin la extension a partir de un \<fileLocatorName\> 

```
NameHelper::getFileOrDirNameWithoutExt($fileLocatorName);
```

#### Retorna el nombre de un archivo o directorio a partir de un \<fileLocatorName\> 


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
Esta libreria busca dar soporte a imagenes normales, responsive y con almacenamiento local o externo.

Para lo cual se presupone que las variaciones de una imagen responsive se agrupan en una carpeta. 

Tambien se busca facilitar el uso de convenciones: para lo cual se estandariza una para generacion de el nombres para las carpetas que almacenan las variaciones de una imagen responsive y la carpeta donde se almacenan las imagenes en laravel.

De forma que existen metodos especiales que siguen estas convenciones a los cuales se les incluye la palabra Conventional y LaravelConvetional

#### Gramatica para las url
Convenciones de notacion para la gramatica:

Los <> se utilizan para rodear un simbolo no terminal

El ::= se utiliza para reglas de produccion

Los simbolos no terminales se expresan como una cadena o caracteres normales

El siguiente grupo de pares de simbolos, se deben utilizar junto a las expresiones de la siguiente forma: el primero en cada pareja se escribe como sufijo despues de la expresion y el segundo rodea la expresion. 

El ? o [] indican que la expresion es opcional

El * o {} indica que la expresion se repite 0 o mas veces

El + indica que la expresion se repite 1 o mas veces

Si se quiere usar uno de los caracteres anteriores se debe de anteceder \ con 

De manera que la libreria utilizara la siguiente gramatica para sus urls

```<baseUrl>/<dirImage>?/<imageName>?```

Donde: 
Los metodos que contienen la palabra LaravelConvetional suelen darle el valor a
```
<baseUrl>  de "/storage/images" 
```

Donde:
Los metodos que contienen la palabra Convetional suelen darle el valor a
```
<dirImage> de el resultado de NameHelper::transformNameToUrlName($imageName)
```

Notese que la diferencia entre una url externa he interna se basa en el valor de ```<baseUrl>```

##### Imagen no responsiva local para laravel

```
<nonResponsiveLocalUrl>::= <baseUrl>/<dirImage>?/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local responsiva para laravel

```
<ResponsiveLocalUrl>::= <baseUrl>/<dirImage>
```
Como por ejemplo 
```/storage/images/imagen/```

##### Imagen no responsiva local o externa convencional
```
<ConventionalNonResponsiveUrl>::= <baseUrl>/<dirImage>/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local o externa responsiva convencional

```
<ConventionalResponsiveUrl>::= <baseUrl>/<dirImage>
```
Como por ejemplo 
```/storage/images/imagen/```


##### Imagen no responsiva local o externa
```
<nonResponsiveUrl>::= <baseUrl>/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


##### Imagen local o externa responsiva

```
<ResponsiveUrl>::= <baseUrl>
```
Como por ejemplo 
```/storage/images/imagen/```


### Ejemplos de uso

#### Almacenar la url de las imagenes en la bd:

Para almacenar una imagen responsive en la base de datos de una aplicacion laravel  se recomienda usar 

```
NameHelper::generateLaravelConvetionalResponsiveImageDirUrl($imageName)
```

Lo que generara una url de imagen como 
```/storage/images/imagen/```

Para el caso de imagenes no responsivas

```
NameHelper::generateLaravelConvetionalImageUrl($imageName)
```

Lo que generara una url de imagen como 
```/storage/images/imagen/imagen.jpg```

#### Recuperar imagenes en la bd:

Notese que las imagenes responsives estan almacenadas en un directorio

De manera que los nombres para cada una de las imagenes responsive deben obtenerse por medio de

```
NameHelper::generateResponsiveImageUrls($imageName, $baseUrl);
```

o 

```
NameHelper::generateConvetionalResponsiveImageUrls($imageName,$baseUrl)
```

O 
```
NameHelper::generateLaravelConvetionalResponsiveImageUrls($imageName)
```
#### Mas ejemplos de uso
```
Probando la salida de los metodos con

$fileLocator='/imagen.png'
$baseUrl='/cachapa/'

NameHelper::generateLaravelConvetionalResponsiveImageUrls('/imagen.png')=[
/storage/images/imagen/imagen.png
/storage/images/imagen/360-imagen.png
/storage/images/imagen/720-imagen.png
/storage/images/imagen/1080-imagen.png
/storage/images/imagen/1440-imagen.png
/storage/images/imagen/1800-imagen.png
/storage/images/imagen/2160-imagen.png
/storage/images/imagen/2880-imagen.png
/storage/images/imagen/3600-imagen.png
/storage/images/imagen/4320-imagen.png
]
NameHelper::generateLaravelConvetionalResponsiveImageDirUrl('/imagen.png')=/storage/images/imagen
NameHelper::generateLaravelConvetionalImageUrl('/imagen.png')=/storage/images/imagen/imagen.png
NameHelper::generateLaravelConvetionalImagePath('/imagen.png')=/images/imagen/imagen.png
NameHelper::generateConvetionalResponsiveImageUrls('/imagen.png','/cachapa/')=[
/cachapa/imagen/imagen.png
/cachapa/imagen/360-imagen.png
/cachapa/imagen/720-imagen.png
/cachapa/imagen/1080-imagen.png
/cachapa/imagen/1440-imagen.png
/cachapa/imagen/1800-imagen.png
/cachapa/imagen/2160-imagen.png
/cachapa/imagen/2880-imagen.png
/cachapa/imagen/3600-imagen.png
/cachapa/imagen/4320-imagen.png
]
NameHelper::generateConvetionalImageUrl('/imagen.png','/cachapa/')=/cachapa/imagen/imagen.png
NameHelper::generateResponsiveImageUrls('/imagen.png','/cachapa/')=[
/cachapa/imagen.png
/cachapa/360-imagen.png
/cachapa/720-imagen.png
/cachapa/1080-imagen.png
/cachapa/1440-imagen.png
/cachapa/1800-imagen.png
/cachapa/2160-imagen.png
/cachapa/2880-imagen.png
/cachapa/3600-imagen.png
/cachapa/4320-imagen.png
]
NameHelper::generateConvetionalImageDirUrl('/imagen.png','/cachapa/')=/cachapa/imagen
NameHelper::generateImageUrl('/imagen.png','/cachapa/')=/cachapa/imagen.png
NameHelper::generateResponsiveImageNames('/imagen.png')=[
/imagen.png
360-/imagen.png
720-/imagen.png
1080-/imagen.png
1440-/imagen.png
1800-/imagen.png
2160-/imagen.png
2880-/imagen.png
3600-/imagen.png
4320-/imagen.png
]
NameHelper::transformNameToUrlName('/imagen.png')=imagen.png
NameHelper::getFileOrDirName('/imagen.png')=imagen.png
NameHelper::getFileOrDirNameWithoutExt('/imagen.png')=imagen
NameHelper::getExtOfFile('/imagen.png')=png

Probando la salida de los metodos con

$fileLocator='/imagen/'
$baseUrl='/cachapa/'

$imageName='imagen' de generateResponsiveImageNames pareciera no tener una extension
NameHelper::generateLaravelConvetionalResponsiveImageDirUrl('/imagen/')=/storage/images/imagen
NameHelper::generateLaravelConvetionalImageUrl('/imagen/')=/storage/images/imagen/imagen
NameHelper::generateLaravelConvetionalImagePath('/imagen/')=/images/imagen/imagen
$imageName='imagen' de generateResponsiveImageNames pareciera no tener una extension
NameHelper::generateConvetionalImageUrl('/imagen/','/cachapa/')=/cachapa/imagen/imagen
$imageName='imagen' de generateResponsiveImageNames pareciera no tener una extension
NameHelper::generateConvetionalImageDirUrl('/imagen/','/cachapa/')=/cachapa/imagen
NameHelper::generateImageUrl('/imagen/','/cachapa/')=/cachapa/imagen
$imageName='/imagen/' de generateResponsiveImageNames pareciera no tener una extension
NameHelper::transformNameToUrlName('/imagen/')=imagen
NameHelper::getFileOrDirName('/imagen/')=imagen
NameHelper::getFileOrDirNameWithoutExt('/imagen/')=imagen
$fileLocatorName='/imagen/' de getExtOfFile pareciera no tener una extension
```
### Make a donation. Your contribution will make a difference.
[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/israeldavidvm)
[![Paypal](https://img.shields.io/badge/Paypal-@israeldavidvm-0077B5?style=for-the-badge&logo=paypal&logoColor=white&labelColor=101010)](https://paypal.me/israeldavidvm)
[![Binance](https://img.shields.io/badge/Binance_ID-809179020-101010?style=for-the-badge&logo=binancel&logoColor=white&labelColor=101010)](https://www.binance.com/activity/referral-entry/CPA?ref=CPA_004ZGH9EIS)

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
