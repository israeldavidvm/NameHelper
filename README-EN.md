
# NameHelper

[Readme version in English](./README-EN.md)

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
This library seeks to support normal, responsive images with local or external storage.

For which it is assumed that the variations of a responsive image are grouped in a folder.

It also seeks to facilitate the use of conventions: for which a name generation is standardized for the folders that store the variations of a responsive image and the folder where the images are stored in Laravel.

So there are special methods that follow these conventions, which include the word Conventional and LaravelConvectional.

#### Grammar for urls
Notation Conventions for Grammar:

The <> are used to surround a non-terminal symbol

The ::= is used for production rules

Non-terminal symbols are expressed as a string or normal characters

The following group of pairs of symbols should be used together with expressions in the following way: the first in each pair is written as a suffix after the expression and the second surrounds the expression.

He ? or [] indicate that the expression is optional

The * or {} indicates that the expression is repeated 0 or more times

The + indicates that the expression is repeated 1 or more times

If you want to use one of the previous characters, you must precede \ with

So the library will use the following grammar for its urls

```<baseUrl>/<dirImage>?/<imageName>?```

Where:
Methods that contain the word LaravelConvectional usually give the value to
```
<baseUrl> of "/storage/images"
```

Where:
Methods that contain the word Conventional usually give the value to
```
<dirImage> from the result of NameHelper::transformNameToUrlName($imageName)
```

Note that the difference between an external and internal url is based on the value of ```<baseUrl>```

##### Local non-responsive image for laravel

```
<nonResponsiveLocalUrl>::= <baseUrl>/<dirImage>?/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Responsive local image for laravel

```
<ResponsiveLocalUrl>::= <baseUrl>/<dirImage>
```
For example
```/storage/images/image/```

##### Conventional local or external non-responsive image
```
<ConventionalNonResponsiveUrl>::= <baseUrl>/<dirImage>/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Conventional responsive local or external image

```
<ConventionalResponsiveUrl>::= <baseUrl>/<dirImage>
```
For example
```/storage/images/image/```


##### Local or external non-responsive image
```
<nonResponsiveUrl>::= <baseUrl>/<imageName>
```

For example

```/storage/images/imagen/imagen.jpg```


##### Responsive local or external image

```
<ResponsiveUrl>::= <baseUrl>
```
For example
```/storage/images/image/```


### Examples of use

#### Store the url of the images in the database:

To store a responsive image in the database of a Laravel application, it is recommended to use

```
NameHelper::generateLaravelConvectionResponsiveImageDirUrl($imageName)
```

Which will generate an image url like
```/storage/images/image/```

In the case of non-responsive images

```
NameHelper::generateLaravelConvectionalImageUrl($imageName)
```

Which will generate an image url like
```/storage/images/imagen/imagen.jpg```

#### Recover images in the database:

Note that responsive images are stored in a directory

So the names for each of the responsive images must be obtained through

```
NameHelper::generateResponsiveImageUrls($imageName, $baseUrl);
```

either

```
NameHelper::generateConvectionResponsiveImageUrls($imageName,$baseUrl)
```

EITHER
```
NameHelper::generateLaravelConvectionResponsiveImageUrls($imageName)
```
#### More usage examples
```
Testing the output of the methods with

$fileLocator='/image.png'
$baseUrl='/cachapa/'

Name Helper::generate Laravel ConventionalResponsiveImageUrls('/image.png')=[
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
Name Helper::generate Laravel ConventionalResponsiveImageDirUrl('/imagen.png')=/storage/images/imagen
Name Helper::generate Laravel ConvectionalImageUrl('/imagen.png')=/storage/images/image/imagen.png
NameHelper::generateConvetionalResponsiveImageUrls('/image.png','/cachapa/')=[
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
NameHelper::generateConvectionalImageUrl('/imagen.png','/cachapa/')=/cachapa/image/imagen.png
NameHelper::generateResponsiveImageUrls('/image.png','/cachapa/')=[
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
NameHelper::generateConvectionalImageDirUrl('/image.png','/cachapa/')=/cachapa/image
Name Helper::generate Image Url('/imagen.png','/cachapa/')=/cachapa/imagen.png
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
NameHelper::transformNameToUrlName('/image.png')=image.png
Name Helper::get File Or DirName('/imagen.png')=imagen.png
NameHelper::getFileOrDirNameWithoutExt('/image.png')=image
NameHelper::getExtOfFile('/image.png')=png

Testing the output of the methods with

$fileLocator='/image/'
$baseUrl='/cachapa/'

$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateLaravelConvectionResponsiveImageDirUrl('/image/')=/storage/images/image
NameHelper::generateLaravelConvectionalImageUrl('/image/')=/storage/images/image/image
$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateConvectionalImageUrl('/image/','/cachapa/')=/cachapa/image/image
$imageName='image' from generateResponsiveImageNames appears to have no extension
NameHelper::generateConvectionalImageDirUrl('/image/','/cachapa/')=/cachapa/image
NameHelper::generateImageUrl('/image/','/cachapa/')=/cachapa/image
$imageName='/image/' from generateResponsiveImageNames appears to have no extension
NameHelper::transformNameToUrlName('/image/')=image
NameHelper::getFileOrDirName('/image/')=image
NameHelper::getFileOrDirNameWithoutExt('/image/')=image
$fileLocatorName='/image/' from getExtOfFile appears to have no extension
```


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
