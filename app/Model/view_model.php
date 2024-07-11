<?php 
	class viewModel{
		protected function view_Model($directorio,$vistas):string
		{//url filtrado

			if(in_array($vistas, $directorio)){
				if(is_file("./resourses/modules/".$vistas."-view.php")){
					$contenido="./resourses/modules/".$vistas."-view.php";
				}else{
					$contenido="home";
				}
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}
?>