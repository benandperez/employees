<?php

namespace App\Controller;

use App\Entity\SubArea;
use App\Form\AreaSearchType;
use App\Form\SubareaSearchType;
use App\Form\SubAreaType;
use App\Repository\SubAreaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sub/area")
 */
class SubAreaController extends AbstractController
{
    /**
     * @Route("/", name="sub_area_index", methods={"GET"})
     */
    public function index(SubAreaRepository $subAreaRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $form = $this->createForm(SubareaSearchType::class, null);
        $form->handleRequest($request);
        $data = null;

        if (isset($request->query->get('subarea_search')['value'])){
            $data = $request->query->get('subarea_search')['value'];
        }

        if (isset($data)){
            $subarea = $subAreaRepository->findSubarea($data);
        }else{
            $subarea = $subAreaRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $subarea, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->renderForm('sub_area/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form
        ]);
    }

    /**
     * @Route("/new", name="sub_area_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subArea = new SubArea();
        $form = $this->createForm(SubAreaType::class, $subArea);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $subArea->setCreatedAt(new \DateTime());
            $subArea->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subArea);
            $entityManager->flush();

            return $this->redirectToRoute('sub_area_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_area/new.html.twig', [
            'sub_area' => $subArea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sub_area_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SubArea $subArea): Response
    {
        $form = $this->createForm(SubAreaType::class, $subArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subArea->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sub_area_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_area/edit.html.twig', [
            'sub_area' => $subArea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sub_area_delete", methods={"POST"})
     */
    public function delete(Request $request, SubArea $subArea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subArea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subArea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sub_area_index', [], Response::HTTP_SEE_OTHER);
    }
}
