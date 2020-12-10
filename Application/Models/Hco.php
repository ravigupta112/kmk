<?php

use MVC\BaseModel;

class ModelsHco extends BaseModel
{
     /**
     * Get current model table
     * @return string
     */
    protected function getTableName()
    {
        return $this->tblHco;
    }
    
    /**
     * Get HCO details by Id
     * @param integer $id
     * @return array type
     * @throws Exception
     */
    public function getHcoDetails($id)
    {
        try{
            // Filter the paramater
            $id = abs($id);
            
            // Prepare the Query
            $sql = "SELECT h.id as hco_id, h.hco_name, h.city AS hco_city, h.state AS hco_state, h.zip AS hco_zip "
                    . "   , hcp.id AS hcp_id, hcp.hcp_name, hcp.city AS hcp_city, hcp.state AS hcp_state, hcp.zip AS hcp_zip "
                    . "   , s.id AS spacialty_id, s.specialty_name "
                    . " FROM {$this->table} AS h"
                    . " LEFT JOIN {$this->tblHcoHcp} AS h2 ON h.id = h2.hco_id "
                    . " LEFT JOIN {$this->tblHcp} AS hcp ON hcp.id = h2.hcp_id AND hcp.is_deleted != {$this->deleted} "
                    . " LEFT JOIN {$this->tblHcoSpecialty} AS hs ON h.id = hs.hco_id "
                    . " LEFT JOIN {$this->tblSpecialty} AS s ON s.id = hs.specialty_id AND s.is_deleted != {$this->deleted} "
                    . "WHERE h.id = {$id} AND h.is_deleted != {$this->deleted} ";
            
            // Query execution
            $query = $this->db->query($sql);
            $data = [];
            // Prepare the data
            if (!empty($query->rows)) {
                $hco = current($query->rows);
                $data = [
                    'hco_id' => $hco['hco_id'],
                    'hco_name' => $hco['hco_name'],
                    'hco_city' => $hco['hco_city'],
                    'hco_state' => $hco['hco_state'],
                    'hco_zip' => $hco['hco_zip']
                ];
                foreach ($query->rows as $val) {
                    if (isset($val['hcp_id'])) {
                        $data['hcp'][$val['hcp_id']] = [
                            'hcp_name' => $val['hcp_name'],
                            'hcp_city' => $val['hcp_city'],
                            'hcp_state' => $val['hcp_state'],
                            'hcp_zip' => $val['hcp_zip']
                        ];
                    }
                    if (isset($val['spacialty_id'])) {
                        $data['speciality'][$val['spacialty_id']] = [
                            'specialty_name' => $val['specialty_name']
                        ];
                    }
                }
            }
            return $data;
        } catch (\Exception $ex){
            throw new Exception($ex->getMessage());
        }
        
    }

}
