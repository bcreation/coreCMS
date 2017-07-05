<?php

/**
 * Undocumented class
 */
class PagesController extends Controller{
/**
 * Return the view by passing thez id of post
 *
 * @param [type] $id
 * @return void
 */
    function view($id){
        $this->loadModel('Post');      
        $d['page'] = $this->Post->findFirst(
            array(
                'conditions' => array(
                'id'=>$id,
                'post_online'=>1,
                'post_type'=>'work'
                )
            )
        );
        if ( empty($d['page'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

/**
 * Fetch Pages for menu 
 *
 * @return void
 */
    function getMenu(){
        $this->loadModel('Post');      
        return $this->Post->find(
            array(
                'conditions' => array(
                'post_online'=>1,
                'post_type'=>'work'
                )
            )
            );
    }

}
