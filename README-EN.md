# NameHelper

[Readme version in English](./README-EN.md)

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**  *generated with [DocToc](https://github.com/thlorenz/doctoc)*

- [NameHelper](#namehelper)
  - [Manage file names, responsive images, URLs and more with ease!](#manage-file-names-responsive-images-urls-and-more-with-ease)
  - [License](#license)
  - [Features What does NameHelper offer you?](#features-what-does-namehelper-offer-you)
  - [Documentation](#documentation)
    - [Handling file names, path in linux file system or url](#handling-file-names-path-in-linux-file-system-or-url)
      - [Return the extension of a file from a \<fileLocatorName\>. Note, the file should not be a directory since directories do not have extensions, an assertion will be issued if a directory is passed instead of a file.](#return-the-extension-of-a-file-from-a-%5Cfilelocatorname%5C-note-the-file-should-not-be-a-directory-since-directories-do-not-have-extensions-an-assertion-will-be-issued-if-a-directory-is-passed-instead-of-a-file)
      - [Return the name of a file or directory without the extension from a \<fileLocatorName\>](#return-the-name-of-a-file-or-directory-without-the-extension-from-a-%5Cfilelocatorname%5C)
      - [Returns the name of a file or directory from a \<fileLocatorName\>](#returns-the-name-of-a-file-or-directory-from-a-%5Cfilelocatorname%5C)
    - [Name to url name converter](#name-to-url-name-converter)
    - [Name generator for responsive Images](#name-generator-for-responsive-images)
    - [Generation of URLs for Images](#generation-of-urls-for-images)
      - [Grammar for urls](#grammar-for-urls)
        - [Notation conventions for grammar:](#notation-conventions-for-grammar)
        - [URL grammar](#url-grammar)
    - [Generation of routes for Responsive, non-responsive local and external Images](#generation-of-routes-for-responsive-non-responsive-local-and-external-images)
      - [Path to local or external non-responsive image](#path-to-local-or-external-non-responsive-image)
      - [Routes to local or external responsive images](#routes-to-local-or-external-responsive-images)
      - [ConventionalDir](#conventionaldir)
      - [External or internal](#external-or-internal)
    - [Store the paths to an image in the database:](#store-the-paths-to-an-image-in-the-database)
    - [Routes to be stored in the database of resources such as images or local directories following Laravel conventions:](#routes-to-be-stored-in-the-database-of-resources-such-as-images-or-local-directories-following-laravel-conventions)
    - [Routes to work with the Storage of resources such as images or local directories following Laravel conventions:](#routes-to-work-with-the-storage-of-resources-such-as-images-or-local-directories-following-laravel-conventions)
    - [Examples of use](#examples-of-use)
      - [Store the base path of an image in the database](#store-the-base-path-of-an-image-in-the-database)
        - [Using Laravel convention and directors convention with the same image name for local images](#using-laravel-convention-and-directors-convention-with-the-same-image-name-for-local-images)
        - [Using only the directory convention with the same name as the image](#using-only-the-directory-convention-with-the-same-name-as-the-image)
      - [Recover images in the database:](#recover-images-in-the-database)
      - [More usage examples](#more-usage-examples)
    - [Make a donation. Your contribution will make a difference.](#make-a-donation-your-contribution-will-make-a-difference)
    - [Find me on:](#find-me-on)
  - [Technologies used / Used technologies](#technologies-used--used-technologies)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->


## Manage file names, responsive images, URLs and more with ease!

The NameHelper repository offers you a complete library to simplify working with names in your application.

The NameHelper class provides a collection of utility functions for working with image names, particularly in the context of generating responsive image URLs. It also includes auxiliary functions for manipulating file names and some special functions that allow the generation of urls specially designed for Laravel.

I usually use this package with other packages created by me such as ImageCompressor and SmartImage.

## License

This code is licensed under the GNU General Public License version 3.0 or later (LGPLV3+). A full copy of the license can be found at https://www.gnu.org/licenses/lgpl-3.0-standalone.htmlalone.html0-standalone.html

## Features What does NameHelper offer you?

- Transform names into formats compatible with URLs:

- Convert names to lowercase (UTF-8).
- Replace spaces and underscores with hyphens.
- Replaces special characters with alphanumeric equivalents (for example, "á" becomes "a").
- Remove punctuation marks and symbols not suitable for URLs.

- Generate variations of responsive names for images:

- Create image names with most of the recommended sizes that a responsive image should have (for example, "360-image.jpg").

- Generate URLs for local and external images, responsive and non-responsive.

- Create URLs optimized for the Laravel framework.

- Makes it easier to work with file names, extensions or directories

## Documentation

NameHelper provides a collection of useful functions for manipulating file names, URLs, and generating URLs for images.

### Handling file names, path in linux file system or url

The library also provides a number of ways to work with file names present in what we call a $fileLocatorName which is nothing more than a string that refers to a file name, path in the file system in Linux or url.

So we can

#### Return the extension of a file from a \<fileLocatorName\>. Note, the file should not be a directory since directories do not have extensions, an assertion will be issued if a directory is passed instead of a file.

```
NameHelper::getExtOfFile($fileLocatorName);
```

#### Return the name of a file or directory without the extension from a \<fileLocatorName\>

```
NameHelper::getFileOrDirNameWithoutExt($fileLocatorName);
```

#### Returns the name of a file or directory from a \<fileLocatorName\>


```
NameHelper::getFileOrDirName($fileLocatorName);
```

### Name to url name converter

One of the things this library offers is a simple way to convert names to url names.

Suppose you want to use the name of a blog post as an identifier through the url.

So to access the post titled "hello world" you access the path
www.miblog.com/blog/hello-world

Here we can use the function

```NameHelper::transformNameToRouteName($name)```

Which when passed as a parameter
$name="hello world" will return hello-world

### Name generator for responsive Images

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
This library seeks to support normal, responsive images with local or external storage.

For which it is assumed that the variations of a responsive image are grouped in a folder.

It also seeks to facilitate the use of conventions: for which a name generation is standardized for the folders that store the variations of a responsive image and the folder where the images are stored in Laravel.

#### Grammar for urls
##### Notation conventions for grammar:

The <> are used to surround a non-terminal symbol

The ::= is used for production rules

Non-terminal symbols are expressed as a string or normal characters

The following group of pairs of symbols should be used together with expressions in the following way: the first in each pair is written as a suffix after the expression and the second surrounds the expression.

He ? or [] indicate that the expression is optional

The * or {} indicates that the expression is repeated 0 or more times

The + indicates that the expression is repeated 1 or more times

If you want to use one of the previous characters, you must precede \ with

##### URL grammar

So the library will use the following grammar for its urls

```<baseUrl>/<dirImage>(/<imageName>)? | <baseUrl>/<imageName>```

Where:
Methods that contain InLaravelConvectionLink usually give the value to
```
<baseUrl> "/storage/images"
```
And the methods that contain InLaravelConvectionalStorage usually give the value to
```
<baseUrl> "/images"
```

Where:
Methods that contain InConvectionalDir usually give the value to
```
<dirImage> from the result of NameHelper::transformNameToRouteName($imageName)
```

Note that the difference between an external and internal url is based on the value of ```<baseUrl>```

### Generation of routes for Responsive, non-responsive local and external Images

The difference between a responsive image and one that is not is that for the responsive image, sets of URLs will be used, one for each variation of the image and not in the other. So they will have a shape like the following


#### Path to local or external non-responsive image
```
<NonResponsiveImageUrl>::= <baseUrl>(/<dirImage>)?/<imageName>
```

Like for example

```/storage/images/imagen/imagen.jpg```


#### Routes to local or external responsive images

For this case, a set of fruits is generated with the syntax of the non-responsive images

```
<ResponsiveVariationImageUrl>::= <baseUrl>(/<dirImage>)?/<imageName>
```

Like for example

```/storage/images/imagen/360-image.jpg```

#### ConventionalDir
Where:
Methods that contain InConvectionalDir usually give the value to
```
<dirImage> from the result of NameHelper::transformNameToRouteName($imageName)
```

#### External or internal

Note that the difference between an external and internal url is based on the value of ```<baseUrl>```

### Store the paths to an image in the database:

In order to allow the storage of images to be as flexible as possible, the following will be done.

The path to the directory of the folder that contains it (only the folder without the image name) and the name of the image will be saved in the database.

So that you can take that base route, the name of the image and generate a route or set of routes depending on whether the image is responsive or not.

### Routes to be stored in the database of resources such as images or local directories following Laravel conventions:

When storing the url of our resources (such as images, directories, etc.), we should consider storing the url that allows us to access the resource publicly; in the default Laravel configuration there is a route provided for this.

So we developed a series of methods that end in InLaravelConvectionalLink that will generate a url to these routes.

### Routes to work with the Storage of resources such as images or local directories following Laravel conventions:

Just as there is a convention for routes to resources that are publicly accessible, there is a convention for actual routes to resources in the default Laravel configuration.


### Examples of use

#### Store the base path of an image in the database

As we said before, one of the approaches that can be taken to maximize flexibility when working with images

It is only storing the path in which the image is stored

##### Using Laravel convention and directors convention with the same image name for local images

In the case in which we want to use the Laravel convention, it should be the one that is publicly accessible, a route that can be obtained through the method

```
NameHelper::generateRouteToConvectionalDirInLaravelConvectionalLink($imageName)
```

Which will generate an image url like
```/storage/images/dog-image/```

Note that this method appends a folder to the end of the path that Laravel uses by convention

##### Using only the directory convention with the same name as the image

Which can be obtained by the method, note that depending on whether the url base is external or not, we will talk about external or internal image

```
NameHelper::generateRouteToConvectionalImageDirInBaseRoute($imageName,$baseUrl=null)

```

```
<ResponsiveUrl>::= <baseUrl>/<dirImage>
```
Like for example
```/storage/images/image/```


#### Recover images in the database:

In case you have stored the full path to the folder that contains the resource in the database as we recommend

The names of the images can be recovered in the following way

```
NameHelper::generateRoutesToResponsiveImagesInBaseRoute($imageName, $baseUrl);
```
when the image is responsive or

```
NameHelper::generateRouteToImageInBaseRoute($imageName,$baseUrl=null)
```

when the image is not responsive.

If you have not stored the full path to the folder that contains the resource in the database as we recommend

```
NameHelper::generateRoutesToResponsiveImagesInConvectionalDirInBaseRoute($imageName,$baseUrl)
```

EITHER
```
NameHelper::generateRoutesToResponsiveImagesInConvectionalDirInLaravelConvectionalLink($imageName)
```
who will add the necessary information

#### More usage examples
```
Testing the output of the methods with

$fileLocator='/image.png'
$baseUrl='/cachapa/'

NameHelper::generateRoutesToResponsiveImagesInConvectionalDirInLaravelConvectionalLink('/image.png')=[
/storage/images/image/image.png
/storage/images/image/360-image.png
/storage/images/image/720-image.png
/storage/images/image/1080-image.png
/storage/images/image/1440-image.png
/storage/images/image/1800-image.png
/storage/images/image/2160-image.png
/storage/images/image/2880-image.png
/storage/images/image/3600-image.png
/storage/images/image/4320-image.png
]
NameHelper::generateRouteToConvectionalDirInLaravelConvectionalLink('/image.png')=/storage/images/image
NameHelper::generateRouteToImageInConvectionalDirInLaravelConvectionalLink('/image.png')=/storage/images/image/image.png
NameHelper::generateRouteToImageInConvectionalDirInLaravelConvectionalStorage('/image.png')=/images/image/image.png
NameHelper::generateRoutesToResponsiveImagesInConvectionalDirInBaseRoute('/image.png','/cachapa/')=[
/cachapa/image/image.png
/cachapa/image/360-image.png
/cachapa/image/720-image.png
/cachapa/image/1080-image.png
/cachapa/image/1440-image.png
/cachapa/image/1800-image.png
/cachapa/image/2160-image.png
/cachapa/image/2880-image.png
/cachapa/image/3600-image.png
/cachapa/image/4320-image.png
]
NameHelper::generateRouteToImageInConvectionalDirInBaseRoute('/image.png','/cachapa/')=/cachapa/image/image.png
NameHelper::generateRoutesToResponsiveImagesInBaseRoute('/image.png','/cachapa/')=[
/cachapa/image.png
/cachapa/360-image.png
/cachapa/720-image.png
/cachapa/1080-image.png
/cachapa/1440-image.png
/cachapa/1800-image.png
/cachapa/2160-image.png
/cachapa/2880-image.png
/cachapa/3600-image.png
/cachapa/4320-image.png
]
NameHelper::generateRouteToConvectionalImageDirInBaseRoute('/image.png','/cachapa/')=/cachapa/image
NameHelper::generateRouteToImageInBaseRoute('/image.png','/cachapa/')=/cachapa/image.png
Name Helper::generate Responsive Image Names('/image.png')=[
/image.png
360-/image.png
720-/image.png
1080-/image.png
1440-/image.png
1800-/image.png
2160-/image.png
2880-/image.png
3600-/image.png
4320-/image.png
]
NameHelper::transformNameToRouteName('/image.png')=image.png
Name Helper::get File Or DirName('/imagen.png')=imagen.png
NameHelper::getFileOrDirNameWithoutExt('/image.png')=image
NameHelper::getExtOfFile('/image.png')=png

Testing the output of the methods with

$fileLocator='/image/'
$baseUrl='/cachapa/'

$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateRouteToConvectionalDirInLaravelConvectionalLink('/image/')=/storage/images/image
NameHelper::generateRouteToImageInConvectionalDirInLaravelConvectionalLink('/image/')=/storage/images/image/image
NameHelper::generateRouteToImageInConvectionalDirInLaravelConvectionalStorage('/image/')=/images/image/image
$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateRouteToImageInConvectionalDirInBaseRoute('/image/','/cachapa/')=/cachapa/image/image
$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateRouteToConvectionalImageDirInBaseRoute('/image/','/cachapa/')=/cachapa/image
NameHelper::generateRouteToImageInBaseRoute('/image/','/cachapa/')=/cachapa/image
$imageName='/image/' from generateResponsiveImageNames appears to have no extension
NameHelper::transformNameToRouteName('/image/')=image
NameHelper::getFileOrDirName('/image/')=image
NameHelper::getFileOrDirNameWithoutExt('/image/')=image
$fileLocatorName='/image/' from getExtOfFile appears to have no extension

```

### Make a donation. Your contribution will make a difference.
[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/israeldavidvm)
[![Paypal](https://img.shields.io/badge/Paypal-@israeldavidvm-0077B5?style=for-the-badge&logo=paypal&logoColor=white&labelColor=101010)](https://paypal.me/israeldavidvm )
[![Binance](https://img.shields.io/badge/Binance_ID-809179020-101010?style=for-the-badge&logo=binancel&logoColor=white&labelColor=101010)](https://www.binance.com/ activity/referral-entry/CPA?ref=CPA_004ZGH9EIS)


### Find me on:
[![GITHUB](https://img.shields.io/badge/Github-israeldavidvm-gray?style=for-the-badge&logo=github&logoColor=white&labelColor=101010)](https://github.com/israeldavidvm)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-israeldavidvm-0077B5?style=for-the-badge&logo=linkedin&logoColor=white&labelColor=101010)](https://www.linkedin.com/ in/israeldavidvm/)
[![Twitter](https://img.shields.io/badge/Twitter-@israeldavidvm-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white&labelColor=101010)](https://twitter.com/israeldavidvm )
[![Facebook](https://img.shields.io/badge/Facebook-israeldavidvm-1877F2?style=for-the-badge&logo=facebook&logoColor=white&labelColor=101010)](https://www.facebook.com/ israeldavidvm)
[![Instagram](https://img.shields.io/badge/Instagram-@israeldavidvmv-gray?style=for-the-badge&logo=instagram&logoColor=white&labelColor=101010)](https://www.instagram.com /israeldavidvm/)
[![TikTok](https://img.shields.io/badge/TikTok-@israeldavidvm-E4405F?style=for-the-badge&logo=tiktok&logoColor=white&labelColor=101010)](https://www.tiktok.com /@israeldavidvm)
[![YouTube](https://img.shields.io/badge/YouTube-@israeldavidvm-FF0000?style=for-the-badge&logo=youtube&logoColor=white&labelColor=101010)](https://www.youtube.com /channel/UCmZLFpEPNdwpJOhal0wry7A)

## Technologies used / Used technologies

[![PHP](https://img.shields.io/badge/php-blue?logo=php&style=for-the-badge&logoColor=blue&labelColor=gray)]()
