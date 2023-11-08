<?php

namespace App\Controllers;

use App\Models\UserInfoModel;

use Dompdf\Dompdf;


use PhpOffice\PhpWord\IOFactory;

use PhpOffice\PhpWord\PhpWord;

class User extends BaseController
{
    protected $userInfoModel;

    public function __construct()
    {
        $this->userInfoModel = new UserInfoModel();
    }

    public function index()
    {
        //menyesuaikan nomor urut data
        $currentPage = $this->request->getVar('page_user_data') ? $this->request->getVar('page_user_data') : 1;

        //fungsi cari data
        $keyword = $this->request->getVar('keyword');
        if($keyword) {
            $userdata = $this->userInfoModel->search($keyword);
        }  else {
            $userdata = $this->userInfoModel;
        }

        $data = [
            'title' => 'User Page',
            'user' => $userdata->paginate(5, 'user_data'),
            'pager' => $this->userInfoModel->pager,
            'currentPage' => $currentPage           
        ];

        return view('user/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'User Details',
            'user' => $this->userInfoModel->getUser($id)            
        ];

        //jika data kosong
        if(empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID number ' . $id . ' not found.');
        }

        return view('user/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Add User', 
        ];
        return view('user/create', $data);
    }

    public function save()
    {
        //validasi
        if(!$this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'age' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Mohon isi umur anda',
                    'numeric' => 'Mohon isi umur anda'
                ]
            ],
            'hired_since' => 'required',
            'image' => [
                'rules' => 'max_size[image,5000]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File bukan berupa gambar',
                    'mime_in' => 'File bukan berupa gambar'
                ]
            ],
            'file' => [
                'rules' => 'max_size[file,5000]|ext_in[file,doc,docx,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'File tidak terbaca'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        //get image 
        $imageFile = $this->request->getFile('image');
        //if picture not uploaded
        if($imageFile->getError() == 4) {
            $imageName = 'default.jpg';
        } else {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('img', $imageName);
        }

        //get file 
        $docFile = $this->request->getFile('file');
        //if file not uploaded
        if($docFile->getError() == 4) {
            $docName = '';
        } else {
            $docName = $docFile->getRandomName();
            $docFile->move('file', $docName);
        }

        $user = explode(".", $docName);
        $data = $user[1];

        if($data != "pdf") {

            require_once "../vendor/PhpOffice/PhpWord/bootstrap.php";

            $data = "html";
            $wordDocPath = FCPATH . "file" . DIRECTORY_SEPARATOR . $docName;

            $phpWord = \PhpOffice\PhpWord\IOFactory::load($wordDocPath);
            $section = $phpWord->addSection();
        
            $_filename = $user[0];
            $source = FCPATH . "file" . DIRECTORY_SEPARATOR . "{$_filename}.html";
        
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
            $objWriter->save($source);

            // $docName = $_filename . "." . $data;
        } 
        
        $this->userInfoModel->save([
            'id' => $this->request->getVar('id'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'age' => $this->request->getVar('age'),
            'hired_since' => $this->request->getVar('hired_since'),
            'image' => $imageName,
            'file' => $docName
        ]);

        session()->setFlashdata('notification', 'Data berhasil ditambah!');

        return redirect()->to('/user');
    }

    public function delete($id)
    {
        //delete picture 
        $user = $this->userInfoModel->find($id);
        if($user['image'] != 'default.jpg') {
            unlink('img/' . $user['image']);
        }   
        
        //delete file 
        $user = $this->userInfoModel->find($id);
        if(!empty($user['file'])) {
            unlink('file/' . $user['file']);
        }

        //delete data
        $this->userInfoModel->delete($id);
        session()->setFlashdata('notification', 'Data berhasil dihapus!');
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User', 
            'user' => $this->userInfoModel->getUser($id)
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {
        //validasi
        if(!$this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'age' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Mohon isi umur anda',
                    'numeric' => 'Mohon isi umur anda'
                ]
            ],
            'hired_since' => 'required',
            'image' => [
                'rules' => 'max_size[image,5000]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File bukan berupa gambar',
                    'mime_in' => 'File bukan berupa gambar'
                ]
            ],
            'file' => [
                'rules' => 'max_size[file,5000]|ext_in[file,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'File tidak terbaca'
                ]
            ]
        ])) {
            return redirect()->to('/user/edit/' . $this->request->getVar('id'))->withInput();
        }

        $imageFile = $this->request->getFile('image');
        //change image check
        if($imageFile->getError() == 4) {
            $imageName = $this->request->getVar('oldImage');
        } else {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('img', $imageName);
            if($imageName != 'default.jpg') {
                if($this->request->getVar('oldImage') != 'default.jpg') {
                    unlink('img/' . $this->request->getVar('oldImage'));
                }
            }    
        }

        $docFile = $this->request->getFile('file');
        //change file check
        if($docFile->getError() == 4) {
            $docName = $this->request->getVar('oldFile');
        } else {
            $docName = $docFile->getRandomName();
            $docFile->move('file', $docName); 
            if($docName != $this->request->getVar('oldFile')) {
                unlink('file/' . $this->request->getVar('oldFile'));
            }
        }

        $this->userInfoModel->save([
            'id' => $id,
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'age' => $this->request->getVar('age'),
            'hired_since' => $this->request->getVar('hired_since'),
            'image' => $imageName,
            'file' => $docName
        ]);

        session()->setFlashdata('notification', 'Data berhasil diubah!');

        return redirect()->to('/user');
    }

    public function print($id, $download=false)
    {
        $dompdf = new Dompdf();
        $dompdf->set_option("enable_remote", true);

        $data = [
            'user' => $this->userInfoModel->getUser($id)
        ];
        $html = view('user/print', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        if($download) {
            $dompdf->stream('data user.pdf', array('Attachment' => 1));
        }

        return $dompdf->stream('data user.pdf', array('Attachment' => 0));
    }

}
