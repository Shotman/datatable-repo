<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\ORM\QueryBuilder;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\NumberColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Filter\TextFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {
        $filter = new TextFilter();
        $filter->set(["operator" => "LIKE"]);
        $table = $dataTableFactory->create();
        $table
            ->add('name', TextColumn::class, ["searchable" => true, "filter" => $filter, "operator" => "LIKE"])
            ->add('age', TextColumn::class, ["searchable" => true, "filter" => $filter, "operator" => "LIKE"])
            ->add('phone', TextColumn::class, ["searchable" => true, "filter" => $filter, "operator" => "LIKE"])
            ->add('address', TextColumn::class, ["searchable" => true, "filter" => $filter, "operator" => "LIKE"])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Person::class,
            ])->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'table' => $table,
        ]);
    }
}
