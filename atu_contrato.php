
<?php
$id_contrato = filter_input(INPUT_GET, 'id_contrato', FILTER_SANITIZE_NUMBER_INT);
require_once 'menu.php';
require_once'Funcoes/func_data.php';
require_once 'database_gac.php';

$assunt = '<i class="far fa-handshake"></i> ' . ' Atualizar Contrato';


$sqlcontrato = "SELECT * FROM contrato WHERE id_contrato = $id_contrato";
$resultado = mysqli_query($conection, $sqlcontrato)or die('Não foi possivel conectar ao MySQL');
while ($registro = mysqli_fetch_array($resultado)) {
    $for = $registro['id_prestador'];
    $rg = $registro['rg'];
    $RS = $registro['d_fim_vige_cont'];
    ?>       


    <!doctype html>
    <html lang="pt-br">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
            <link rel="stylesheet"  type="text/css" href="css/styleatucont.css" media="screen"/>
            <link rel="stylesheet" href="css/bootstrap.css" >
            <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>


            <script>
                var mask = {
                    money: function () {
                        var el = this
                                , exec = function (v) {
                                    v = v.replace(/\D/g, "");
                                    v = new String(Number(v));
                                    var len = v.length;
                                    if (1 == len)
                                        v = v.replace(/(\d)/, "0.0$1");
                                    else if (2 == len)
                                        v = v.replace(/(\d)/, "0.$1");
                                    else if (len > 2) {
                                        v = v.replace(/(\d{2})$/, '.$1');
                                    }
                                    return v;
                                };

                        setTimeout(function () {
                            el.value = exec(el.value);
                        }, 1);
                    }

                }

                $(function () {
                    $('#campovalor').bind('keypress', mask.money);
                    $('#campovalor').bind('keyup', mask.money);
                });

            </script>	
            <script>
                $(function () {
                    var cperi = $('.div1');
                    $('#customRadio2').click(function () {
                        cperi.hide('slow')
                    });
                });
                $(function () {
                    var cperi = $('.div1');
                    $('#customRadio1').click(function () {
                        cperi.show('slow')
                    });
                });
            </script>
            <script>
                $(function () {

                    var cprazo = $('.div2');

                    $('#customRadio5').click(function () {

                        cprazo.hide('slow')


                    });
                });
                $(function () {

                    var cprazo = $('.div2');

                    $('#customRadio4').click(function () {

                        cprazo.show('slow')


                    });
                });

                $(function () {

                    var cprazo = $('.div2');

                    $('#customRadio6').click(function () {

                        cprazo.show('slow')


                    });
                });

            </script>

        </head>
        <body style="background-color: #cfcfcf;" >
            <?php require_once 'image_header6.php'; ?>
            
           <div  class=" container-fluid    "  style="margin-top: 60px">
                <div  class="row  justify-content-center" >
                    <div class="col-md-10 ">

                        <?php
                        if (isset($_SESSION['msg12'])) {
                            echo $_SESSION['msg12'];
                            unset($_SESSION['msg12']);
                        }
                        ?>

                        <form id= "fmr1"  class="needs-validation"   action="proce_atu_contrato.php"  method="post" novalidate>
                            <div class="row">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                <div class="col-md-2 mb-3">
                                    <label for="tipo">TIPO</label>
                                    <div class="custom-control custom-radio">
                                        <input value= "AQUISIÇÃO" type="radio" id="customRadio4" name="tipo" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio4">AQUISIÇÃO</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input value="SERVIÇOS" type="radio" id="customRadio5" name="tipo" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio5">SERVIÇOS</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input value="SOLUÇÃO" type="radio" id="customRadio6" name="tipo" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio6">SOLUÇÃO</label>
                                    </div>						 	
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="cnatureza">ÁREA ADMINISTRADORA:</label>
                                    <select class="custom-select d-block w-100"  Type="text" name="natureza" id="cnatureza"   ><br />				
                                        <option selected><?php echo $registro['natureza'];?></option>
                                        <option value="GACAD">GACAD</option>
                                        <option value="GACAM">GACAM</option>						
                                    </select>
                                    <br/>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="cvig_contrat">MÉTODO CÁLCULO:</label>
                                    <select class="form-control"  Type="number" name="tip_chamado" id="ctip_chamado"  maxlength="40" value="<?php; ?>" >
                                        <optgroup label="TIPO DE CHAMADO">
                                            <option selected><?php echo $registro['tip_chamado']; ?></option>
                                            <option value= "1">1 - DO ATENDIMENTO</option>	
                                            <option value= "2">2 - DO CHAMADO</option>
                                        </optgroup>
                                    </select><p>	
                                </div> 
                                  <div class="form-group col-md-2">
                                    <label for="cmine">MINIMÔNICO:</label>
                                    <input class="form-control" Type="text" name="mine"  value="<?php echo $registro['mine']; ?>" >
                                </div>



                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="crg" >RG:</label>
                                    <input class="form-control" Type="text" name="rg" id="crg"  value="<?php echo $registro['rg']; ?>" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cstatus">STATUS:</label>
                                    <select class="custom-select d-block w-100" type="text" name="status" id="cstatus" value="<?php echo $registro['status']; ?>"  required>
                                        <option selected><?php echo $registro['status']; ?></option>
                                        <option value= "VIGENTE">VIGENTE</option>	
                                        <option value="VIGENTE/GARANTIA">VIGENTE/GARANTIA</option>
                                        <option value="ENCERRADO">ENCERRADO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="forn">ID-PRESTADOR/ FORNECEDOR:</label>
                                    <select class="form-control" id="forn" name="id_prestador" value="<?php echo $registro['id_prestador']; ?>" >
                                        <option selected><?php echo $registro['id_prestador']; ?></option>  
                                        <?php
                                        $q1 = "SELECT * FROM  prestador WHERE modo = '2'";
                                        $r1 = mysqli_query($conection, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            ?>
                                            <option value = "<?php echo $row ['id_prestador']; ?>"><?php echo $row['id_prestador'] . "-" . ""; ?><?php echo $row ['nome']; ?></option>
                                        <?php } ?>
                                    </select>	
                                </div>		


                                <div class="form-group col-md-2">
                                    <label for="cd_Assinatura">DATA DA ASSINATURA:</label>
                                    <input class="form-control" Type="Date" name="d_Assinatura" id="cd_Assinatura"  value="<?php echo $registro['d_Assinatura']; ?>" >
                                </div>
                            </div> 
                            <div class="form-row">				
                                <div class="form-group col-md-2">
                                    <label for="campovalor" >VALOR CONTRATADO:</label>			 
                                    <input class="form-control"  Type="text"   name="valor_Contratado" id="campovalor" value="<?php echo $registro['valor_Contratado']; ?>" >
                                </div> 
                                <div class="form-group col-md-10">
                                    <label for="cobjeto">OBEJTO:</label>
                                    <input class="form-control" Type="text" name="objeto" id="cobjeto" value="<?php echo $registro['objeto']; ?>" />
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="n_siscor" >SISCOR INICIAL:</label>
                                    <input class="form-control" Type="text" name="n_siscor" id="cn_siscor"  value="<?php echo $registro['n_siscor']; ?>" >
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="cprojeto_basico"  >PROJETO BÁSICO:</label>
                                    <input class="form-control" Type="text" name="projeto_basico" id="cprojeto_basico" value="<?php echo $registro['projeto_basico']; ?>" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="n_processo" >Nº PROCESSO:</label>
                                    <input class="form-control" Type="text" name="n_processo" id="cn_processo" size="15" maxlength="40" placeholder= "Nº Processo Verde"value="<?php echo $registro['n_processo']; ?>" />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="cvig_contrat"> VIGÊNCIA CONTRATUAL:</label>
                                    <input class="form-control" Type="number" name="vig_contrat" id="cvig_contrat" value="<?php echo $registro['vig_contrat']; ?>" >

                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="cd_Inic_vige_contr">INÍCIO VIG. CONTRATUAL:</label>
                                    <input class="form-control"  Type="Date" name="d_Inic_vige_contr" id="cd_Inic_vige_contr" size="40" maxlength="40" value="<?php echo $registro['d_Inic_vige_contr']; ?>">
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="cd_fim_vige_cont">FIM VIG. CONTRATUAL:</label>
                                    <input class="form-control"  Type="Date" name="d_fim_vige_cont" id="cd_fim_vige_cont" size="40" maxlength="40" value="<?php echo $registro['d_fim_vige_cont']; ?>">
                                </div> 




                            </div> 
                            <div class="row">
                                <div  class="col-md-2 mb-3 div2 "  >
                                    <label for="cprazo_entrega">DATA ENTREGA:</label>
                                    <input class="form-control" Type="date" name="prazo_entrega" id="cprazo_entrega"  value="<?php echo $registro['prazo_entrega']; ?>" >

                                </div>
                                <div class="col-md-2 mb-3  div2 ">
                                    <label for="cvig_garantia">PERIODO VIG GARANTIA:</label>
                                    <input class="form-control" Type="number" name="vig_garantia" min="1"  max="999" id="cvig_garantia" value="<?php echo $registro['vig_garantia']; ?>" >
                                </div>
                                <div class="col-md-2 mb-3 div2 ">
                                    <label for="cvig_garantia">INICIO VIG GARANTIA:</label>
                                    <input class="form-control" Type="date" name="d_recebimento" min="1"  max="999" id="cvig_garantia" value="<?php echo $registro['d_recebimento']; ?>" disabled>
                                </div>
                                <div class="col-md-2 mb-3  div2 ">
                                    <label for="cvig_garantia">FIM VIG GARANTIA:</label>
                                    <input class="form-control" Type="date" name="fim_vig_garat" min="1"  max="999" id="cvig_garantia" value="<?php echo $registro['fim_vig_garat']; ?>" disabled>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="pos_prorrogacao">PRORROGAÇÃO</label>
                                    <div class="custom-control custom-radio">
                                        <input value= "SIM" type="radio" id="customRadio1" name="pos_prorrogacao"  class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">SIM</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input value="NÃO" type="radio" id="customRadio2" name="pos_prorrogacao"  class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">NÃO</label>
                                    </div>		

                                </div> 

                                <div class="col-md-2 mb-3 div1">
                                    <label for="cd_prorro">DATA PRORROGAÇÃO:</label>
                                    <input class="form-control" Type="date" name="d_prorro"  id="cperi_Pror" value="<?php echo $registro['d_prorro']; ?>" >                   
                                </div>


                            </div>
                            <div class="row">


                            </div> 


                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="clink_pv">URL PROCESSO VERDE:</label>		  
                                    <input class="form-control" Type="url" name="link_pv" id="clink_pv"  value="<?php echo $registro['link_pv']; ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="clink_ged">URL GEDIG:</label>	
                                    <input class="form-control" Type="url" name="link_ged" id="clink_ged" value="<?php
                                    echo $registro['link_ged'];
                                    ;
                                    ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="clink_proscorm">URL PROPOSTA COMERCIAL:</label>	
                                    <input class="form-control" Type="url" name="link_proscorm" id="clink_proscorm" value="<?php echo $registro['link_proscorm']; ?>" >
                                </div>				
                                <div class="col-md-12 mb-3">
                                    <input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>" />
                                    <input type="submit" name="Prosseguir " value="Atualizar"  class="btn btn-outline-primary btn-lg" >
                                    <input type="hidden" name="submitted" value="TRUE" />
                                </div>

                            </div> 

                        </form>      	 
                    </div>
                </div>

            </div> 



            <?php
        }
        ?>


        <nav class="navbar fixed-bottom navbar-light bg-light">
<?php if (isset($id_contrato)) { ?>

                <a class="navbar-brand" href="idex.php?id=<?php echo $id_contrato; ?>">RETORNAR </a>

            <?php } else {
                ?>

                <a class="navbar-brand" href="lista_geral.php">RETORNAR </a>

                <?php
            }
            ?> 
        </nav>		
    </body>
</html>