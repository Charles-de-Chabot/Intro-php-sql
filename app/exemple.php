<?php
$prenom = "julien";
$nom = "Linard";
$_toto = "truc";
$toto3 = "machin";
$is_active = true;
$age = 15;
$prix = 2.75;
$array = ["pommes", "poire", "cerise", "fraise", "mangue", "banane"];
var_dump($array);
$concatenation = "Bonjour $prenom tu as $age ans.";
$concat2 = 'Bonjour ' . $prenom . ', tu as ' . $age . " ans.";
echo $concatenation;
echo $concat2;


//* CONDITIONS IF/ELSE
if ($age >= 18) {
    var_dump("Tu es majeur");
} else {
    print "Tu es mineur";
}

//* CONDITION IF/ELSE IF/ ELSE
$couleur_1 = "rouge";
$couleur_2 = "vert";
if ($couleur_1 == "rouge" && $couleur_2 == "bleu") {
    print "Les 2 couleurs sont bonnes";
} else if ($couleur_1 == "rouge" || $couleur_2 == "bleu") {
    print "Une des deux couleurs est bonne";
}else{
    print "Aucune des couleurs est bonne";
}

//* TABLEAUX
$tab = ["couteau", "corde", "briquet", "duvet"];
$tab2 = array("couteau", "corde", "briquet", "duvet"); //Syntaxe historique


//* Pour insérer un élément dans le tableau
$tab[] = "bache"; 
var_dump($tab);


//* Tableau associatif
$identite = [
    "nom" => "linard",
    "prenom" => "julien",
    "age" => "25"
];

//* BOUCLE  
//* For
for($i = 0; $i < 10; $i++){
    print "boucle numero: " . $i+1 . "<br>";
};

//* While
$j = 0;
while($j < 10){
    echo "boucle numero: " . $j + 1 . "<br>";
    $j++;
};
print "<br>";
print "<br>";
//* foreach
foreach($tab as $matos) {
    print $matos . "<br>";
};
print "<br>";
print "<br>";

//* Tableau un peu plus complexe 
$array = [
    "fruits" => ["pommes", "poire", "cerise", "fraise", "mangue", "banane"],
    "annimaux" => ["chien", "chat", "tigre" , "loup",],
    "pays" => ["France", "Italie", "Espagne"],
    "test" => "false"
];
print "<br>";
print "<br>";
foreach($array as $key => $value) {
    print 'la clé du parent est ' . $key . "<br>";
    //* afficher les enfants 
    if (is_array($value)) {

    
    print "ses enfants on pour valeur: <br>";
        foreach($value as $child) {
        print "=> $child <br>";
        }
    } else {
        print "son enfant a pour valeur: ";
        print "=> $value <br>";
    } 
} 

//* FUNCTION
function hello (){
    print "Hello World by function";
};

function bonjour($prenom){
    print "Salut $prenom";
};

function sum($a, $b) {
    print 'la somme de ' . $a . ' + ' . $b . ' = ' . $a + $b;
};

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro PHP</title>
</head>

<body>
    <h1>Hello <?php echo $prenom; ?></h1>
    <h2>Tu as <?= $age ?> ans.</h2>
    <p><?php hello(); ?></p>
    <p> <?php bonjour("Julien"); ?> </p>
    <p><?php sum(254, 251); ?></p>
</body>

</html>