<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaMagangModel;
use App\Models\UniversitasModel;
use App\Models\BidangModel;

class Pesertamagang extends BaseController
{
    protected $magangModel;

    public function __construct()
    {
        $this->magangModel = new PesertaMagangModel();
        $this->universitasModel = new UniversitasModel();
        $this->bidangModel = new BidangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta Magang',
            'isi' => 'peserta/index',
            'data' => $this->magangModel->getAll()

        ];
        // echo json_encode($data);
        echo view('layout_admin/v_wrapper',$data);
    }

    public function show($id)
    {
        if ($this->magangModel->id_exists($id)) {
            $data = [
                'title' => 'Data Peserta Magang',
                'isi' => 'peserta/show',
                'data' => $this->magangModel->getID($id)

            ];
            // echo view('peserta/show'.$id);
            echo view('layout_admin/v_wrapper', $data);
        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Peserta Magang',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function new()
    {
        $data = [
            'title' => 'Form Tambah Peserta Magang',
            'univ' => $this->universitasModel->findAll(),
            'bidang' => $this->bidangModel->findAll(),
            'isi'	=> 'peserta/new' 
        ];
        echo view('layout_admin/v_wrapper', $data);
    }

    public function create()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'id_bidang' => $this->request->getPost('id_bidang'),
            'id_universitas' => $this->request->getPost('id_universitas')
        ];

        $validate = $this->magangModel->insert($data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
            ];

            return redirect()->to('/pesertamagang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->magangModel->errors()
            ];

            return redirect()->to('/pesertamagang/new')->with('error', $data['message']);
        }
    }

    public function edit($id)
    {
        if ($this->magangModel->id_exists($id)) {
            $data = [
                'title' => 'Form Edit Peserta',
                'peserta' => $this->magangModel->find($id),
                'univ' => $this->universitasModel->findAll(),
                'bidang' => $this->bidangModel->findAll(),
                'isi' => 'peserta/edit'
            ];

            echo view('layout_admin/v_wrapper', $data);

        } else {
            $data = [
                'status' => 404,
                'title' => 'Data Peserta Magang',
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }

    public function update($id)
    {
        $data = [
            'id_bidang' => $this->request->getPost('id_bidang'),
            'id_universitas' => $this->request->getPost('id_universitas'),
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim')
        ];

        $validate = $this->magangModel->update($id, $data);

        if ($validate) {
            $data = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];

            return redirect()->to('/pesertamagang')->with('success', $data['message']);
        } else {
            $data = [
                'status' => 500,
                'message' => $this->magangModel->errors()
            ];

            return redirect()->to('/pesertamagang/edit/' . $id)->with('error', $data['message']);
        }
    }

    public function delete($id)
    {
        if ($this->magangModel->id_exists($id)) {
            $this->magangModel->delete($id);
            $data = [
                'status' => 200,
                'message' => 'Data berhasil dihapus',
                'isi' => 'PKL/data_pkl'
            ];

            return redirect()->to('/pesertamagang')->with('success', $data['message']);

        } else {
            $data = [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ];
            echo view('errors/html/error_404', $data);
        }
    }
    // fitur search
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data = [
            'title' => 'Data Peserta Magang',
            'peserta' => $this->magangModel->getKeyword(),
            'isi'	=> 'PKL/data_pkl'
        ];
        // echo json_encode($data);
        echo view('layout_admin/v_wrapper',$data);
    }

    // Tombol Opsi Pada Tabel
    private function _action_admin($id_magang)
    {
        $link = "
                <a data-toggle='tooltip' data-placement='top' class='btnEdit' title='Edit' value='" . $id_magang . "'>
	      		    <button type='button' class='btn btn-primary btn-sm data-toggle='modal' data-target='#modalPenarikan'><i class='fa fa-edit'></i></button>
	      	    </a>
                ";
        return $link;
    }

    //load data peserta magang
    public function loadDataAdmin()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists = $this->M_peserta_magang->get_datatables();
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nim;
                $row[] = $list->nama;
                $row[] = $list->id_universitas;
                $row[] = $this->_action_admin($list->id);
                $data[] = $row;
            }
            $output = [
                "draw"            => $this->request->getPost('draw'),
                "recordsTotal"    => $this->M_peserta_magang->count_all(),
                "recordsFiltered" => $this->M_peserta_magang->count_filtered(),
                "data"            => $data
            ];
            echo json_encode($output);
        }
    }

}
