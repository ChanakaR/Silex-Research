<?php
/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/19/16
 * Time: 1:20 PM
 */

namespace MyControllers;

use Silex\Application;

class BlogController
{
    private  $blogPosts = array(
        1 => array(
            'date'      => '2011-03-29',
            'author'    => 'Michel',
            'title'     => 'Title for post 1',
            'body'      => 'Hi All, We have rendered a blog post using silex successfully. some text description about blog. This is the blog body.',
        ),
        2 => array(
            'date'      => '2011-03-29',
            'author'    => 'Kevin',
            'title'     => 'Title for post 2',
            'body'      => 'Hi All, We have rendered a blog post using silex successfully. some text description about blog. This is the blog body.',
        ),
        3 => array(
            'date'      => '2011-03-29',
            'author'    => 'Alice',
            'title'     => 'Title for post 3',
            'body'      => 'Hi All, We have rendered a blog post using silex successfully. some text description about blog. This is the blog body.',
        ),
        4 => array(
            'date'      => '2011-03-29',
            'author'    => 'Bob',
            'title'     => 'Title for post 4',
            'body'      => 'Hi All, We have rendered a blog post using silex successfully. some text description about blog. This is the blog body.',
        ),
        5 => array(
            'date'      => '2011-03-29',
            'author'    => 'Peter',
            'title'     => 'Title for post 5',
            'body'      => 'Hi All, We have rendered a blog post using silex successfully. some text description about blog. This is the blog body.',
        ),
    );

    public function showAll()
    {
        $output = '';
        foreach ($this->blogPosts as $post) {
            $output .= "<h1 style='color: #42a5f5;'>{$post['title']}</h1>";
            $output .= "<p>{$post['body']}<br>Author : {$post['author']}</p>";
        }
        return $output;
    }

    public function showById($id,Application $app){
        if(!isset($this->blogPosts[$id])){
            $app->abort(404,"Post id is invalid");
        }
        $post = $this->blogPosts[$id];
        return  "<h1>{$post['title']}</h1>".
                "<p>{$post['body']}</p>";
    }
}
