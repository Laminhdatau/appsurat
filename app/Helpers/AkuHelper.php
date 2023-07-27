<?php
use Ramsey\Uuid\Uuid;



if (!function_exists('auto_uuid')) {
    function auto_uuid()
    {
        return Uuid::uuid4()->toString();
    }
}


if (!function_exists('auto_inc')) {
    function auto_inc($table)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        // Insert data kosong untuk memicu auto increment
        $builder->insert([]);
        // Dapatkan ID terakhir yang di-generate oleh auto increment
        $lastId = $db->insertID();

        return $lastId;
    }
}
