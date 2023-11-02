<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    //verificamos si tiene algun like y los pasamos a la variable isLiked, despues cambiamos el valor para que reaccione en el like-post.balde.php
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if( $this->post->checkLike(auth()->user())){

            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes --;

        }else{
            
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes ++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
