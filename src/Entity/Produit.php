<?php

    namespace App\Entity;

    class Produit
    {
        public function getAllProduits(){
            $solid = $this->getProduitsSolid();
            $liquid = $this->getProduitsLiquid();
            return array_merge($solid, $liquid);
        }

        public function getProduitsSolid(){
            return $produits = array(
                array('id' => 1, 'name' => 'T-shirt'),
                array('id' => 2, 'name' => 'Pantalon'),
                array('id' => 3, 'name' => 'Chaussures'),
                array('id' => 4, 'name' => 'Casquette'));
        }

        public function getProduitsLiquid(){
        return $voyages = array(
            array('id' => 1, 'name' => 'Voyage à Paris'),
            array('id' => 2, 'name' => 'Escapade à Bali'),
            array('id' => 3, 'name' => 'Aventure en Amazonie'),
            array('id' => 4, 'name' => 'Safari en Afrique'),
            array('id' => 5, 'name' => 'Croisière dans les Caraïbes'));
        }

        public function getThroughFilter($filter){
            switch ($filter){
                case 1:
                    return $this->getAllProduits();
                    break;
                case 2:
                    return $this->getProduitsSolid();
                    break;
                case 3:
                    return $this->getProduitsLiquid();
            }
        }
    }