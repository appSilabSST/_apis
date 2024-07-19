<?php

if (isset($_GET["where"])) {
    $dados = json_decode(base64_decode($_GET['where']), true);
    foreach ($dados as $key => $value) {
        if ($key == $table) {
            foreach ($value as $chaves => $val) {
                $i = 0;
                if (strpos($val, ',') === false) {
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves);
                    $option_value[":" . str_replace($condicoes_where, "", $chaves)] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
        } else if ($key == "controle_funcionario_empresa") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
            if (strpos($join, "$key on") === false) {
                $join .= " JOIN $key on $key.id_funcao_empresa = $table.id_funcao_empresa";
            }
        } else if ($key == "funcao_empresa") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
            if (strpos($join, "controle_funcao_empresa on") === false) {
                $join .= " JOIN controle_funcao_empresa on controle_funcao_empresa.id_funcao_empresa = $table.id_funcao_empresa";
            }

            if (strpos($join, "$key on") === false) {
                $join .= " JOIN $key on $key.codigo = controle_funcao_empresa.id_setor_empresa";
            }
        } else if ($key == "*************") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
        }
    }

    $body_where = implode(" AND ", $body_where);

    $where = " WHERE  $body_where";
}
