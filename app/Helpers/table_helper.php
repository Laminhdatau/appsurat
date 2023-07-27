<?php

if (!function_exists('ambilIdTemp')) {
    /**
     * Get the id_template_wil or id_wilayah data from the table based on the given conditions.
     *
     * @param string $idType  The ID type to fetch ('id_template_wil' or 'id_wilayah')
     * @param array  $conditions The conditions to fetch the data (optional)
     *
     * @return array
     */
    function ambilIdTemp(string $idType, array $conditions = [])
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_template_wil');

        if (!empty($conditions)) {
            $builder->where($conditions);
        }

        $results = $builder->select('id_surat, ' . $idType)->get()->getResult();

        $data = [];
        foreach ($results as $result) {
            $idSurat = $result->id_surat;
            $ids = explode(',', $result->$idType);

            if (count($ids) === 1) {
                $data[$idSurat] = $ids[0];
            } else {
                $data[$idSurat] = $ids;
            }
        }

        return $data;
    }
}
