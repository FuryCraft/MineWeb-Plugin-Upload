<?php
/**
 * Fury_Craft : Développeur (https://dev.fury-craft.tk), YouTubeur (https://www.youtube.com/c/furycraft/) et administrateur de Fury Land (https://www.furyland.ga/)
 * @author        Fury_Craft - https://dev.fury-craft.tk
 * @copyright     Fury_Craft - All rights reserved
 * @link          http://mineweb.org/market
 * @since         ERROR
 */

class UploadsController extends AppController{

    /**
     * Called when the route /uploads is called.
     */
    public function index(){
        //Load configuration
        $this->loadModel('Upload.Uploads');
        //Retrieves the last 35 logs
        $uploads = $this->Uploads->find('all', ['order' => ['created desc'], 'limit' => 35]);

        return $this->set(compact('uploads'));
    }

    /**
     * Called when the route /admin/xenbridge is called.
     */
    public function admin_index(){
        if($this->isConnected && $this->User->isAdmin()){
            $this->layout = 'admin';

            //Get list of logs
            $this->loadModel('Uploads.Uploads');
            $uploads = $this->Uploads->find('all', ['order' => ['id desc']]);

            if ($this->request->is('post')) {
                $uploads_level = $this->request->data["level"];
                $uploads_author = $this->request->data["author"];
                $uploads_comment = $this->request->data["description"];

                //Form validation
                if(!isset($uploads_level) || ($uploads_level < 0 || $uploads_level > 4)){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_LEVEL_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($uploadslog_author) || empty($uploads_author) || strlen($uploads_author) < 2 || strlen($uploads_author) > 50){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_AUTHOR_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($uploads_comment) || empty($uploads_comment) || strlen($uploads_comment) < 10){
                    $this->Session->setFlash($this->Lang->get('UPLOADS_COMMENT_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                //Add a new log
                $this->Uploads->create();
                if(
                    $this->Uploads->save(
                        ['level' => $uploads_level, 
                        'author' => $uploads_author, 
                        'description' => $uploads_comment, 
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

            return $this->set(compact('uploads'));
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

            $this->loadModel('Uploads.Uploads');
            if ($this->Uploads->delete($id)){
                $this->Session->setFlash($this->Lang->get('UPLOADS_ADMIN_DELETE'), 'default.success');
            }

            return $this->redirect($this->referer());

        }else{
            return $this->redirect('/');
        }
    }

}