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
 * Return the view by passing thez id of post
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



}
