<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\User;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher) 
    {
        $users = new Users();
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $users->setPassword(password_hash($users->getPassword(), PASSWORD_DEFAULT));
            $entityManager->persist($users);
            $entityManager->flush();
            $this->addFlash(type: 'exito', message: Users::REGISTRO_CORRECTO);
            return $this->redirectToRoute(route: 'app_registro');
        }


        

        return $this->render('registro/index.html.twig', [
            'controller_name' => 'dear friend',
            'welcome_message' => 'This is your secret place to comment your series, your movies, and your books.',
            'welcome_message2' => 'In case you need some suggestion, we allow ourselves to indicate below some lists of recommendations:',
            'formulario'=>$form->createView()
        ]);
    }
}
