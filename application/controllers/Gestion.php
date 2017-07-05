<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gestion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in')["cargo"][0] == 3 or $this->session->userdata('logged_in')["cargo"][0] == 4) {
            $this->layouthelper->SetMaster('layout');
        } else {
            redirect('/Login');
        }
    }

    public function indexcontentdos()
    {
        $this->layouthelper->LoadView("pruebas/contentdos", null);
    }

    public function entregamanual()
    {
        $data['categorias']  = $this->cat->findAll();
        $data['asignaturas'] = $this->asig->findAll();
        $this->layouthelper->LoadView("gestion/entregamanual", $data);

    }

    public function entregadigital()
    {
        $data["solicitudes"] = $this->soli->findByArrayIN(array(7, 1)); //busco las solicitudes enviadas por el catalogo y las parcialmente entregadas 1 y 7
        $this->layouthelper->LoadView("gestion/entregadigital", $data);
    }

    public function get_detalle_solicitud()
    {
        $tododetjson = array();
        $idsol       = $_POST['idsolicitud'];
        $detalle     = $this->detsol->findByArray(array("DETSOL_SOL_ID" => $idsol, "DETSOL_ESTADO" => 1));
        foreach ($detalle as $key => $value) {
            $producto      = $this->prod->findById($value->get("DETSOL_PROD_ID"));
            $tododetjson[] = json_encode(array(
                'ID'          => $value->get("DETSOL_ID"),
                'TIPOPROD'    => $value->get("DETSOL_TIPOPROD"),
                'IMAGEN'      => base_url('resources/images/Imagenes_Server/' . $value->get("PROD_IMAGEN")),
                "POSICION"    => $value->get("PROD_POSICION"),
                'CANTIDAD'    => $value->get("DETSOL_CANTIDAD"),
                'ESTADO'      => $value->get("DETSOL_ESTADO"),
                'SOL_ID'      => $value->get("DETSOL_SOL_ID"),
                'PROD_ID'     => $value->get("DETSOL_PROD_ID"),
                'PROD_NOMBRE' => $producto->get("PROD_NOMBRE"),
            ));
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($tododetjson));
    }

    public function baja()
    {
        $allbajas        = $this->baja->findAll();
        $arraytodasbajas = array();
        foreach ($allbajas as $key => $value) {
            $arraytodasbajas[] = array("BAJA_ID" => $value->get("BAJA_ID"),
                "BAJA_MOTIVO_ID"                     => $value->get("BAJA_MOTIVO_ID"),
                "BAJA_DESC"                          => $value->get("BAJA_DESC"),
                "BAJA_INV_ID"                        => $value->get("BAJA_INV_ID"),
                "BAJA_FECHA"                         => $value->get("BAJA_FECHA"),
                "BAJA_USU_RUT"                       => $value->get("BAJA_USU_RUT"),
                "BAJA_CANTIDAD"                      => $value->get("BAJA_CANTIDAD"),
                "BAJA_TIPO"                          => $value->get("BAJA_TIPO"),
                "MOT_ID"                             => $value->get("MOT_ID"),
                "MOT_NOMBRE"                         => $value->get("MOT_NOMBRE"),
                "INV_ID"                             => $value->get("INV_ID"),
                "INV_PROD_ID"                        => $value->get("INV_PROD_ID"),
                "INV_PROD_NOM"                       => $value->get("INV_PROD_NOM"),
                "INV_PROD_CANTIDAD"                  => $value->get("INV_PROD_CANTIDAD"),
                "INV_PROD_ESTADO"                    => $value->get("INV_PROD_ESTADO"),
                "INV_PROD_CODIGO"                    => $value->get("INV_PROD_CODIGO"),
                "INV_INGRESO_ID"                     => $value->get("INV_INGRESO_ID"),
                "INV_FECHA"                          => $value->get("INV_FECHA"),
                "INV_IMAGEN"                         => $value->get("INV_IMAGEN"),
                "INV_TIPO_ID"                        => $value->get("INV_TIPO_ID"),
                "INV_CATEGORIA_ID"                   => $value->get("INV_CATEGORIA_ID"),
                "INV_ULTIMO_USUARIO"                 => $value->get("INV_ULTIMO_USUARIO"),
                "INV_ACTUAL_USUARIO"                 => $value->get("INV_ACTUAL_USUARIO"),
                "USU_RUT"                            => $value->get("USU_RUT"),
                "USU_DV"                             => $value->get("USU_DV"),
                "USU_NOMBRES"                        => $value->get("USU_NOMBRES"),
                "USU_APELLIDOS"                      => $value->get("USU_APELLIDOS"),
                "BAJA_MOTIVO_RESULTADO"              => $this->obs->findByArray(array("OBS_BAJA_ID" => $value->get("BAJA_ID"))),
            );
        }

        $data["inventario"] = $this->inv->findByArray(array('INV_PROD_ESTADO' => 1));
        $data["motivos"]    = $this->mot->findByArray(array("MOT_ESTADO" => 1)); //array('MOT_DIF' => 1)
        $data["bajas"]      = $arraytodasbajas;
        $data['categorias'] = $this->cat->findByArray(array('CAT_ESTADO' => 1));
        $this->layouthelper->LoadView("gestion/baja", $data);
    }

    public function get_iventario_by_cat_ajax()
    {
        $nomsearch   = $_POST['search'];
        $todoivbycat = $this->inv->findByArrayLike($nomsearch, 'INV_PROD_NOM', 'INV_ID');
        $arrayinv    = array();
        foreach ($todoivbycat as $key => $value) {
            if ($value->get('INV_TIPO_ID') == 1 and $value->get('INV_PROD_ESTADO') == 1) {
                $arrayinv[] = array("id" => $value->get('INV_ID'),
                    "text"                   => $value->get('INV_ID') . "-" . $value->get('INV_PROD_NOM'),
                );
            }
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($arrayinv));
    }

    public function dar_de_baja()
    {
        $usersesion = $this->session->userdata('logged_in');
        $ultimoid   = 0;
        if (isset($_POST['forminventario']) and $_POST['forminventario'] != "0" and $_POST['formmotivoorigen'] != "0" and isset($_POST['formmotivoorigen']) and trim($_POST['formdescripcion']) != "" and trim($_POST['cantidadbaja']) != "") {
            $inventario = $this->inv->findById($_POST['forminventario']);
            if ($inventario->get("INV_PROD_CANTIDAD") < $_POST['cantidadbaja']) {
                $this->session->set_flashdata('Deshabilitar', 'Lo sentimos la cantidad a dar de baja no puede ser mayor al stock actual, esta ingresando ' . $_POST['cantidadbaja'] . ' ' . $inventario->get("INV_PROD_NOM") . ' y existen en stock ' . $inventario->get("INV_PROD_CANTIDAD"));
                redirect('/Gestion/baja');
            }
            if (intval($_POST['formmotivoorigen']) == 15 and intval($inventario->get("INV_TIPO_ID")) == 2) {
                $this->session->set_flashdata('Deshabilitar', 'Lo sentimos no puede enviar a reparación un producto de tipo fungible');
                redirect('/Gestion/baja');
            }

            $_columns = array(
                'BAJA_ID'        => 0,
                'BAJA_MOTIVO_ID' => $_POST['formmotivoorigen'],
                'BAJA_DESC'      => $_POST['formdescripcion'],
                'BAJA_INV_ID'    => $_POST['forminventario'],
                'BAJA_FECHA'     => date("Y-m-d H:i:s"),
                'BAJA_USU_RUT'   => $usersesion['rut'],
                'BAJA_CANTIDAD'  => $_POST['cantidadbaja'],
                'BAJA_TIPO'      => $inventario->get("INV_TIPO_ID"),
            );

            $this->baja->setColumns($_columns);
            $ultimoid = $this->baja->insert();
            if ($ultimoid > 0) {
                switch (intval($_POST['formmotivoorigen'])) {
                    case 15:
                        if (intval($inventario->get("INV_TIPO_ID")) == 1) {
                            $this->inv->update($_POST['forminventario'], array('INV_PROD_ESTADO' => 2));
                        }
                        break;
                    default:
                        if (intval($inventario->get("INV_TIPO_ID")) == 1) {
                            $this->inv->update($_POST['forminventario'], array('INV_PROD_ESTADO' => 0));
                        }
                        break;
                }
                if (intval($inventario->get("INV_TIPO_ID")) == 2) {
                    $total = intval($inventario->get("INV_PROD_CANTIDAD")) - intval($_POST['cantidadbaja']);
                    $this->inv->update($_POST['forminventario'], array('INV_PROD_CANTIDAD' => $total));
                }
            }

            $this->session->set_flashdata('Habilitar', 'Se ingresó correctamente el activo a dar de baja');
            redirect('/Gestion/baja', 'refresh');
        } else {
            $this->session->set_flashdata('Deshabilitar', 'Lo sentimos algunos de los campos no están definidos, favor revisar');
            redirect('/Gestion/baja', 'refresh');
        }

    }

    public function get_obs_by_baja_id()
    {
        $idbaja        = $_POST['bajaid'];
        $allobs        = array();
        $observaciones = $this->obs->findByArray(array('OBS_BAJA_ID' => $idbaja));

        $baja = $this->baja->findById($idbaja);

        //necesito obtener el id del inventario que se esta dando de baja

        if ($observaciones != null) {
            foreach ($observaciones as $key => $value) {
                $allobs[] = array(
                    'ID'         => $value['OBS_ID'],
                    'TEXTO'      => $value['OBS_TEXTO'],
                    'BAJA_ID'    => $value['OBS_BAJA_ID'],
                    'MOT_NOMBRE' => $value['OBS_MOT_NOMBRE'],
                    'FECHA'      => $value['OBS_FECHA'],
                );
            }
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array('INV_ID' => $baja->get("BAJA_INV_ID"), 'allobs' => json_encode($allobs))));
    }

    public function insert_obs_to_baja()
    {
        //{"bajaid": bajaidhidden,"texto": texto,"motivores": motivores},
        if (isset($_POST["bajaid"]) and isset($_POST["texto"]) and isset($_POST["motivores"])) {
            $bajaid           = $_POST["bajaid"];
            $texto            = $_POST["texto"];
            $motivores        = $_POST["motivores"];
            $inventarioabajar = $_POST["inventarioabajar"];
            $motivo           = $this->mot->findById($motivores);
            $columns          = array(
                'OBS_ID'         => 0,
                'OBS_TEXTO'      => $texto,
                'OBS_BAJA_ID'    => $bajaid,
                'OBS_FECHA'      => date("Y-m-d H:i:s"),
                'OBS_MOT_ID'     => $motivo->get("MOT_ID"),
                'OBS_MOT_NOMBRE' => $motivo->get("MOT_NOMBRE"),
            );
            $this->obs->setColumns($columns);
            $ultimoobs = $this->obs->insert();
            if ($ultimoobs > 0) {
                switch (intval($motivo->get("MOT_ID"))) {
                    case 16:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 1));
                        break;
                    case 17:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 0));
                        break;
                    case 18:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 2));
                        break;
                    case 19:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 0));
                        break;
                    case 20:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 2));
                        break;
                    case 21:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 2));
                        break;
                    case 23:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 0));
                        break;
                    case 24:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 2));
                        break;
                    case 25:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 2));
                        break;
                    default:
                        $this->inv->update($inventarioabajar, array('INV_PROD_ESTADO' => 0));
                        break;
                }
                $this->session->set_flashdata('Habilitar', 'Se ingresó correctamente el motivo resultado');
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode(array("estado" => true, "mensaje" => "Se ha insertado correctamente")));
            } else {
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode(array("estado" => false, "mensaje" => "Ocurrio un error al insertar esta observación")));
            }

        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => true, "mensaje" => "Alguno de los formularios no esta definido, favor revisar")));
        }

    }

    public function ingreso()
    {
        $data['proveedores'] = $this->prov->findByArray(array("PROV_ESTADO" => 1));
        $data['productos']   = $this->prod->findByArray(array("PROD_ESTADO" => 1));
        $data['ingresos']    = $this->ing->findAll();
        $data['categorias']  = $this->cat->findAllSelect();

        $data['tipos'] = $this->tipoP->findAll();
        $this->layouthelper->LoadView("gestion/ingreso", $data);
    }

    public function ingresar_producto_stock()
    {
        $usersesion = $this->session->userdata('logged_in');
        $producto   = $this->prod->findById($_POST['producto']);

        if (trim($_POST['producto']) != "" and trim($_POST['cantidad']) != "" and trim($_POST['descripcion']) != "" and trim($_POST['vidautil']) != "" and trim($_POST['modo']) != "") {

        } else {
            $this->session->set_flashdata('Deshabilitar', 'Lo sentimos existe uno de los campos requeridos vacíos');
            redirect('Gestion/ingreso', 'refresh');
        }

        if ($_POST['modo'] == 1) {
            if (trim($_POST['ordencompra']) != "" and trim($_POST['preciounitario']) != "" and trim($_POST['proveedor']) != "") {
                # code...
            } else {
                $this->session->set_flashdata('Deshabilitar', 'Lo sentimos al seleccionar modo compra debe ingresar Orden de compra, Precio Unitario y Seleccionar un Proveedor');
                redirect('Gestion/ingreso', 'refresh');
            }
        } elseif ($_POST['modo'] == 2) {
            # code...
        } else {
            $this->session->set_flashdata('Deshabilitar', 'Lo sentimos no ha seleccionado ningun modo de adquisición');
            redirect('Gestion/ingreso', 'refresh');
        }

        $columns = array(
            'ING_PROD_ID'             => $_POST['producto'],
            'ING_CANTIDAD'            => $_POST['cantidad'],
            'ING_ORDEN_COMPRA'        => $_POST['ordencompra'],
            'ING_DESC'                => $_POST['descripcion'],
            'ING_USU_RUT'             => $usersesion['rut'],
            'ING_VIDA_UTIL_PROVEEDOR' => $_POST['vidautil'],
            'ING_PROV_RUT'            => $_POST['proveedor'],
            'ING_PRECIO_UNITARIO'     => $_POST["preciounitario"],
            'ING_TIPO_INGRESO'        => $_POST["modo"],
        );
        $ultimoingreso = $this->ing->insert($columns);

        if ($producto->get("PROD_TIPOPROD_ID") == 1) {
            for ($i = 0; $i < $_POST['cantidad']; $i++) {
                $_columns = array(
                    'INV_ID'            => 0,
                    'INV_PROD_ID'       => $producto->get("PROD_ID"),
                    'INV_PROD_NOM'      => $producto->get("PROD_NOMBRE"),
                    'INV_IMAGEN'        => $producto->get("PROD_IMAGEN"),
                    'INV_PROD_CANTIDAD' => 1,
                    'INV_PROD_ESTADO'   => 1,
                    'INV_INGRESO_ID'    => $ultimoingreso,
                    'INV_CATEGORIA_ID'  => $producto->get("PROD_CAT_ID"),
                    'INV_TIPO_ID'       => 1,
                );
                $ultimoidonventarioingresado = $this->inv->insertDirect($_columns);
                $this->inv->update($ultimoidonventarioingresado, array('INV_PROD_CODIGO' => $producto->get("PROD_CAT_ID") . $ultimoidonventarioingresado));
            }
        } else if ($producto->get("PROD_TIPOPROD_ID") == 2) {
            $insumo = $this->inv->findByArrayOne(array('INV_PROD_ID' => $producto->get("PROD_ID")));
            if ($insumo != null) {
                $total = intval($insumo->get('INV_PROD_CANTIDAD')) + intval($_POST['cantidad']);
                $this->inv->update($insumo->get("INV_ID"), array('INV_PROD_CANTIDAD' => $total, 'INV_PROD_CODIGO' => $producto->get("PROD_CAT_ID") . $insumo->get("INV_ID")));
            } else {
                $columnascrearinv = array(
                    'INV_ID'            => 0,
                    'INV_PROD_ID'       => $producto->get("PROD_ID"),
                    'INV_PROD_NOM'      => $producto->get("PROD_NOMBRE"),
                    'INV_IMAGEN'        => $producto->get("PROD_IMAGEN"),
                    'INV_PROD_CANTIDAD' => $_POST['cantidad'],
                    'INV_PROD_ESTADO'   => 1,
                    'INV_INGRESO_ID'    => $ultimoingreso,
                    'INV_CATEGORIA_ID'  => $producto->get("PROD_CAT_ID"),
                    'INV_TIPO_ID'       => 2,
                );
                $ultimoidonventarioingresado = $this->inv->insertDirect($columnascrearinv);
                $this->inv->update($ultimoidonventarioingresado, array('INV_PROD_CODIGO' => $producto->get("PROD_CAT_ID") . $ultimoidonventarioingresado));
            }
        }

        $this->session->set_flashdata('Habilitar', 'Se ingresó correctamente el stock de este producto.');
        redirect('Gestion/ingreso', 'refresh');

    }

    public function recepcion()
    {
        //$data["solicitudes"] = $this->soli->findByArrayIN(array(3,5));
        $this->layouthelper->LoadView("gestion/recepcion", null);
    }

    public function recepcion_ajax()
    {
        $newarray    = array();
        $solicitudes = $this->soli->findByArrayIN(array(3, 5, 6));
        foreach ($solicitudes as $key => $value) {
            $usuario    = $this->usu->findById($value->get('SOL_USU_RUT'));
            $cargo      = $this->cargo->findById($usuario->get("USU_CARGO_ID"));
            $newarray[] = array(
                $value->get('SOL_ID'),
                $usuario->get("USU_NOMBRES") . "-" . $value->get('SOL_USU_RUT'),
                $value->get('SOL_FECHA_INICIO'),
                $value->get('SOL_FECHA_TERMINO'),
                $cargo->get("CARGO_NOMBRE"),
                "<a target='_blank' href='" . base_url() . "resources/pdf/" . $value->get('SOL_RUTA_PDF') . "' class='fa fa-file-pdf-o'></a>",
                "<button idsol='" . $value->get('SOL_ID') . "' class='getasignaciones btn btn-block btn-success' data-toggle='modal' data-target='#recproins' >Gestionar recepcion P/I</button>",

            );
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($newarray));
        //$this->layouthelper->LoadView("gestion/recepcion",$data);
    }

    public function rechazar_solicitud()
    {
        $idsolicitud = $this->input->post('idsolicitud');
        $this->soli->update($idsolicitud, array('SOL_ESTADO' => 2));
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("estado" => true, "mensaje" => "Se ha rechazado correctamente la solicitud N°" . $idsolicitud)));

    }

    public function get_all_asignaciones_by_sol()
    {
        $idsolicitud  = $_POST['idsolicitud'];
        $asignaciones = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $idsolicitud));

        if ($asignaciones != null) {
            $newarrayasign = array();
            foreach ($asignaciones as $key => $value) {
                $newarrayasign[] = array(
                    "ASIG_ID"            => $value['ASIG_ID'],
                    "ASIG_ESTADO"        => $value['ASIG_ESTADO'],
                    "ASIG_SOL_ID"        => $value['ASIG_SOL_ID'],
                    "ASIG_INV_ID"        => $value['ASIG_INV_ID'],
                    "ASIG_FECHA"         => $value['ASIG_FECHA'],
                    "ASIG_CANT"          => $value['ASIG_CANT'],
                    "ASIG_CANT_DEVUELTA" => $value['ASIG_CANT_DEVUELTA'],
                    "INV_ID"             => $value['INV_ID'],
                    "INV_PROD_ID"        => $value['INV_PROD_ID'],
                    "INV_PROD_NOM"       => $value['INV_PROD_NOM'],
                    "INV_PROD_CANTIDAD"  => $value['INV_PROD_CANTIDAD'],
                    "INV_PROD_ESTADO"    => $value['INV_PROD_ESTADO'],
                    "INV_PROD_CODIGO"    => $value['INV_PROD_CODIGO'],
                    "INV_INGRESO_ID"     => $value['INV_INGRESO_ID'],
                    "INV_FECHA"          => $value['INV_FECHA'],
                    "INV_IMAGEN"         => $value['INV_IMAGEN'],
                    "INV_TIPO_ID"        => $value['INV_TIPO_ID'],
                    "INV_CATEGORIA_ID"   => $value['INV_CATEGORIA_ID'],
                    "INV_ULTIMO_USUARIO" => $value['INV_ULTIMO_USUARIO'],
                    "INV_ACTUAL_USUARIO" => $value['INV_ACTUAL_USUARIO'],

                );
            }
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => true, "mensaje" => "Se ha cargado exitosamente la asignacion de esa solicitud", "allasig" => json_encode($newarrayasign))));
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("estado" => false, "mensaje" => "Lo sentimos esta solicitud no posee asignaciones de productos o insumos")));
        }

    }

    public function update_asignaciones_recepcionadas()
    {
        $cerrarono   = $_POST['resultadocerrarono'];
        $solicitudid = $_POST['idsol'];

        if (isset($_POST['idcheckeados'])) {
            $idcheckeados = $_POST['idcheckeados'];
            foreach ($idcheckeados as $key => $value) {
                $this->asignacion->update($value, array('ASIG_ESTADO' => 2));
                $asignacionobj = $this->asignacion->findById($value);
                $this->inv->update($asignacionobj->get('ASIG_INV_ID'), array('INV_PROD_ESTADO' => 1));
            }
        }

        if (isset($_POST['checkeadostipo2'])) {
            $checkmascantidadfungibles = $_POST['checkeadostipo2'];
            foreach ($checkmascantidadfungibles as $key => $value) {
                $this->asignacion->update($value['idasignacion'], array('ASIG_ESTADO' => 2, "ASIG_CANT_DEVUELTA" => $value['cantidad']));
                $asignacionobj = $this->asignacion->findById($value['idasignacion']);
                $inventarioobj = $this->inv->findById($asignacionobj->get('ASIG_INV_ID'));

                $ultimacantidad = $inventarioobj->get('INV_PROD_CANTIDAD'); //ultima cantidad en el inventario hay que sumarle los los devolvidos
                $ultimacantidad = intval($ultimacantidad) + intval($value['cantidad']);

                $this->inv->update($asignacionobj->get('ASIG_INV_ID'), array('INV_PROD_CANTIDAD' => $ultimacantidad));

                //$asignacionobj = $this->asignacion->findById($value['idasignacion']);
                //$this->inv->update($asignacionobj->get('ASIG_INV_ID'),array('INV_PROD_ESTADO'  => 1));
            }
        }

        if (!empty($_POST['nocheckeados']) && is_array($_POST['nocheckeados'])) {
            $nocheckeados = $_POST['nocheckeados'];
            foreach ($nocheckeados as $key => $value) {
                $this->asignacion->update($value, array('ASIG_ESTADO' => 3));
                $asignacionobj = $this->asignacion->findById($value);
                $inventarioobj = $this->inv->findById($asignacionobj->get('ASIG_INV_ID'));
                if ($inventarioobj->get("INV_TIPO_ID") == 1) {
                    $this->inv->update($asignacionobj->get('ASIG_INV_ID'), array('INV_PROD_ESTADO' => 3));
                } else if ($inventarioobj->get("INV_TIPO_ID") == 2) {
                    $actualcantidadasig = $asignacionobj->get('ASIG_CANT_DEVUELTA');
                    $actualcantidadinv  = $inventarioobj->get('INV_PROD_CANTIDAD');
                    $ultimoresul        = intval($actualcantidadinv) - intval($actualcantidadasig);
                    $this->asignacion->update($value, array('ASIG_ESTADO' => 3, "ASIG_CANT_DEVUELTA" => 0));
                    $this->inv->update($asignacionobj->get('ASIG_INV_ID'), array('INV_PROD_ESTADO' => 1, 'INV_PROD_CANTIDAD' => $ultimoresul));

                }
                $this->soli->update($solicitudid, array('SOL_ESTADO' => 3));
            }
        } else {
            $this->soli->update($solicitudid, array('SOL_ESTADO' => 4));
        }

        if ($_POST["flagrecepcionarocerrar"] == "reccer") {
            $this->soli->update($solicitudid, array('SOL_ESTADO' => 4));
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("estado" => true, "mensaje" => "Se ha guardado correctamente la recepcion de productos para esta solicitud")));
    }

    public function get_user_by_cargo_ajax()
    {
        $alluser  = array();
        $idcargo  = $_POST['idcargo'];
        $usuarios = $this->usu->findByArray(array("USU_CARGO_ID" => $idcargo));
        foreach ($usuarios as $key => $value) {
            $alluser[] = json_encode(array('RUT' => $value->get("USU_RUT"),
                'DV'                                 => $value->get("USU_DV"),
                'NOMBRES'                            => $value->get("USU_NOMBRES"),
                'APELLIDOS'                          => $value->get("USU_APELLIDOS"),
                'CARGO_ID'                           => $value->get("USU_CARGO_ID"),
                'CARRERA_ID'                         => $value->get("USU_CARRERA_ID"),
                'EMAIL'                              => $value->get("USU_EMAIL"),
                'TELEFONO1'                          => $value->get("USU_TELEFONO1"),
                'TELEFONO2'                          => $value->get("USU_TELEFONO2"),
                'CLAVE'                              => $value->get("USU_CLAVE"),
                'ESTADO'                             => $value->get("USU_ESTADO")));
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($alluser));
    }

    public function get_inv_by_cat_tipo_ajax()
    {
        $allinv     = array();
        $idtipo     = $_POST['idtipo'];
        $idcat      = $_POST['idcat'];
        $inventario = $this->inv->findByArray(array('INV_CATEGORIA_ID' => $idcat, 'INV_TIPO_ID' => $idtipo, 'INV_PROD_ESTADO' => 1));
        if ($inventario != null) {
            foreach ($inventario as $key => $value) {
                if ($value->get('INV_TIPO_ID') == 1) {
                    $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CODIGO'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        $value->get('INV_PROD_CANTIDAD'),
                        "<button type='button' tipo=" . $value->get('INV_TIPO_ID') . " cant=" . $value->get('INV_PROD_CANTIDAD') . " id=" . $value->get('INV_ID') . " nom='" . $value->get('INV_PROD_NOM') . "' class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
                } else if ($value->get('INV_TIPO_ID') == 2) {
                    $allinv[] = array($value->get('INV_ID'),
                        $value->get('INV_PROD_CODIGO'),
                        $value->get('INV_PROD_CANTIDAD'),
                        $value->get('INV_PROD_NOM'),
                        "<input type='number' min='1' max=" . $value->get('INV_PROD_CANTIDAD') . " id='INPUT" . $value->get('INV_ID') . "' class='form-control' >",
                        "<button type='button' tipo='" . $value->get('INV_TIPO_ID') . "' cant=" . $value->get('INV_PROD_CANTIDAD') . " id=" . $value->get('INV_ID') . " nom='" . $value->get('INV_PROD_NOM') . "' class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
                }
            }
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($allinv));
    }

    public function get_inv_by_productos_id()
    {
        $allinv                = array();
        $todoslosiddeproductos = array(0);
        if (isset($_POST['productosid'])) {
            $todoslosiddeproductos = $_POST['productosid'];
        }
        $inventario = $this->inv->findByArrayIN($todoslosiddeproductos, array('INV_PROD_ESTADO' => 1));
        //print_r($inventario);
        //exit();

        foreach ($inventario as $key => $value) {
            if ($value->get('INV_TIPO_ID') == 1) {
                $allinv[] = array($value->get('INV_ID'),
                    $value->get('INV_PROD_CODIGO'),
                    $value->get('INV_PROD_CANTIDAD'),
                    $value->get('INV_PROD_NOM'),
                    $value->get('INV_PROD_CANTIDAD'),
                    "<button type='button' prodid=" . $value->get('INV_PROD_ID') . " tipo=" . $value->get('INV_TIPO_ID') . " cant=" . $value->get('INV_PROD_CANTIDAD') . " id=" . $value->get('INV_ID') . " nom='" . $value->get('INV_PROD_NOM') . "' class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
            } else if ($value->get('INV_TIPO_ID') == 2) {
                $allinv[] = array($value->get('INV_ID'),
                    $value->get('INV_PROD_CODIGO'),
                    $value->get('INV_PROD_CANTIDAD'),
                    $value->get('INV_PROD_NOM'),
                    "<input type='number' min='1' max=" . $value->get('INV_PROD_CANTIDAD') . " id='INPUT" . $value->get('INV_ID') . "' class='form-control' >",
                    "<button type='button' prodid=" . $value->get('INV_PROD_ID') . " tipo='" . $value->get('INV_TIPO_ID') . "' cant=" . $value->get('INV_PROD_CANTIDAD') . " id=" . $value->get('INV_ID') . " nom='" . $value->get('INV_PROD_NOM') . "' class='ADDinv btn btn-block btn-success btn-flat fa fa-plus'></button>");
            }
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($allinv));
    }

    public function insert_entrega_manual()
    {
        $usersesion   = $this->session->userdata('logged_in');
        $asignaciones = $_POST["asignaciones"];
        if ($asignaciones != null) {
            $rutusu            = $_POST["rutusu"];
            $asignatura        = $_POST["asignatura"];
            $grupotrabajo      = $_POST["grupotrabajo"];
            $rangofechas       = $_POST["rangofechas"];
            $observaciones     = $_POST["observaciones"];
            $dividirfechas     = explode("-", $rangofechas);
            $dateinicio        = DateTime::createFromFormat("d/m/Y H:i:s", trim($dividirfechas[0]));
            $fechainicio       = $dateinicio->format('Y-m-d H:m:s');
            $datetermino       = DateTime::createFromFormat("d/m/Y H:i:s", trim($dividirfechas[1]));
            $fechatermino      = $datetermino->format("Y-m-d H:m:s");
            $columnassolicitud = array(
                'SOL_ID'            => 0,
                'SOL_USU_RUT'       => $rutusu,
                'SOL_ASIG_ID'       => $asignatura,
                'SOL_FECHA_INICIO'  => $fechainicio,
                'SOL_FECHA_TERMINO' => $fechatermino,
                'SOL_NRO_GRUPOTRAB' => $grupotrabajo,
                'SOL_OBSERVACION'   => $observaciones,
                'SOL_ESTADO'        => 5,
            );
            $nuevasolicitud  = $this->soli->create($columnassolicitud);
            $ultimasolicitud = $nuevasolicitud->insert();

            $this->soli->insertlog(array("LOGESTSOL_ESTADO" => 5, "LOGESTSOL_USU_RUT" => $usersesion['rut'], "LOGESTSOL_SOL_ID" => $ultimasolicitud));

            //SE INSERTA UN DETALLE SOLO PARA INDICAR QUE ESA SOLICITUD FUE MANUAL, Y SOLO SE ASIGNARON INSUMO Y PRODUCTOS DIRECTAMENTE.
            //PUEDE QUE ESTE DEMAS ESTAS LINEAS DE CODIGO PERO LO VEREMOS MAS ADELANTE.
            $columnadetsol = array(
                'DETSOL_ID'       => 0,
                'DETSOL_TIPOPROD' => null,
                'DETSOL_CANTIDAD' => 0,
                'DETSOL_ESTADO'   => 5,
                'DETSOL_SOL_ID'   => $ultimasolicitud,
                'DETSOL_PROD_ID'  => null,
            );
            $nuevodetalle  = $this->detsol->create($columnadetsol);
            $ultimodetalle = $nuevodetalle->insert();
            //HASTA AQUI NOSE AUN SI VOY A DEJAR ESTAS LINEAS DE CODIGO

            foreach ($asignaciones as $key => $value) {
                $columnasignacion = array(
                    'ASIG_ID'     => 0,
                    'ASIG_ESTADO' => 1,
                    'ASIG_SOL_ID' => $ultimasolicitud,
                    'ASIG_INV_ID' => $value["idinv"],
                    'ASIG_FECHA'  => date("Y-m-d H:i:s"),
                    'ASIG_CANT'   => $value["cantidadinv"],
                );
                $nuevaasignacion  = $this->asignacion->create($columnasignacion);
                $ultimaasignacion = $nuevaasignacion->insert();
                $this->asignacion->insertlog(array("LOGESTASIG_ASIG_ID" => $ultimaasignacion, "LOGESTASIG_USU_RUT" => $usersesion['rut'], "LOGESTASIG_ESTADO" => 1));
                if ($ultimaasignacion > 0) {
                    $inventario = $this->inv->findById($value["idinv"]);
                    if ($inventario->get("INV_TIPO_ID") == 1) {
                        $columnasaeditar = array(
                            'INV_PROD_ESTADO'    => 3,
                            'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                            'INV_ACTUAL_USUARIO' => $rutusu,
                        );
                        $inventario->update($value["idinv"], $columnasaeditar);
                    } else if ($inventario->get("INV_TIPO_ID") == 2) {
                        $columnasaeditar = array(
                            'INV_PROD_CANTIDAD'  => intval($inventario->get("INV_PROD_CANTIDAD")) - intval($value["cantidadinv"]),
                            'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                            'INV_ACTUAL_USUARIO' => $rutusu,
                        );
                        $inventario->update($value["idinv"], $columnasaeditar);
                    }
                }
            }
            $cargo                   = "";
            $usurutsolicitante       = "";
            $asignaturanombre        = "";
            $usuario                 = $this->usu->findById($rutusu);
            $verificardocenteoalumno = $usuario->get("USU_CARGO_ID");
            if ($verificardocenteoalumno == 1) {
                $cargo = "ESTUDIANTE";
            }

            if ($verificardocenteoalumno == 2) {
                $cargo = "DOCENTE";
            }

            $asignaturaobj              = $this->asig->findById($asignatura);
            $asignaturanombre           = $asignaturaobj->get("ASIGNATURA_NOMBRE");
            $nombreapellidossolicitante = $usuario->get("USU_NOMBRES") . ' ' . $usuario->get("USU_APELLIDOS");
            $usurutsolicitante          = $usuario->get("USU_RUT") . "-" . $usuario->get("USU_DV");

            $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
            $pdf->SetFont('dejavusans', '', 7, '', true);
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Solicitud de prestamos N°' . $ultimasolicitud, "");
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->AddPage();

            $asignacionesactuales = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $ultimasolicitud));
            // print_r($asignacionesactuales);

            $htmlpdf = $pdf->HTMLPDFSOLICITUD($ultimasolicitud, $cargo, $nombreapellidossolicitante, $asignaturanombre, $dividirfechas[0], $dividirfechas[1], $observaciones, $grupotrabajo, $usersesion['nombres'], $asignacionesactuales, $usurutsolicitante);

            $pdf->writeHTML($htmlpdf, true, false, true, false, '');
            ob_clean();
            $rutasavePDF = FCPATH . 'resources/pdf/SOLICITUD' . $ultimasolicitud . '-' . $rutusu . ".pdf";
            $this->soli->update($ultimasolicitud, array('SOL_RUTA_PDF' => "SOLICITUD" . $ultimasolicitud . '-' . $rutusu . ".pdf"));
            $rutaAJAX = '/iPanol/resources/pdf/SOLICITUD' . $ultimasolicitud . '-' . $rutusu . ".pdf";
            $pdf->Output($rutasavePDF, 'F');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("resultado" => true, "mensaje" => "Se ha creado correctamente la asignación para esta solicitud", "path" => $rutaAJAX)));
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("resultado" => false, "mensaje" => "La solicitud ingresada no tiene asignaciones de inventario")));
        }

    }

    public function insert_entrega_digital()
    {
        $usersesion   = $this->session->userdata('logged_in');
        $asignaciones = $_POST["asignaciones"];
        //if ($asignaciones != null) {
        $cerraroparcial = $_POST["parcialocerrar"];
        $idsolicitud    = $_POST["idsolicitud"];
        $solicitud      = $this->soli->findById($idsolicitud);
        $rutusu         = $solicitud->get("SOL_USU_RUT");
        $asignatura     = $solicitud->get("SOL_ASIG_ID");
        $grupotrabajo   = $solicitud->get("SOL_NRO_GRUPOTRAB");
        $observaciones  = $_POST["observaciones"];
        $dateinicio     = DateTime::createFromFormat("Y-m-d H:i:s", $solicitud->get("SOL_FECHA_INICIO"));
        $fechainicio    = $dateinicio->format('d-m-Y H:i:s');
        $datetermino    = DateTime::createFromFormat("Y-m-d H:i:s", $solicitud->get("SOL_FECHA_TERMINO"));
        $fechatermino   = $datetermino->format("d-m-Y H:i:s");

        $detallesol = $this->detsol->findByArray(array('DETSOL_SOL_ID' => $idsolicitud));
        foreach ($detallesol as $key => $value) {
            foreach ($asignaciones as $key2 => $value2) {
                if ($value->get("DETSOL_PROD_ID") == $value2["idprod"]) {
                    $this->detsol->update($value->get("DETSOL_ID"), array('DETSOL_ESTADO' => 3));
                }
            }
        }
        foreach ($asignaciones as $key => $value) {
            $columnasignacion = array(
                'ASIG_ID'     => 0,
                'ASIG_ESTADO' => 1,
                'ASIG_SOL_ID' => $idsolicitud,
                'ASIG_INV_ID' => $value["idinv"],
                'ASIG_FECHA'  => date("Y-m-d H:i:s"),
                'ASIG_CANT'   => $value["cantidadinv"],
            );
            $nuevaasignacion  = $this->asignacion->create($columnasignacion);
            $ultimaasignacion = $nuevaasignacion->insert();
            $this->asignacion->insertlog(array("LOGESTASIG_ASIG_ID" => $ultimaasignacion, "LOGESTASIG_USU_RUT" => $usersesion['rut'], "LOGESTASIG_ESTADO" => 1));

            if ($ultimaasignacion > 0) {
                $inventario = $this->inv->findById($value["idinv"]);
                if ($inventario->get("INV_TIPO_ID") == 1) {
                    $columnasaeditar = array(
                        'INV_PROD_ESTADO'    => 3,
                        'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                        'INV_ACTUAL_USUARIO' => $rutusu,
                    );
                    $inventario->update($value["idinv"], $columnasaeditar);
                } else if ($inventario->get("INV_TIPO_ID") == 2) {
                    $columnasaeditar = array(
                        'INV_PROD_CANTIDAD'  => intval($inventario->get("INV_PROD_CANTIDAD")) - intval($value["cantidadinv"]),
                        'INV_ULTIMO_USUARIO' => $inventario->get("INV_ACTUAL_USUARIO"),
                        'INV_ACTUAL_USUARIO' => $rutusu,
                    );
                    $inventario->update($value["idinv"], $columnasaeditar);
                }
            }

        }

        $detallesolverificar = $this->detsol->findByArray(array('DETSOL_SOL_ID' => $idsolicitud));
        $b                   = 0;
        $i                   = 0;
        foreach ($detallesolverificar as $key => $value) {
            $i++;
            if ($value->get("DETSOL_ESTADO") == 3) {
                $b++;
            }
        }

        if ($b == $i) {
            $this->soli->update($idsolicitud, array('SOL_ESTADO' => 3));
            $this->soli->insertlog(array("LOGESTASIG_ID" => 0, "LOGESTSOL_ESTADO" => 3, "LOGESTSOL_USU_RUT" => $usersesion['rut'], "LOGESTSOL_SOL_ID" => $idsolicitud));
        } else {
            if ($cerraroparcial == "asignarcerrar") {
                $this->soli->update($idsolicitud, array('SOL_ESTADO' => 3));
                $this->soli->insertlog(array("LOGESTASIG_ID" => 0, "LOGESTSOL_ESTADO" => 3, "LOGESTSOL_USU_RUT" => $usersesion['rut'], "LOGESTSOL_SOL_ID" => $idsolicitud));
            } else if ($cerraroparcial == "asignarparcial") {
                $this->soli->update($idsolicitud, array('SOL_ESTADO' => 7));
                $this->soli->insertlog(array("LOGESTASIG_ID" => 0, "LOGESTSOL_ESTADO" => 7, "LOGESTSOL_USU_RUT" => $usersesion['rut'], "LOGESTSOL_SOL_ID" => $idsolicitud));
            }

        }

        $cargo                   = "";
        $usurutsolicitante       = "";
        $asignaturanombre        = "";
        $usuario                 = $this->usu->findById($rutusu);
        $verificardocenteoalumno = $usuario->get("USU_CARGO_ID");
        if ($verificardocenteoalumno == 1) {
            $cargo = "ESTUDIANTE";
        }

        if ($verificardocenteoalumno == 2) {
            $cargo = "DOCENTE";
        }

        $asignaturaobj              = $this->asig->findById($asignatura);
        $asignaturanombre           = $asignaturaobj->get("ASIGNATURA_NOMBRE");
        $nombreapellidossolicitante = $usuario->get("USU_NOMBRES") . ' ' . $usuario->get("USU_APELLIDOS");
        $usurutsolicitante          = $usuario->get("USU_RUT") . "-" . $usuario->get("USU_DV");
        $pdf                        = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   Solicitud de prestamos N°' . $idsolicitud, "");
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        $asignacionesactuales = $this->asignacion->findByArray(array('ASIG_SOL_ID' => $idsolicitud));

        $htmlpdf = $pdf->HTMLPDFSOLICITUD($idsolicitud, $cargo, $nombreapellidossolicitante, $asignaturanombre, $fechainicio, $fechatermino, $observaciones, $grupotrabajo, $usersesion['nombres'], $asignacionesactuales, $usurutsolicitante);

        $pdf->writeHTML($htmlpdf, true, false, true, false, '');
        ob_clean();
        $rutasavePDF = FCPATH . 'resources/pdf/SOLICITUD' . $idsolicitud . '-' . $rutusu . ".pdf";
        $this->soli->update($idsolicitud, array('SOL_RUTA_PDF' => "SOLICITUD" . $idsolicitud . '-' . $rutusu . ".pdf"));
        $rutaAJAX = '/iPanol/resources/pdf/SOLICITUD' . $idsolicitud . '-' . $rutusu . ".pdf";
        $pdf->Output($rutasavePDF, 'F');
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("resultado" => true, "mensaje" => "Se ha creado correctamente la asignación para esta solicitud", "path" => $rutaAJAX)));
        // }else{
        // $this->output->set_content_type('application/json');
        // $this->output->set_output(json_encode(array("resultado" => false ,"mensaje" => "La solicitud ingresada no tiene asignaciones de inventario")));
        // }

    }

    /* End of file gestion.php */
    /* Location: ./application/controllers/gestion.php */
    public function validar()
    {
        $nomProd = $_POST['nombreProducto'];
        $this->db->from('inventario');
        $this->db->where('INV_PROD_NOM', $nomProd);
        $query    = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount == 0) {
            $val = 0;
        } else {
            $val = 1;
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array("val" => $val)));
    }

    public function codigos()
    {
        /*cod de barra activos*/
        $NuevoProductoActivo = array();
        $productos           = $this->prod->findByTipProdYEstado(1, 1);
        foreach ($productos as $key => $value) {
            $NuevoProductoActivo[] = array(
                'PROD_ID'            => $value->get('PROD_ID'),
                'PROD_NOMBRE'        => $value->get('PROD_NOMBRE'),
                'PROD_STOCK_TOTAL'   => $value->get('PROD_STOCK_TOTAL'),
                'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
                'PROD_CAT_ID'        => $this->cat->findById($value->get('PROD_CAT_ID')),
                'PROD_TIPOPROD_ID'   => $this->tipoP->findById($value->get('PROD_TIPOPROD_ID')),
                'PROD_POSICION'      => $value->get('PROD_POSICION'),
                'PROD_PRIORIDAD'     => $value->get('PROD_PRIORIDAD'),
                'PROD_STOCK_OPTIMO'  => $value->get('PROD_STOCK_OPTIMO'),
                'PROD_DIAS_ANTIC'    => $value->get('PROD_DIAS_ANTIC'),
                'PROD_IMAGEN'        => $value->get('PROD_IMAGEN'),
                'PROD_ESTADO'        => $value->get('PROD_ESTADO'),
            );
            $datos['productosActivos'] = $NuevoProductoActivo;
        }
        /*cod de barra activos*/

        /*cod de barra Fungibles*/
        $NuevoProductoFungible = array();
        $productos             = $this->prod->findByTipProdYEstado(2, 1);
        foreach ($productos as $key => $value) {
            $NuevoProductoFungible[] = array(
                'PROD_ID'            => $value->get('PROD_ID'),
                'PROD_NOMBRE'        => $value->get('PROD_NOMBRE'),
                'PROD_STOCK_TOTAL'   => $value->get('PROD_STOCK_TOTAL'),
                'PROD_STOCK_CRITICO' => $value->get('PROD_STOCK_CRITICO'),
                'PROD_CAT_ID'        => $this->cat->findById($value->get('PROD_CAT_ID')),
                'PROD_TIPOPROD_ID'   => $this->tipoP->findById($value->get('PROD_TIPOPROD_ID')),
                'PROD_POSICION'      => $value->get('PROD_POSICION'),
                'PROD_PRIORIDAD'     => $value->get('PROD_PRIORIDAD'),
                'PROD_STOCK_OPTIMO'  => $value->get('PROD_STOCK_OPTIMO'),
                'PROD_DIAS_ANTIC'    => $value->get('PROD_DIAS_ANTIC'),
                'PROD_IMAGEN'        => $value->get('PROD_IMAGEN'),
                'PROD_ESTADO'        => $value->get('PROD_ESTADO'),
            );
            $datos['productosFungibles'] = $NuevoProductoFungible;
        }
        /*cod de barra Fungibles*/
        $datos['categorias'] = $this->cat->findAll();
        $datos['tipos']      = $this->tipoP->findAll();
        $this->layouthelper->LoadView("gestion/codigos", $datos);
    }

    public function generarPDFGeneral()
    {

        $nomProd = $_POST["idBarcode"];

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Códigos de barra en general'); //Titlo del pdf
        $pdf->setPrintHeader(false); //No se imprime cabecera
        $pdf->setPrintFooter(true); //No se imprime pie de pagina
        $pdf->SetMargins(10, 10, 10, false); //Se define margenes izquierdo, alto, derecho
        $pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Definir el quiebre de la paguina
        $pdf->SetFont('Helvetica', '', 10); //Estilo de fuente
        $style = array(
            'position'     => '',
            'align'        => 'C',
            'stretch'      => false,
            'fitwidth'     => false,
            'cellfitalign' => 'C',
            'border'       => true,
            'vpadding'     => 20,
            'fgcolor'      => array(0, 0, 0),
            'bgcolor'      => false, //array(255,255,255),
            'text'         => true,
            'font'         => 'helvetica',
            'fontsize'     => 8,
            'stretchtext'  => 4,
        );
        $pdf->addPage();

        $this->db->where('INV_PROD_NOM', $nomProd);
        $query = $this->db->get('inventario');
        $html  = "";
        foreach ($query->result_array() as $row) {
            $barcode = $row['INV_PROD_CODIGO'];
            $nombre  = $row['INV_PROD_NOM'];

            $html = '<table style="width: 50%; display:table;" border="1" cellpadding="5">
                    <tr>
                      <td bgcolor="#E6E6E6" style="height:51px; text-align:center; top: 50%;">
                        <br><br><b>' . $nombre . ' </b>
                      </td>
                    </tr>
                   </table>';
            $pdf->write1DBarcode($barcode, 'C39', 105, '', 90, 18, 0.4, $style, 'N');

            $pdf->Ln(-18);
            $pdf->writeHTML($html, true, 0, true, 0);
        }
        $pdf->lastPage();
        $val   = array('/', "-", ":", "¿", "?");
        $texto = str_replace($val, " ", $nomProd);

        $carp = FCPATH . 'resources/pdf/barcode/';
        if (file_exists($carp)) {

            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $texto . '.pdf';
            $pdf->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $texto . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        } else {

            mkdir(FCPATH . 'resources/pdf/barcode/', 0700);
            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $texto . '.pdf';
            $pdf->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $texto . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        }
    }

    public function eliminarPDF()
    {
        $rutasavePDF = $_POST['path'];
        unlink($rutasavePDF);
    }

    public function generarPDFunitario()
    {

        $idInv         = $_POST['idInv'];
        $id            = 0;
        $nombre        = "";
        $barcode       = 0;
        $nombreArchivo = "";

        $pdf2 = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf2->SetTitle('Código de barra unitario'); //Titlo del pdf
        $pdf2->setPrintHeader(false); //No se imprime cabecera
        $pdf2->setPrintFooter(true); //No se imprime pie de pagina
        $pdf2->SetMargins(10, 10, 10, false); //Se define margenes izquierdo, alto, derecho
        $pdf2->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
        $pdf2->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Definir el quiebre de la paguina
        $pdf2->SetFont('Helvetica', '', 10); //Estilo de fuente
        $style = array(
            'position'     => '',
            'align'        => 'C',
            'stretch'      => false,
            'fitwidth'     => false,
            'cellfitalign' => 'C',
            'border'       => true,
            'vpadding'     => 20,
            'fgcolor'      => array(0, 0, 0),
            'bgcolor'      => false, //array(255,255,255),
            'text'         => true,
            'font'         => 'helvetica',
            'fontsize'     => 8,
            'stretchtext'  => 4,
        );
        $pdf2->addPage();

        $this->db->where('INV_ID', $idInv);
        $query = $this->db->get('inventario');
        $html  = "";
        foreach ($query->result_array() as $row) {
            $barcode       = $row["INV_PROD_CODIGO"];
            $nombre        = $row["INV_PROD_NOM"];
            $id            = $row["INV_ID"];
            $nombreArchivo = str_replace(' ', '', $nombre) . "-" . $id;

            $html = '<table style="width: 50%; display:table;" border="1" cellpadding="5">
                    <tr>
                      <td bgcolor="#E6E6E6" style="height:51px; text-align:center; top: 50%;">
                        <br><br><b>' . $nombre . ' </b>
                      </td>
                    </tr>
                   </table>';
            $pdf2->write1DBarcode($barcode, 'C39', 105, '', 90, 18, 0.4, $style, 'N');

            $pdf2->Ln(-18);
            $pdf2->writeHTML($html, true, 0, true, 0);
        }
        $val   = array('/', "-", ":", "¿", "?");
        $texto = str_replace($val, " ", $nombreArchivo);

        $carp = FCPATH . 'resources/pdf/barcode/';
        if (file_exists($carp)) {

            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $texto . '.pdf';
            $pdf2->lastPage();
            $pdf2->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $texto . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        } else {

            mkdir(FCPATH . 'resources/pdf/barcode/', 0700);
            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $texto . '.pdf';
            $pdf2->lastPage();
            $pdf2->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $texto . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        }
    }

    public function generarPDFseleccionado()
    {

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Códigos de barra seleccionados'); //Titlo del pdf
        $pdf->setPrintHeader(false); //No se imprime cabecera
        $pdf->setPrintFooter(true); //No se imprime pie de pagina
        $pdf->SetMargins(10, 10, 10, false); //Se define margenes izquierdo, alto, derecho
        $pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Definir el quiebre de la paguina
        $pdf->SetFont('Helvetica', '', 10); //Estilo de fuente
        $style = array(
            'position'     => '',
            'align'        => 'C',
            'stretch'      => false,
            'fitwidth'     => false,
            'cellfitalign' => 'C',
            'border'       => true,
            'vpadding'     => 20,
            'fgcolor'      => array(0, 0, 0),
            'bgcolor'      => false, //array(255,255,255),
            'text'         => true,
            'font'         => 'helvetica',
            'fontsize'     => 8,
            'stretchtext'  => 4,
        );
        $pdf->addPage();

        /*va juntooooo*/
        $data = array();
        $data = $_POST['data'];
        $cant = count($data);
        $html = "";
        if (isset($data)) {
            $we = 0;
            for ($i = 0; $i < $cant; $i++) {
                $this->db->where('INV_ID', $data[$i]);
                $variable = $this->db->get('inventario');
                foreach ($variable->result() as $row) {
                    $nombre  = $row->INV_PROD_NOM;
                    $barcode = $row->INV_PROD_CODIGO;
                    $html    = '<table style="width: 50%; display:table;" border="1" cellpadding="5">
                    <tr>
                      <td bgcolor="#E6E6E6" style="height:51px; text-align:center; top: 50%;">
                        <br><br><b>' . $nombre . ' </b>
                      </td>
                    </tr>
                   </table>';
                    $pdf->write1DBarcode($barcode, 'C39', 105, '', 90, 18, 0.4, $style, 'N');

                    $pdf->Ln(-18);
                    $pdf->writeHTML($html, true, 0, true, 0);
                }
                ++$we;
            }
        }
        /*va juntooooo*/

        date_default_timezone_set("Chile/Continental");
        $fecha = date("d-m-Y-h-i-s", time());

        $carp = FCPATH . 'resources/pdf/barcode/';
        if (file_exists($carp)) {

            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $fecha . '.pdf';
            $pdf->lastPage();
            $pdf->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $fecha . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        } else {

            mkdir(FCPATH . 'resources/pdf/barcode/', 0700);
            $rutasavePDF = FCPATH . 'resources/pdf/barcode/' . $fecha . '.pdf';
            $pdf->lastPage();
            $pdf->output($rutasavePDF, 'F');
            $rutaAJAX = base_url() . 'resources/pdf/barcode/' . $fecha . '.pdf';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array("path" => $rutaAJAX)));

        }

    }

    public function traerProductosByIdTipo()
    {
        $tipoP        = $_POST['idTipo'];
        $todoProByCat = $this->prod->findByTipProdYEstado($tipoP, 1);
        $arrayProd    = array();
        foreach ($todoProByCat as $key => $value) {
            $arrayProd[] = array("id" => $value->get('PROD_ID'), "nombre" => $value->get('PROD_ID') . " - " . $value->get('PROD_NOMBRE'));
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($arrayProd));
    }

    public function traerInventarioByIdTipoYCategoria()
    {
        $tipoC = $_POST['idTipo'];

        /*cod de barra Fungibles y Activos segun $_POST*/
        $NuevoProductoFungible = array();
        $productos             = $this->inv->findByTipProdYEstado($tipoC, 1);
        foreach ($productos as $key => $value) {
            $NuevoProducto[] = array(
                'INV_ID'             => $value->get('INV_ID'),
                'INV_PROD_ID'        => $value->get('INV_PROD_ID'),
                'INV_PROD_NOM'       => $value->get('INV_PROD_NOM'),
                'INV_PROD_CANTIDAD'  => $value->get('INV_PROD_CANTIDAD'),
                'INV_PROD_ESTADO'    => $value->get('INV_PROD_ESTADO'),
                'INV_PROD_CODIGO'    => $value->get('INV_PROD_CODIGO'),
                'INV_INGRESO_ID'     => $value->get('INV_INGRESO_ID'),
                'INV_CATEGORIA_ID'   => $value->get('INV_CATEGORIA_ID'),
                'INV_TIPO_ID'        => $value->get('INV_TIPO_ID'),
                'INV_FECHA'          => $value->get('INV_FECHA'),
                'INV_IMAGEN'         => $value->get('INV_ID'),
                'INV_ULTIMO_USUARIO' => $value->get('INV_ULTIMO_USUARIO'),
                'INV_ACTUAL_USUARIO' => $value->get('INV_ACTUAL_USUARIO'),
            );
        }
        /*cod de barra Fungibles y Activos segun $_POST*/

        $todoProByTipo = $NuevoProducto;
        $arrayInv      = array();
        foreach ($todoProByTipo as $key => $value) {
            $arrayInv[] = array("
          <form id='formid' method='post' accept-charset='utf-8'>
              <input value=" . $value['INV_ID'] . " class='items' type='checkbox'>
          </form>
              ",
                $value['INV_ID'],
                $value['INV_PROD_NOM'],
                '<button id="" name="" value=' . $value['INV_ID'] . ' type="button" class="barcode xd btn btn-danger btn-block">
              <i class="fa fa-barcode"></i></button>',
            );
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($arrayInv));
    }

    public function editar_ingreso()
    {
        $idingreso = $_POST["idingreso"];
        $ocom      = null;
        $proveedor = null;
        $vidautil  = null;
        $desc      = null;
        if (isset($_POST["odecompraedit"]) and $_POST["odecompraedit"] != "") {
            $ocom = $_POST["odecompraedit"];
        }

        if (isset($_POST["descedit"]) and $_POST["descedit"] != "") {
            $desc = $_POST["descedit"];
        }

        if (isset($_POST["vidautiledit"]) and $_POST["vidautiledit"] != "") {
            $vidautil = $_POST["vidautiledit"];
        }

        if (isset($_POST["proveedor"]) and $_POST["proveedor"] != "") {
            $proveedor = $_POST["proveedor"];
        }

        $_columns = array(
            'ING_ORDEN_COMPRA'        => $ocom,
            'ING_DESC'                => $desc,
            'ING_VIDA_UTIL_PROVEEDOR' => $vidautil,
            'ING_PROV_RUT'            => $proveedor,
        );
        $this->ing->update($idingreso, $_columns);
        $this->session->set_flashdata('Habilitar', 'Ingreso actualizado correctamente');
        redirect('Gestion/ingreso', 'refresh');
    }

    public function cargar_detalle_ingreso_ajax()
    {
        $idingreso = $_POST["idingreso"];
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($this->ing->findById($idingreso)->toArray()));
    }

    public function Solicitudes()
    {
        $datos['Solicitudes'] = $this->soli->findEstados();
        $this->layouthelper->LoadView("gestion/solicitudes", $datos);
    }

    public function CambiarEstadoSOL($estado, $id)
    {
        if ($estado == 1) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 2));
            redirect('gestion/Solicitudes');
        } elseif ($estado == 2) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 1));
            redirect('gestion/Solicitudes');
        } elseif ($estado == 3) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 7));
            redirect('gestion/Solicitudes');
        } elseif ($estado == 4) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 6));
            redirect('gestion/Solicitudes');
        } elseif ($estado == 6) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 4));
            redirect('gestion/Solicitudes');
        } elseif ($estado == 7) {
            $this->session->set_flashdata('Update', 'Se Cambio el ESTADO Correctamente');
            $this->soli->update($id, array('SOL_ESTADO' => 3));
            redirect('gestion/Solicitudes');
        }
    }

}
