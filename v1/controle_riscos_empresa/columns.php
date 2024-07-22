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
        } elseif ($tab == 'risco') {
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
                $join .= " JOIN $tab on $tab.id_risco = $table.id_risco";
            }
        } elseif ($tab == 'grupo_risco') {
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
                if (strpos($join, "risco on") === false) {
                    $join .= " JOIN risco on risco.id_risco = $table.id_risco";
                }
                $join .= " JOIN $tab on $tab.id_grupo = risco.id_grupo";
            }
        } elseif ($tab == 'funcao_empresa') {
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
                $join .= " JOIN $tab on $tab.codigo = $table.id_setor_empresa";
            }
        } elseif ($tab == 'controle_epi_ppra') {
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
                $join .= " LEFT JOIN $tab on $tab.id_risco_empresa = $table.codigo";
            }
        } elseif ($tab == 'controle_epis_local_trabalho') {
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
            if (strpos($join, "controle_epi_ppra on") === false) {
                $join .= " LEFT JOIN controle_epi_ppra on controle_epi_ppra.id_risco_empresa = $table.codigo";
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " LEFT JOIN $tab on $tab.id_controle = controle_epi_ppra.id_epis_local_trabalho";
            }
        }
    }
    $columns = implode(',', $body_columns);
}
