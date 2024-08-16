<?php

function getStatus($status)
{

    switch ($status) {
        case '1':
            $lable = '<span class="badge text-bg-primary">Sedang dipinjam</span>';
            break;

        case '2':
            $lable = '<span class="badge text-bg-success">Sudah dikembalikan</span>';
            break;

        default:
            $lable = "";
            break;
    }
    return $lable;
}
