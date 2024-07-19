<?php
if (isset($_GET["columns"])) {

    $dados = json_decode(base64_decode($_GET['columns']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            if (isset($value['basic'])) {
                $body_c = explode(",", $value['basic']);
                foreach ($body_c as $key => $column) {
                    $body_columns[$key] = $tab . "." . $column;
                }
            }
            if (isset($value['extensions'])) {
                foreach ($value['extensions'] as $key => $column) {
                    $body_columns[$key] = "$column as $key";
                }
            }
        } elseif ($tab == 'controle_funcionario_empresa') {
            if (isset($value['basic'])) {
                $body_c = explode(",", $value['basic']);
                foreach ($body_c as $key => $column) {
                    $body_columns[$key] = $tab . "." . $column;
                }
            }
            if (isset($value['extensions'])) {
                foreach ($value['extensions'] as $key => $column) {
                    $body_columns[$key] = "$column as $key";
                }
            }
            if (strpos($join, " $tab on") === false) {
                $join .= "left join $tab on $tab.id_funcionario = $table.id_funcionario";
            }
        } elseif ($tab == 'empresa') {
            if (isset($value['basic'])) {
                $body_c = explode(",", $value['basic']);
                foreach ($body_c as $key => $column) {
                    $body_columns[$key] = $tab . "." . $column;
                }
            }
            if (isset($value['extensions'])) {
                foreach ($value['extensions'] as $key => $column) {
                    $body_columns[$key] = "$column as $key";
                }
            }

            if (strpos($join, " $tab on") === false) {
                $join .= "left join $tab on $tab.id_empresa = controle_funcionario_empresa.id_empresa";
            }
        }
    }

    $columns = implode(',',  $body_columns);
}
