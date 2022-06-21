<form action="assinatura_SAME/consulta/sql_cadastrar_documento.php" method="POST">
                <div class="div_br"> </div>
                
                <div class="row">
                    <div class="col-md-8">
                        Paciente:
                        <input type="text" class="form-control" name="frm_paciente_nome" value="<?php echo $var_nm_paciente;?>" readonly>
                        <input type="hidden" class="form-control" name="frm_cd_paciente" value="<?php echo $var_cd_paciente;?>" readonly>
                    </div>

                    <div class="col-md-2">
                        RG:
                        <input type="text" class="form-control" name="frm_paciente_rg" value="<?php echo $var_rg;?>" readonly>
                    </div>                       

                    <div class="col-md-2">
                        CPF:
                        <input type="number" class="form-control" name="frm_paciente_cpf" value="<?php echo $var_cpf;?>" readonly>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-3">
                        Data de Nascimento:
                        <input type="text" class="form-control" name="frm_paciente_nascimento"  value="<?php echo $var_dt_nascimento;?>" readonly>
                    </div>

                    <div class="col-md-4">
                        Périodo de Internação:
                        <input type="date" class="form-control" name="frm_paciente_periodo_min" required>
                    </div>

                    <div  style="padding-top: 30px;">
                        há
                    </div>

                    <div class="col-md-4">
                         
                        <input type="date" class="form-control" name="frm_paciente_periodo_max" required>
                    </div>
                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <!--TITULO REQUERENTE-->
                <div class="fnd_azul" id="fnd_azul">     
                <i class="fa-solid fa-user"></i> Dados do Requerente 
                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Paciente" checked>
                            <label class="form-check-label" for="flexRadio_Paciente">
                                Paciente
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_RepresentanteLegal" >
                            <label class="form-check-label" for="flexRadio_RepresentanteLegal">
                                Representante Legal
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Tutor" >
                            <label class="form-check-label" for="flexRadio_Tutor">
                                Tutor ou Curador
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Parente" >
                            <label class="form-check-label" for="flexRadio_Parente">
                                Parente  
                            </label>
                             <?php include 'assinatura_SAME/filtro/include_filtro_parente.php';?>
                        </div>

                        <!-- PASSA O VALOR SELECIONADO PARA PROXIMA PAGINA-->
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" name="frm_radio_escolha" id="js_radio_escolha" value="" readonly>
                        </div>
                    </div>
                </div>

                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-6">
                        Nome:
                        <input type="text" class="form-control" name="frm_requerente_nome" value="" id="js_frm_nome" required>
                    </div>

                    <div class="col-md-3">
                        RG:
                        <input type="text" class="form-control" name="frm_requerente_rg" value="" id="js_frm_rg" required>
                    </div>

                    <div class="col-md-3">
                        CPF:
                        <input type="text" class="form-control" name="frm_requerente_cpf" value="" id="js_frm_cpf" required>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-3">
                        Data de Nascimento:
                        <input type="date" class="form-control" name="frm_requerente_nascimento" value="" id="js_frm_nascimento" required>
                    </div>

                    <div class="col-md-3">
                        Estado Civil:
                        <input type="text" class="form-control" name="frm_requerente_estado_civil" value="" id="js_frm_estado_civil" required>
                    </div>

                    <div class="col-md-6">
                        Profissão:
                        <input type="text" class="form-control" name="frm_requerente_profissao" value="" id="js_frm_profissao" required>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-2">
                        CEP:
                        <input type="text" class="form-control" name="frm_requerente_cep" value="" id="cep" maxlength="9" placeholder=" " required>
                    </div>

                    <div class="col-md-5">
                        Cidade:
                        <input type="text" class="form-control" name="frm_requerente_cidade" value="" id="cidade" required>
                    </div>

                    <div class="col-md-5">
                        Estado:
                        <input type="text" class="form-control" name="frm_requerente_estado" value="" id="uf" required>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-6">
                        Rua:
                        <input type="text" class="form-control" name="frm_requerente_rua" value="" id="endereco" required>
                    </div>

                    <div class="col-md-6">
                        Bairro:
                        <input type="text" class="form-control" name="frm_requerente_bairro" value="" id="bairro" required>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-4">
                        Telefone Primário:
                        <input type="number" class="form-control" name="frm_requerente_tel_primario" value="" required>
                    </div>

                    <div class="col-md-4">
                        Telefone Secundário:
                        <input type="number" class="form-control" name="frm_requerente_tel_secundario" value="" required>
                    </div>

                    
                    <div class="col-md-4">
                        Telefone Terciário:
                        <input type="number" class="form-control" name="frm_requerente_tel_terciario" value="" required>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-12">
                        Motivo do Requerimento:
                        <textarea class="form-control" name="frm_requerente_motivo" id="" rows="3" required></textarea>
                    </div>

                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Cadastrar</button>

            </form>