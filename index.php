<?php

/**
 * Objectif : afficher sous forme de résumés la liste des produits
 *  - Nom du produit
 *  - Image principale
 *  - Prix
 *  - Intitulé de la catégorie
 *  - Nom de la boutique du créateur
 */

 /**********************/
 /* CONNEXION A LA BDD */
 /**********************/
// On stocke les informations de connexion dans des constantes
const DB_HOST = 'localhost';
const DB_NAME = 'Shop';
const DB_USER = 'root';
const DB_PASSWORD = '';

// Construction du Data Source Name
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;

// Tableau d'options pour la connexion PDO
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

// Création de la connexion PDO (création d'un objet PDO)
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
$pdo->exec('SET NAMES UTF8');

 /*************************************/
 /* REQUETE DE SELECTION DES PRODUITS */
 /*************************************/

 $sql = 'SELECT P.id AS product_id, name, price, stock, picture, label, shop_name
 FROM products AS P
 INNER JOIN categories AS Ca ON Ca.id = P.category_id
 INNER JOIN creators AS Cr ON Cr.id = P.creator_id';

$query = $pdo->prepare($sql);
$query->execute();
$products = $query->fetchAll();




 /*************************************/
 /* AFFICHAGE : INCLUSION DU TEMPLATE */
 /*************************************/

 // Affichage : inclusion du template index.phtml
include './index.phtml';