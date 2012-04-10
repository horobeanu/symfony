<?php
namespace webCS\FrontendBundle\Extension;
use Symfony\Component\HttpKernel\KernelInterface;

class Util extends \Twig_Extension {

    public function getFilters() {
        return array(
            'var_dump'   => new \Twig_Filter_Function('var_dump'),
            'strpos'   => new \Twig_Filter_Function('strpos'),
            'highlight'  => new \Twig_Filter_Method($this, 'highlight'),
            'truncate'  => new \Twig_Filter_Method($this, 'truncate'),
            'wcs_implode'  => new \Twig_Filter_Method($this, 'wcs_implode'),
            'wcs_count'  => new \Twig_Filter_Method($this, 'wcs_count'),
            'getSizeFormatted'  => new \Twig_Filter_Method($this, 'getSizeFormatted'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'browserVersion' => new \Twig_Function_Method($this, 'browserVersion'),
        );
    }
    
    public function wcs_count($array)
    {
        return count(array_values($array));
    }
    
    public function wcs_implode($array, $key = null, $glue=',', $mainKey = null, $mainKeyName=null, $mainGlue='-')
    {
        if ($mainKey && $mainKeyName){
            $result = '';
            $mainArray = array();
            foreach($array as $item){
                if (isset($item[$mainKey][$mainKeyName])) {
                    $mainArray[$item[$mainKey][$mainKeyName]] = array();
                }
            }
            if (!$mainGlue){
                return implode($glue, array_keys($mainArray));
            }
            
            foreach($array as $item){
                if (isset($item[$key])){
                    $mainArray[$item[$mainKey][$mainKeyName]][] = $item[$key];
                }
            }
            
            foreach($mainArray as $key=>$main){
                $subcats = implode($glue, $main);
                $result = $result.$key.$mainGlue.$subcats.$glue;
            }
            
            if ($result) {
                $len = strlen($glue);
                $result = substr($result,0,-$len);
            }
            
            return $result;
        }
        
        if (!$key){
            return implode($glue, $array);
        }
        
        $result = '';
        foreach($array as $item){
            if (isset($item[$key])){
                $result .= $item[$key].$glue;
            }
        }
        
        if ($result) {
            $len = strlen($glue);
            $result = substr($result,0,-$len);
        }
        return $result;
    }
    
    public function highlight($sentence, $expr)
    {
        return preg_replace('/(' . $expr . ')/',
                            '<span style="color:red">\1</span>', $sentence);
    }
    
    public function truncate($string, $limit, $break=' ', $pad='...', $striptags = true)
    {
        if ($striptags){
            $string = strip_tags($string);
        }
        
        if(strlen($string) <= $limit){
            return $string;
        }
        if(false !== ($breakpoint = strpos($string, $break, $limit))) {
            if($breakpoint < strlen($string) - 1) {
                $string = substr($string, 0, $breakpoint) . $pad;
            } 
        }
        
        return $string;
    }
    
    public function browserVersion() {
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
            return 'firefox';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strstr($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
            return 'safari';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
            return 'chrome';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
            return 'opera';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) {
            return 'ie6';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7')) {
            return 'ie7';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8')) {
            return 'ie8';
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')) {
            return 'ie9';
        }
    }
    
     
    public function getSizeFormatted($bytes)
    {
        if ($bytes < 1024) {
            return $$bytes .' B';
        } elseif ($bytes < 1048576) {
            return round($bytes / 1024, 2) .' KB';
        } elseif ($bytes < 1073741824) {
            return round($bytes / 1048576, 2) . ' MB';
        } else {
            return round($bytes / 1073741824, 2) . ' GB';
        }
    }

    public function getName()
    {
        return 'wcs_twig_extension';
    }

}