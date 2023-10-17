<?php

namespace App\Controllers;

use App\Models\UserInfoModel;

use \Dompdf\Dompdf;

class User extends BaseController
{
    protected $userInfoModel;

    public function __construct()
    {
        $this->userInfoModel = new UserInfoModel();
    }

    public function index()
    {

        $currentPage = $this->request->getVar('page_user_data') ? $this->request->getVar('page_user_data') :
        1;

        $keyword = $this->request->getVar('keyword');
        if($keyword) {
            $userdata = $this->userInfoModel->search($keyword);
        }  else {
            $userdata = $this->userInfoModel;
        }

        $data = [
            'title' => 'User Page',
            'user' => $userdata->paginate(4, 'user_data'),
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
            'name' => 'required',
            'email' => 'required',
            'image' => [
                'rules' => 'max_size[image,5000]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Picture size too big',
                    'is_image' => 'Please choose an image',
                    'mime_in' => 'Please choose an image'
                ]
            ],
            'file' => [
                'rules' => 'max_size[file,5000]|ext_in[file,txt,docx,pptx,xlsx,pdf]',
                'errors' => [
                    'max_size' => 'File size too big',
                    'mime_in' => 'Please choose a file'
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
        //if picture not uploaded
        if($docFile->getError() == 4) {
            $docName = '';
        } else {
            $docName = $docFile->getRandomName();
            $docFile->move('file', $docName);
        }


        $this->userInfoModel->save([
            'id' => $this->request->getVar('id'),
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'image' => $imageName,
            'file' => $docName
        ]);

        session()->setFlashdata('notification', 'Data successfully added!');

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
        if($user['file']) {
            unlink('file/' . $user['file']);
        }

        $this->userInfoModel->delete($id);
        session()->setFlashdata('notification', 'Data successfully deleted!');
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
            'name' => 'required',
            'email' => 'required',
            'image' => [
                'rules' => 'max_size[image,5000]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Picture size too big',
                    'is_image' => 'Please choose an image',
                    'mime_in' => 'Please choose an image'
                ]
                ],
                'file' => [
                    'rules' => 'max_size[file,5000]|ext_in[file,txt,docx,pptx,xlsx,pdf]',
                    'errors' => [
                        'max_size' => 'File size too big',
                        'mime_in' => 'Please choose a file'
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
                unlink('img/' . $this->request->getVar('oldImage'));
            }    
        }

        $docFile = $this->request->getFile('file');
        //change file check
        if($docFile->getError() == 4) {
            $docName = $this->request->getVar('oldFile');
        } else {
            $docName = $docFile->getRandomName();
            $docFile->move('file', $docName); 
        }

        $this->userInfoModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'image' => $imageName,
            'file' => $docName
        ]);

        session()->setFlashdata('notification', 'Data successfully updated!');

        return redirect()->to('/user');
    }

    public function print($id, $download=false)
    {
        $dompdf = new Dompdf();

        $data = [
            'user' => $this->userInfoModel->getUser($id)
        ];
        $html = view('user/print', $data);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'potrait');
        $dompdf->render();
        if($download)
            $dompdf->stream('data user.pdf', array('Attachment' => 1));
        else
            $dompdf->stream('data user.pdf', array('Attachment' => 0));
    }

}
