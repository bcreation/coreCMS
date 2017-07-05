<?php

/**
 * Undocumented class
 */
class PostsController extends Controller{

    /**
 * Return the index by passing thez id of post
 *
 * @param [type] $id
 * @return void
 */
    function index(){
        $perPage = 1;
        $this->loadModel('Post');  

        $condition =  array(
                    'post_online' => 1,
                    'post_type' => 'post'
                ) ;

        $d['posts'] = $this->Post->find(array(
                'conditions' => $condition,
                'limit' => $perPage
            ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total'] / $perPage);
        if ( empty($d['posts'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

/**
 * Return the view by passing thez id of post
 *
 * @param [type] $id
 * @return void
 */
    function view($id){
        $perPage = 1;
        $this->loadModel('Post');      
        $d['page'] = $this->Post->findFirst(
            array(
                'conditions' => array(
                'id'=>$id,
                'post_online'=> 1,
                'post_type'=>'post'                
                )
            )
        );
        if ( empty($d['page'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }



}
