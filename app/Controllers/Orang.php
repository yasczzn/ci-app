<?php

namespace App\Controllers;

use App\Models\OrangModel;

use \Dompdf\Dompdf;

class Orang extends BaseController
{
    protected $orangModel;

    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') :
        1;

        $keyword = $this->request->getVar('keyword');
        if($keyword) {
            $orang = $this->orangModel->search($keyword);
        }  else {
            $orang = $this->orangModel;
        }

        $data = [
            'title' => 'Daftar Orang',
            // 'orang' => $this->orangModel->findAll() 
            'orang' => $orang->paginate(4, 'orang'),
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage
        ];

        return view('orang/index', $data);
    }

    public function printpdf($download=false)
    {
        $dompdf = new Dompdf();

        $data = [
            'orang' => $this->orangModel->findAll()
        ];
        $html = view('orang/printpdf', $data);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        if($download)
            $dompdf->stream('data orang.pdf', array('Attachment' => 1));
        else
            $dompdf->stream('data orang.pdf', array('Attachment' => 0));
    }

}
