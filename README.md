# NameHelper 

[Readme version in English](./README-EN.md)

## ¡Maneja nombres de archivos, imagenes responsive, URLs y más con facilidad!

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**  *generated with [DocToc](https://github.com/thlorenz/doctoc)*

- [NameHelper](#namehelper)
  - [¡Maneja nombres de archivos, imagenes responsive, URLs y más con facilidad!](#%C2%A1maneja-nombres-de-archivos-imagenes-responsive-urls-y-m%C3%A1s-con-facilidad)
  - [Licencia](#licencia)
  - [Caracteristicas ¿Qué te ofrece NameHelper?](#caracteristicas-%C2%BFqu%C3%A9-te-ofrece-namehelper)
  - [Documentacion](#documentacion)
    - [Manejo de nombres de archivo, ruta en el sistema de archivos linux o url](#manejo-de-nombres-de-archivo-ruta-en-el-sistema-de-archivos-linux-o-url)
      - [Retornar la extension de un archivo a partir de un \<fileLocatorName\>. Nota el archivo no deberia ser un directorio pues los directorios no tienen extension se emitira un assertion en caso de pasar un directorio en lugar de un archivo](#retornar-la-extension-de-un-archivo-a-partir-de-un-%5Cfilelocatorname%5C-nota-el-archivo-no-deberia-ser-un-directorio-pues-los-directorios-no-tienen-extension-se-emitira-un-assertion-en-caso-de-pasar-un-directorio-en-lugar-de-un-archivo)
      - [Retornar el nombre de un archivo o directorio sin la extension a partir de un \<fileLocatorName\>](#retornar-el-nombre-de-un-archivo-o-directorio-sin-la-extension-a-partir-de-un-%5Cfilelocatorname%5C)
      - [Retorna el nombre de un archivo o directorio a partir de un \<fileLocatorName\>](#retorna-el-nombre-de-un-archivo-o-directorio-a-partir-de-un-%5Cfilelocatorname%5C)
    - [Conversor de nombres a nombres de url](#conversor-de-nombres-a-nombres-de-url)
    - [Generacion de nombres para Images responsivas](#generacion-de-nombres-para-images-responsivas)
    - [Generacion de urls para Images](#generacion-de-urls-para-images)
      - [Gramatica para las url](#gramatica-para-las-url)
        - [Convenciones de notacion para la gramatica:](#convenciones-de-notacion-para-la-gramatica)
        - [Gramatica de las urls](#gramatica-de-las-urls)
    - [Generacion de rutas para Imagenes Responsivas, no responsivas locales y externas](#generacion-de-rutas-para-imagenes-responsivas-no-responsivas-locales-y-externas)
      - [Ruta a Imagen no responsiva local o externa](#ruta-a-imagen-no-responsiva-local-o-externa)
      - [Rutas a imagenes locales o externas responsivas](#rutas-a-imagenes-locales-o-externas-responsivas)
      - [ConventionalDir](#conventionaldir)
      - [Externa o interna](#externa-o-interna)
    - [Almacenar las rutas a un imagen en la base de datos:](#almacenar-las-rutas-a-un-imagen-en-la-base-de-datos)
    - [Rutas para ser almacenadas en BD de recursos como imagenes o directorios locales siguiendo las convenciones de laravel:](#rutas-para-ser-almacenadas-en-bd-de-recursos-como-imagenes-o-directorios-locales-siguiendo-las-convenciones-de-laravel)
    - [Rutas para trabajar con el Storage de recursos como imagenes o directorios locales siguiendo las convenciones de laravel:](#rutas-para-trabajar-con-el-storage-de-recursos-como-imagenes-o-directorios-locales-siguiendo-las-convenciones-de-laravel)
    - [Ejemplos de uso](#ejemplos-de-uso)
      - [Almacenar la ruta base de una imagen en la base de datos](#almacenar-la-ruta-base-de-una-imagen-en-la-base-de-datos)
        - [Usando la convencion de Laravel y la convencion de directoros con el mismo nombre de la imagen para imagenes locales](#usando-la-convencion-de-laravel-y-la-convencion-de-directoros-con-el-mismo-nombre-de-la-imagen-para-imagenes-locales)
        - [Usando solo la convencion de directoros con el mismo nombre de la imagen](#usando-solo-la-convencion-de-directoros-con-el-mismo-nombre-de-la-imagen)
      - [Recuperar imagenes en la bd:](#recuperar-imagenes-en-la-bd)
      - [Mas ejemplos de uso](#mas-ejemplos-de-uso)
    - [Make a donation. Your contribution will make a difference.](#make-a-donation-your-contribution-will-make-a-difference)
    - [Find me on:](#find-me-on)
  - [Technologies used / Tecnologias usadas](#technologies-used--tecnologias-usadas)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->


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

```NameHelper::transformNameToRouteName($name)```

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

#### Gramatica para las url
##### Convenciones de notacion para la gramatica:

Los <> se utilizan para rodear un simbolo no terminal

El ::= se utiliza para reglas de produccion

Los simbolos no terminales se expresan como una cadena o caracteres normales

El siguiente grupo de pares de simbolos, se deben utilizar junto a las expresiones de la siguiente forma: el primero en cada pareja se escribe como sufijo despues de la expresion y el segundo rodea la expresion. 

El ? o [] indican que la expresion es opcional

El * o {} indica que la expresion se repite 0 o mas veces

El + indica que la expresion se repite 1 o mas veces

Si se quiere usar uno de los caracteres anteriores se debe de anteceder \ con 

##### Gramatica de las urls

De manera que la libreria utilizara la siguiente gramatica para sus urls

```<baseUrl>(/<laravelConvention>)?/<dirImage>(/<imageName>)? | <baseUrl>(/<laravelConvention>)?/<imageName>```

Donde: 
Los metodos que contienen InLaravelConvetionalLink suelen darle el valor a
```
(/<laravelConvention>)?  "/storage/images" 
```
Y los metodos que contienen InLaravelConvetionalStorage suelen darle el valor a
```
(/<laravelConvention>)?  "/images" 
```

Donde:
Los metodos que contienen InConvetionalDir suelen darle el valor a
```
<dirImage> de el resultado de NameHelper::transformNameToRouteName($imageName)
```

Notese que la diferencia entre una url externa he interna se basa en el valor de ```<baseUrl>```

### Generacion de rutas para Imagenes Responsivas, no responsivas locales y externas

La diferencia entre una imagen responsiva y otro que no lo es radica en que para la imagen responsiva se utilizaran conjuntos de url una por cada variacion de la imagen y en la otra no. De manera que tendran una forma como la siguiente


#### Ruta a Imagen no responsiva local o externa 
```
<NonResponsiveImageUrl>::= <baseUrl>(/<laravelConvention>)?(/<dirImage>)?/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/imagen.jpg```


#### Rutas a imagenes locales o externas responsivas

Para este caso se generara un conjunto de rutas 

```
<ResponsiveVariationImageUrl>::= <baseUrl>(/<laravelConvention>)?(/<dirImage>)?/<imageName>
```

Como por ejemplo 

```/storage/images/imagen/360-image.jpg```

#### ConventionalDir
Donde:
Los metodos que contienen InConvetionalDir suelen darle el valor a
```
<dirImage> de el resultado de NameHelper::transformNameToRouteName($imageName)
```

#### Externa o interna

Notese que la diferencia entre una url externa he interna se basa en el valor de ```<baseUrl>```

### Almacenar las rutas a un imagen en la base de datos:

Con el objetivo de permitir que el almacenamiento de las imagenes sea lo mas flexible posible, se hara lo siguiente.

Se guardara la ruta al directorio de la carpeta que la contiene (solo la carpeta sin el nombre de la imagen) y el nombre de la imagen en la base de datos.

De forma que se pueda tomar esa ruta base, el nombre de la imagen y generar una ruta o conjunto de rutas dependiendo de si la imagen es responsive o no.

### Rutas para ser almacenadas en BD de recursos como imagenes o directorios locales siguiendo las convenciones de laravel:

A la hora de almacenar la url de nuestros recursos (como imagenes imagenes, directorios, etc), deberiamos considerar almacenar la url que nos permite acceder al recurso de forma publica, en la configuracion por defecto de laravel hay una ruta contemplada para ello.

De modo que desarrollamos una serie de metodos que terminan en InLaravelConvetionalLink que generara una url hacia dichas rutas.

### Rutas para trabajar con el Storage de recursos como imagenes o directorios locales siguiendo las convenciones de laravel:

Al igual que existe una convencion para las rutas hacia los recursos que son accesibles de forma publica existe una convencion para las rutas reales hacia los recursos en la configuracion por defecto de laravel.


### Ejemplos de uso 

#### Almacenar la ruta base de una imagen en la base de datos

Como dijimos anteriormente uno de los enfoques que se pueden tomar para maximizar la flexibilidad a la hora de trabajar con imagenes 

Es el de solo almacenar la ruta en la que se almacena la imagen

##### Usando la convencion de Laravel y la convencion de directoros con el mismo nombre de la imagen para imagenes locales

Que para el caso en que queramos usar la convencion de laravel debera ser la que es accesible de forma publica ruta que puede ser obtenida por medio del metodo

```
NameHelper::generateRouteToConvetionalDirInLaravelConvetionalLink($imageName)
```

Lo que generara una url de imagen como 
```/storage/images/imagen-perro/```

Notese que dicho metodo anexa una carpeta al final de la ruta que usa laravel por convencion

##### Usando solo la convencion de directoros con el mismo nombre de la imagen

Que puede ser obtenida por el metodo, notese que dependiendo de si la base url es externa o no se hablara de imagen externa o interna

```
NameHelper::generateRouteToConvetionalImageDirInBaseRoute($imageName,$baseUrl=null)

```

```
<ResponsiveUrl>::= <baseUrl>/<dirImage>
```
Como por ejemplo 
```/storage/images/imagen/```


#### Recuperar imagenes en la bd:

En caso de haber almacenado la ruta completa hacia la carpeta que contiene el recurso en la base de datos como recomendamos

Los nombres de las imagenes podran ser recuperados de la siguiete forma

```
NameHelper::generateRoutesToResponsiveImagesInBaseRoute($imageName, $baseUrl);
```
cuando la imagen es responsiva o 

```
NameHelper::generateRouteToImageInBaseRoute($imageName,$baseUrl=null)
```

cuando la imagen no es responsiva.

En caso de no haber almacenado la ruta completa hacia la carpeta que contiene el recurso en la base de datos como recomendamos

```
NameHelper::generateRoutesToResponsiveImagesInConvetionalDirInBaseRoute($imageName,$baseUrl)
```

O 
```
NameHelper::generateRoutesToResponsiveImagesInConvetionalDirInLaravelConvetionalLink($imageName)
```
que añadiran la informacion necesaria



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
