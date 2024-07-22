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
        } elseif ($tab == 'epi') {
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
                $join .= " JOIN $tab on $tab.id_epi = $table.id_epi";
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
                $join .= " JOIN $tab on $tab.id_epis_local_trabalho = $table.id_controle";
            }
        } elseif ($tab == 'controle_riscos_empresa') {
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
                $join .= " JOIN controle_epi_ppra on controle_epi_ppra.id_epis_local_trabalho = $table.id_controle";
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " JOIN $tab on $tab.codigo = controle_epi_ppra.id_risco_empresa";
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
            if (strpos($join, "controle_epi_ppra on") === false) {
                $join .= " JOIN controle_epi_ppra on controle_epi_ppra.id_epis_local_trabalho = $table.id_controle";
            }
            if (strpos($join, "controle_riscos_empresa on") === false) {
                $join .= " JOIN controle_riscos_empresa on controle_riscos_empresa.codigo = controle_epi_ppra.id_risco_empresa";
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " JOIN $tab on $tab.codigo = controle_riscos_empresa.id_setor_empresa";
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
            if (strpos($join, "controle_epi_ppra on") === false) {
                $join .= " JOIN controle_epi_ppra on controle_epi_ppra.id_epis_local_trabalho = $table.id_controle";
            }
            if (strpos($join, "controle_riscos_empresa on") === false) {
                $join .= " JOIN controle_riscos_empresa on controle_riscos_empresa.codigo = controle_epi_ppra.id_risco_empresa";
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " JOIN $tab on $tab.id_risco = controle_riscos_empresa.id_risco";
            }
        }
    }

    $columns = implode(',', $body_columns);
}
