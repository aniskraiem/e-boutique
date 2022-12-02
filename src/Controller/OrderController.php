<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Contacts;
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
        //récupérer les données de la base de données
        $order = $this->getDoctrine()->getRepository(Order::class)->findAll();

        //rendre la page order.html.twig pour afficher les données reçues
        return $this->render('orders/order.html.twig', [
            'totalOrders' => count($order),
            'order' => $paginator->paginate(
                $order,
                $request->query->getInt('page', 1),
                5
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

        //initialiser la variable 
        $myVariableCSV = " ";

        //initialiser dans la variable $orders les données récupérées
        $orders = $ApiService->getOrders();

        //initialiser dans la variable $contacts les données récupérées
        $contacts = $ApiService->getContacts();




        foreach ($orders['results'] as $o) {

     
            //    $myVariableCSV = "order:  delivery_name: delivery_address:  delivery_country:  delivery_zipcode:  delivery_city:  items_count:  item_index:  item_id:  item_quantity:  line_price_excl_vat:  line_price_incl_vat:\n";
            //Ajout de données (avec le . devant pour ajouter les données à la variable existante)

            $myVariableCSV .= "\n order: ";

            $myVariableCSV .= $o['OrderNumber'];

            foreach ($contacts['results'] as $c) {
                $contact = new Contacts();

                $contact->setAccountID($c['ID']);
                $contact->setAccountName($c['AccountName']);
                $contact->setAddressLine1($c['AddressLine1']);
                $contact->setCity($c['City']);
                $contact->setContactName($c['ContactName']);
                $contact->setCountry($c['Country']);
                $contact->setZipCode($c['ZipCode']);


                $em = $this->getDoctrine()->getManager();

                // dites à Doctrine que vous voulez  enregistrer les contacts 
                $em->persist($contact);

                // exécute réellement les requêtes 
                $em->flush();

                if ($c['ID'] == $o['DeliverTo']) {

                    //Ajout de données au fichier CSV

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
                        $article = new Articles();

                        $article->setAmount($s['Amount']);
                        $article->setDescription($s['Description']);
                        $article->setDiscount($s['Discount']);
                        $article->setItem($s['Item']);
                        $article->setItemDescription($s['ItemDescription']);
                        $article->setQuantity($s['Quantity']);
                        $article->setUnitCode($s['UnitCode']);
                        $article->setUnitDescriptions($s['UnitDescription']);
                        $article->setUnitPrice($s['UnitPrice']);
                        $article->setVATAmount($s['VATAmount']);
                        $article->setVATPercentage($s['VATPercentage']);



                        $em = $this->getDoctrine()->getManager();

                        // dites à Doctrine que vous voulez  enregistrer les articles 
                        $em->persist($article);

                        // exécute réellement les requêtes 
                        $em->flush();
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

                        $order = new Order();


                        //définir les données 
                        $order->setOrderNumber($o['OrderNumber']);
                        $order->setItemcount(count($o['SalesOrderLines']['results']));

                        $order->setAccountName($c['AccountName']);
                        $order->setAdresse($c['AddressLine1']);
                        $order->setPays($c['Country']);
                        $order->setAdresse($c['AddressLine1']);
                        $order->setItemIndex($s['Description']);
                        $order->setZipcode($c['ZipCode']);
                        $order->setVille($c['City']);
                        $order->setItemId($s['Item']);
                        $order->setItemQuantity($s['Quantity']);
                        $order->setPrixHTVA($s['Amount']);
                        $order->setPrixTVA($s['Amount'] + $s['VATAmount']);




                        $em = $this->getDoctrine()->getManager();

                        // dites à Doctrine que vous voulez  enregistrer les orders 
                        $em->persist($order);

                        // exécute réellement les requêtes 
                        $em->flush();



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