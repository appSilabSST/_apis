<?php


if (isset($_GET["group_by"])) {
    $dados = json_decode(base64_decode($_GET['group_by']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            $body_group_by[] = $tab . "." . $value;
        } elseif ($tab == '************') {
            $body_group_by[] = $tab . "." . $value;
        }
    }

    $body_group_by = implode(",", $body_group_by);

    $group_by = " GROUP BY $body_group_by";
}
