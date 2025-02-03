<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Image_processing;
use App\Libraries\Permission;
use CodeIgniter\HTTP\RedirectResponse;

class Institute_result extends BaseController
{

    protected $validation;
    protected $session;
    protected $crop;
    protected $permission;
    protected $imageProcessing;
    private $module_name = 'Notice';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->crop = \Config\Services::image();
        $this->permission = new Permission();
        $this->imageProcessing = new Image_processing();
    }

    /**
     * @description This method provides notice page view
     * @return RedirectResponse|void
     */
    public function index()
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_institute_result');
            $data['result'] = $table->get()->getResult();


            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['mod_access']) and $data['mod_access'] == 1) {
                echo view('Admin/Institute_result/index', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method provides create page view
     * @return RedirectResponse|void
     */
    public function create(){
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['create']) and $data['create'] == 1) {
                echo view('Admin/Institute_result/create');
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method store notice
     * @return RedirectResponse
     */
    public function create_action()
    {
        $data['description'] = $this->request->getPost('description');

        $this->validation->setRules([
            'description' => ['label' => 'Description', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/institute_result_create');
        } else {


            $table = DB()->table('nb_institute_result');
            $table->insert($data);
            $resultId = DB()->insertID();

            if (!empty($_FILES['pdf']['name'])) {
                $target_dir = FCPATH . '/uploads/institute_result/' . $resultId . '/';
                $this->imageProcessing->directory_create($target_dir);

                $file = $this->request->getFile('pdf');

                $namePic = $file->getRandomName();
                $file->move($target_dir, $namePic);
                $dataImg['pdf'] = $namePic;

                $noticeTable = DB()->table('nb_institute_result');
                $noticeTable->where('institute_result_id',$resultId)->update($dataImg);
            }

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Create Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/institute_result_create');

        }
    }

    /**
     * @description This method provides update page view
     * @param int $notice_id
     * @return RedirectResponse|void
     */
    public function update($institute_result_id)
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_institute_result');
            $data['result'] = $table->where('institute_result_id', $institute_result_id)->get()->getRow();


            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['update']) and $data['update'] == 1) {
                echo view('Admin/Institute_result/update', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method update notice
     * @return RedirectResponse
     */
    public function update_action()
    {
        $institute_result_id = $this->request->getPost('institute_result_id');
        $data['description'] = $this->request->getPost('description');

        $this->validation->setRules([
            'description' => ['label' => 'Description', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/institute_result_update/' . $institute_result_id);
        } else {
            $table = DB()->table('nb_institute_result');
            $table->where('institute_result_id', $institute_result_id)->update($data);

            if (!empty($_FILES['pdf']['name'])) {
                $target_dir = FCPATH . '/uploads/institute_result/' . $institute_result_id . '/';
                $this->imageProcessing->directory_create($target_dir);

                $oldImg = get_data_by_id('pdf','nb_institute_result','institute_result_id',$institute_result_id);
                if ((!empty($oldImg)) && (file_exists($target_dir))) {
                    $this->imageProcessing->image_unlink($target_dir . '/' . $oldImg);
                }

                $file = $this->request->getFile('pdf');

                $namePic = $file->getRandomName();
                $file->move($target_dir, $namePic);
                $dataImg['pdf'] = $namePic;

                $noticeTable = DB()->table('nb_institute_result');
                $noticeTable->where('institute_result_id',$institute_result_id)->update($dataImg);
            }
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Update Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/institute_result_update/' . $institute_result_id);
        }
    }


    /**
     * @description This method delete notice
     * @param int $institute_result_id
     * @return RedirectResponse
     */
    public function delete($institute_result_id){
        helper('filesystem');
        $target_dir = FCPATH . '/uploads/institute_result/'.$institute_result_id;
        if (file_exists($target_dir)) {
            delete_files($target_dir, TRUE);
            rmdir($target_dir);
        }

        $table = DB()->table('nb_institute_result');
        $table->where('institute_result_id', $institute_result_id)->delete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Delete Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return redirect()->to('admin/institute_result');
    }



}
