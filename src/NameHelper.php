<?php

namespace Israeldavidvm\NameHelper;

use Exception;

class NameHelper {

    public static $responsiveImageSizes=[360,720,1080,1440,1800,2160,2880,3600,4320];

    public static function generateLaravelConvetionalResponsiveImageUrls($imageName){

        return self::generateConvetionalResponsiveImageUrls(
            $imageName,
            "/storage/images"
        );

    }

    public static function generateLaravelConvetionalResponsiveImageDirUrl($imageName){

        return self::generateConvetionalImageDirUrl(
            $imageName,
            "/storage/images"
        );

    }

    public static function generateLaravelConvetionalImageUrl($imageName){

        return self::generateConvetionalImageUrl(
            $imageName,
            "/storage/images"
        );

    }

    public static function generateLaravelConvetionalImagePath($imageName){

        return self::generateConvetionalImageUrl(
            $imageName,
            "/images"
        );

    }

    public static function generateConvetionalResponsiveImageUrls($imageName,$baseUrl){

        $conventionalBaseUrl=self::generateConvetionalImageDirUrl($imageName,$baseUrl);

        return self::generateResponsiveImageUrls(
            $imageName, 
            $conventionalBaseUrl
        );

    }

    public static function generateConvetionalImageUrl($imageName,$baseUrl){

        $conventionalBaseUrl=self::generateConvetionalImageDirUrl($imageName,$baseUrl);

        return self::generateImageUrl(
            $imageName, 
            $conventionalBaseUrl
        );

    }

    
    /**
     * Genera un conjunto de urls para una imagen responsive tomando
     *  en cuenta que cada url es la combinacion de
     * $baseUrl/$responsiveImageName
     * Nota se decidio que la funcion realizara una transfromacion del nombre de la imagen
     */
    public static function generateResponsiveImageUrls($imageName,$baseUrl){
    
        $responsiveImageUrls=null;

        $imageName=self::transformNameToUrlName($imageName);
     
        $responsiveImageNames=self::generateResponsiveImageNames($imageName);
    
        foreach ($responsiveImageNames as $size => $responsiveImageName) {

            $responsiveImageUrls[$size]=self::generateImageUrl($responsiveImageName,$baseUrl);

        }

        return $responsiveImageUrls;
    }

    public static function generateConvetionalImageDirUrl($imageName,$baseUrl=null){

        $responsiveDirName=self::transformNameToUrlName(self::getFileOrDirNameWithoutExt($imageName));

        if($baseUrl===null){
            return $responsiveDirName;
        }

        return self::concatenateUrls($baseUrl,$responsiveDirName);


    }

    public static function generateImageUrl($imageName,$baseUrl=null){

        $imageName=self::transformNameToUrlName($imageName);

        if($baseUrl===null){
            return $imageName;
        }

        return self::concatenateUrls($baseUrl,$imageName);

    }

    /**
     * Genera las versiones responsive para un nombre de
     * imagen:
     * Warning; No transforma los nombres de la imagen a una url
     * para ello consulte la funcion transformNameToUrlName($string)
     */
    public static function generateResponsiveImageNames($imageName){
        
        $responsiveImageNames=null;

        $lastDotPosition = strrpos($imageName, ".");
    
        if($lastDotPosition === false){
            throw new Exception("\$imageName='$imageName' de ".__FUNCTION__." pareciera no tener una extension");
        }

        $responsiveImageNames[]="$imageName";

        foreach (self::$responsiveImageSizes as $size){

            $responsiveImageNames[$size]="$size-$imageName";

        }

        return $responsiveImageNames;
    }

    
    #---------------------working with file names-----------------------------

