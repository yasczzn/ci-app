<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'            
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
        ];
        return view('pages/about', $data);
    }

    public function form()
    {
        $data = [
            'title' => 'Form'
        ];
        echo view('pages/form', $data);
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
