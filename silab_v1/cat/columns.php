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
        } elseif ($tab == 'controle_lote_agenda') {
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
                $join .= " LEFT JOIN $tab on $tab.id_cat = $table.id_cat";
                if (strpos($join, "lote_esocial on") === false) {
                    $join .= " LEFT JOIN lote_esocial on lote_esocial.id_lote = $tab.id_lote";
                }
            }
        } elseif ($tab == 'funcionario_empresa') {
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
                $join .= " LEFT JOIN $tab on $tab.cpf = $table.cpf ";
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
