<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Form\AvisType;
use App\Form\CommentaireType;
use App\Repository\AvisRepository;
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

    public function fetchOrders(ApiService $ApiService): Response
    {
//        dd($ApiService->getOrders());
        $response = $this->render('order.html.twig', [
            'data' => $ApiService->getOrders(),
        ]);

        $response->setSharedMaxAge(3600);

        return $response;
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

    $orders  = $ApiService->getOrders();
    $contacts  = $ApiService->getContacts();

    foreach ($orders['results'] as $o) {
        $myVariableCSV .= "\n order: ";

            $myVariableCSV .=  $o['OrderNumber'];
           

        foreach ($contacts['results'] as $c) {
            

if($c['ID']==$o['DeliverTo']){

        $myVariableCSV .= "\n delivery_name: ";

        $myVariableCSV .=  $c['AccountName'];
        $myVariableCSV .= "\n delivery_address: ";

        $myVariableCSV .=  $c['AddressLine1'];
        $myVariableCSV .= "\n delivery_country: ";

        $myVariableCSV .=  $c['Country'];

        $myVariableCSV .= "\n delivery_zipcode: ";

        $myVariableCSV .=  $c['ZipCode'];
        $myVariableCSV .= "\n delivery_city: ";

        $myVariableCSV .=  $c['City'];
        $myVariableCSV .= "\n item_count: ";

        $myVariableCSV .=  count($o['SalesOrderLines']['results']);
   
         foreach ($o['SalesOrderLines']['results'] as $s) {
        
        $myVariableCSV .= "\n item_index: ";

        $myVariableCSV .=  $s['Description'];
        $myVariableCSV .= "\n item_id: ";

        $myVariableCSV .=  $s['Item'];
        $myVariableCSV .= "\n item_quantity: ";

        $myVariableCSV .=  $s['Quantity'];
        $myVariableCSV .= "\n line_price_excl_vat: ";

        $myVariableCSV .=  $s['Amount'];
        $myVariableCSV .= "\n line_price_incl_vat: ";

        $myVariableCSV .=  $s['Amount']+ $s['VATAmount'];
        
    }
}
    }
 
    }
    
    //Si l'on souhaite ajouter un espace
 
    //On donne la variable en string à la response, nous définissons le code HTTP à 200
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
    }
   

}
