<?php

$calcul = $_GET['calcul'] ?? '';
$result = '';

// Si une expression a été envoyée
if (!empty($calcul)) {
  // On nettoie l'expression pour éviter les caractères interdits
  $calcul = preg_replace('/[^0-9+\-.*\/()%]/', '', $calcul);

  try {
    // Évalue l'expression
    $evalResult = eval("return $calcul;");

    // Si le résultat est numérique, on vérifie sa longueur
    if (is_numeric($evalResult)) {
      $resultStr = (string) $evalResult;
      if (strlen($resultStr) > 5) {
        $result = substr($resultStr, 0, 5) . '...';
      } else {
        $result = $resultStr;
      }
    } else {
      $result = 'Erreur';
    }

  } catch (Throwable $e) {
    $result = 'Erreur';
  }
}
?>








<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

  <!-- ma calculatrice -->
  <div class="container">
    <div class="d-flex justify-content-center row">
      <div class="col-6 d-flex justify-content-center">


        <form action="" method="get" class="row " ;>

          <!-- Espace haut -->
          <div class="col-12" style="height: 25px;">
            <div class="row text-center">
              <p>Calculatrice</p>
            </div>
          </div>


          <!-- Affichage -->
          <div class="col-1"></div>
          <div class="col-10">
            <div class="affichage">
              <h4><?php echo $calcul ?></h4>
              <input type="text" name="calcul" id="calcul" style="background-color: #a9d4db;">

              <h1> <?php echo $result ?> </h1>

            </div>
          </div>
          <div class="col-1"></div>

          <!-- Espace après affichage -->
          <div class="col-12" style="height: 25px;"></div>

          <!-- Boutons -->
          <div class="col-10">
            <div class="row text-center">
              <!-- Ligne 9 8 7 CE -->
              <div class="col-1"></div>
              <div class="col-2"><button type="button" onclick="sendKey(7)">7</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(8)">8</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(9)">9</button></div>
              <div class="col-2"></div>
              <div class="col-3"><button type="button" onclick="sendkeyCe()" class="btn-total">CE</button></div>


              <div class="col-12" style="height: 15px;"></div>

              <!-- Ligne 6 5 4 /  -->
              <div class="col-1"></div>
              <div class="col-2"><button type="button" onclick="sendKey(4)">4</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(5)">5</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(6)">6</button></div>
              <div class="col-2"></div>
              <div class="col-3"><button type="button" onclick="sendKey('/')" class="btn-total">/</button></div>


              <div class="col-12" style="height: 15px;"></div>

              <!-- Ligne 3 2 1 - -->
              <div class="col-1"></div>
              <div class="col-2"><button type="button" onclick="sendKey(1)">1</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(2)">2</button></div>
              <div class="col-2"><button type="button" onclick="sendKey(3)">3</button></div>
              <div class="col-2"></div>
              <div class="col-3"><button type="button" onclick="sendKey('-')" class="btn-total">-</button></div>



              <div class="col-12" style="height: 15px;"></div>


              <!-- Ligne 0 Calculer -->
              <div class="col-1"></div>
              <div class="col-4"><button type="button" onclick="sendKey(0)" class="w-100">0</button></div>
              <div class="col-2"><button type="button" onclick="sendKey('.')" class="w-100">.</button></div>
              <div class="col-2"></div>
              <div class="col-3"><button type="submit"  class="btn-total">=</button></div>


              <div class="col-12" style="height: 35px;"></div>
            </div>
          </div>
          <!-- colonne droite -->
          <div class="col-2">
            <div class="row">
              <div class="col-11"><button  class="btn-total">C</button></div>
              <div class="col-11" style="height: 15px;"></div>
              <div class="col-11"><button type="button" onclick="sendKey('*')" class="btn-total">*</button></div>
              <div class="col-11" style="height: 15px;"></div>
              <div class="col-11"><button type="button" onclick="sendKey('+')" class="btn-total" style="height: 145px;">+</button></div>
              <div class="col-11" style="height: 15px;"></div>
            </div>
          </div>

        </form>


      </div>
    </div>
  </div>



  <script>
    function sendKey(keysend) {
      document.getElementById("calcul").value += keysend;
    }

    function sendkeyCe() {
      document.getElementById("calcul").value = ""
    }

    
    function sendkeyC() { 
      document.getElementById("calcul").value = ""
      document.getElementById("result").innerHTML = ""
     }

     document.addEventListener('keydown', function(event) {
  const keyMapping = {
    '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9, '0': 0,
    '+': '+', '-': '-', '*': '*', '/': '/'
  };

  if (keyMapping[event.key] !== undefined) {
    sendKey(keyMapping[event.key]);
  } else if (event.key === 'Enter') {
    event.preventDefault();
    document.querySelector('form').submit();
  } else if (event.key === 'Backspace') {
    event.preventDefault(); // Pour éviter d’effacer caractère par caractère
    sendkeyCe();
  }
});
        
  </script>







</body>

</html>