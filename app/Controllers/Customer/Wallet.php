<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\Permission;
use CodeIgniter\HTTP\RedirectResponse;

class Wallet extends BaseController
{

    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    /**
     * @description This method provides wallet page view
     * @return RedirectResponse|void
     */
    public function index()
    {
        $isLoggedInCustomer = $this->session->isLoggedInCustomer;
        if (!isset($isLoggedInCustomer) || $isLoggedInCustomer != TRUE) {
            return redirect()->to(site_url('Login'));
        } else {
            $settings = get_settings();
            $table = DB()->table('nb_fund_request');
            $table->join('nb_payment_method', 'nb_payment_method.payment_method_id = nb_fund_request.payment_method_id');
            $data['fund_request'] = $table->where('nb_fund_request.customer_id', $this->session->cusUserId)->get()->getResult();

            $tableBal = DB()->table('nb_customer');
            $data['cust'] = $tableBal->where('customer_id', $this->session->cusUserId)->get()->getRow();


            $data['keywords'] = $settings['meta_keyword'];
            $data['description'] = $settings['meta_description'];
            $data['title'] = 'Wallet';

            $data['page_title'] = 'Wallet';
            $data['menu_active'] = 'wallet';
            echo view('Theme/' . $settings['Theme'] . '/header', $data);
            echo view('Theme/' . $settings['Theme'] . '/Customer/menu');
            echo view('Theme/' . $settings['Theme'] . '/Customer/walllet');
            echo view('Theme/' . $settings['Theme'] . '/footer');
        }
    }

    /**
     * @description This method provides add funds page view
     * @return RedirectResponse|void
     */
    public function add_funds()
    {
        $isLoggedInCustomer = $this->session->isLoggedInCustomer;
        if (!isset($isLoggedInCustomer) || $isLoggedInCustomer != TRUE) {
            return redirect()->to(site_url('Login'));
        } else {
            $settings = get_settings();
            $table = DB()->table('nb_fund_request');
            $data['fund_request'] = $table->where('customer_id', $this->session->cusUserId)->get()->getResult();

            $tableBal = DB()->table('nb_customer');
            $data['cust'] = $tableBal->where('customer_id', $this->session->cusUserId)->get()->getRow();


            $data['keywords'] = $settings['meta_keyword'];
            $data['description'] = $settings['meta_description'];
            $data['title'] = 'Account Add Fund';
            $data['page_title'] = 'Dashboard';
            $data['menu_active'] = 'dashboard';
            echo view('Theme/' . $settings['Theme'] . '/header', $data);
            echo view('Theme/' . $settings['Theme'] . '/Customer/menu');
            echo view('Theme/' . $settings['Theme'] . '/Customer/add_funds');
            echo view('Theme/' . $settings['Theme'] . '/footer');
        }
    }

    /**
     * @description This method provides fund action execute
     * @return RedirectResponse
     */
    public function fund_action(){
        $data['amount'] = $this->request->getPost('amount');
        $data['payment_method_id'] = $this->request->getPost('payment_method_id');
        $data['customer_id'] = $this->session->cusUserId;

        $this->validation->setRules([
            'amount' => ['label' => 'Amount', 'rules' => 'required'],
            'payment_method_id' => ['label' => 'Payment Method', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert text-white alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . '</div>');
            return redirect()->to('add_founds');
        } else {

            if($data['payment_method_id'] == '7'){
                $data['card_name'] = $this->request->getPost('card_name');
                $data['card_number'] = $this->request->getPost('card_number');
                $data['card_expiration'] = $this->request->getPost('card_expiration');
                $data['card_cvc'] = $this->request->getPost('card_cvc');
            }

            $table = DB()->table('nb_fund_request');
            $table->insert($data);
            
            $this->session->setFlashdata('message', '<div class="alert-success-m alert-success alert-dismissible" role="alert">Update successfully </div>');
            return redirect()->to('my_wallet');
        }
    }
}