<?php
if (isset($_GET["order_by"])) {
    $dados = json_decode(base64_decode($_GET['order_by']), true);

    foreach ($dados as $key => $value) {
        if ($key == "######") {
            $body_order_by[] = "######." . $key . " :" . $key;
            $option_value[":$key"] = $value;
            if (strpos($join, '"######."') === false) {
                $join .= "########";
            }
        } else {
            $body_order_by[] = $table . "." . $key . " :" . $key;
            $option_value[":$key"] = $value;
        }
    }
    $order_by = " ORDER BY  $body_order_by";
}
