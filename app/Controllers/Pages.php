<?php

namespace App\Controllers;

use App\Models\UserInfoModel;

class Pages extends BaseController
{
    protected $userInfoModel;

    public function __construct()
    {
        $this->userInfoModel = new UserInfoModel();
    }

    public function index()
    {
        session();

        $currentPage = $this->request->getVar('page_user_data') ? $this->request->getVar('page_user_data') : 1;

        //fungsi cari data
        $keyword = $this->request->getVar('keyword');
        if($keyword) {
            $userdata = $this->userInfoModel->search($keyword);
        }  else {
            $userdata = $this->userInfoModel;
        }

        $data = [
            'title' => 'Home',    
            'user' => $userdata->paginate(6, 'user_data'),
            'pager' => $this->userInfoModel->pager,
            'currentPage' => $currentPage     
        ];

        session()->setFlashdata('notification');

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
        ];
        return view('pages/about', $data);
    }

    public function contact() 
    { 
        $data = [
            'title' => 'Contact',
            'address' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. ABC no. 5',
                    'kota' => 'Tangerang'
                ],
                [
                    'tipe' => 'apartemen',
                    'alamat' => 'Jl. DEF no. 2',
                    'kota' => 'Solo'
                ],
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. GHI no. 30',
                    'kota' => 'Bogor'
                ],
                [
                    'tipe' => 'ruko',
                    'alamat' => 'Jl. JKL no. 7',
                    'kota' => 'Jakarta Selatan'
                ]
            ]
        ];
        echo view('pages/contact', $data);
    }
}
