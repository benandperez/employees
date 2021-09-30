<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaSearchType;
use App\Form\AreaType;
use App\Form\EmployeesSearchType;
use App\Repository\AreaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/area")
 */
class AreaController extends AbstractController
{
    /**
     * @Route("/", name="area_index", methods={"GET"})
     */
    public function index(AreaRepository $areaRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $form = $this->createForm(AreaSearchType::class, null);
        $form->handleRequest($request);
        $data = null;

        if (isset($request->query->get('area_search')['value'])){
            $data = $request->query->get('area_search')['value'];
        }

        if (isset($data)){
            $area = $areaRepository->findArea($data);
        }else{
            $area = $areaRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $area, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->renderForm('area/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form
        ]);
    }

    /**
     * @Route("/new", name="area_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $area = new Area();
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area->setCreatedAt(new \DateTime());
            $area->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($area);
            $entityManager->flush();

            return $this->redirectToRoute('area_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/new.html.twig', [
            'area' => $area,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="area_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Area $area): Response
    {
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('area_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/edit.html.twig', [
            'area' => $area,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="area_delete", methods={"POST"})
     */
    public function delete(Request $request, Area $area): Response
    {
        if ($this->isCsrfTokenValid('delete'.$area->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($area);
            $entityManager->flush();
        }

        return $this->redirectToRoute('area_index', [], Response::HTTP_SEE_OTHER);
    }
}
