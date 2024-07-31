<?php
    function error_message2($message){
        $body_error = '
            <!-- Flexbox container for aligning the toasts -->
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
    
                        <!-- Then put toasts within -->
                        <div class="toast" role="alert" style="opacity: 1 !important;">
                            <div class="toast-header text-danger">
                            <span class="rounded me-2 icon-attention"></span>
                            <strong class="me-auto">Error al enviar</strong>
                            <small>Hace 1 Seg.</small>
                            <button type="button" class="btn-close"></button>
                            </div>
                            <div class="toast-body">
                            '.$message.'
                            </div>
                        </div>
                    </div>
                ';
    
        return $body_error;
    }
    // Configuración de manejo de errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('log_errors', 1);
    ini_set('error_log', './error.log');
    
    // Manejador de errores personalizados
    function customErrorHandler($errno, $errstr, $errfile, $errline) {
    
        switch ($errno) {
            case E_USER_ERROR:
                echo error_message2("Hubo un error al procesar los datos, intente nuevamente.");
                break;
    
            case E_USER_WARNING:
                echo error_message2("Hubo un error al procesar los datos, intente nuevamente.");
                break;
    
            case E_USER_NOTICE:
                echo error_message2("Hubo un error al procesar los datos, intente nuevamente.");
                break;
    
            default:
                echo error_message2("Hubo un error al procesar los datos, intente nuevamente.");
                break;
        }
        return true;
    }
    
    set_error_handler("customErrorHandler");
    
    // Manejador de errores fatales
    function shutdownHandler() {
    
        $error = error_get_last();
        if ($error !== NULL && $error['type'] === E_ERROR) {
            $errno = $error['type'];
            $errfile = $error['file'];
            $errline = $error['line'];
            $errstr = $error['message'];
    
            error_log(error_message2("Hubo un error al procesar los datos, intente nuevamente."));
            
            //header("Location: /error_page.html");
            exit();
        }
    }
    
    register_shutdown_function('shutdownHandler');
?>