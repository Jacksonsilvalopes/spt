<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecebimentoProvisorio
 *
 * @author jacks
 */
class UpdObservacao {
    private $Dados;
    private $User;
    private $Msg;
    private $Resultado;

    const Entity = 'aceite';

    public function ExeUpdate($id_aceite, array $Dados) {
        $this->aceite = (int) $id_aceite;
        $this->Dados = $Dados;

        $this->validarDados();
        if ($this->Resultado):
            $this->Alterar();
        endif;
    }

    public function gerResultado() {
        return $this->Resultado;
    }

    public function getMsg() {
        return $this->Msg;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);

        if (in_array('', $this->Dados)):
            $this->Resultado = false;
            $this->Msg = "<p style='color: red';><b>Erro ao alterar: </b>Para alterar o usuário preencha todos os campos! </p>";
        else:
           
            $this->Resultado = true;
        endif;
    }

    private function Alterar() {
        $Update = new Update();
        $Update->ExeUpdate(self::Entity, $this->Dados, "WHERE id_aceite = :id", "id={$this->aceite }");
        if ($Update->getResultado()):
            $this->Msg = "<p style='color: green';>Atualização executada com sucesso!</p>";
            $this->Resultado = true;
        else:
            $this->Msg = "<p style='color: red';>Erro ao atualizar</p>";
            $this->Resultado = false;
        endif;
    }

}
