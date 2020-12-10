<?php

use MVC\Controller;

class ControllersApp extends Controller
{

    public function hcoDetails($param)
    {

        try {
            $model = $this->model('hco');
            $id = isset($param['id']) ? intval($param['id']) : 0;
            $data = $model->getHcoDetails($id);
            if (empty($data)) {
                throw new \Exception("Data not found");
            }
            $this->response->setContent($data);
        } catch (\Exception $ex) {
            $this->response->setContent([
                'message' => $ex->getMessage()
            ]);
        }
        // Send Response
        $this->response->sendStatus(200);
    }

    public function deleteHcp($param)
    {
        try {
            $model = $this->model('hcp');
            $id = isset($param['id']) ? intval($param['id']) : 0;
            $data['deleted'] = 0;
            if ($model->deleteById($id)) {
                $data['deleted'] = 1;
            }
            $this->response->setContent($data);
        } catch (\Exception $ex) {
            $this->response->setContent([
                'message' => $ex->getMessage()
            ]);
        }
        // Send Response
        $this->response->sendStatus(201);
    }

    public function searchHcp($param)
    {
        try {
            $model = $this->model('hcp');
            $id = isset($param['id']) ? intval($param['id']) : 0;

            $searchArr = [];
            if (isset($_POST['hcp_name']) && trim($_POST['hcp_name']) != "") {
                $searchArr['hcp_name'] = trim($_POST['hcp_name']);
            }

            if (isset($_POST['specialty']) && trim($_POST['specialty']) != "") {
                $searchArr['specialty'] = trim($_POST['specialty']);
            }
            if (isset($_POST['hcp_zip']) && trim($_POST['hcp_zip']) != "") {
                $searchArr['hcp_zip'] = trim($_POST['hcp_zip']);
            }

            $data = $model->findHcpByHcoId($id, $searchArr);
            if (empty($data)) {
                throw new \Exception("Data not found");
            }
            $this->response->setContent($data);
        } catch (\Exception $ex) {
            $this->response->setContent([
                'message' => $ex->getMessage()
            ]);
        }
        // Send Response
        $this->response->sendStatus(200);
    }

}
