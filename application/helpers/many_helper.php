<?php
function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $d && $d->format('Y-m-d H:i:s') == $date;
}

/*
 * Method to change date pattern
 * @param String the $date to change the pattern
 * @param String the $newPattern to the new date
 */
if (!function_exists('convertDate')) {
    function convertDate($date, $newPattern = NULL)
    {
        $oldPattern = '#(\d+).{1}(\d+).{1}(\d+)#';
        preg_match($oldPattern, $date, $matches);
        if (count($matches) !== 0) {
            $date = $matches[3] . '/' . $matches[2] . '/' . $matches[1];
            if ($newPattern !== NULL) {
                $date = date($newPattern, strtotime($date));
            }
            return $date;
        } else {
            return false;
        }
    }
}
/*
 * Method to checks if mb_string is installed and use it, or switch to normal strtolower
 * @param String the $data to change to lower
 * @param String the $charset
 */
if (!function_exists('str2lower')) {
    function str2lower($data, $charset = 'UTF-8')
    {
        return function_exists('mb_strtolower') ? mb_strtolower($data, $charset) : strtolower($data);
    }
}/*
 * Method to checks if mb_string is installed and use it, or switch to normal strtoupper
 * @param String the $data to change to upper
 * @param String the $charset
 */
if (!function_exists('str2upper')) {
    function str2upper($data, $charset = 'UTF-8')
    {
        return function_exists('mb_strtoupper') ? mb_strtoupper($data, $charset) : strtoupper($data);
    }
}
if (!function_exists('str2upper')) {
    function str2upper($data, $charset = 'UTF-8')
    {
        return function_exists('mb_strtoupper') ? mb_strtoupper($data, $charset) : strtoupper($data);
    }
}
if (!function_exists('str2upper')) {
    function str2upper($data, $charset = 'UTF-8')
    {
        return function_exists('mb_strtoupper') ? mb_strtoupper($data, $charset) : strtoupper($data);
    }
}

if (!function_exists('autolink')) {
    function autolink($str)
    {
        # don't use target if tail is follow
        $regex['file'] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
        $regex['file'] = "(\.($regex[file])\") TARGET=\"_blank\"";
        # define URL ( include korean character set )
        $regex['http'] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9:;&#=_~%\[\]\?\/\.\,\+\-]+)([\.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
        # define E-mail address ( include korean character set )
        $regex['mail'] = "([\xA1-\xFEa-z0-9_\.\-]+)@([\xA1-\xFEa-z0-9_\-]+\.[\xA1-\xFEa-z0-9\-\._\-]+[\.]*[a-z0-9]\??[\xA1-\xFEa-z0-9=]*)";
        # If use "wrap=hard" option in TEXTAREA tag,
        # connected link tag that devided sevral lines
        $src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
        $tar[] = "<\\1\\2\\3>";
        $src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
        $tar[] = "<\\1\\2>";
        $src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*($regex[http]|mailto:$regex[mail])[^>]*>/i";
        $tar[] = "<\\1 \\2=\"\\3\">";
        # replaceed @ charactor include email form in URL
        $src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
        $tar[] = "\\1://\\2_HTTPAT_\\3";
        # replaced special char and delete target
        # and protected link when use html link code
        $src[] = "/&(quot|gt|lt)/i";
        $tar[] = "!\\1";
        $src[] = "/<a([^>]*)href=[\"' ]*($regex[http])[\"']*[^>]*>/i";
        $tar[] = "<A\\1HREF=\"\\3_orig://\\4\" TARGET=\"_blank\">";
        $src[] = "/href=[\"' ]*mailto:($regex[mail])[\"']*>/i";
        $tar[] = "HREF=\"mailto:\\2#-#\\3\">";
        $src[] = "/<([^>]*)(background|codebase|src)[ \n]*=[\n\"' ]*($regex[http])[\"']*/i";
        $tar[] = "<\\1\\2=\"\\4_orig://\\5\"";
        # auto linked url and email address that unlinked
        $src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)($regex[http])/i";
        $tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</a>";
        $src[] = "/($regex[mail])/i";
        $tar[] = "<A HREF=\"mailto:\\1\">\\1</a>";
        $src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
        $tar[] = "\\1";
        $src[] = "/<\/A><\/A>/i";
        $tar[] = "</A>";
        # restored code that replaced for protection
        $src[] = "/!(quot|gt|lt)/i";
        $tar[] = "&\\1";
        $src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
        $tar[] = "\\1";
        $src[] = "'#-#'";
        $tar[] = "@";
        $src[] = "/$regex[file]/i";
        $tar[] = "\\1";
        # restored @ charactor include Email form in URL
        $src[] = "/_HTTPAT_/";
        $tar[] = "@";
        # put border value 0 in IMG tag
        $src[] = "/<(IMG SRC=\"[^\"]+\")>/i";
        $tar[] = "<\\1 BORDER=0>";
        # If not MSIE, disable embed tag
        if (!preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
            $src[] = "/<embed/i";
            $tar[] = "&lt;embed";
        }

        $str = preg_replace($src, $tar, $str);
        return $str;
    }
}