<?php
declare(strict_types=1);
//die("PHP SCRIPT IS RUNNING");
$url=$_SERVER["REQUEST_URI"];

if($url==="/robots.txt"){
    //
    http_response_code(200);
    return;
}
if($url==="/favicon.ico"){
    //
    http_response_code(404);
    return;
}
if(0!==strpos($url,"/https://raw.githubusercontent.com/")){
    showMainPage();
    return;
}
$url=substr($url,1);
$lowercase_type=explode(".",basename($url));
$lowercase_type=strtolower($lowercase_type[array_key_last($lowercase_type)]);
// var_dump("url",$url,"_GET",$_GET,"_POST",$_POST,"_REQUEST",$_REQUEST,"_SERVER",$_SERVER);
//var_dump($url);
// 
$redirect_header='X-Accel-Redirect: /githubusercontent_proxy/'.urlencode($url);
//$redirect_header='X-Accel-Redirect: /githubusercontent_proxy/'.$url;
if(0){
    var_dump($redirect_header);
}else{
    //header("");
    header("Content-Type: ".fileContentType($lowercase_type));
    header($redirect_header);
}
function showMainPage(){
    http_response_code(200);
    header("Content-Type: text/plain; charset=utf-8");
    echo "hi!\n";
    echo "add your raw.githubusercontent.com link to the end of the url:\n";
    echo "https://rawgit.loltek.net/";
    echo "\n\nexample:\nto get: https://raw.githubusercontent.com/loltek/rawgit.loltek.net/master/src/www/script.php \ngo to:  https://rawgit.loltek.net/https://raw.githubusercontent.com/loltek/rawgit.loltek.net/master/src/www/script.php";
    echo "\n\n\n";
    echo "github repo (bugs/development/blahblah): https://github.com/loltek/rawgit.loltek.net\n";
    echo "nginx config for this script: \n";
    readfile("/etc/nginx/sites-enabled/rawgit.loltek.net");
    echo "\nsource code for this script: \n\n\n";
    readfile(__FILE__);
}

function fileContentType(string $lowercase_type):string{
    // list extracted from nginx using
    /*
    $lines=array_values(array_filter(array_map("trim",explode("\n",$raw)),"strlen"));
    $result=[];
    foreach($lines as $line){
        $line=substr($line,0,-1);
        $tmp=explode(" ",$line,2);
        assert(count($tmp)===2);
        $type=trim($tmp[0]);
        $exts=explode(" ",trim($tmp[1]));
        foreach($exts as $ext){
            $result[trim($ext)]=trim($type);
        }
    }
    var_export($result);
    */
    $mimes=array (
        'html' => 'text/html',
        'htm' => 'text/html',
        'shtml' => 'text/html',
        'css' => 'text/css',
        'xml' => 'text/xml',
        'gif' => 'image/gif',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'js' => 'application/javascript',
        'atom' => 'application/atom+xml',
        'rss' => 'application/rss+xml',
        'mml' => 'text/mathml',
        'txt' => 'text/plain',
        'jad' => 'text/vnd.sun.j2me.app-descriptor',
        'wml' => 'text/vnd.wap.wml',
        'htc' => 'text/x-component',
        'png' => 'image/png',
        'tif' => 'image/tiff',
        'tiff' => 'image/tiff',
        'wbmp' => 'image/vnd.wap.wbmp',
        'ico' => 'image/x-icon',
        'jng' => 'image/x-jng',
        'bmp' => 'image/x-ms-bmp',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        'webp' => 'image/webp',
        'woff' => 'application/font-woff',
        'jar' => 'application/java-archive',
        'war' => 'application/java-archive',
        'ear' => 'application/java-archive',
        'json' => 'application/json',
        'hqx' => 'application/mac-binhex40',
        'doc' => 'application/msword',
        'pdf' => 'application/pdf',
        'ps' => 'application/postscript',
        'eps' => 'application/postscript',
        'ai' => 'application/postscript',
        'rtf' => 'application/rtf',
        'm3u8' => 'application/vnd.apple.mpegurl',
        'xls' => 'application/vnd.ms-excel',
        'eot' => 'application/vnd.ms-fontobject',
        'ppt' => 'application/vnd.ms-powerpoint',
        'wmlc' => 'application/vnd.wap.wmlc',
        'kml' => 'application/vnd.google-earth.kml+xml',
        'kmz' => 'application/vnd.google-earth.kmz',
        '7z' => 'application/x-7z-compressed',
        'cco' => 'application/x-cocoa',
        'jardiff' => 'application/x-java-archive-diff',
        'jnlp' => 'application/x-java-jnlp-file',
        'run' => 'application/x-makeself',
        'pl' => 'application/x-perl',
        'pm' => 'application/x-perl',
        'prc' => 'application/x-pilot',
        'pdb' => 'application/x-pilot',
        'rar' => 'application/x-rar-compressed',
        'rpm' => 'application/x-redhat-package-manager',
        'sea' => 'application/x-sea',
        'swf' => 'application/x-shockwave-flash',
        'sit' => 'application/x-stuffit',
        'tcl' => 'application/x-tcl',
        'tk' => 'application/x-tcl',
        'der' => 'application/x-x509-ca-cert',
        'pem' => 'application/x-x509-ca-cert',
        'crt' => 'application/x-x509-ca-cert',
        'xpi' => 'application/x-xpinstall',
        'xhtml' => 'application/xhtml+xml',
        'xspf' => 'application/xspf+xml',
        'zip' => 'application/zip',
        'bin' => 'application/octet-stream',
        'exe' => 'application/octet-stream',
        'dll' => 'application/octet-stream',
        'deb' => 'application/octet-stream',
        'dmg' => 'application/octet-stream',
        'iso' => 'application/octet-stream',
        'img' => 'application/octet-stream',
        'msi' => 'application/octet-stream',
        'msp' => 'application/octet-stream',
        'msm' => 'application/octet-stream',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'mid' => 'audio/midi',
        'midi' => 'audio/midi',
        'kar' => 'audio/midi',
        'mp3' => 'audio/mpeg',
        'ogg' => 'audio/ogg',
        'm4a' => 'audio/x-m4a',
        'ra' => 'audio/x-realaudio',
        '3gpp' => 'video/3gpp',
        '3gp' => 'video/3gpp',
        'ts' => 'video/mp2t',
        'mp4' => 'video/mp4',
        'mpeg' => 'video/mpeg',
        'mpg' => 'video/mpeg',
        'mov' => 'video/quicktime',
        'webm' => 'video/webm',
        'flv' => 'video/x-flv',
        'm4v' => 'video/x-m4v',
        'mng' => 'video/x-mng',
        'asx' => 'video/x-ms-asf',
        'asf' => 'video/x-ms-asf',
        'wmv' => 'video/x-ms-wmv',
        'avi' => 'video/x-msvideo',
    );
    if(isset($mimes[$lowercase_type])){
        return $mimes[$lowercase_type];
    }
    header("X-Unknown-Mime: true");
    return 'application/octet-stream';
}
