<?php 
    function eliminarElemento($ruta) {
        if (is_dir($ruta)) {
            // Si es un directorio
            $archivos = glob($ruta . '/*');
            foreach ($archivos as $archivo) {
                eliminarElemento($archivo);
            }
            rmdir($ruta);
        } elseif (is_file($ruta)) {
            // Si es un archivo
            unlink($ruta);
        }
    }

    if (isset($_POST["crear_carpeta"])) {
        $nombre = $_POST["nombre_carpeta"];
        mkdir("./$nombre");
        copy("index.php", "./$nombre/index.php");
        copy("style.css", "./$nombre/style.css");
        copy("index.js", "./$nombre/index.js");
    }

    if(isset($_POST["subir_archivo"])) {
        $file_name = date("Y-m-d - H-i-s")."-".$_FILES['file']['name'];
        //Pillamos la localizacion temporal del arhivo al subirlo
        $file_location = $_FILES['file']['tmp_name'];
        //Movemos el archivo de la localizacion temporal a la carpeta actual del fichero
        move_uploaded_file($file_location, "./".$file_name);
    }

    if(isset($_POST["delete"])) {
        $file_name = $_POST["file_name_delete"];
        eliminarElemento($file_name);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Explorador de arhivos</title>
</head>
<body>
    <header>
        <h1>Explorer web</h1>
    </header>
    <nav>
        <div class="layout-navbar">
            <div class="icon-back">
                <a href="./..">
                    <span class="material-symbols-outlined">arrow_back_ios</span>
                </a>
            </div>
            <div class="icon-create">
                <span class="material-symbols-outlined">create_new_folder</span>
            </div>
            <div class="icon-upload">
                <span class="material-symbols-outlined">upload_file</span>
            </div>
        </div>
    </nav>
    <div class="layout-body">
        <div class="layout-files">
            <?php
                $directorio = "./"; 
                $archivos = scandir($directorio);
                foreach ($archivos as $archivo) {
                    if ($archivo != "." && $archivo != "..") {
                        if($archivo == "index.php" || $archivo == "style.css" || $archivo == "index.js"){
                            continue;
                        }else{ 
                            $rutaArchivo = $directorio . $archivo;              
            ?>              
                            <div class="file">
                                <?php if(is_dir($archivo)): ?>
                                    <a href='<?= $rutaArchivo ?>'><?= $archivo ?>/</a>
                                <?php else: ?>
                                    <a href='<?= $rutaArchivo ?>'><?= $archivo ?></a>
                                <?php endif ?>
                                <form action="" method="post" onSubmit='return confirm("¿Seguro?")'>
                                    <input type="hidden" name="file_name_delete" value="<?= $rutaArchivo ?>">
                                    <button type="submit" name="delete" on>Borrar</button>
                                </form>
                            </div>

                        <?php } ?>
                    <?php } ?>
                <?php } ?>
        </div>
    </div>
    <div class="fondo">
        <span></span>
    </div>
    <div class="hidden-form-crear-carpeta popup">
        <form action="" method="post">
            <input type="text" required name="nombre_carpeta" placeholder="Nombre carpeta..." maxlength="15">
            <button type="submit" name="crear_carpeta">crear carpeta</button>
        </form>
        <div class="icon-back-form-create">
            <button>
                <span class="material-symbols-outlined">arrow_back_ios</span>
            </button>
        </div>
    </div> 

    <div class="hidden-form-subir-archivo popup">
        <form action="" method="post" enctype="multipart/form-data" >
                <input type="file" required name="file">
                <button type="submit" name="subir_archivo">subir a "<?= $_SERVER["REQUEST_URI"] ?>"</button>
        </form>
        <div class="icon-back-form-update">
            <button>
                <span class="material-symbols-outlined">arrow_back_ios</span>
            </button>
        </div>
    </div>
    
    <script src="index.js"></script>
</body>
</html>