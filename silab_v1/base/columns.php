<?php
if (isset($_GET["columns"])) {

    $dados = json_decode(base64_decode($_GET['columns']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            if (isset($value['basic'])) {
                $body_c = explode(",", $value['basic']);
                foreach ($body_c as $key => $column) {
                    $body_columns[] = $tab . "." . $column;
                }
            }
            if (isset($value['extensions'])) {
                foreach ($value['extensions'] as $key => $column) {
                    $body_columns[] = "$column as $key";
                }
            }
        } elseif ($tab == '*************') {
            if (isset($value['basic'])) {
                $body_c = explode(",", $value['basic']);
                foreach ($body_c as $key => $column) {
                    $body_columns[] = $tab . "." . $column;
                }
            }
            if (isset($value['extensions'])) {
                foreach ($value['extensions'] as $key => $column) {
                    $body_columns[] = "$column as $key";
                }
            }
            if (strpos($join, "$tab on") === false) {
                $join .= "****************";
            }
        }
    }

    $columns = implode(',',  $body_columns);
}

