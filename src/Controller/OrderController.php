<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\ApiService;

class OrderController extends AbstractController
{

    /**
     * @Route("/orders", name="orders", methods={"GET"})
     */

    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->render('order.html.twig', [
            'totalOrders' => count($order),
            'order' => $paginator->paginate($order,
                $request->query->getInt('page', 1), 5
            ),
        ]);
    }

    /**
     * @Route("/flow/orders_to_csv", name="OrdersToCsv")
     */
    public function orderstocsv(ApiService $ApiService): Response
    {
        //Nom des colonnes en première lignes
        // le \n à la fin permets de faire un saut de ligne, super important en CSV
        // le point virgule sépare les données en colonnes

        //    $myVariableCSV = "order:  delivery_name: delivery_address:  delivery_country:  delivery_zipcode:  delivery_city:  items_count:  item_index:  item_id:  item_quantity:  line_price_excl_vat:  line_price_incl_vat:\n";


        //Ajout de données (avec le . devant pour ajouter les données à la variable existante)
        $myVariableCSV = " ";

        $orders = $ApiService->getOrders();
        $contacts = $ApiService->getContacts();
        $order = new Order();
        foreach ($orders['results'] as $o) {
            $myVariableCSV .= "\n order: ";

            $myVariableCSV .= $o['OrderNumber'];
           
            foreach ($contacts['results'] as $c) {


                if ($c['ID'] == $o['DeliverTo']) {

                    $myVariableCSV .= "\n delivery_name: ";
                    $myVariableCSV .= $c['AccountName'];

                    $myVariableCSV .= "\n delivery_address: ";
                    $myVariableCSV .= $c['AddressLine1'];

                    $myVariableCSV .= "\n delivery_country: ";
                    $myVariableCSV .= $c['Country'];

                    $myVariableCSV .= "\n delivery_zipcode: ";
                    $myVariableCSV .= $c['ZipCode'];

                    $myVariableCSV .= "\n delivery_city: ";
                    $myVariableCSV .= $c['City'];
                  

                    $myVariableCSV .= "\n item_count: ";
                    $myVariableCSV .= count($o['SalesOrderLines']['results']);

                    foreach ($o['SalesOrderLines']['results'] as $s) {
                       
                        $myVariableCSV .= "\n item_index: ";
                        $myVariableCSV .= $s['Description'];

                        $myVariableCSV .= "\n item_id: ";
                        $myVariableCSV .= $s['Item'];

                        $myVariableCSV .= "\n item_quantity: ";
                        $myVariableCSV .= $s['Quantity'];

                        $myVariableCSV .= "\n line_price_excl_vat: ";
                        $myVariableCSV .= $s['Amount'];

                        $myVariableCSV .= "\n line_price_incl_vat: ";
                        $myVariableCSV .= $s['Amount'] + $s['VATAmount'];
                        
                        $order->setOrderNumber($o['OrderNumber']);
                        $order->setItemcount(count($o['SalesOrderLines']['results']));

                        $order->setAccountName($c['AccountName']);
                        $order->setAdresse($c['AddressLine1']);
                        $order->setPays($c['Country']);
                        $order->setZipcode($c['ZipCode']);
                        $order->setVille($c['City']);
                        $order->setItemIndex($s['Description']);
                        $order->setItemId($s['Item']);
                        $order->setItemQuantity($s['Quantity']);
                        $order->setPrixHTVA($s['Amount']);
                        $order->setPrixTVA($s['Amount'] + $s['VATAmount']);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($order);
                        $em->flush();
                       
                        continue;
                      

                    }
                }
            }

        }
        



      //  On donne la variable en string à la response, nous définissons le code HTTP à 200
        return new Response(
            
            $myVariableCSV,
            200,
            [
                //Définit le contenu de la requête en tant que fichier Excel
                'Content-Type' => 'application/vnd.ms-excel',
                //On indique que le fichier sera en attachment donc ouverture de boite de téléchargement ainsi que le nom du fichier
                "Content-disposition" => "attachment; filename=orders.csv"
            ],

        );
        return $this->redirect('/orders');

    }


}