<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeesSearchType;
use App\Form\EmployeesType;
use App\Repository\EmployeesRepository;
use App\Repository\SubAreaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employees")
 */
class EmployeesController extends AbstractController
{
    /**
     * @Route("/", name="employees_index", methods={"GET"})
     */
    public function index(EmployeesRepository $employeesRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $form = $this->createForm(EmployeesSearchType::class, null);
        $form->handleRequest($request);
         $data = null;

         if (isset($request->query->get('employees_search')['value'])){
             $data = $request->query->get('employees_search')['value'];
         }

        if (isset($data)){
            $employees = $employeesRepository->findEmployees($data);
        }else{
            $employees = $employeesRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $employees, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->renderForm('employees/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form
        ]);
    }

    /**
     * @Route("/new", name="employees_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employee = new Employees();
        $form = $this->createForm(EmployeesType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->setCreatedAt(new \DateTime());
            $employee->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employees/new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employees_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employees $employee): Response
    {
        $form = $this->createForm(EmployeesType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employees/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="employees_delete", methods={"POST"})
     */
    public function delete(Request $request, Employees $employee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/get/sub/area", name="getSubarea", methods={"GET","POST"})
     */
    public function getSubArea(Request $request, SubAreaRepository $subAreaRepository)
    {
        $output = [];
        $subAreas = $subAreaRepository->findBy(['area' => $request->request->get('data')]);
        foreach ($subAreas as $subArea){

            $output[]=[$subArea->getId(),$subArea->getDescription()];
        }

        return new JsonResponse($output);

    }
}
