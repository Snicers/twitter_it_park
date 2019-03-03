<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/{id}", name="user",requirements={"id"="\d+"}))
     */
    public function index($id)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);

        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'posts' => $user->getPosts
        ]);
    }

    /**
     * @Route("/profile", name ="profile")
     */
    public function profile()
    {

        $user = $this->getUser();
        $postsRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postsRepository->findByUser($user);

        return $this->render('user/profile.html.twig', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }
}
