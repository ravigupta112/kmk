<?php

use MVC\BaseModel;

class ModelsHcp extends BaseModel
{
    
    /**
     * Get current model table
     * @return string
     */
    protected function getTableName()
    {
        return $this->tblHcp;
    }
    
    /**
     * Search HCP by HCO ID
     * @param integer $id
     * @param array $searchParams
     * @return array
     * @throws Exception
     */
    public function findHcpByHcoId($id, $searchParams = [])
    {
        try {
            $id = abs($id);
            $conditionArr = [];
            
            // Prepare the conditions
            if (isset($searchParams['hcp_name']) && $searchParams['hcp_name'] != "") {
                $conditionArr[] = " hcp.hcp_name = '{$this->db->escape($searchParams['hcp_name'])}' ";
            }

            if (isset($searchParams['hcp_zip']) && $searchParams['hcp_zip'] != "") {
                $conditionArr[] = " hcp.zip = '{$this->db->escape($searchParams['hcp_zip'])}' ";
            }

            if (isset($searchParams['specialty']) && $searchParams['specialty'] != "") {
                $conditionArr[] = " s.specialty_name = '{$this->db->escape($searchParams['specialty'])}' ";
            }

            // Prepare the SQL query
            $sql = "SELECT  hcp.id AS hcp_id, hcp.hcp_name, hcp.city AS hcp_city, hcp.state AS hcp_state, hcp.zip AS hcp_zip "
                    . "   , s.id AS spacialty_id, s.specialty_name "
                    . " FROM {$this->table} AS hcp "
                    . " INNER JOIN {$this->tblHcoHcp} AS h2 ON hcp.id = h2.hcp_id "
                    . " INNER JOIN {$this->tblHco} AS hco ON hco.id = h2.hco_id AND hco.is_deleted != {$this->deleted} "
                    . " LEFT JOIN {$this->tblSpecialty} AS s ON s.id = hcp.specialty_id AND s.is_deleted != {$this->deleted} "
                    . " WHERE hco.id = {$id} AND hcp.is_deleted != {$this->deleted} ";

            if (!empty($conditionArr)) {
                $sql .= " AND " . implode(" AND ", $conditionArr);
            }

            $sql .= " GROUP BY hcp.id ";

            // Execute Query
            $query = $this->db->query($sql);
            $data = [];
            if (!empty($query->rows)) {
                $data = $query->rows;
            }
            return $data;
        } catch (\Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

}
