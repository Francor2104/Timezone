<!DOCTYPE html>
<html>
<head>
  <title>Saludo en diferentes zonas horarias</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="vintage-theme">
  <h1 class="title">Saludo en diferentes zonas horarias</h1>
  

  <div class="text">

    
    <form method="post" action="">
      <label for="country" class="label">Selecciona un país:</label>
      <select name="country" id="country" class="select">
        <option value="Argentina">Argentina</option>
        <option value="Australia">Australia</option>
        <option value="Brasil">Brasil</option>
        <option value="Canadá">Canadá</option>
        <option value="China">China</option>
        <option value="Colombia">Colombia</option>
        <option value="Corea del Sur">Corea del Sur</option>
        <option value="Egipto">Egipto</option>
        <option value="España">España</option>
        <option value="Estados Unidos">Estados Unidos</option>
        <option value="Francia">Francia</option>
        <option value="India">India</option>
        <option value="Inglaterra">Inglaterra</option>
        <option value="Italia">Italia</option>
        <option value="Japón">Japón</option>
      </select>
      
      <button type="submit" class="button">Saludar</button>
    </form>
  </div>
    
    <div id="result" class="result-container">
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $country = $_POST["country"];
        $countryTimezones = [
          "Argentina" => "America/Argentina/Buenos_Aires",
          "Australia" => "Australia/Sydney",
          "Brasil" => "America/Sao_Paulo",
          "Canadá" => "America/Toronto",
          "China" => "Asia/Shanghai",
          "Colombia" => "America/Bogota",
          "Corea del Sur" => "Asia/Seoul",
          "Egipto" => "Africa/Cairo",
          "España" => "Europe/Madrid",
          "Estados Unidos" => "America/New_York",
          "Francia" => "Europe/Paris",
          "India" => "Asia/Kolkata",
          "Inglaterra" => "Europe/London",
          "Italia" => "Europe/Rome",
          "Japón" => "Asia/Tokyo"
        ];

        if (array_key_exists($country, $countryTimezones)) {
          date_default_timezone_set($countryTimezones[$country]);
          $time = new DateTime('now');
          $hour = intval($time->format('H'));

          $greeting = "";
          if ($hour >= 5 && $hour < 12) {
            $greeting = "¡Buenos días desde $country!";
          } elseif ($hour >= 12 && $hour < 18) {
            $greeting = "¡Buenas tardes desde $country!";
          } else {
            $greeting = "¡Buenas noches desde $country!";
          }

          $formattedTime = $time->format('h:i:s A');
          echo "<p class='greeting'>$greeting</p>";
          echo "<p class='time'>La hora local es: $formattedTime</p>";
        } else {
          echo "<p class='error'>No se pudo determinar la zona horaria para $country.</p>";
        }
      }
    ?>
  </div>
</body>
</html>