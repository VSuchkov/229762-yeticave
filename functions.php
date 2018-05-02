<?php
function fsr($num)
{
    $num = ceil($num);
    if ($num < 1000) {
        $num = $num;
    } elseif ($num >= 1000) {
        $num = substr($num, 0, -3) . " " . substr($num, -3) . "<b class='rub'>р</b>";
    }
    return $num;
};
function renderTemplate($path, $arr) {
    extract($arr);
    if (file_exists($path)) {
        ob_start();
        require_once($path);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    } else {
    return "";
    }
};

?>