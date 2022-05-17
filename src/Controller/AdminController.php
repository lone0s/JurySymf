<?php

namespace App\Controller;

use App\Entity\AuthUser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin', name: 'admin')]
class AdminController extends AbstractController
{
    /*#[Route('/list', name: '_listing')]
    public function userList(ManagerRegistry $doc): Response
    {
        $em = $doc->getManager();
        $userRepo = $em->getRepository(AuthUser::class);
        $users = $userRepo->findAll();
        dump($users);
        $args = array('users' => $users);
        return $this->render('lists/admin/listing_utilisateur.html.twig', $args);
    }*/

    #[Route('/listing', name: '_user_listing')]
    public function userRoleListing(ManagerRegistry $doc): Response
    {
        $em = $doc->getManager();
        $userRepo = $em->getRepository(AuthUser::class);
        $users = $userRepo->findAll();
        $args = array('users' => $users);
        return $this->render('lists/admin/listing_utilisateurs.html.twig', $args);
    }

    #[Route('/droits/elever/{id_user}', name: '_add_admin')]
    public function addAdminAction(ManagerRegistry $doc, $id_user): Response
    {
        $hasAccess = $this -> isGranted('ROLE_SUPER_ADMIN');
        $this -> denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
        if($hasAccess) {
            $em = $doc->getManager();
            $userRepo = $em->getRepository(AuthUser::class);
            $user = $userRepo->find($id_user);
            if ($user) {
                $user->setRoles(array('ROLE_ADMIN'));
                $em->flush();
                $this->addFlash('info', 'Ajout admin réussi !');
            } else {
                $this->addFlash('info', 'Utilisateur inconnu !');
            }
        }
        return $this->redirectToRoute('admin_user_listing');
    }
}
