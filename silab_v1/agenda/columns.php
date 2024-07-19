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
        } elseif ($tab == 'funcionario_empresa') {
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
                $join .= " INNER join $tab on $tab.id_funcionario = $table.id_pessoa";
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
            if (strpos($join, "$tab on") === false) {
                $join .= " LEFT JOIN $tab on $tab.id_empresa = $table.id_empresa";
            }
        } elseif ($tab == 'tipo_atendimento') {
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
                $join .= " LEFT JOIN $tab on $tab.id_atendimento = $table.id_atendimento";
            }
        } elseif ($tab == 'assinaturas_documentos') {
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
                $join .= " LEFT JOIN $tab on $tab.id_agenda = $table.id_agenda";
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
                $join .= " LEFT JOIN $tab on $tab.id_funcao_empresa = $table.id_funcao_empresa";
            }
        } elseif ($tab == 'funcao_empresa') {
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
                $join .= " JOIN controle_funcao_empresa on controle_funcao_empresa.id_funcao_empresa = $table.id_funcao_empresa";
            }

            if (strpos($join, " $tab on") === false) {
                $join .= " JOIN  $tab on  $tab.codigo = controle_funcao_empresa.id_setor_empresa";
            }
        }
    }
    $columns = implode(',',  $body_columns);
}
