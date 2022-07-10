<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Product extends BaseController
{
    use ResponseTrait;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index()
    {
        $data = $this->model->findAll();

        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->getWhere(['product_id' => $id])->getResult();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found for id '. $id);
        }
    }

    public function create()
    {
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price')
        ];

        $this->model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Data Saved"
            ],
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $input = $this->request->getRawInput();

        $data = [
            'product_name' => $input['product_name'],
            'product_price' => $input['product_price'],
        ];

        $this->model->update($id, $data);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated',
            ],
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);

        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ],
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found for id '. $id);
        }
    }
}