    /**
     * Retorna la extension de un archivo a partir de un <fileLocatorName>
     * Warning: No se asegura que la ruta sea correcta.
     *
     * @param string $fileLocatorName puede ser un nombre de archivo, 
     * ruta en el sistema de archivos o url
     * @return string extension del archivo
     * @throws Exception si $fileLocatorName no a punta a un archivo 
     */
    public static function getExtOfFile($fileLocatorName) {

        $fileName=self::getFileOrDirName($fileLocatorName);

        $lastDotPosition = strrpos($fileName, ".");
    
        if($lastDotPosition === false){
            throw new Exception("\$fileLocatorName='$fileLocatorName' de ".__FUNCTION__." pareciera no tener una extension");
        }
        
        return substr($fileName, $lastDotPosition + 1);
    }

    /**
     * Retorna el nombre de un archivo sin la extension a partir de un <fileLocatorName> 
     * Warning: No se asegura que la ruta sea correcta.
     *
     * @param string $fileLocatorName puede ser un nombre de archivo, 
     * ruta en el sistema de archivos o url
     * @return string 
     */
    public static function getFileOrDirNameWithoutExt($fileLocatorName){

        $fileName=self::getFileOrDirName($fileLocatorName);

        $lastDotPosition = strrpos($fileName, ".");

        if ($lastDotPosition === false) {
            return $fileName;
        }    
            
        $fileOrDirNameWithoutExt=substr(
            $fileName,
            0, 
            $lastDotPosition
        );
    
        return $fileOrDirNameWithoutExt;
        
    }

    /**
     * Retorna el nombre de un archivo a partir de un <fileLocatorName> 
     * Warning: No se asegura que la ruta sea correcta.
     *
     * @param string $fileLocatorName puede ser un nombre de archivo, 
     * ruta en el sistema de archivos o url
     * @return string 
     */
    public static function getFileOrDirName($fileLocatorName){

        $lastSlashPosition = strrpos($fileLocatorName, "/");
    
        //si no se encuentra el slash se asume que 
        //es un nombre de archivo o directorio
        if ($lastSlashPosition === false) {
            //si no se encuentra un punto (.)
            return $fileLocatorName;
        }    

        $lastPosition=mb_strlen($fileLocatorName)-1;

        //si el slash no esta en la ultima posicion
        if($lastSlashPosition!=$lastPosition){

            return $fileOrDirName=
                substr(
                    $fileLocatorName,
                    $lastSlashPosition+1
                );


        }

        $penultimateSlashPosition = strrpos(
            $fileLocatorName, 
            "/",
            -2
        );

        $fileOrDirName=substr(
            $fileLocatorName,
            $penultimateSlashPosition+1,
            ($lastPosition-$penultimateSlashPosition-1)
            
        );
    
        return $fileOrDirName;
        
    }

    public static function concatenateUrls($url1,$url2){
        $lastUrl1Position=mb_strlen($url1)-1;
        
        $lastCharacterUrl1=substr(
            $url1,
            $lastUrl1Position,
        );

        if($lastCharacterUrl1==='/'){

            $url1=substr(
                $url1,
                0,
                -1
            );
        }

        $firstCharacterUrl2=substr(
            $url2,
            0,
            1
        );

        if($firstCharacterUrl2==='/'){
            $url2=substr(
                $url2,
                1,
            );
        }

        return "$url1/$url2";;
    
    }

    /**
     * Al pasar como parametro $name="hello world" retornara hello-world
     *
     */
    public static function transformNameToUrlName($name){

        $name=mb_strtolower($name, 'UTF-8');
    
        $name = str_replace([' ','_'],'-',$name);
    
    
        $name = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            'a',
            $name
        );
     
        $name = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            'e',
            $name
        );
     
        $name = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            'i',
            $name
        );
     
        $name = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            'o',
            $name
        );
     
        $name = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            'u',
            $name
        );
     
        $name = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $name
        );
        
        $name = str_replace(
            array(
                "/","\\", "¨", "º",
                "$", "%", "&", "~",
                "(", ")", "¿", "?",
                "[", "]", "{", "}",
                "+", "¡", "^", "¨", "´","'",
                "<",">", 
                ";", ",", ":"),
            "",$name);
            
        return $name;
    }
    

}
