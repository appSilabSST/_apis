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
        } elseif ($tab == 'controle_funcao_empresa') {
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
            if (strpos($join, "$tab on") === false) {
                $join .= " LEFT JOIN $tab on $tab.codigo = $table.id_funcao_empresa";
            }
        } elseif ($tab == 'funcao') {

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

            if (strpos($join, "controle_funcao_empresa on") === false) {
                $join .= " LEFT JOIN controle_funcao_empresa on controle_funcao_empresa.codigo = $table.id_funcao_empresa";
            }

            if (strpos($join, "$tab on") === false) {
                $join .= " LEFT JOIN $tab on $tab.id_funcao = controle_funcao_empresa.id_funcao";
            }
        }
    }

    $columns = implode(',',  $body_columns);
}
