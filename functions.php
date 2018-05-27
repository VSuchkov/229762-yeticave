<?php
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func($values);
    }

    return $stmt;
}

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