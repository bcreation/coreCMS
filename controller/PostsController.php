<?php

/**
 * Undocumented class
 */
class PostsController extends Controller{

/**
 * Return the index by passing the id of post
 *
 * @param [type] $id
 * @return void
 */
    function index(){
        $perPage = 1;
        $this->loadModel('Post');  

        $condition =  array(
                    'online' => 1,
                    'type' => 'post'
                ) ;

        $d['posts'] = $this->Post->find(array(
                'conditions' => $condition,
                'limit' => ($perPage*( $this->request->page-1).','. $perPage)
            ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total'] / $perPage);
        if ( empty($d['posts'])){
            $this->e404('Page introuvable');
        }
        
        $this->set($d);
    }
    
    /**
     * Return the view by passing the id of post
     *
     * @param [type] $id
     * @return void
     */
    function view($id, $slug){
        
        $perPage = 1;
        $this->loadModel('Post');      
        $d['post'] = $this->Post->findFirst(
            array(
                'fields' => 'id, slug, content, name',
                'conditions' => array(
                'id'=>$id,
                'online'=> 1,
                'type'=>'post'                
                )
            )
        );
        if ( empty($d['post'])){
            $this->e404('Page introuvable');
        }
       
        if( $slug !== $d['post']->slug){
            $this->redirect("posts/view/id:$id/slug:".$d['post']->slug, 301);
        }
        $this->set($d);
    }


/**
 * Return the index by passing thez id of post
 *
 * @param [type] $id
 * @return void
 */
    function admin_index(){
        $perPage = 10;
        $this->loadModel('Post');  

        $d['posts'] = $this->Post->find(array(
                'fields' => 'id, name, online',
                'limit' => ($perPage*( $this->request->page-1).','. $perPage)
            ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total'] / $perPage);
        if ( empty($d['posts'])){
            $this->e404('Page introuvable');
        }

        $this->set($d);
    }

    /**
     * Delete a item
     *
     * @param [type] $id
     * @return void
     */
    public function admin_edit($id = null){
        $this->loadModel('Post');  
        $d['id'] = '';
        if($this->request->data){
            $this->Post->save($this->request->data);
            $id = $this->Post->id;
        }
        if(isset($id)){
            $this->request->data = $this->Post->findFirst(
                array('conditions' => array('id' => $id))
            );  
            $d['id'] = $id;
        }
        $this->set($d);
    }

    /**
     * Delete a item
     *
     * @param [type] $id
     * @return void
     */
    public function admin_delete($id){
        $this->loadModel('Post');  
        $this->Session->setFlash("Contenu supprimé");
        //$this->Post->delete($id);  
        $this->redirect("admin/posts/index");
    }
}
