<?php
/**
 * Fury_Craft : Développeur (https://dev.fury-craft.tk), YouTubeur (https://www.youtube.com/c/furycraft/) et administrateur de Fury Land (https://www.furyland.ga/)
 * @author        Fury_Craft - https://dev.fury-craft.tk
 * @copyright     Fury_Craft - All rights reserved
 * @link          http://mineweb.org/market
 * @since         ERROR
 */

class UploadController extends AppController{

    /**
     * Called when the route /Upload is called.
     */
    public function index(){
        //Load configuration
        $this->loadModel('Upload.Uploads');
        //Retrieves the last 35 logs
        $Uploads = $this->Uploads->find('all', ['order' => ['created desc'], 'limit' => 35]);

        return $this->set(compact('Uploads'));
    }

    /**
     * Called when the route /admin/xenbridge is called.
     */
    public function admin_index(){
        if($this->isConnected && $this->User->isAdmin()){
            $this->layout = 'admin';

            //Get list of logs
            $this->loadModel('Upload.Uploads');
            $Uploads = $this->Uploads->find('all', ['order' => ['id desc']]);

            if ($this->request->is('post')) {
                $Upload_level = $this->request->data["level"];
                $Upload_author = $this->request->data["author"];
                $Upload_comment = $this->request->data["description"];

                //Form validation
                if(!isset($Upload_level) || ($Upload_level < 0 || $Upload_level > 4)){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_LEVEL_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($Upload_author) || empty($Upload_author) || strlen($Upload_author) < 2 || strlen($Upload_author) > 50){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_AUTHOR_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($Upload_comment) || empty($Upload_comment) || strlen($Upload_comment) < 10){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_COMMENT_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                //Add a new log
                $this->Uploads->create();
                if(
                    $this->Uploads->save(
                        ['level' => $Upload_level, 
                        'author' => $Upload_author, 
                        'description' => $Upload_comment, 
                        'created' => date('Y-m-d H:i:s')
                   ])
                ){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_ADD_SUCCESS'), 'default.success');
                    return $this->redirect($this->referer());
                }
              
                //error occurred
                $this->Session->setFlash($this->Lang->get('UPLOADS_ERROR_OCCURED'), 'default.error');
                return $this->redirect($this->referer());
            }

            return $this->set(compact('Uploads'));
        }else{
            return $this->redirect('/');
        }
    }

    /**
     * Deletes a log according to the id passed in parameter
     * @param $id - id of the log to delete
     */
    public function admin_delete($id = null){
        if($this->isConnected && $this->User->isAdmin()){
            
            if ($this->request->is('post')){
                throw new MethodNotAllowedException();
            }

            $this->loadModel('Upload.Uploads');
            if ($this->Uploads->delete($id)){
                $this->Session->setFlash($this->Lang->get('UPLOADS_ADMIN_DELETE'), 'default.success');
            }

            return $this->redirect($this->referer());

        }else{
            return $this->redirect('/');
        }
    }

}