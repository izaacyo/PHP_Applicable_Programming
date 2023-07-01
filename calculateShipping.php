<?php

class Product {
         private $price;
         private $weight;

         public function __construct($price, $weight){
             $this->weight=$weight;
             $this->price=$price;
         }

         function getWeight(){
             return $this->weight;
         }
}


class Shipping {
    private $totalShipping;

    public function calculateTotalShipping($weight, $pricePerKilogram){
        return $weight * $pricePerKilogram;
}
}

       $product = new Product(5,1);
       $pricePerKilogram = 5;

       $shipping = new Shipping();
       $totalShippingPrice = $shipping -> calculateTotalShipping($product->getWeight(), $pricePerKilogram);







// MODEL

/*function CalculateShipping($productWeight, $priceKilogram, $hasFreeShipping){
    if(!$hasFreeShipping){
        return $productWeight * $priceKilogram;
    }
};


$products[1]['weight']= 1;
$products[1]['price']= 6;
$products[1]['freeShipping']= true;

$products[2]['weight'] = 2;
$products[2]['price'] = 3;
$products[2]['freeShipping']= false;

$priceKilogram = 5;

$totalShippingPrice= 0;

foreach ($products as $product){
     $totalShippingPrice = CalculateShipping($product['weight'], $priceKilogram, $product['freeShipping']);
}

echo $totalShippingPrice;*/