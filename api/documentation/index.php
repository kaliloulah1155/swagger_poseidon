<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>POSEIDON Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="../../swagger-ui/dist/swagger-ui.css" />
    <link rel="stylesheet" type="text/css" href="../../swagger-ui/dist/index.css" />
    <link rel="icon" type="image/png" href="../../swagger-ui/dist/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../../swagger-ui/dist/favicon-16x16.png" sizes="16x16" />
  </head>

  <body>
    <div id="swagger-ui"></div>
    <script src="../../swagger-ui/dist/swagger-ui-bundle.js" charset="UTF-8"> </script>
    <script src="../../swagger-ui/dist/swagger-ui-standalone-preset.js" charset="UTF-8"> </script>
    <script src="../../swagger-ui/dist/swagger-initializer.js" charset="UTF-8"> </script>
    <script>
    window.onload = function() {
      // Begin Swagger UI call region
        console.log(window.location.pathname);
      const ui = SwaggerUIBundle({
        url: "http://localhost:81/API_RES_POSEIDON/api/documentation/api.php",
        dom_id: '#swagger-ui',
        deepLinking: true,
          presets: [
              SwaggerUIBundle.presets.apis,
              SwaggerUIStandalonePreset
          ],
          layout: "StandaloneLayout"
      })
      // End Swagger UI call region
      window.ui = ui
    }
  </script>
  </body>
</html>
