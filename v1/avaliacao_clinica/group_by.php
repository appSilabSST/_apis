<?php


if (isset($_GET["group_by"])) {
    $dados = json_decode(base64_decode($_GET['group_by']), true);

    foreach ($dados as $key => $value) {
        if ($key == "######") {
            $body_group_by[] = "######." . $key . " :" . $key;
            $option_value[":$key"] = $value;
            if (strpos($join, '"######."') === false) {
                $join .= "########";
            }
        } else {
            $body_group_by[] = $table . "." . $key . " :" . $key;
            $option_value[":$key"] = $value;
        }
    }
    $group_by = " GROUP BY $body_group_by";
}
