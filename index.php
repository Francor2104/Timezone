<!DOCTYPE html>
<html>
<head>
  <title>Saludo en diferentes zonas horarias</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="vintage-theme">
  <h1 class="title">Saludo en diferentes zonas horarias</h1>

  <div class="text">
    <?php
    class Pais {
      public $nombre;
      public $zonaHoraria;

      public function __construct($nombre, $zonaHoraria) {
        $this->nombre = $nombre;
        $this->zonaHoraria = $zonaHoraria;
      }
    }

    $paises = [
      new Pais("Argentina", "America/Argentina/Buenos_Aires"),
      new Pais("Australia", "Australia/Sydney"),
      new Pais("Brasil", "America/Sao_Paulo"),
      new Pais("Canadá", "America/Toronto"),
      new Pais("China", "Asia/Shanghai"),
      new Pais("Colombia", "America/Bogota"),
      new Pais("Corea del Sur", "Asia/Seoul"),
      new Pais("Egipto", "Africa/Cairo"),
      new Pais("España", "Europe/Madrid"),
      new Pais("Estados Unidos", "America/New_York"),
      new Pais("Francia", "Europe/Paris"),
      new Pais("India", "Asia/Kolkata"),
      new Pais("Inglaterra", "Europe/London"),
      new Pais("Italia", "Europe/Rome"),
      new Pais("Japón", "Asia/Tokyo"),
      new Pais("Venezuela", "America/Caracas")
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $paisSeleccionado = $_POST["pais"];

      $zonaHoraria = null;
      foreach ($paises as $pais) {
        if ($pais->nombre === $paisSeleccionado) {
          $zonaHoraria = $pais->zonaHoraria;
          break;
        }
      }

      if ($zonaHoraria !== null) {
        date_default_timezone_set($zonaHoraria);
        $horaActual = new DateTime('now');
        $hora = intval($horaActual->format('H'));

        $saludo = "";
        if ($hora >= 5 && $hora < 12) {
          $saludo = "¡Buenos días desde $paisSeleccionado!";
        } elseif ($hora >= 12 && $hora < 18) {
          $saludo = "¡Buenas tardes desde $paisSeleccionado!";
        } else {
          $saludo = "¡Buenas noches desde $paisSeleccionado!";
        }

        $horaFormateada = $horaActual->format('h:i:s A');
        echo "<p class='greeting'>$saludo</p>";
        echo "<p class='time'>La hora local es: $horaFormateada</p>";
      } else {
        echo "<p class='error'>No se pudo determinar la zona horaria para $paisSeleccionado.</p>";
      }
    }
    ?>

    <form method="post" action="">
      <label for="pais" class="label">Selecciona un país:</label>
      <select name="pais" id="pais" class="select">
        <?php
        foreach ($paises as $pais) {
          echo "<option value='$pais->nombre'>$pais->nombre</option>";
        }
        ?>
      </select>
      <button type="submit" class="button">Saludar</button>
    </form>
  </div>

  <div id="result" class="result-container">
  </div>
</body>
</html>