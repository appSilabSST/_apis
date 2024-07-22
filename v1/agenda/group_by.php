<?php
if (isset($_GET["group_by"])) {
    $dados = json_decode(base64_decode($_GET['group_by']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_group_by[] = $tab . "." . $column;
            }
        } elseif ($tab == 'funcao_empresa') {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_group_by[] = $tab . "." . $column;
            }

            if (strpos($join, "controle_funcao_empresa on") === false) {
                $join .= " JOIN controle_funcao_empresa on controle_funcao_empresa.codigo = $table.id_funcao_empresa";
            }

            if (strpos($join, " $tab on") === false) {
                $join .= " JOIN  $tab on  $tab.codigo = controle_funcao_empresa.id_setor_empresa";
            }
        }
    }

    $body_group_by = implode(",", $body_group_by);

    $group_by = " GROUP BY $body_group_by";
}
